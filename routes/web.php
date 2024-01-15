<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\CFCController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\User\AlunosController;
use Illuminate\Support\Facades\Route;

//tela inicial
Route::get('/', function () {
    return view('welcome');
})->name('welcome');

//admin
Route::group(['prefix' => 'admin'], function(){
    //autenticação
    Route::get('/login', [AdminController::class, 'index_login'])->name('admin.view');
    Route::post('/login', [AdminController::class, 'login'])->name('admin.login');
    Route::post('/logout', [AdminController::class, 'logout'])->name('admin.logout');

    // admins
    Route::resources(['/admin' => AdminController::class]); 
    Route::post('/search', [AdminController::class, 'search'])->name('admin.search');
    Route::get('/admins', [AdminController::class, 'index_admins'])->name('admin.admins');

    //cfcs
    Route::resources(['/cfc' => CFCController::class]);
    Route::group(['prefix' => 'cfc'], function(){
        Route::post('/search', [CFCController::class, 'search'])->name('cfc.search');
    });
});

//users
Route::group(['prefix' => 'user'], function(){
    //autenticação
    Route::get('/login', [UserController::class, 'index_login'])->name('user.view');
    Route::post('/login', [UserController::class, 'login'])->name('user.login');
    Route::post('/logout', [UserController::class, 'logout'])->name('user.logout');

    Route::get('/home', [UserController::class, 'home'])->name('user.home');

    // users
    Route::resources(['/user' => UserController::class]);
    Route::post('/search', [UserController::class, 'search'])->name('user.search');
    
    //alunos
    Route::resources(['/aluno' => AlunosController::class]);
    Route::post('aluno/search', [AlunosController::class, 'search'])->name('aluno.search');
});
