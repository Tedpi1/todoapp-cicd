<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AuthManager;
use App\Http\Controllers\TaskManager;

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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/login', [AuthManager::class, 'login'])->name('login');
Route::get('/register', [AuthManager::class, 'register'])->name('register');
Route::post('/register', [AuthManager::class, 'registerPost'])->name('register.post');
Route::post('/login', [AuthManager::class, 'loginPost'])->name('login.post');
Route::middleware('auth')->group(function(){
    Route::get('/', [TaskManager::class, 'listTask'])->name('home');
    Route::get('/add-task', [TaskManager::class, 'addTask'])->name('add.task');
    Route::post('/add-task', [TaskManager::class, 'addTaskPost'])->name('add.task.post');
    Route::get('/update-task/{id}', [TaskManager::class, 'updateTask'])->name('update.task.update');
});

