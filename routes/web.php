<?php

use App\Livewire\Admin\Addnew;
use App\Livewire\Admin\Index as AdminIndex;
use App\Livewire\Admin\ListCategory;
use App\Livewire\Admin\ListImage;
use App\Livewire\Admin\ListProduct as AdminListProduct;
use App\Livewire\Admin\News;
use App\Livewire\Admin\Order;
use App\Livewire\Login;
use App\Livewire\User\About;
use App\Livewire\User\Checkout;
use App\Livewire\User\CartShop;
use App\Livewire\User\Contact;
use App\Livewire\User\Home;
use App\Livewire\User\Index;
use App\Livewire\User\ListProduct as UserListProduct;
use App\Livewire\User\ProductDetail;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\EmailVerificationRequest;

Route::get('/', Home::class)->name('users.home');

Route::get('/about', About::class)->name('users.about');

Route::get('/contact', Contact::class)->name('users.contact');

Route::get('/login', Login::class)->name('login');

<<<<<<< Updated upstream
Route::get('/product-detail/{id}', ProductDetail::class)->name('user.product-detail');
=======
Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');

Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();
 
    return back()->with('message', 'Verification link sent!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();
 
    return redirect('/home');
})->middleware(['auth', 'signed'])->name('verification.verify');

Route::get('/product-detail', ProductDetail::class)->name('user.product-detail');
>>>>>>> Stashed changes

Route::get('/list-product', UserListProduct::class)->name('user.list-product');

Route::get('/list-product/{id}', UserListProduct::class)->name('user.list-product-category');

Route::get('/admin/list_product', AdminListProduct::class)->name('admin.list_product');

Route::get('/checkout', Checkout::class)->name('users.checkout');

Route::get('/cartShop', CartShop::class)->name('user.cartShop');

Route::get('/admin', AdminListProduct::class)->name('admin.index');

Route::get('/admin/addnew', Addnew::class)->name('admin.addnew');

Route::get('/admin/order', Order::class)->name('admin.order');

Route::get('/admin/list_category', ListCategory::class)->name('admin.list_category');

Route::get('/admin/list_image', ListImage::class)->name('admin.list_image');

Route::get('/admin/news', News::class)->name('admin.news');
