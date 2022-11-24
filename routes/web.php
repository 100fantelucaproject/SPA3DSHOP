<?php

use App\Http\Controllers\AnnouncementController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\UserController;
use GuzzleHttp\Middleware;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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

Route::middleware(['auth', 'verified'])->group(function () {

    Route::get('/announcement/create', [AnnouncementController::class, 'create'])->name('announcement.create');

    Route::get('/announcement/edit/{announcement}', [AnnouncementController::class, 'edit'])->name('announcement.edit');

    Route::put('/annoucement/update/{announcement}', [AnnouncementController::class, 'update'])->name('announcement.update');
});

Route::post('/announcement/store', [AnnouncementController::class, 'store'])->name('announcement.store');

Route::delete('/announcement/destroy({announcement}', [AnnouncementController::class, 'destroy'])->name('announcement.destroy');
//--------------------------------------------------------------------------------------------------------------------------------------------------------------

//User Routes
//--------------------------------------------------------------------------------------------------------------------------------------------------------------
Route::get('/user/announcements', [UserController::class, 'UserAnnouncements'])->name('user.announcements');

//--------------------------------------------------------------------------------------------------------------------------------------------------------------

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})
->middleware([
        'auth:sanctum',
        config('jetstream.auth_session'),
        'verified',
    ])
->name('dashboard');
