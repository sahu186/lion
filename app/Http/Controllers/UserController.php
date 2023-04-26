<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Contact;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\User;
use App\Models\Wallet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function index()
    {
        $product = Product::paginate(6);
        return view('user.home', compact('product'));
    }
    public function addcart(Request $request, $id)
    {
        $user = auth()->user();
        $cart = new Cart();
        $product = Product::find($id);
        $cart->name = $user->name;
        $cart->email = $user->email;
        $cart->productname = $product->name;
        $cart->price = $product->price;
        $cart->description = $product->description;
        $cart->image = $product->image;
        $cart->quantity = $request->quantity;
        $cart->user_id = Auth::user()->id;

        $cart->save();
        return redirect()->back();
    }

    public function update(Request $request, $id)
    {
        $cartItem = Cart::find($id);
        $cartItem->quantity = $request->quantity;
        $cartItem->save();

        return redirect()->route('payment');
    }



    public function showcart()
    {
        $user = auth()->user();
        $cart = Cart::where('email', $user->email)->get();


        return view('user.showcart', compact('cart'));
    }

    public function deletecart($id)
    {
        $cart = Cart::find($id);
        $cart->delete();
        return redirect()->back();
    }

    public function payment()
    {
        $user_id = Auth::id(); // get the authenticated user's id
        $cart = Cart::where('user_id', $user_id)->get(); // get the user's cart items
        $showwallet = Wallet::where('user_id',$user_id)->sum('amount');
        return view('user.payment', ['cart' => $cart, 'showwallet' => $showwallet]);
    }


    public function placeorder(Request $request)
    {

        // Validate the form data
        $validate = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email',
            'phone' => 'required|min:10',
            'address' => 'required',
            'zipcode' => 'required',
            
        ]);

        // Get the ZIP code from the form submission
        $zipcode = $request->input('zipcode');

        // Make an HTTP request to the Postal PIN Code API
        $response = file_get_contents('https://api.postalpincode.in/pincode/' . $zipcode);

        // Parse the JSON response into an associative array
        $result = json_decode($response, true);

        // Check if the request was successful
        if ($result[0]['Status'] == 'Success') {
            // Get the city, state, and country from the response
            $city = $result[0]['PostOffice'][0]['District'];
            $state = $result[0]['PostOffice'][0]['State'];
            $country = $result[0]['PostOffice'][0]['Country'];

            // Set the values in the request object for use in the view
            $request->merge(compact('city', 'state', 'country'));
        }

        // Calculate the total price of the order
        $totalPrice = 0;
        $user_id = Auth::id();
        $cart = Cart::where('user_id', $user_id)->get();
        foreach ($cart as $item) {
            $totalPrice += $item->price * $item->quantity;
        }

        // Get the user and their email
        $user = auth()->user();
        $user_id = Auth::id();
        $email = $user->email;

        // Get the amount available in the user's wallet
        $amountInWallet = Wallet::where('user_id', $user_id)->sum('amount');

        // Check if the user has enough balance in their wallet
        if ($totalPrice > $amountInWallet) {
            return redirect()->back()->with('alert', 'Insufficient balance in wallet');
        }

        // Deduct the order amount from the user's wallet
        $updatedAmount = $amountInWallet - $totalPrice;
        $user_id = Auth::id();
        DB::table('wallets')->where('user_id', $user_id)->update(['Amount' => $updatedAmount]);

        // Create a new order
        $order = new Order();
        $order->name = $validate['name'];
        $order->email = $validate['email'];
        $order->phone = $validate['phone'];
        $order->address = $validate['address'];
        $order->zipcode = $validate['zipcode'];
        $order->city =$request->city;
        $order->state = $request->state;
        $order->country = $request->country;
        $order->total_price = $totalPrice;
        $order->cash_on_delivery = true;
        $order->save();

        // Create order items for each item in the cart
        foreach ($cart as $item) {
            $orderItem = new OrderItem();
            $orderItem->order_id = $order->id;
            $orderItem->productname = $item->productname;
            $orderItem->quantity = $item->quantity;
            $orderItem->price = $item->price;
            $orderItem->description = $item->description;
            $orderItem->image = $item->image;
            $orderItem->user_id = Auth::user()->id;
            $orderItem->save();
        }

        // Clear the user's cart
        DB::table('carts')->where('email', $email)->delete();

        return redirect()->back()->with('message', 'Ordered Successfully');
    }

    public function showcontactus()
    {
        return view('user.contact');
    }

    public function contactus(Request $request)
    {
        $contact = new Contact();
        $contact->name = $request->name;
        $contact->phone = $request->phone;
        $contact->email = $request->email;
        $contact->message = $request->message;
        $contact->save();
        return redirect()->back()->with('message', 'Your Request Submitted');
    }


    public function about()
    {
        return view('user.about');
    }

    public function totalprice(Request $request)
    {
        $totalPrice = $request->totalPrice;
        session(['totalPrice' => $totalPrice]);
        return response()->json($totalPrice);
    }
    public function wallet()
    {
        $user = Auth::user(); // get the authenticated user
        $wallet = Wallet::where('user_id', $user->id)->first(); // get the user's wallet record
        $showwallet = $wallet ? $wallet->amount : 0; // set $showwallet to the wallet amount or 0 if the wallet does not exist
        return view('user.wallet', ['showwallet' => $showwallet, 'user' => $user]);
    }
    public function addwallet(Request $request)
    {
        $user_id = Auth::id(); // get the authenticated user's id
        $wallet = Wallet::where('user_id', $user_id)->first(); // get the user's wallet record
        if (!$wallet) { // if the user does not have a wallet, create one
            $wallet = new Wallet;
            $wallet->user_id = $user_id;
        }
        $wallet->amount += $request->amount; // add the amount to the wallet
        $wallet->save();
        return redirect()->back();
    }

    public function myorder()
    {
        $user_id = Auth::id(); // get the authenticated user's id
        $myorder = OrderItem::where('user_id', $user_id)->get(); // get the user's order items
        return view('user.myorder', compact('myorder'));
    }

    public function cancelorder($id)
    {
        $cancelledOrder = OrderItem::find($id); // Retrieve order item from database
        $cancelledAmount = $cancelledOrder->price * $cancelledOrder->quantity; // Calculate amount to be added back
        $cancelledOrder->delete(); // Delete order item from database
    
        // Add cancelled amount back to user's wallet balance
        $user_id = Auth::id();
        $wallet = Wallet::where('user_id', $user_id)->firstOrFail();
        $wallet->amount += $cancelledAmount;
        $wallet->save();
    
        return redirect()->back()->with('message', 'Order cancelled successfully. Amount has been added back to your wallet.');
    }


    
}
