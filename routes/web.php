<?php

use App\Livewire\Admin\Index as AdminIndex;
use App\Livewire\Login;
use App\Livewire\User\About;
use App\Livewire\User\Home;
use App\Livewire\User\Index;
use Illuminate\Support\Facades\Route;

Route::get('/', Home::class)->name('users.home');

Route::get('/about', About::class)->name('users.about');

Route::get('/login', Login::class)->name('login');

Route::get('/admin', AdminIndex::class)->name('admin.index');
