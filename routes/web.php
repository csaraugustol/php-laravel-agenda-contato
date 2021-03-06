<?php


use App\Http\Controllers\ContatoController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\TelefoneController;
use App\Http\Controllers\EnderecoController;
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

//Route::get('/index', 'ContatoController@index')->name('contato.index')->middleware('auth');

Route::get('pdf', 'PdfController@retornaContPdf')->name('exportacao.pdf')->middleware('auth');

Route::get('excel', 'ExcelController@export')->name('excel')->middleware('auth');

Route::get('/importacao-form', 'ContatoController@importaArqCsv')->middleware('auth');

Route::post('/importacao', 'ContatoController@importaArqCsv')->name('contato.importaArqCsv')->middleware('auth');
