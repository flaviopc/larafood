<?php

Route::group([
    'prefix' => 'v1',
    'namespace' => 'Api'
], function () {
    Route::get('/tenant/{uuid}', 'TenantApiController@show');
    Route::get('/tenants', 'TenantApiController@index');

    Route::get('/categories/{identify}', 'CategoryApiController@show');
    Route::get('/categories', 'CategoryApiController@categoriesByTenant');

    Route::get('/tables/{identify}', 'TableApiController@show');
    Route::get('/tables', 'TableApiController@tablesByTenant');

    Route::get('/products/{identify}', 'ProductApiController@show');
    Route::get('/products', 'ProductApiController@productsByTenant');

    Route::post('/client', 'Auth\RegisterController@store');

    Route::post('/sanctum/token', 'Auth\AuthClientController@auth');
    Route::get('/me','Auth\AuthClientController@me')->middleware('auth:sanctum');
    Route::post('/logout','Auth\AuthClientController@logout')->middleware('auth:sanctum');
});
