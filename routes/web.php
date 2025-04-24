<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;

use App\Notifications\CustomResetPassword;

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

Auth::routes(['verify' => true, 'register' => false]);

Route::get('/', function () { return redirect('/admin'); });
Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [LoginController::class, 'login']);
Route::get('logout', [LoginController::class, 'logout']);

Route::get('/register', function () { return view('auth.register'); });
Route::post('register', [RegisterController::class,'register']);




Route::get('mail-preview', function () {
    return (new CustomResetPassword('ji'))->toMail(App\User::find(1));
});


Route::group(['namespace' => 'Admin', 'prefix' => 'admin', 'as' => 'admin.', 'middleware' => ['auth', 'admin']], function () {
	
	Route::get('/', [App\Http\Controllers\Admin\HomeController::class, 'index'])->name('home');
	
	Route::get('clear-cache', [App\Http\Controllers\Admin\HomeController::class, 'clearCache']);

	Route::get('users/profile/{id}', [App\Http\Controllers\Admin\UserController::class, 'getProfile']);
	Route::post('users/profile-update/{id}', [App\Http\Controllers\Admin\UserController::class, 'updateProfile'])->name('users.update.profile');
 
	Route::get('/dashboard', function () { 
		return redirect('/admin');
	})->name('dashboard');

	/* -------------------------------------------------------------------------------------------------------------------------------------------------- */

	// UPORABNIKI
	Route::get('users/delete/{id}', [App\Http\Controllers\Admin\UserController::class, 'delete']);
	Route::get('users/search', [App\Http\Controllers\Admin\UserController::class, 'search'])->name('users.search');
	Route::get('users/isciUporabnike', [App\Http\Controllers\Admin\UserController::class, 'isciUporabnike'])->name('users.isciuporabnike');
	Route::resource('users', 'UserController');

	
	Route::post('users/dodajprijatelja', [App\Http\Controllers\Admin\PrijateljstvoController::class, 'dodajPrijatelja'])->name('users.dodajprijatelja');
	Route::post('users/sprejmiprijatelja', [App\Http\Controllers\Admin\PrijateljstvoController::class, 'sprejmiPrijatelja'])->name('users.sprejmiprijatelja');
	Route::post('users/zavrniprijatelja', [App\Http\Controllers\Admin\PrijateljstvoController::class, 'zavrniPrijatelja'])->name('users.zavrniprijatelja');
	Route::post('users/odstraniprijatelja', [App\Http\Controllers\Admin\PrijateljstvoController::class, 'odstraniPrijatelja'])->name('users.odstraniprijatelja');
	


	Route::get('users/view/{id}', [App\Http\Controllers\Admin\UserController::class, 'viewProfile']);


	/* -------------------------------------------------------------------------------------------------------------------------------------------------- */

	// OBJAVE

		Route::get('objave/delete/{id}', [App\Http\Controllers\Admin\ObjavaController::class, 'delete']);
		Route::post('objave/vseckaj', [App\Http\Controllers\Admin\ObjavaController::class, 'vseckaj'])->name('objave.vseckaj');
		Route::resource('objave', 'ObjavaController')->names('objave');

	/* -------------------------------------------------------------------------------------------------------------------------------------------------- */

	// KOMENTARJI

		Route::get('komentarji/delete/{id}', [App\Http\Controllers\Admin\KomentarController::class, 'delete']);
		Route::get('komentarji/create/{id}', [App\Http\Controllers\Admin\KomentarController::class, 'create']);
		Route::resource('komentarji', 'KomentarController')->names('komentarji');

	/* -------------------------------------------------------------------------------------------------------------------------------------------------- */

	// SPOROČILA

		Route::get('sporocila/delete/{id}', [App\Http\Controllers\Admin\SporociloController::class, 'delete']);
		Route::post('sporocila/store', [App\Http\Controllers\Admin\SporociloController::class, 'store'])->name('sporocila.store');
		Route::get('sporocila/show/{id}',  [App\Http\Controllers\Admin\SporociloController::class, 'show']);
		

	/* -------------------------------------------------------------------------------------------------------------------------------------------------- */

	//SHRANJENA OBJAVA

		Route::get('shranjeneobjave/shranjene', [App\Http\Controllers\Admin\ShranjenaObjavaController::class, 'vrniShranjeneObjave'])->name('admin.objave.shranjene');
		Route::post('shranjeneobjave/store', [App\Http\Controllers\Admin\ShranjenaObjavaController::class, 'shraniObjavo']);
	/* -------------------------------------------------------------------------------------------------------------------------------------------------- */

});

Route::name('frontend.')->group(function () {

});

Route::get('/dashboard', function () { 
	return view('pages.dashboard'); 
})->name('dashboard');

// API Documentation
Route::get('/rest-api', function () { return view('api'); });

