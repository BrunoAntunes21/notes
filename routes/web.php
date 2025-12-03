<?php

use App\Http\Controllers\MainController;
use App\Http\Controllers\AuthController;
use App\Http\Middleware\CheckIsLogged;
use App\Http\Middleware\CheckIsNotlogged;
use Illuminate\Support\Facades\Route;

// Auth routes -- user not logged
Route::middleware([CheckIsNotlogged::class])->group(function () {
    Route::get('/login', [AuthController::class, 'login']);
    Route::post('/loginSubmit', [AuthController::class, 'loginSubmit']);
});

// App routes -- user logged
Route::middleware([CheckIsLogged::class])->group(function () {
    Route::get('/', [MainController::class, 'index'])->name('home');
    Route::get('/newNote', [MainController::class, 'newNote'])->name('new');
    Route::post('/newNoteSubmit',[MainController::class,'newNoteSubmit'])->name('newNoteSubmit');
    //edit notes
    Route::get('/edit/{id}', [MainController::class, 'editNote'])->name('edit');
    Route::post('/editNoteSubmit',[MainController::class,'editNoteSubmit'])->name('editNoteSubmit');
    //delete Notes
    Route::get('/delete/{id}', [MainController::class, 'deleteNote'])->name('delete');
    Route::get('/deleteNoteConfirm/{id}', [MainController::class, 'deleteNoteConfirm'])->name('deleteNoteConfirm');




    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
});
