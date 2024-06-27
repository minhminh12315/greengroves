<?php

use App\Livewire\Admin\Addnew;
use App\Livewire\Admin\Index as AdminIndex;
use App\Livewire\Admin\ListProduct;
use App\Livewire\Admin\Order;
use App\Livewire\Login;
use App\Livewire\User\About;
use App\Livewire\User\Home;
use App\Livewire\User\Index;
use Illuminate\Support\Facades\Route;

Route::get('/', Home::class)->name('users.home');

Route::get('/about', About::class)->name('users.about');

Route::get('/login', Login::class)->name('login');

Route::get('/admin', AdminIndex::class)->name('admin.index');

Route::get('/admin/list_product', ListProduct::class)->name('admin.list_product');

Route::get('/admin/addnew', Addnew::class)->name('admin.addnew');

Route::get('/admin/order', Order::class)->name('admin.order');