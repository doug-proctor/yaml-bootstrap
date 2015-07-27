<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', [
	'as' => 'home', 'uses' => 'PagesController@home'
]);

Route::get('/preview/', function () {
    return Redirect::route('project.preview');
});

Route::get('preview/{id}', [
    'as' => 'preview', 'uses' => 'ProjectsController@preview'
]);

Route::get('yaml/{id}', [
    'as' => 'yaml', 'uses' => 'ProjectsController@yaml'
]);

Route::get('view/{hash}', [
    'as' => 'view', 'uses' => 'PagesController@view'
]);

Route::resource('projects', 'ProjectsController');

Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);
