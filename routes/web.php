<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Models\Product;
use App\Http\Controllers\MidtransController;

Route::get('/', [ProductController::class, 'index'])->name('home');

Route::get('/register',[AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register',[AuthController::class,'register'])->name('register.submit');
// Login Routes
// Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm']);
    Route::post('/login', [AuthController::class, 'login'])->name('login');
    
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    //     Route::get('/register',[AuthController::class,'register'])->name('register');
//     Route::post('/register',[AuthController::class,'showRegisterForm']);
// });


// Route::get('/', [ProductController::class, 'index'])->name('home');
// Route::get('/product/{id}', [ProductController::class, 'show'])->name('product.show');


// // Cart Routes
// Route::controller(CartController::class)->group(function () {
//     Route::get('/cart', 'index')->name('cart.index');
// });

// Profile Routes
// Route::controller(ProfileController::class)->group(function () {
//     Route::get('/profile', 'edit')->name('profile.edit');
//     Route::patch('/profile', 'update')->name('profile.update');
// });

// // Route untuk customer
// Route::middleware('auth')->group(function () {
//     Route::get('/home', [HomeController::class, 'index'])->name('home');
// });

// // Route untuk admin (proteksi dengan middleware admin)
// Route::prefix('admin')->middleware(['auth', 'admin'])->group(function () {
//     Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
//     // Tambahkan route admin lainnya di sini
// });
// Tambahkan route untuk tambah ke keranjang
// Route::get('/add-to-cart/{id}', [CartController::class, 'addToCart'])->name('cart.add');
// Route::post('/add-to-cart/{id}', [CartController::class, 'add'])->name('cart.add');

// // Tampilkan halaman keranjang
// Route::get('/cart', [CartController::class, 'index'])->name('cart.index');

// // Checkout
// //Route::get('/checkout', [CartController::class, 'checkout'])->name('cart.checkout');
// Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout');
// // Proses checkout (misal reset keranjang)
// Route::post('/checkout', [CartController::class, 'processCheckout'])->name('cart.processCheckout');
// Route::get('/cart/remove/{id}', [CartController::class, 'removeFromCart'])->name('cart.remove');

Route::get('/', function () {
    return redirect('/dashboard');
});

Route::get('/', function () {
    return view('welcome');  // ini yang buat welcome blade muncul
});

Route::middleware('auth')->get('/dashboard', function () {
    $products = \App\Models\Product::all();
    return view('dashboard', compact('products'));
})->name('dashboard');

Route::get('/admin/dashboard2', [AdminController::class, 'dashboard'])->middleware('auth');
Route::get('/admin/pesanan', [App\Http\Controllers\AdminController::class, 'pesanan']);

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::put('/password', [ProfileController::class, 'updatePassword'])->name('password.update');
});
Route::middleware(['auth'])->group(function () {
    Route::resource('products', ProductController::class)->only([
        'index', 'create', 'store', 'update', 'destroy'
    ]);
    Route::get('/menu', [ProductController::class, 'publicMenu'])->name('menu');
    Route::post('/cart/add', [CartController::class, 'addToCart'])->name('cart.add');
    Route::get('/cart', [CartController::class, 'showCart'])->name('cart.cart');
    Route::get('/cart/remove/{id}', [CartController::class, 'removeFromCart'])->name('cart.remove');
    Route::post('/checkout', [CheckoutController::class, 'process'])->name('checkout.process');
    Route::post('/get-token', [MidtransController::class, 'token']);
    Route::get('/cart/checkout', [CheckoutController::class, 'index'])->name('cart.checkout');

    Route::post('/checkout/update', [CheckoutController::class, 'update'])->name('checkout.update');
    Route::patch('/admin/orders/{order}/status', [CheckoutController::class, 'updateStatus'])->name('admin.orders.updateStatus');

    Route::get('/products/{product}/edit', [ProductController::class, 'edit'])->name('products.edit');

});


