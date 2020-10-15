<?php

use Illuminate\Support\Facades\Route;

Route::get('/', 'PagesController@index')->name('index');
// Route::get('/nosotros', 'PagesController@about')->name('about');
Route::get('/contacto/{type}', 'PagesController@contact')->name('contact');

Route::get('/admincnet/{any?}', function (){
    return view('pages.admin');
})->where('any', '.*');

Route::get('/reportar-tu-pago', 'PaymentController@create')->name('pay-report');

Route::post('/payment/store', 'PaymentController@store')->name('store-report');

Route::get('/customer/find/{dni}', 'CustomerController@search')->name('search-customer');

Route::get('customer-pdf/{id}', 'CustomerController@pdf');



Route::get('/ccache', function() {
    $exitCode = Artisan::call('config:clear');
    $exitCode = Artisan::call('cache:clear');
    $exitCode = Artisan::call('config:cache');
    return 'DONE'; //Return anything
});

Route::get('mailable', function () {
    $contract = App\Models\Contract::find(1);
    $customer = $contract->customer;

    $pdf = Traits\HelpersTrait::contract($contract->id);

    return new App\Mail\CustomerContract($contract, $customer, $pdf);
});
