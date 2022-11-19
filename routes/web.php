<?php

use App\Http\Controllers\AnalisController;
use App\Http\Controllers\CategoryController;
use App\Models\Category;
use App\Models\Transaksi;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PesananController;
use App\Http\Controllers\PilihanController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\HomePilihanController;

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

    $notif = 0;
    if(isset(auth()->user()->id)){
       $notif = Transaksi::latest()->transaksi()->get();
    }
    return view('home',[
        'notif'=> $notif,
        'categories' => Category::all()
    ]);
});

Route::get('/dashboard', function (){
    return view('dashboard.index');
})->middleware('admin');


Route::get('/pilihan', [HomePilihanController::class,'index']);
Route::get('/pilih/{pilihan:slug}', [HomePilihanController::class,'show']);

Route::resource('/dashboard/pilihan', PilihanController::class)->middleware('auth');
Route::resource('/dashboard/transaksi', TransaksiController::class);
Route::post('/transaksi', [TransaksiController::class, 'create']);

Route::get('/register', [RegisterController::class, 'index']);
Route::post('/register', [RegisterController::class, 'store'])->middleware('guest');

Route::get('/login', [LoginController::class, 'index'])->name('login')->middleware('guest');
Route::post('/login', [LoginController::class, 'authenticate']);
Route::get('/logout', [LoginController::class, 'logout']);

Route::get('/pesanan', [PesananController::class,'index'])->middleware('auth');
Route::get('/pesanan/{transaksi:user_id}', [PesananController::class,'show'])->middleware('auth');

Route::resource('dashboard/category', CategoryController::class);

Route::get('/dashboard/analis', [AnalisController::class, 'index'])->middleware('auth');
