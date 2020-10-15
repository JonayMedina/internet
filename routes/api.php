<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::group([

    'middleware' => 'api',
    'prefix' => 'auth'

], function ($router) {

    Route::post('login', 'AuthController@login');
    Route::post('logout', 'AuthController@logout');
    Route::post('refresh', 'AuthController@refresh');
    Route::post('me', 'AuthController@me');

});

Route::group(['middleware' => 'auth:api'], function (){

    Route::group(['prefix' => 'customers'], function(){
        Route::get('/', 'CustomerController@index');
        Route::get('count', 'CustomerController@indexCount');
        Route::post('store', 'CustomerController@store');
        Route::get('remember-pay/{customer}', 'CustomerController@rememberPay');
        Route::put('update/{id}', 'CustomerController@update');
        Route::put('desactive/{id}', 'CustomerController@desactive');
        Route::put('activate/{id}', 'CustomerController@activate');
        Route::delete('destroy/{id}', 'CustomerController@destroy');
        Route::get('verify-email/{email}', 'CustomerController@emailV');
        Route::get('verify-phone/{phone}', 'CustomerController@phoneV');
        Route::get('verify-dni/{dnmi}', 'CustomerController@dniV');
    });

    Route::group(['prefix' => 'plans'], function(){
        Route::get('/', 'PlanController@index');
        Route::get('count', 'PlanController@indexCount');
        Route::post('store', 'PlanController@store');
        Route::put('update/{plan}', 'PlanController@update');
        Route::put('desactive/{plan}', 'PlanController@desactive');
        Route::put('activate/{plan}', 'PlanController@activate');
        Route::delete('destroy/{plan}', 'PlanController@destroy');
        Route::get('email-verify/{email}', 'PlanController@emailV');
    });

    Route::group(['prefix' => 'charges'], function () {
        Route::get('/', 'PaymentController@index');
        Route::get('count', 'PaymentController@indexCount');
        Route::get('history', 'PaymentController@indexHistory');
        Route::post('store', 'PaymentController@store');
        Route::get('show/{id}', 'PaymentController@show');
        Route::get('edit/{id}', 'PaymentController@edit');
        Route::put('update/{id}', 'PaymentController@update');
        Route::put('desactive/{id}', 'PaymentController@desactive');
        Route::put('activate/{id}', 'PaymentController@activate');
        Route::delete('destroy/{id}', 'PaymentController@destroy');
    });

    Route::group(['prefix' => 'banks'], function () {

        Route::post('store', 'BankController@store');
        Route::get('show/{id}', 'BankController@show');
        Route::get('edit/{id}', 'BankController@edit');
        Route::put('update/{id}', 'BankController@update');
        Route::put('desactive/{id}', 'BankController@desactive');
        Route::put('activate/{id}', 'BankController@activate');
        Route::delete('destroy/{id}', 'BankController@destroy');
    });
});

Route::get('banks/', 'BankController@index');
