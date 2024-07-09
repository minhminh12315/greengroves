<?php // routes/breadcrumbs.php

// Note: Laravel will automatically resolve `Breadcrumbs::` without
// this import. This is nice for IDE syntax and refactoring.

use App\Models\Categories;
use Diglactic\Breadcrumbs\Breadcrumbs;

// This import is also not required, and you could replace `BreadcrumbTrail $trail`
//  with `$trail`. This is nice for IDE type checking and completion.
use Diglactic\Breadcrumbs\Generator as BreadcrumbTrail;

// Home
Breadcrumbs::for('home', function (BreadcrumbTrail $trail) {
    $trail->push('Home', route('users.home'));
});

// Home > Blog
Breadcrumbs::for('shop', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push('Shop', route('user.list-product'));
});

Breadcrumbs::for('about', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push('About', route('users.about'));
});

Breadcrumbs::for('contact', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push('Contact', route('users.contact'));
});


Breadcrumbs::for('category', function (BreadcrumbTrail $trail, $category) {
    if ($category->parent) {
        $trail->parent('category', $category->parent);
    } else {
        $trail->parent('shop');
    }
    $trail->push(ucwords(strtolower($category->name)), route('user.list-product-category', $category->id));
});

Breadcrumbs::for('product-detail', function (BreadcrumbTrail $trail, $product) {
    $categoryId = $product->category_id;
    $category = Categories::find($categoryId);
    if ($category) {
        $trail->parent('category', $category); 
    } else {
        $trail->parent('shop'); 
    }
    $trail->push(ucwords(strtolower($product->name)), route('user.product-detail', $product->id));
});
