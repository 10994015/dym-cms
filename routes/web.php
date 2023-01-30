<?php

use App\Http\Controllers\AuthController;
use App\Http\Livewire\CreateProxy;
use App\Http\Livewire\Home;
use App\Http\Livewire\HomeComponet;
use App\Http\Livewire\MemberComponet;
use App\Http\Livewire\Proxy;
use App\Http\Livewire\SetMember;
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
Route::get('/', HomeComponet::class)->middleware(['auth']);
Route::get('/member', MemberComponet::class)->middleware(['auth']);
// Route::get('/', Home::class)->middleware(['auth']);
// Route::get('/proxy', Proxy::class)->middleware(['auth']);
Route::get('/createProxy', CreateProxy::class)->middleware(['auth']);
Route::post('/createProxySet', [AuthController::class, 'register'])->middleware(['auth']);
Route::get('/setMember/{id}', SetMember::class)->middleware(['auth']);

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
