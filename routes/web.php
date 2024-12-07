<?php

use App\Http\Controllers\user\UserController;
use App\Http\Controllers\admin\AdminController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserListController;
use App\Http\Controllers\ViewProductController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('home');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

// user routes
Route::middleware(['auth','userMiddleware']) -> group(function(){
    
    Route::get('product', [ViewProductController::class,'index'])->name('user.viewproduct');
    Route::get('add_cart/{id}', [UserController::class,'addCart'])->name('add_cart');
    Route::get('order', [UserController::class,'order'])->name('order');
    Route::get('remove_cart/{id}', [UserController::class,'removeCart'])->name('removeCart');

});

// admin routes
Route::middleware(['auth','adminMiddleware']) -> group(function(){
    
    Route::get('/admin/dashboard', [AdminController::class,'index'])->name('admin.dashboard');

    //admin create product CRUD
    Route::get('/admin/product', [ProductController::class,'index'])->name('admin.product');
    Route::get('/admin/create', [ProductController::class,'create'])->name('admin.create');
    Route::post('/admin/create', [ProductController::class,'store'])->name('admin.store');
    Route::get('/admin/{product}/edit', [ProductController::class,'edit'])->name('admin.edit');
    Route::put('/admin/{product}', [ProductController::class,'update'])->name('admin.update');
    Route::delete('/admin/{product}', [ProductController::class,'destroy'])->name('admin.destroy');

    //userlist CRUD
    Route::get('/admin/userlist', [UserListController::class,'index'])->name('admin.userlist');
    Route::get('/admin/{user}/edituser', [UserListController::class,'edit'])->name('admin.edituser');
    Route::put('/admin/{user}/edituser', [UserListController::class,'update'])->name('admin.updateuser');
    Route::delete('/admin/{user}/edituser', [UserListController::class,'destroy'])->name('admin.dltuser');

});