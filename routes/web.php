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

Auth::routes(['register' => false]);

/* Home */
Route::get('/', 'WelcomeController@index')->name('welcome');
Route::get('/home', 'HomeController@index')->name('home');


/* Header links */
Route::get('/dashboard', 'DashboardController@index')->name('dashboard');
Route::get('/cabinet', 'CabinetController@index')->name('cabinet');
Route::get('/votes', 'VotesController@index');
Route::get('/achievements', 'AchievementsController@index');
Route::get('/rules', 'RulesController@index');
Route::get('/hall', 'HallController@index');
Route::get('/english', 'EnglishController@index');
Route::get('/test', 'TestEnglishController@index');


/* Points */
Route::get('/points', 'PointsController@create');
Route::get('/points/codestyle', 'PointsController@codestyle');
Route::get('/points/mentoring', 'PointsController@mentoring');
Route::get('/points/responsibility', 'PointsController@responsibility');


/* Other */
Route::get('/loop', 'LoopController@index');
Route::get('/vacations', 'VacationController@index');
Route::get('/accounts', 'AccountsController@index');
Route::get('/contracts', 'ContractsController@index');
Route::get('/contracts/editcontract', 'ContractsController@editContract');
Route::get('/savetourresults', 'DashboardController@saveTourResults');

/* Submit */
Route::post('/points', 'PointsController@store');
Route::post('/contracts/saveContract', 'ContractsController@saveContract');
Route::post('/cabinet/saveTime', 'CabinetController@saveTime');
Route::post('/cabinet/saveDescription', 'CabinetController@saveDescription');
Route::post('/vacations/saveValues', 'VacationController@saveValues');
Route::post('/achievements/saveAchievements', 'AchievementsController@saveAchievements');
Route::post('/votes/saveValues', 'VotesController@saveValues');
Route::post('/english/saveAnswers', 'EnglishController@saveAnswers');
    
/* Tests */
Route::get('/english/schedule', 'EnglishController@schedule');
Route::get('/english/analiz', 'EnglishController@analiz');
Route::get('/english/reading', 'EnglishController@testReading');
Route::get('/english/logic', 'EnglishController@testLogic');
Route::get('/english/restatements', 'EnglishController@testRestatements');
Route::get('/english/completions', 'EnglishController@testCompletions');