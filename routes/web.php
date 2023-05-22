<?php
use App\Http\Controllers\ProductController;
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

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();

Route::get('/welcome', 'HomeController@index')->name('welcome');

Auth::routes();

Route::get('/products', 'ProductController@index')->name('products');

Auth::routes();

Route::get('/create', [ProductController::class, 'create'])->name('create');

Route::post('/create', [ProductController::class, 'submit'])->name('submit');

Auth::routes();
Route::get('/show/{id}', [ProductController::class, 'show'])->name('show');

Route::get('/edit/{id}', [ProductController::class, 'edit'])->name('edit');

Route::post('/edit/{id}', [ProductController::class, 'update'])->name('update');

Route::post('/delete/{id}', [ProductController::class, 'delete'])->name('delete');

Route::get('/search', [ProductController::class, 'search'])->name('search');