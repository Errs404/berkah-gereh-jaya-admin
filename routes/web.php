<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OrderController;


/*
|--------------------------------------------------------------------------
| Public
|--------------------------------------------------------------------------
*/

Route::view('/', 'welcome')->name('home');

/*
|--------------------------------------------------------------------------
| Authenticated (and verified) pages
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'verified'])->group(function () {
    // Dashboard & main pages
    Route::view('/dashboard', 'dashboard.index')->name('dashboard');
    Route::view('/orders', 'orders.index')->name('orders');

    Route::view('/user', 'user')->name('user');
    Route::view('/settings', 'settings')->name('settings');
    Route::view('/reports', 'reports')->name('reports');
    Route::view('/help', 'help')->name('help');
    Route::view('/security', 'security')->name('security');
    Route::view('/products', 'products')->name('products');
    Route::view('/messages', 'messages')->name('messages');
    Route::view('/forms', 'forms')->name('forms');
    Route::view('/analytics', 'analytics')->name('analytics');
    Route::view('/files', 'files')->name('files');
    Route::view('/calendar', 'calendar')->name('calendar');

    // Kalau "overview" itu sebenarnya dashboard lain, samakan view-nya (pilih salah satu)
    Route::view('/overview', 'dashboard.index')->name('overview');

    /*
    |--------------------------------------------------------------------------
    | Elements module
    |--------------------------------------------------------------------------
    */
    Route::prefix('elements')->name('elements.')->group(function () {
        Route::view('/', 'elements')->name('index');

        Route::view('/tables', 'elements-tables')->name('tables');
        Route::view('/modals', 'elements-modals')->name('modals');
        Route::view('/forms', 'elements-forms')->name('forms');
        Route::view('/cards', 'elements-cards')->name('cards');
        Route::view('/buttons', 'elements-buttons')->name('buttons');
        Route::view('/badges', 'elements-badges')->name('badges');
        Route::view('/alerts', 'elements-alerts')->name('alerts');
    });

    /*
    |--------------------------------------------------------------------------
    | Orders module
    |--------------------------------------------------------------------------
    */
    Route::middleware(['auth', 'verified'])->group(function () {
        Route::get('/orders', [OrderController::class, 'index'])->name('orders');
    });

    /*
    |--------------------------------------------------------------------------
    | Profile (auth only; verified sudah termasuk)
    |--------------------------------------------------------------------------
    */
    Route::prefix('profile')->name('profile.')->group(function () {
        Route::get('/', [ProfileController::class, 'edit'])->name('edit');
        Route::patch('/', [ProfileController::class, 'update'])->name('update');
        Route::delete('/', [ProfileController::class, 'destroy'])->name('destroy');
    });
});

require __DIR__ . '/auth.php';
