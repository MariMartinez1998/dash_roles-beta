<?php

use Illuminate\Support\Facades\Route;
//agregamos los siguientes controladores
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RolController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\BlogController;

use App\Http\Controllers\RelacionController;
use App\Http\Controllers\MessageController;

use App\Http\Controllers\pdfController;
use App\Http\Controllers\profilleController;

use App\mail\WelcomeNewsletter;
use Illuminate\Support\Facades\Mail;
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

/*Route::get('/', function () {
    return view('welcome');
});*/
//Route::get('/', 'App\Http\Controllers\RelacionController@index' );


Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//y creamos un grupo de rutas protegidas para los controladores
Route::group(['middleware' => ['auth']], function() {
    Route::resource('roles', RolController::class);
    Route::resource('usuarios', UsuarioController::class);
    Route::resource('blogs', BlogController::class);
    Route::resource('cliente', RelacionController::class);
    Route::get('cliente/{id}', [RelacionController::class, 'show'])->name('seguimiento');
    Route::post('menssage/store', [MessageController::class, 'store'])->name('message-store');
    Route::get('download-pdf', [BlogController::class, 'downloadPDF'])->name('download-pdf');
    Route::get('download-placa', [BlogController::class, 'downloadplaca'])->name('download-placa');
    Route::get('/changepassword',[profilleController::class, 'changepasswordForm'])->name('changepassword');
    Route::post('/changepassword', [profilleController::class, 'changepassword'])->name('changepassword');
    //Route::name('print')->get('/imprimir', 'Controller@imprimir');
});

//Envio de correos
Route::get('registro', function () {
    $correo = new WelcomeNewsletter;
    Mail::to('mayojose321@gmail.com')->send($correo);
    return "mensaje enviado";
});

// use App\Models\User;
Route::get('notificacion', function () {
    $correo = new WelcomeNewsletter;
    Mail::to('mayojose321@gmail.com')->send($correo);
    return "mensaje enviado";
});