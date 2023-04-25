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
