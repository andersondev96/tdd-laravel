<?php

use App\Http\Controllers\RegisterController;
use App\Http\Controllers\Todo;
use App\Mail\Invitation;
use App\Models\Invite;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;

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


Route::get('/', function () {
    return view('welcome');
});

Route::post('register', RegisterController::class)->name('register');


Route::middleware('auth')->group(function () {

    Route::post('invite', function () {
        Mail::to(request()->email)->send(new Invitation());
        Invite::create(['email' => request()->email]);
    });

    Route::get('todo', Todo\IndexController::class)->name('todo.index');

    Route::post('todo', Todo\CreateController::class)->name('todo.store');

    Route::put('todo/{todo}', Todo\UpdateController::class)->name('todo.update');

    Route::delete('todo/{todo}', Todo\DeleteController::class)->name('todo.destroy');
});

require __DIR__.'/auth.php';
