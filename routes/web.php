<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

use App\Video;


Route::get('/', function () {

    $videos = \App\Models\Video::all();

    foreach ($videos as $video) {
        echo $video->user->email . '<br>';
        foreach ($video->comments as $comment) {
            echo $comment->body;
        }
        echo '<hr>';
    }
    die();

    return '<pre>' . print_r($videos, 1) . '</pre>';
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Routes del controller de videos (laravel 9 lo hace asi mas simple =)).
Route::get('/crear-video', [\App\Http\Controllers\VideoController::class, 'createVideo'])->name('createVideo')->middleware('auth');
Route::post('/guardar-video', [\App\Http\Controllers\VideoController::class, 'saveVideo'])->name('saveVideo')->middleware('auth');
