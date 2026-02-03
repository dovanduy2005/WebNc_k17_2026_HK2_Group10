<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('index');
});

Route::get('/cars', [App\Http\Controllers\CarController::class, 'index']);
Route::get('/cars/{id}', [App\Http\Controllers\CarController::class, 'show']);

Route::get('/about', function () {
    return view('about');
});

Route::get('/contact', function () {
    return view('contact');
});
Route::post('/contact', [App\Http\Controllers\FeedbackController::class, 'storeContact'])->name('contact.store');

Route::get('/auth', function () {
    return view('auth');
})->name('login');

Route::post('/login', [App\Http\Controllers\AuthController::class, 'login']);
Route::post('/register', [App\Http\Controllers\AuthController::class, 'register']);
Route::post('/logout', [App\Http\Controllers\AuthController::class, 'logout'])->name('logout');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [App\Http\Controllers\ProfileController::class, 'show'])->name('profile');
    Route::post('/profile', [App\Http\Controllers\ProfileController::class, 'update']);
    
    Route::get('/favorites', [App\Http\Controllers\FavoriteController::class, 'index'])->name('favorites');
    Route::post('/favorites/{car}/toggle', [App\Http\Controllers\FavoriteController::class, 'toggle'])->name('favorites.toggle');

    Route::get('/contracts', [App\Http\Controllers\ContractController::class, 'index'])->name('contracts');
    Route::get('/contracts/create', [App\Http\Controllers\ContractController::class, 'create'])->name('contracts.create');
    Route::post('/contracts', [App\Http\Controllers\ContractController::class, 'store'])->name('contracts.store');
    Route::get('/contracts/{contract}', [App\Http\Controllers\ContractController::class, 'show'])->name('contracts.show');
    
    Route::get('/feedback', [App\Http\Controllers\FeedbackController::class, 'create'])->name('feedback.create');
    Route::post('/feedback', [App\Http\Controllers\FeedbackController::class, 'store'])->name('feedback.store');
});

// Admin Routes
Route::prefix('admin')->name('admin.')->group(function () {
    // Guest Admin Routes (Accessible even if logged in as customer, controller handles logic)
    Route::get('/login', [App\Http\Controllers\Admin\AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [App\Http\Controllers\Admin\AuthController::class, 'login'])->name('login.submit');

    // Protected Admin Routes
    Route::middleware(['admin'])->group(function () {
        Route::post('/logout', [App\Http\Controllers\Admin\AuthController::class, 'logout'])->name('logout');
        
        Route::get('/dashboard', [App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('dashboard');
        
        Route::get('/revenue', [App\Http\Controllers\Admin\RevenueController::class, 'index'])->name('revenue.index');
        
        // Cars
        Route::resource('cars', App\Http\Controllers\Admin\CarController::class);
        
        // Contracts
        Route::resource('contracts', App\Http\Controllers\Admin\ContractController::class)->only(['index', 'show', 'update']);
        
        // Feedbacks
        Route::resource('feedbacks', App\Http\Controllers\Admin\FeedbackController::class)->only(['index', 'destroy']);
        Route::delete('/feedbacks/consultation/{consultation}', [App\Http\Controllers\Admin\FeedbackController::class, 'destroyConsultation'])->name('feedbacks.consultation.destroy');
        Route::post('/feedbacks/{feedback}/reply', [App\Http\Controllers\Admin\FeedbackController::class, 'reply'])->name('feedbacks.reply');

        // Customers
        Route::get('/customers', [App\Http\Controllers\Admin\CustomerController::class, 'index'])->name('customers.index');
    });
});
