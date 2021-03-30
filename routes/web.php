<?php

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
	return view('pages.main');
})->name('main');

//Auth::routes();
Auth::routes(['verify' => true]);

Route::get('dashboard', 'App\Http\Controllers\DashboardController@index')->name('dashboard')->middleware('auth');
Route::get('faq', 'App\Http\Controllers\FAQController@index')->name('faq')->middleware('auth');

Route::resource( 'meetings', 'App\Http\Controllers\MeetingsController' )->names([
	'index' => 'meetings',
	'show' => 'meetings.show',
	'create' => 'meetings.new',
	'edit' => 'meetings.edit',
	'update' => 'meetings.update',
])->middleware('auth');

Route::resource( 'emails', 'App\Http\Controllers\EmailsController' )->names([
    'index' => 'emails',
    'show' => 'emails.show',
    'create' => 'emails.new',
    'edit' => 'emails.edit',
    'update' => 'emails.update',
])->middleware('auth');
Route::get('emails/send/{id}', 'App\Http\Controllers\EmailsController@send')->name('emailssend')->middleware('auth');

Route::resource( 'surveys', 'App\Http\Controllers\SurveysController' )->names([
    'index' => 'surveys',
    'show' => 'surveys.show',
    'create' => 'surveys.new',
    'edit' => 'surveys.edit',
    'update' => 'surveys.update',
])->middleware('auth');

Route::resource( 'chat', 'App\Http\Controllers\ChatController' )->names([
    'index' => 'chat',
    'show' => 'chat.show',
    'create' => 'chat.new',
    'edit' => 'chat.edit',
    'update' => 'chat.update',
])->middleware('auth');

Route::get('profile', 'App\Http\Controllers\ProfileController@index')->name('profile')->middleware('auth');
Route::post('profile/update/{id}', 'App\Http\Controllers\ProfileController@update')->name('profileu')->middleware('auth');

Route::get('users', 'App\Http\Controllers\UsersController@index')->name('users')->middleware('auth', 'admin');
Route::get('surveysadmin', 'App\Http\Controllers\SurveysAdminController@index')->name('surveysadmin')->middleware('auth', 'admin');
Route::get('surveycsv', 'App\Http\Controllers\SurveysAdminController@getAnswers')->name('surveycsv')->middleware('auth', 'admin');

Route::get('/email/verify', function () {
	return view('auth.verify');
})->middleware(['auth'])->name('verification.notice');

// Ajax
Route::get('setmood', 'App\Http\Controllers\MoodController@store')->name('setmood')->middleware('auth');
Route::get('csend', 'App\Http\Controllers\ChatController@store')->name('csend')->middleware('auth');