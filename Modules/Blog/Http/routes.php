<?php

Route::group(['middleware' => 'web', 'prefix' => 'blog', 'namespace' => '\Blog\Http\Controllers'], function()
{
    Route::get('/', 'BlogController@index');
});
