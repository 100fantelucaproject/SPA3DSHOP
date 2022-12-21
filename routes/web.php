<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\AnnouncementController;
use App\Http\Controllers\LangController;

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

//Main routes
//--------------------------------------------------------------------------------------------------------------------------------------------------------------
Route::inertia('/', 'Welcome')->name('welcome');
//--------------------------------------------------------------------------------------------------------------------------------------------------------------

//Announcements routes 
//--------------------------------------------------------------------------------------------------------------------------------------------------------------
Route::get('/announcement/index/', [AnnouncementController::class, 'index'])->name('announcement.index');

Route::get('/announcement/show/{announcement}', [AnnouncementController::class, 'show'])->name('announcement.show');

Route::middleware(['auth:sanctum', 'verified', config('jetstream.auth_session')])->group(function () {

    Route::get('/announcement/create', [AnnouncementController::class, 'create'])->name('announcement.create');

    Route::get('/announcement/edit/{announcement}', [AnnouncementController::class, 'edit'])->name('announcement.edit');

    Route::put('/annoucement/update/{announcement}', [AnnouncementController::class, 'update'])->name('announcement.update');

    Route::post('/announcement/store', [AnnouncementController::class, 'store'])->name('announcement.store');

    Route::delete('/announcement/destroy/{announcement}', [AnnouncementController::class, 'destroy'])->name('announcement.destroy');
});
//--------------------------------------------------------------------------------------------------------------------------------------------------------------

//User Routes
//--------------------------------------------------------------------------------------------------------------------------------------------------------------
Route::get('/user/announcements', [UserController::class, 'UserAnnouncements'])
->middleware(['auth:sanctum', 'verified', config('jetstream.auth_session')])
->name('user.announcements');
//--------------------------------------------------------------------------------------------------------------------------------------------------------------

//Image routes
//--------------------------------------------------------------------------------------------------------------------------------------------------------------
Route::middleware(['auth:sanctum', 'verified', config('jetstream.auth_session')])->group(function () {

Route::delete('/announcement/delete/image/{image}', [ImageController::class, 'destroy'])->name('image.delete');

Route::post('/announcement/update/image/', [ImageController::class, 'update'])->name('image.update');

});
//--------------------------------------------------------------------------------------------------------------------------------------------------------------

//File routes
//--------------------------------------------------------------------------------------------------------------------------------------------------------------
Route::get('/file/download/{file}', [FileController::class, 'downloadFile'])->name('file.download');
//--------------------------------------------------------------------------------------------------------------------------------------------------------------

//Language route
//--------------------------------------------------------------------------------------------------------------------------------------------------------------
Route::post('/locale', [LangController::class, 'langLocale'])->name('locale');
//--------------------------------------------------------------------------------------------------------------------------------------------------------------
