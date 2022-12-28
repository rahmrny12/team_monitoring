<?php

use App\Http\Controllers\ClientController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\TimeActivityController;
use App\Http\Controllers\UserController;
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
});

Route::get('dashboard', function () {
    return view('dashboard', ['title' => 'Dashboard']);
})->name('dashboard');

Route::resource('projects', ProjectController::class);
Route::get('/projects/archive/{id}', [ProjectController::class, 'archive'])->name('archive');

Route::resource('time-activities', TimeActivityController::class);
Route::resource('clients', ClientController::class);

Route::get('members', [MemberController::class, 'index'])->name('members');
Route::post('members', [MemberController::class, 'invite'])->name('invite-member');
Route::get('projects/{id}/members', [MemberController::class, 'membersByProject'])->name('project-members');
Route::post('projects/{id}/members', [MemberController::class, 'addMember'])->name('add-member');
Route::delete('projects/{project_id}/members/{user_id}', [MemberController::class, 'removeMember'])->name('remove-member');
