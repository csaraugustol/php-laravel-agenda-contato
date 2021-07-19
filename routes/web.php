<?php


use App\Http\Controllers\ContatoController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\TelefoneController;
use App\Http\Controllers\EnderecoController;
use App\Http\Controllers\Auth\LoginController;
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
    return view('welcome');
});

Route::resource('/contato', 'ContatoController')->middleware('auth');

Route::resource('/usuario', 'UsuarioController');

Route::resource('/telefone', 'TelefoneController')->middleware('auth');

Route::resource('/endereco', 'EnderecoController')->middleware('auth');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::post('/busca', 'ContatoController@buscaFiltrada')->name('contato.busca')->middleware('auth');

Route::get('/logout', function(){
Auth::logout();
return redirect()->action('LoginController@logout');
})->name('logout');
