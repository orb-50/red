<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [App\Http\Controllers\HomeController::class, 'welcome'])
    ->middleware('guest')
->name('welcome');

Route::get('/home', function () {
    return view('home');
})->middleware('auth')->name('home');
Route::get('/practice', function () {
    return view('practice.nav');
})->name('practice.nav');

Route::get('/register', [App\Http\Controllers\RegisterController::class, 'create'])
    ->middleware('guest')
    ->name('register');
Route::post('/register', [App\Http\Controllers\RegisterController::class, 'store'])
    ->middleware('guest')
    ->name('Postregister');
Route::get('/login', [App\Http\Controllers\LoginController::class, 'index'])
    ->middleware('guest')
    ->name('login');
Route::post('/login', [App\Http\Controllers\LoginController::class, 'authenticate'])
    ->middleware('guest')
    ->name('Postlogin');
Route::get('/useredit/{id}', [App\Http\Controllers\UserController::class, 'useredit'])
    ->middleware('auth')
    ->name('useredit');
Route::post('/useredit/{id}', [App\Http\Controllers\UserController::class, 'usereditupdate'])
    ->middleware('auth')
    ->name('usereditupdate');         
Route::get('/logout', [App\Http\Controllers\LoginController::class, 'logout'])
    ->middleware('auth')
    ->name('logout');
Route::get('/ticket', [App\Http\Controllers\HomeController::class, 'index'])
    ->middleware('auth')
    ->name('ticket');
Route::get('/detail/{id}', [App\Http\Controllers\HomeController::class, 'detail'])
    ->middleware('auth')
    ->name('detail');
Route::post('/ticket', [App\Http\Controllers\HomeController::class, 'store'])
    ->middleware('auth')
    ->name('Postticket');
Route::post('/comment/{id}', [App\Http\Controllers\HomeController::class, 'comment'])
    ->middleware('auth')
    ->name('comment');
Route::post('/comment/delete/{id}', [App\Http\Controllers\HomeController::class, 'commentDelete'])
    ->middleware('auth')
    ->name('comment.delete');
Route::get('/ticketList', [App\Http\Controllers\HomeController::class, 'list'])
    ->middleware('auth')
    ->name('ticketList');
Route::get('/ticketUpdate/{id}', [App\Http\Controllers\HomeController::class, 'updateMenu'])
    ->middleware('auth')
    ->name('ticketUpdate');
Route::post('/ticketUpdate', [App\Http\Controllers\HomeController::class, 'update'])
    ->middleware('auth')
    ->name('update');
Route::get('ticketdelete/{id}', [App\Http\Controllers\HomeController::class, 'ticketdelete'])
    ->middleware('auth')
    ->name('ticketdelete');
Route::get('userlist', [App\Http\Controllers\UserController::class, 'userlist'])
    ->middleware('auth')
    ->name('userlist');
Route::get('userlistticket/{id}', [App\Http\Controllers\UserController::class, 'userlistticket'])
    ->middleware('auth')
    ->name('userlistticket');
Route::get('usermanagement', [App\Http\Controllers\UserController::class, 'usermanagement'])
    ->middleware('auth')
    ->name('usermanagement');
Route::get('/admin/edit/{id}', [App\Http\Controllers\AdminController::class, 'edit'])
    ->middleware('auth')
    ->name('admin.edit');
Route::post('/admin/edit/{id}', [App\Http\Controllers\AdminController::class, 'update'])
    ->middleware('auth')
    ->name('admin.update');
Route::get('/admin/delete/{id}', [App\Http\Controllers\AdminController::class, 'delete'])
    ->middleware('can:administrator')
    ->name('admin.delete');
Route::get('/admin/category', [App\Http\Controllers\AdminController::class, 'category'])
    ->middleware('auth')
    ->name('category');

Route::get('/ticketList/search', [App\Http\Controllers\HomeController::class, 'search'])
    ->middleware('auth')
    ->name('search');

Route::prefix('category')->middleware(['can:administrator'])->group(function(){
    Route::get('index', [App\Http\Controllers\CategoryController::class,'index'])->name('category.index');
    Route::post('update',[App\Http\Controllers\CategoryController::class, 'update'])->name('category.update');
    Route::post('store',[App\Http\Controllers\CategoryController::class, 'store'])->name('category.store');
    Route::post('delete/{category}',[App\Http\Controllers\CategoryController::class, 'delete'])->name('category.delete');
});
