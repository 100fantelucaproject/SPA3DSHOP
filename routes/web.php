<?php

use App\Http\Controllers\AnnouncementController;
use App\Models\Announcement;
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

// Route::get('/', function () {
//     return Inertia::render('Welcome', [
//         'canLogin' => Route::has('login'),
//         'canRegister' => Route::has('register'),
//     ]);
// });

//Main routes
//--------------------------------------------------------------------------------------------------------------------------------------------------------------
Route::inertia('/', 'Welcome')->name('welcome');
//--------------------------------------------------------------------------------------------------------------------------------------------------------------

//Announcements routes 
//--------------------------------------------------------------------------------------------------------------------------------------------------------------
Route::get('/announcement/index', [AnnouncementController::class, 'index'])->name('announcement.index');

Route::get('/announcement/show/{announcement}', [AnnouncementController::class, 'show'])->name('announcement.show');

Route::get('/announcement/create', [AnnouncementController::class, 'create'])->name('announcement.create');

Route::post('/announcement/store', [AnnouncementController::class, 'store'])->name('announcement.store');

Route::delete('/announcement/destroy({announcement}', [AnnouncementController::class, 'destroy'])->name('announcement.destroy');

Route::get('/announcement/edit/{announcement}', [AnnouncementController::class, 'edit'])->name('announcement.edit');

Route::put('/annoucement/update/{announcement}', [AnnouncementController::class, 'update'])->name('announcement.update');
//--------------------------------------------------------------------------------------------------------------------------------------------------------------



Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');
});
