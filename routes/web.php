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

Route::view('/', 'welcome');

Route::view('register-teacher', 'register_teacher');
Route::post('register-teacher', 'AuthController@registerTeacherStore');

Route::view('register-student', 'register_student');
Route::post('register-student', 'AuthController@registerStudentStore');

Route::get('oauth/{type}/{provider}', 'AuthController@RedirectToProvider');
Route::get('{type}/{provider}/callback', 'AuthController@ProviderCallback');

Route::get('users', 'AuthController@usersDisplay');