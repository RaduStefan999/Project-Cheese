<?php

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
    return redirect('/login');
});

Route::group(['middleware' => ['web']], function() {

    // Login Routes...
        Route::get('login', ['as' => 'login', 'uses' => 'Auth\LoginController@showLoginForm']);
        Route::post('login', ['as' => 'login.post', 'uses' => 'Auth\LoginController@login']);
        Route::post('logout', ['as' => 'logout', 'uses' => 'Auth\LoginController@logout']);

});

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/docs', 'CheeseController@docs')->name('docs');
Route::get('/controlpanel', 'CheeseController@controlpanel')->name('cpanel');
Route::get('/consoleoutput', 'CheeseController@console')->name('console');

Route::post('/MilkUpload', 'MilkController@milkreceiver')->name('milk.submit');
Route::post('/MilkRemove', 'MilkController@milkremover')->name('milk.remove');

Route::get('/runcmd', 'MilkController@milkcommander')->name('milk.command');
Route::get('/runcmd1', 'MilkController@milkcommander1')->name('milk.command1');
Route::get('/runcmd2', 'MilkController@milkcommander2')->name('milk.command2');
Route::get('/runcmd3', 'MilkController@milkcommander3')->name('milk.command3');
