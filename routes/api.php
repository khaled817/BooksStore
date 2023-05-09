<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use  App\Http\Controllers\Api\BooksController;
use  App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\TransactionController;
use App\Http\Controllers\Auth\JWTAuthController;
use App\Http\Controllers\Api\UserController;



Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['middleware' => 'api', 'prefix' => 'auth'], function () {
    Route::post('register', [JWTAuthController::class, 'register']);
    Route::post('login', [JWTAuthController::class, 'login']);
    Route::post('logout', [JWTAuthController::class, 'logout']);
    Route::post('refresh', [JWTAuthController::class, 'refresh']);
    Route::get('me', [JWTAuthController::class, 'me']); 
});

// Users

Route::get('/users', [UserController::class, 'index']);
Route::post('/users', [UserController::class, 'store']);
Route::get('/users/{user}', [UserController::class, 'show']);
Route::put('/users/{user}', [UserController::class, 'update']);
Route::delete('/users/{user}', [UserController::class, 'destroy']);

//Books

Route::get('/books', [BooksController::class, 'index'])->middleware('jwt');
Route::post('/books', [BooksController::class, 'store']);
Route::get('/books/{id}', [BooksController::class, 'show']);
Route::put('/books/{id}', [BooksController::class, 'update']);
Route::delete('/books/{id}', [BooksController::class, 'destroy']);

//Transactions

Route::get('/transactions', [TransactionController::class, 'index']);
Route::post('/transactions', [TransactionController::class, 'store']);
Route::get('/transactions/{id}', [TransactionController::class, 'show']);
Route::put('/transactions/{id}', [TransactionController::class, 'update']);
Route::delete('/transactions/{id}', [TransactionController::class, 'destroy']);

Route::middleware('auth')->group(function () {
    // Get user profile
    Route::get('/users/profile', [UserController::class, 'profile']);

    // Get user details
    Route::get('/users/{id}', [UserController::class, 'show']);
});