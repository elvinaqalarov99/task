<?php

use App\Http\Controllers\CompanyController;
use App\Http\Controllers\EmployeeController;
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

Route::get('/', function () {
    return view('index');
});

Auth::routes(['register'=>false]);

Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'index'])->name('dashboard');

Route::group(['prefix' => 'dashboard', 'middleware' => 'auth'], function() {
    
   //note: define custom routes before your call to Route::resource
    Route::get('companies/data',[CompanyController::class,'allData']); 
    Route::resource('companies', CompanyController::class);
    Route::get('employees/data',[EmployeeController::class,'allData']); 
    Route::resource('employees', EmployeeController::class); 
});

Route::get('lang/{lang}',[App\Http\Controllers\LanguageController::class, 'switchLang'])->name('lang.switch');