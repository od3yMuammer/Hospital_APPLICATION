<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\SettingController;
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

Auth::routes();


Route::get('/', function () {
    return view('admin.dashboard.index');
//    return view('auth.register');
//    return view('admin.dashboard.index');
});

//Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('index');
//Route::get('/about', [App\Http\Controllers\HomeController::class, 'about'])->name('about');
//Route::get('/contact', [App\Http\Controllers\HomeController::class, 'contact'])->name('contact');
//
Route::prefix('admin')->name('admin.')->middleware('auth')->group(function () {


    Route::resource('dashboard', \App\Http\Controllers\DashboardController::class);

    Route::resource('cities', \App\Http\Controllers\CityController::class);
    Route::get('cities/restore/{id}', [\App\Http\Controllers\CityController::class, 'restore'])->name('cities.restore');
    Route::get('cities/forceDelete/{id}', [\App\Http\Controllers\CityController::class, 'forceDelete', 'id'])->name('cities.forceDelete');

    Route::resource('ambulances', \App\Http\Controllers\AmbulanceController::class);
    Route::get('ambulances/restore/{id}', [\App\Http\Controllers\AmbulanceController::class, 'restore'])->name('ambulances.restore');
    Route::get('ambulances/forceDelete/{id}', [\App\Http\Controllers\AmbulanceController::class, 'forceDelete', 'id'])->name('ambulances.forceDelete');

    Route::resource('hospitals', \App\Http\Controllers\HospitalController::class);
    Route::get('hospitals/restore/{id}', [\App\Http\Controllers\HospitalController::class, 'restore'])->name('hospitals.restore');
    Route::get('hospitals/forceDelete/{id}', [\App\Http\Controllers\HospitalController::class, 'forceDelete', 'id'])->name('hospitals.forceDelete');

    Route::resource('laboratories', \App\Http\Controllers\LaboratoriesController::class);
    Route::get('laboratories/restore/{id}', [\App\Http\Controllers\LaboratoriesController::class, 'restore'])->name('laboratories.restore');
    Route::get('laboratories/forceDelete/{id}', [\App\Http\Controllers\LaboratoriesController::class, 'forceDelete', 'id'])->name('laboratories.forceDelete');

    Route::resource('majors', \App\Http\Controllers\MajorsController::class);
    Route::get('majors/restore/{id}', [\App\Http\Controllers\MajorsController::class, 'restore'])->name('majors.restore');
    Route::get('majors/forceDelete/{id}', [\App\Http\Controllers\MajorsController::class, 'forceDelete', 'id'])->name('majors.forceDelete');

    Route::resource('doctors', \App\Http\Controllers\DoctorsController::class);
    Route::get('doctors/restore/{id}', [\App\Http\Controllers\DoctorsController::class, 'restore'])->name('doctors.restore');
    Route::get('doctors/forceDelete/{id}', [\App\Http\Controllers\DoctorsController::class, 'forceDelete', 'id'])->name('doctors.forceDelete');

    Route::resource('categories', \App\Http\Controllers\CategoriesController::class);
    Route::get('categories/restore/{id}', [\App\Http\Controllers\CategoriesController::class, 'restore'])->name('categories.restore');
    Route::get('categories/forceDelete/{id}', [\App\Http\Controllers\CategoriesController::class, 'forceDelete', 'id'])->name('categories.forceDelete');

    Route::resource('articles', \App\Http\Controllers\ArticlesController::class);
    Route::get('articles/restore/{id}', [\App\Http\Controllers\ArticlesController::class, 'restore'])->name('articles.restore');
    Route::get('articles/forceDelete/{id}', [\App\Http\Controllers\ArticlesController::class, 'forceDelete', 'id'])->name('articles.forceDelete');


    Route::resource('admins', \App\Http\Controllers\AdminController::class);
    Route::get('admins/restore/{id}', [AdminController::class, 'restore'])->name('admins.restore');
    Route::get('admins/forceDelete/{id}', [AdminController::class, 'forceDelete', 'id'])->name('admins.forceDelete');

    Route::resource('settings',SettingController ::class);
    Route::resource('messages', MessageController::class);
    //    Route::resource('proceses_log', \App\Http\Controllers\ProcessController::class);

    Route::get('/logout', function () {
        Auth::logout();
        return redirect("/login");
    })->name('logout');

});




Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
