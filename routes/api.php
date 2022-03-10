<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Resources\VideoCollection;
use App\Http\Resources\UserCollection;
use App\Http\Controllers\VideoController;
use App\Http\Controllers\UserController;
use App\Models\Video;
use App\Models\User;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

//===================================
//             VIDEOS
//===================================

// Usuari normal (controlar que hagi fet log in)

// List all videos
Route::get('/videos',function () {
    return new VideoCollection(Video::all());
})->middleware('auth:sanctum');
 
// List all series
Route::get('/series', [VideoController::class, 'allSeries'])->middleware('auth:sanctum');

// List all movies
Route::get('/movies', [VideoController::class, 'allMovies'])->middleware('auth:sanctum');

// List videos by title
Route::get('/videos/{title}', [VideoController::class, 'videosByTitle'])->middleware('auth:sanctum');

// List videos by genere
Route::get('/videoGenere/{genere}', [VideoController::class, 'videosByGenere'])->middleware('auth:sanctum');

// List videos by id
Route::get('/videoById/{id}', [VideoController::class, 'videosById'])->middleware('auth:sanctum');

// Update a video
Route::patch('/video/{id}', [VideoController::class, 'updateVideo'])
->middleware('auth:sanctum')
->middleware('isAdmin');

// Delete a video
Route::delete('/video/delete/{id}', [VideoController::class, 'deleteVideo'])
->middleware('auth:sanctum')
->middleware('isAdmin');

//===================================
//             USERS
//===================================

// Login
Route::post('login', [LoginController::class, 'doLoginAPI']);

// List all users
Route::get('/users',function () {
    return new UserCollection(User::all());
})
->middleware('auth:sanctum')
->middleware('isAdmin');

// Create user
Route::post('/userCreate', [UserController::class, 'createUser'])
->middleware('auth:sanctum')
->middleware('isAdmin');

// Update user
Route::patch('/user/{id}', [UserController::class, 'updateUser'])
->middleware('auth:sanctum')
->middleware('isAdmin');

// Delete user
Route::delete('/user/delete/{id}', [UserController::class, 'deleteUser'])->middleware('isAdmin')
->middleware('auth:sanctum')
->middleware('isAdmin');
