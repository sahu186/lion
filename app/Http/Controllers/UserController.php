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
    public function index(){
        $product = Product::paginate(6);
        return view('user.home',compact('product'));
        
    }
    public function addcart(Request $request ,$id)
    {
        $user = auth()->user();
        $cart = new Cart();
        $product = Product::find($id);
        $cart->name=$user->name;
        $cart->email=$user->email;
        $cart->productname=$product->name;
        $cart->price=$product->price;
        $cart->description=$product->description;
        $cart->image=$product->image;
        $cart->quantity = $request->quantity;

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
        $cart =Cart::where('email',$user->email)->get();
        
        
        return view('user.showcart',compact('cart'));
    }

    public function deletecart($id){
        $cart =Cart::find($id);
        $cart->delete();
        return redirect()->back();
    }

    public function payment(){
        $cart = Cart::all();
        $showwallet = DB::table('wallets')->sum('amount');
        return view('user.payment',['cart' =>$cart ,'showwallet' =>$showwallet]);
    }


    public function placeorder(Request $request){

        // Validate the form data
        $validate = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email',
            'phone' => 'required|min:10',
            'address' => 'required',
            'zipcode' => 'required',
        ]);
    
        // Calculate the total price of the order
        $totalPrice = 0;
        $cart = Cart::all();
        foreach ($cart as $item) {
            $totalPrice += $item->price * $item->quantity;
        }
    
        // Get the user and their email
        $user = auth()->user();
        $email = $user->email;
    
        // Get the amount available in the user's wallet
        $amountInWallet = DB::table('wallets')->sum('amount');
    
        // Check if the user has enough balance in their wallet
        if ($totalPrice > $amountInWallet) {
            return redirect()->back()->with(['alert' => 'Insufficient balance in wallet']);
        }
    
        // Deduct the order amount from the user's wallet
        $updatedAmount = $amountInWallet - $totalPrice;
        DB::table('wallets')->update(['amount' => $updatedAmount]);
    
        // Create a new order
        $order = new Order();
        $order->name = $validate['name'];
        $order->email = $validate['email'];
        $order->phone = $validate['phone'];
        $order->address = $validate['address'];
        $order->zipcode = $validate['zipcode'];
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
            $orderItem->save();
        }
    
        // Clear the user's cart
        DB::table('carts')->where('email', $email)->delete();
    
        return redirect()->back()->with('message','Ordered Successfully');
    }

    public function showcontactus(){
        return view('user.contact');
    }

    public function contactus(Request $request){
        $contact = new Contact();
        $contact->name=$request->name;
        $contact->phone=$request->phone;
        $contact->email=$request->email;
        $contact->message=$request->message;
        $contact->save();
        return redirect()->back()->with('message','Your Request Submitted');
        
    }


    public function about(){
        return view('user.about');
    }

    public function totalprice(Request $request){
        $totalPrice = $request->totalPrice;
  session(['totalPrice' => $totalPrice]);
  return response()->json($totalPrice);

    }
    public function wallet(){
        $showwallet = DB::table('wallets')->sum('amount');
        return view('user.wallet',compact('showwallet'));
    }
    public function addwallet(Request $request){
        $addwallet = new Wallet();
        $addwallet->amount=$request->amount;
        $addwallet->save();
        return redirect()->back();
    }

    public function myorder(){
        $myorder = OrderItem::all();
    
        return view('user.myorder',compact('myorder'));
    }

    public function cancelorder($id){
        $cancel = OrderItem::find($id);
        $cancel->delete();
        return redirect()->back();
    }
    
}
