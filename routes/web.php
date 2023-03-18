<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\StudentController;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;
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


// Halaman Login
// Route::get('/login', [LoginController::class, 'index'])->middleware('guest')->name('login');
// Route::post('/login', [LoginController::class, 'authenticate']);
// Route::post('/logout', [LoginController::class, 'logout']);

Auth::routes();

Route::middleware(['auth'])->group(function () {

    Route::get('/', function () {
        return view('home');
    });
    
    Route::controller(StudentController::class)->group(function(){
        // Halaman seluruh siswa
        Route::get('/students', 'index')->name('home');
        // Halaman single siswa
        Route::get('/students/{student:slug}', 'show');
        // Normalisasi
        Route::get('/normalisasi/{student:slug}', 'normalisasi');
        // Medoid
        Route::get('/medoid/{student:slug}', 'medoid');
        Route::get('/medoid', 'medoid_all');
        // Grafik
        // Route::get('/graphics', 'graphics');
    });   
    
    // Halaman seluruh kategori
    Route::get('/categories', function () {
        return view('categories', [
            'categories' => Category::all()
        ]);
    });

});
