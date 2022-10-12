<?php

use App\Http\Controllers\BladeViewController;
use App\Http\Controllers\HomeController;
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

Route::get( '/login', function () {
    return view( 'auth.login' );
} );


Route::get( '/', function () {
    return view( 'welcome' );
} );


Auth::routes( [
    'register' => true, // Registration Routes...
    'reset'    => false, // Password Reset Routes...
    'verify'   => false, // Email Verification Routes...
] );


//RUTAS PARA EL ADMIN
Route::group( [ 'prefix' => 'admin-panel/', 'middleware' => 'auth' ], function () {
    Route::get( '/home', [ App\Http\Controllers\HomeController::class, 'index' ] )->name( 'home' );
    //Route::get( '/', [ BladeViewController::class, 'admin' ] )->name( 'admin' );
    Route::get( '/marcas', [ BladeViewController::class, 'marcas' ] )->name( 'marcas' );
    Route::get( '/categorias', [ BladeViewController::class, 'categorias' ] )->name( 'categorias' );
    Route::get( '/modelos', [ BladeViewController::class, 'modelos' ] )->name( 'modelos' );
    Route::get( '/productos', [ BladeViewController::class, 'productos' ] )->name( 'productos' );
    Route::get( '/tamanos', [ BladeViewController::class, 'tamanos' ] )->name( 'tamanos' );

} );


