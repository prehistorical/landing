<?php

Route::group(['middleware' => 'auth', 'prefix' => 'adm'], function()
{
    Route::get('/create/init/{block}',              ['as' => 'create_init', 'uses' => 'Prehistorical\Landing\CreateController@createInitBlock']);
    Route::get('/create/init',                      ['as' => 'create_init', 'uses' => 'Prehistorical\Landing\CreateController@createInit']);

    //Для групп внутри блоков:
    Route::get('/create/groupitem/{block}',         ['as' => 'create_groupitem', 'uses' => 'Prehistorical\Landing\CreateController@createGroupItem']);

    //Сохранение
    Route::post('/save/block',                      ['as' => 'save_block', 'uses' => 'Prehistorical\Landing\SaveController@saveBlock']);
    Route::post('/save/groupitem',                  ['as' => 'save_groupitem', 'uses' => 'Prehistorical\Landing\SaveController@saveGroupItem']);

    //Удаление
    Route::delete('/delete/groupitem/{block}',      ['as' => 'delete_groupitem', 'uses' => 'Prehistorical\Landing\DeleteController@deleteGroupItem']);
});
