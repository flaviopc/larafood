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

Route::prefix('admin')
        ->namespace('Admin')
        ->group(function () {

    /**
     * Routes Details Plans
     */
    Route::get('plans/{url}/details', 'DetailPlanController@index')->name('details.plan.index');

    /**
     * Routes plans
     */
    Route::put('plans/{url}', 'PlanController@update')->name('plans.update');
    Route::get('plans/{url}/edit', 'PlanController@edit')->name('plans.edit');
    Route::any('plans/search', 'PlanController@search')->name('plans.search');
    Route::get('plans/create', 'PlanController@create')->name('plans.create');
    Route::get('plans/{url}', 'PlanController@show')->name('plans.show');
    Route::delete('plans/{url}', 'PlanController@destroy')->name('plans.destroy');
    Route::post('plans', 'PlanController@store')->name('plans.store');
    Route::get('plans', 'PlanController@index')->name('plans.index');

    Route::get('/', 'PlanController@index')->name('admin.index');
});


Route::get('/', function () {
    return view('welcome');
});
