<?php

use App\Http\Controllers\Admin\EventController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Guest\WelcomeController;
use App\Http\Controllers\User\ProfileController;
use App\Http\Controllers\User\TransactionController;
use Illuminate\Support\Facades\Route;

Auth::routes();
// --- GROUP 1: GUEST (PENGUNJUNG) ---
// Namespace otomatis: App\Http\Controllers\Guest
Route::group(['namespace' => 'App\Http\Controllers\Guest'], function() {
    Route::get('/', [WelcomeController::class, 'index'])->name('welcome');
    Route::get('/event/{event}', [WelcomeController::class, 'show'])->name('events.show');
});

// Auth Routes (Login/Register/Logout)
Auth::routes();

// LOGIKA REDIRECT HOME
Route::get('/home', function () {
    if (auth()->user()->role == 'Admin') {
        return redirect()->route('admin.dashboard'); // Arahkan ke nama route baru
    }
    return redirect()->route('welcome');
})->middleware('auth')->name('home');


// --- GROUP 2: ADMIN (Hanya bisa diakses Admin) ---
Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => ['auth', 'checkRole:Admin'], 'namespace' => 'App\Http\Controllers\Admin'], function() {

    // Dashboard Admin (Event Controller)
    Route::resource('events', EventController::class)->names([
        'index' => 'dashboard', // admin.dashboard
    ]);

    // Kelola User
    Route::put('/users/{id}/role', [UserController::class, 'updateRole'])->name('users.updateRole');
    Route::get('/users/{id}/delete', [UserController::class, 'destroy'])->name('users.delete');

    // Route Profil Admin
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
});


// --- GROUP 3: USER (Hanya bisa diakses User Login) ---
Route::group(['prefix' => 'user', 'as' => 'user.', 'middleware' => ['auth'], 'namespace' => 'App\Http\Controllers\User'], function() {

    // Tiket Saya
    Route::get('/my-tickets', [TransactionController::class, 'index'])->name('tickets.index');
    Route::post('/checkout/{event}', [TransactionController::class, 'store'])->name('checkout');

    // Profil Saya
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');

    // Route Profil User
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
});

