<?php

use App\Http\Controllers\AuthController;
use App\Http\Livewire\ChangeMemberPassword;
use App\Http\Livewire\ChangeProxyPassword;
use App\Http\Livewire\CreateMember;
use App\Http\Livewire\CreateProxy;
use App\Http\Livewire\CreateSubaccount;
use App\Http\Livewire\CreateSubProxy;
use App\Http\Livewire\Dashborad;
use App\Http\Livewire\GameManage;
use App\Http\Livewire\Home;
use App\Http\Livewire\HomeComponet;
use App\Http\Livewire\IpRecord;
use App\Http\Livewire\LoginRecord;
use App\Http\Livewire\MemberComponet;
use App\Http\Livewire\NotFound;
use App\Http\Livewire\PointManage;
use App\Http\Livewire\Proxy;
use App\Http\Livewire\ReportManage;
use App\Http\Livewire\SetMember;
use App\Http\Livewire\SetProxy;
use App\Http\Livewire\SetSubaccount;
use App\Http\Livewire\SetUserPoint;
use App\Http\Livewire\StoreRecord;
use App\Http\Livewire\Subaccount;
use App\Http\Livewire\ViewSubMember;
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

//get
Route::get('/', Dashborad::class)->middleware(['auth']);
Route::get('/proxy', HomeComponet::class)->middleware(['auth']);
Route::get('/member', MemberComponet::class)->middleware(['auth']);
// Route::get('/', Home::class)->middleware(['auth']);
// Route::get('/proxy', Proxy::class)->middleware(['auth']);
Route::get('/createProxy/{id}', CreateProxy::class)->middleware(['auth']);
Route::get('/setMember/{id}', SetMember::class)->middleware(['auth']);
Route::get('/changeMemberPassword/{id}', ChangeMemberPassword::class)->middleware(['auth']);
Route::get('/changeProxyPassword/{id}', ChangeProxyPassword::class)->middleware(['auth']);
Route::get('/createMember', CreateMember::class)->middleware(['auth']);
Route::get('/setProxy/{id}', SetProxy::class)->middleware(['auth']);
Route::get('/loginRecord/{id}', LoginRecord::class)->middleware(['auth']);
Route::get('/ipRecord/{ip}', IpRecord::class)->middleware(['auth']);
Route::get('/pointManage', PointManage::class)->middleware(['auth']);
Route::get('/setUserPoint/{id}', SetUserPoint::class)->middleware(['auth']);
Route::get('/storeRecord/{id}', StoreRecord::class)->middleware(['auth']);
Route::get('/gameManage', GameManage::class)->middleware(['auth']);
Route::get('/reportManage', ReportManage::class)->middleware(['auth']);

Route::get('/subaccount', Subaccount::class)->middleware(['auth']);
Route::get('/createSubaccount', CreateSubaccount::class)->middleware(['auth']);
// Route::get('/viewSubMember/{id}', ViewSubMember::class)->middleware(['auth']);
Route::get('/createSubProxy/{id}', CreateSubProxy::class)->middleware(['auth']);
Route::get('/setSubaccount/{id}', SetSubaccount::class)->middleware(['auth']);


Route::get('/notfound', NotFound::class)->middleware(['auth']);

//post
Route::post('/createProxySet', [AuthController::class, 'register'])->middleware(['auth']);
Route::post('/createSubProxySet', [AuthController::class, 'registerSubProxy'])->middleware(['auth']);
Route::post('/chk_change_password', [AuthController::class, 'changePassword'])->middleware(['auth']);
Route::post('/chk_change_proxy_password', [AuthController::class, 'changeProxyPassword'])->middleware(['auth']);
Route::post('/chk_create_member', [AuthController::class, 'createMember'])->middleware(['auth']);
Route::post('/chk_create_subaccount', [AuthController::class, 'createSubaccount'])->middleware(['auth']);

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
