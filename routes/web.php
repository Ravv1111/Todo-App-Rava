<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TodoController;
use App\Http\controllers\RegisterController;

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
Route::middleware('isGuest')->group(function () {
    Route::get('/', [TodoController::class,'index'])->name('login');
    Route::get('/register', [TodoController::class,'register'])->name('register');
    Route::get('/login' ,[RegisterController::class, 'login_login'])->name('login');
    Route::post('/register', [RegisterController::class, 'register']);
    Route::post('/login', [RegisterController::class, 'login'])->name('login.post');
});

Route::get('/logout', [TodoController::class,'logout'])->name('logout');

Route::middleware('isLogin')->group(function () {
    Route::get('/dashboard', [TodoController::class,'dashboard'])->name('dashboard');
    Route::get('/create', [TodoController::class,'create'])->name('create');
    Route::post('/store', [TodoController::class,'store'])->name('store');
    Route::get('/data', [TodoController::class,'data'])->name('data');
// path yang ada {} artinya path dinamis. path dinamismerupakan path yang datanya diisi 
// dari data base . path dinamis ini nantinya akan berubah ubah tegantung data yang diberikan.
// apabila dalam routenya ada path dinamis maka nantinya data path dinamis ini dapat diakses
// oleh controller melalui pramaeter di function
    Route::get('/edit/{id}', [TodoController::class,'edit'])->name('edit');
    // method route buat update data ke database itu pake patch/put
    Route::patch('/update/{id}', [TodoController::class,'update'])->name('update');
    // method route buat delete data di database itu pake delete
    Route::delete('/destroy/{id}', [TodoController::class,'destroy'])->name('destroy');
    Route::patch('/complated/{id}', [TodoController::class,'updateToComplated'])->name('update-complated');
});