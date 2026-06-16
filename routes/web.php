<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MyEventController;
use App\Http\Controllers\RegistrationController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/eventos/{event}', [EventController::class, 'show'])->name('events.show');

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
});

Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::middleware('participant')->group(function () {
        Route::get('/meus-eventos', [MyEventController::class, 'index'])->name('my-events.index');
        Route::post('/eventos/{event}/inscricao', [RegistrationController::class, 'store'])->name('registrations.store');
        Route::delete('/eventos/{event}/inscricao', [RegistrationController::class, 'destroy'])->name('registrations.destroy');
    });

    Route::middleware('organizer')->prefix('organizador')->name('organizer.')->group(function () {
        Route::get('/eventos', [EventController::class, 'index'])->name('events.index');
        Route::get('/eventos/criar', [EventController::class, 'create'])->name('events.create');
        Route::post('/eventos', [EventController::class, 'store'])->name('events.store');
        Route::get('/eventos/{event}/editar', [EventController::class, 'edit'])->name('events.edit');
        Route::put('/eventos/{event}', [EventController::class, 'update'])->name('events.update');
        Route::delete('/eventos/{event}', [EventController::class, 'destroy'])->name('events.destroy');
    });
});
