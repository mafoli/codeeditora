<?php

Route::group(['middleware' => 'web', 'prefix' => 'categories', 'namespace' => '\CodeEduBook\Http\Controllers'], function()
{
    Route::get('/', 'CategoriesController@index');
});



