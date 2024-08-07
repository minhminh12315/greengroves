<?php

use App\Livewire\Admin\Addnew;
use App\Livewire\Admin\FeedBack;
use App\Livewire\Admin\Index as AdminIndex;
use App\Livewire\Admin\ListCategory;
use App\Livewire\Admin\ListImage;
use App\Livewire\Admin\ListProduct as AdminListProduct;
use App\Livewire\Admin\News;
use App\Livewire\Admin\Order;
use App\Livewire\Admin\OrderShow;
use App\Livewire\ListOrder;
use App\Livewire\Login;
use App\Livewire\OrderDetail;
use App\Livewire\ResetPassword;
use App\Livewire\Setting;
use App\Livewire\User\About;
use App\Livewire\User\Checkout;
use App\Livewire\User\CartShop;
use App\Livewire\User\Contact;
use App\Livewire\User\Home;
use App\Livewire\User\Index;
use App\Livewire\User\ListProduct as UserListProduct;
use App\Livewire\User\ProductDetail;
use App\Livewire\VerifyEmail;
use Illuminate\Support\Facades\Route;
use App\Livewire\Index as SettingIndex;

Route::get('/', Home::class)->name('users.home');
Route::get('/about', About::class)->name('users.about');
Route::get('/contact', Contact::class)->name('users.contact');
Route::get('/login', Login::class)->name('login');

Route::get('/product-detail/{id}', ProductDetail::class)->name('user.product-detail');

Route::get('/list-product', UserListProduct::class)->name('user.list-product');

Route::get('/list-product/{id}', UserListProduct::class)->name('user.list-product-category');

Route::get('/cartShop', CartShop::class)->name('user.cartShop');

Route::middleware(['auth'])->group(function () {
    Route::get('/setting', Setting::class)->name('setting_user');
    Route::get('/list-order', ListOrder::class)->name('list_order');
    Route::get('/reset-password', ResetPassword::class)->name('reset_password');
    Route::get('/order-detail/{id}', OrderDetail::class)->name('order.detail');
});

Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin', AdminListProduct::class)->name('admin.index');
    Route::get('/admin/addnew', Addnew::class)->name('admin.addnew');
    Route::get('/admin/order', Order::class)->name('admin.order');
    Route::get('/admin/list_product', AdminListProduct::class)->name('admin.list_product');
    Route::get('/admin/list_category', ListCategory::class)->name('admin.list_category');
    Route::get('/admin/list_image', ListImage::class)->name('admin.list_image');
    Route::get('/admin/news', News::class)->name('admin.news');
    Route::get('/admin/order-show/{id}', OrderShow::class)->name('admin.order.show');
    Route::get('/admin/list_feedback', FeedBack::class)->name('admin.list_feedback');
});

Route::middleware(['auth', 'user'])->group(function () {
    Route::get('/checkout', Checkout::class)->name('users.checkout');
});

Route::get('/verify-mail/{id}', VerifyEmail::class)->name('verify_mail');
