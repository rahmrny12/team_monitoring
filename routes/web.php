<?php

use App\Http\Controllers\ClientController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\TimeActivityController;
use App\Http\Controllers\TodoController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
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
    return view('dashboard', ['title' => 'Dashboard']);
})->middleware('auth');

Route::get('dashboard', function () {
    return view('dashboard', ['title' => 'Dashboard']);
})->middleware('auth')->name('dashboard');

Route::resource('projects', ProjectController::class)->middleware('auth');
Route::get('projects/archive/{id}', [ProjectController::class, 'archive'])->name('archive')->middleware('auth');
Route::resource('todos', TodoController::class)->middleware('auth');

Route::resource('time-activities', TimeActivityController::class)->middleware('auth');
Route::resource('clients', ClientController::class)->middleware('auth');

Route::get('members', [MemberController::class, 'index'])->name('members')->middleware('auth');
Route::post('members', [MemberController::class, 'invite'])->name('invite-member')->middleware('auth');
Route::get('projects/{id}/members', [MemberController::class, 'membersByProject'])->name('project-members')->middleware('auth');
Route::post('projects/{id}/members', [MemberController::class, 'addMember'])->name('add-member')->middleware('auth');
Route::delete('projects/{project_id}/members/{user_id}', [MemberController::class, 'removeMember'])->name('remove-member')->middleware('auth');

Auth::routes();
