<?php

use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BlogsController;
use App\Http\Controllers\CategoryController;

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

Route::get('/', [BlogsController::class, 'index']);

Route::get('/blogs', [BlogsController::class, 'index'])->name('blogs');
Route::get('/blogs/create', [BlogsController::class, 'create'])->name('blogs.create');
Route::post('/blogs/store', [BlogsController::class, 'store'])->name('blogs.store');
// keep trashed routes here
Route::get('/blogs/trash', [BlogsController::class, 'trash'])->name('blogs.trash');
Route::get('/blogs/trash/{id}/restore', [BlogsController::class, 'restore'])->name('blogs.restore');
Route::delete('/blogs/trash/{id}/permanentDelete', [BlogsController::class, 'permanentDelete'])->name('blogs.permanentDelete');

Route::get('/blogs/{id}', [BlogsController::class, 'show'])->name('blogs.show');
Route::get('/blogs/{id}/edit', [BlogsController::class, 'edit'])->name('blogs.edit');
Route::patch('/blogs/{id}/update', [BlogsController::class, 'update'])->name('blogs.update');
Route::delete('/blogs/{id}/delete', [BlogsController::class, 'delete'])->name('blogs.delete');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Admin routes
Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');
Route::get('/admin/blogs', [AdminController::class, 'blogs'])->name('admin.blogs');


// Categories
Route::resource('categories', CategoryController::class);