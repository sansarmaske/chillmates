<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/expenses', function () {return view('expenses.index');})->name('expenses');
    Route::get('/expenses/create', function () {return view('expenses.create');})->name('expenses.create');
    Route::post('/expenses', function () {return view('expenses.create');})->name('expenses.create');
});



require __DIR__ . '/auth.php';
