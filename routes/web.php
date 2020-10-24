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
    ->middleware('auth')
    ->group(function () {

         /**
         *  Plan Profile
         */
        Route::get('plans/{id}/profile/{idProfile}/detach', 'ACL\PlanProfileController@detachProfilesPlan')->name('plans.profile.detach');
        Route::post('plans/{id}/profiles', 'ACL\PlanProfileController@AttachProfilesPlan')->name('plans.profiles.attach');
        Route::any('plans/{id}/profiles/create', 'ACL\PlanProfileController@profilesAvailable')->name('plans.profiles.available');
        Route::get('plans/{id}/profiles', 'ACL\PlanProfileController@profiles')->name('plans.profiles');
        Route::get('profiles/{id}/plans', 'ACL\PlanProfileController@plans')->name('profiles.plans');

        /**
         * Permission Profile
         */
        Route::get('profiles/{id}/permission/{idPermission}/detach', 'ACL\PermissionProfileController@detachPermissionsProfile')->name('profiles.permissions.detach');
        Route::post('profiles/{id}/permissions', 'ACL\PermissionProfileController@AttachPermissionsProfile')->name('profiles.permissions.attach');
        Route::any('profiles/{id}/permissions/create', 'ACL\PermissionProfileController@permissionsAvailable')->name('profiles.permissions.available');
        Route::get('profiles/{id}/permissions', 'ACL\PermissionProfileController@permissions')->name('profiles.permissions');
        Route::get('permissions/{id}/profile', 'ACL\PermissionProfileController@profiles')->name('permissions.profiles');


        /**
         * Routes Permissions
         */
        Route::any('permissions/search', 'ACL\PermissionController@search')->name('permissions.search');
        Route::resource('permissions', 'ACL\PermissionController');

        /**
         * Routes Profiles
         */
        Route::any('profiles/search', 'ACL\ProfileController@search')->name('profiles.search');
        Route::resource('profiles', 'ACL\ProfileController');

        /**
         * Routes Details Plans
         */
        Route::delete('plans/{url}/details/{idPlan}', 'DetailPlanController@destroy')->name('details.plan.destroy');
        Route::get('plans/{url}/details/{idPlan}', 'DetailPlanController@show')->name('details.plan.show');
        Route::put('plans/{url}/details/{idPlan}', 'DetailPlanController@update')->name('details.plan.update');
        Route::get('plans/{url}/details/{idPlan}/edit', 'DetailPlanController@edit')->name('details.plan.edit');
        Route::post('plans/{url}/details', 'DetailPlanController@store')->name('details.plan.store');
        Route::get('plans/{url}/details', 'DetailPlanController@index')->name('details.plan.index');
        Route::get('plans/{url}/details/create', 'DetailPlanController@create')->name('details.plan.create');


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


Route::get('/', 'Site\SiteController@index')->name('site.home');

Auth::routes();
