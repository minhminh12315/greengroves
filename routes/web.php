<?php

use App\Livewire\Admin\Addnew;
use App\Livewire\Admin\Index as AdminIndex;
use App\Livewire\Admin\ListProduct as AdminListProduct;
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

Route::get('/', Home::class)->name('users.home');

Route::get('/about', About::class)->name('users.about');

Route::get('/contact', Contact::class)->name('users.contact');

Route::get('/login', Login::class)->name('login');

Route::get('/product-detail', ProductDetail::class)->name('user.product-detail');

Route::get('/list-product', UserListProduct::class)->name('user.list-product');

Route::get('/admin/list_product', AdminListProduct::class)->name('admin.list_product');

Route::get('/checkout', Checkout::class)->name('users.checkout');

Route::get('/cartShop',CartShop::class)->name('user.cartShop');

Route::get('/admin', AdminIndex::class)->name('admin.index');

Route::get('/admin/addnew', Addnew::class)->name('admin.addnew');

Route::get('/admin/order', Order::class)->name('admin.order');
