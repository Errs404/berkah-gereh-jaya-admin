<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\OrderController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard.dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


Route::get('/orders', function () {
    return view('orders.orders');
})->middleware(['auth', 'verified'])->name('orders');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/user', function () {
    return view('user');
})->name('user');

Route::get('/settings', function () {
    return view('settings');
})->name('settings');

Route::get('/reports', function () {
    return view('reports');
})->name('reports');

Route::get('/help', function () {
    return view('help');
})->name('help');

Route::get('/security', function () {
    return view('security');
})->name('security');

Route::get('/products', function () {
    return view('products');
})->name('products');

// Route::get('/orders', function () {
//     return view('orders');
// })->name('orders');

Route::get('/messages', function () {
    return view('messages');
})->name('messages');

Route::get('/forms', function () {
    return view('forms');
})->name('forms');

Route::get('/analytics', function () {
    return view('analytics');
})->name('analytics');

Route::get('/files', function () {
    return view('files');
})->name('files');

Route::get('/elements', function () {
    return view('elements');
})->name('elements');

Route::get('/elements-tables', function () {
    return view('elements-tables');
})->name('elements-tables');

Route::get('/elements-modals', function () {
    return view('elements-modals');
})->name('elements-modals');

Route::get('/elements-forms', function () {
    return view('elements-forms');
})->name('elements-forms');

Route::get('/elements-cards', function () {
    return view('elements-cards');
})->name('elements-cards');

Route::get('/elements-buttons', function () {
    return view('elements-buttons');
})->name('elements-buttons');

Route::get('/elements-badges', function () {
    return view('elements-badges');
})->name('elements-badges');

Route::get('/elements-alerts', function () {
    return view('elements-alerts');
})->name('elements-alerts');

Route::get('/calendar', function () {
    return view('calendar');
})->name('calendar');

Route::get('/overview', function () {
    return view('dashboard');
})->name('overview');

// Route::get('/orders', [OrderController::class, 'index']);
// Route::get('/orders/{id}', [OrderController::class, 'show']);
// Route::post('/orders/{id}/cancel', [OrderController::class, 'cancel']);



require __DIR__ . '/auth.php';
