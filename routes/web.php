<?php

use Illuminate\Support\Facades\Route;

Route::domain(env('APP_URL'))->group(function () {
    Route::get("regionBlock", "Web\IndexController@regionBlock")->name('web.regionBlock');
    Route::namespace("Web")->name("web.")->middleware('maintenance')->group(function () {
        Route::get("/", "IndexController@index")->name('index');
        Route::get("activity", "IndexController@activity_list")->name('activity.list');
    });
});

Route::group([], function () {
    Route::post('/attachment/upload/{file_type}/{category}', 'UploadController@commonUpload')->name('attachment.upload');
    Route::delete('/attachment/delete', 'UploadController@commonDelete')->name('attachment.delete');
});

Route::post('/pay/callback/{payment}', 'Web\PayController@third_callback')->name('pay.callback');
Route::post('/pay/sx_callback', 'Web\PayController@sx_callback')->name('pay.sx_callback');
Route::any('/pay/sx_test', 'Web\PayController@sx_test')->name('pay.sx_test');
