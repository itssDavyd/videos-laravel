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


/*Route::get('/', function () {

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
});*/

Auth::routes();

//HOME_CONTROLLER
Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Routes del controller de videos (laravel 9 lo hace asi mas simple =)).
//VIDEOS_CONTROLLER
Route::get('/crear-video', [\App\Http\Controllers\VideoController::class, 'createVideo'])->name('createVideo')->middleware('auth');
Route::post('/guardar-video', [\App\Http\Controllers\VideoController::class, 'saveVideo'])->name('saveVideo')->middleware('auth');
Route::post('/update-video/{video_id}', [\App\Http\Controllers\VideoController::class, 'update'])->name('updateVideo')->middleware('auth');
Route::get('/miniatura/{filename}', [\App\Http\Controllers\VideoController::class, 'getImage'])->name('imageVideo');
Route::get('/video/{video_id}', [\App\Http\Controllers\VideoController::class, 'getVideoPage'])->name('detailVideo');
Route::get('/video-file/{filename}', [\App\Http\Controllers\VideoController::class, 'getVideo'])->name('videoFile');
Route::get('/video-del/{video_id}', [\App\Http\Controllers\VideoController::class, 'delete'])->name('deleteVideo');
Route::get('/edit-video/{video_id}', [\App\Http\Controllers\VideoController::class, 'edit'])->name('editVideo');
Route::get('/buscar/{search?}', [\App\Http\Controllers\VideoController::class, 'search'])->name('searchVideo');
Route::get('/filtro/{buscadorActivo?}', [\App\Http\Controllers\VideoController::class, 'filter'])->name('filtro');

//COMMENT_CONTROLLER
Route::post('/comment', [\App\Http\Controllers\CommentController::class, 'store'])->name('comment')->middleware('auth');
Route::get('/comment-del/{id_comment}', [\App\Http\Controllers\CommentController::class, 'deleteComment'])->name('deleteComment');

//USER_CONTROLLER
Route::get('/channel/{user_id}', [\App\Http\Controllers\UserController::class, 'channel'])->name('channelUser');

//CLEAR CACHE.
Route::get('/clear-cache', function () {
    \Illuminate\Support\Facades\Artisan::call('cache:clear');
    dd('Cache is cleared');
});
