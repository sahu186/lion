<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Psy\TabCompletion\Matcher\FunctionsMatcher;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;
use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/',[UserController::class,'index'])->name('home');
Route::get('aboutus',[UserController::class,'about'])->name('about');
Route::middleware('auth')->group(function(){
    Route::post('addcart/{id}',[UserController::class,'addcart'])->name('addcart');
    Route::get('showcart',[UserController::class,'showcart'])->name('showcart');
    Route::post('/update/{id}',[UserController::class,'update'])->name('showcart.update');
    Route::get('deletecart/{id}',[UserController::class,'deletecart'])->name('deletecart');             
    Route::get('payment',[UserController::class,'payment'])->name('payment');             
    Route::post('placeorder',[UserController::class,'placeorder'])->name('placeorder');
    Route::get('contactus',[UserController::class,'showcontactus'])->name('showcontactus');   
    Route::post('contactus',[UserController::class,'contactus'])->name('contactus');           
    Route::post('/showcart/totalprice', [UserController::class,'totalprice'])->name('showcart.totalprice');
    Route::get('wallet',[UserController::class,'wallet'])->name('wallet');
    Route::post('addwallet',[UserController::class,'addwallet'])->name('addwallet');
    Route::get('myorder',[UserController::class,'myorder'])->name('myorder');
    Route::get('cancelorder/{id}',[UserController::class,'cancelorder'])->name('cancelorder');
           

});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth','IsAdmin'])->group(function() {
    Route::get('/dashboard',[AdminController::class,'index'])->name('dashboard');
    Route::get('addproduct',[ProductController::class,'create'])->name('addproduct');
    Route::post('addproduct',[ProductController::class,'store'])->name('addproduct.store');
    Route::get('showproduct',[ProductController::class,'show'])->name('showproduct.show');
    Route::get('editproduct/{id}',[ProductController::class,'edit'])->name('editproduct.edit');
    Route::post('updateproduct/{id}',[ProductController::class,'update'])->name('updateproduct.update');
    Route::get('delete/{id}',[ProductController::class,'destroy'])->name('delete');
    Route::get('/showorder',[AdminController::class,'showorder'])->name('showorder');
    Route::get('/updatestatus/{id}',[AdminController::class,'updatestatus'])->name('updatestatus');
   
});



require __DIR__.'/auth.php';
