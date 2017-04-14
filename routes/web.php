<?php

Route::group(['prefix' => 'clientes'], function () {
    Route::get('index', 'ClienteController@index');
    Route::post('save', 'ClienteController@store');
    Route::get('get/{id}', 'ClienteController@get');
    Route::put('update/{id}', 'ClienteController@update');
    Route::delete('delete/{id}', 'ClienteController@destroy');
});

Route::group(['prefix' => 'materiaprima'], function () {
    Route::get('index', 'MateriaPrimaController@index');
    Route::post('save', 'MateriaPrimaController@store');
    Route::get('get/{id}', 'MateriaPrimaController@get');
    Route::put('update/{id}', 'MateriaPrimaController@update');
    Route::delete('delete/{id}', 'MateriaPrimaController@destroy');
});

Route::group(['prefix' => 'pedido'], function () {
    Route::get('index', 'PedidoController@index');
    Route::post('save', 'PedidoController@store');
    Route::get('get/{id}', 'PedidoController@get');
    Route::put('update/{id}', 'PedidoController@update');
    Route::delete('delete/{id}', 'PedidoController@destroy');
});

Route::group(['prefix' => 'pedidoitem'], function () {
    Route::get('index', 'PedidoItemController@index');
    Route::post('save', 'PedidoItemController@store');
    Route::get('get/{id}', 'PedidoItemController@get');
    Route::put('update/{id}', 'PedidoItemController@update');
    Route::delete('delete/{id}', 'PedidoItemController@destroy');
});

Route::group(['prefix' => 'produto'], function () {
    Route::get('index', 'ProdutoController@index');
    Route::post('save', 'ProdutoController@store');
    Route::get('get/{id}', 'ProdutoController@get');
    Route::put('update/{id}', 'ProdutoController@update');
    Route::delete('delete/{id}', 'ProdutoController@destroy');
});

Route::group(['prefix' => 'produtomateria'], function () {
    Route::get('index', 'ProdutoMateriaController@index');
    Route::post('save', 'ProdutoMateriaController@store');
    Route::get('get/{id}', 'ProdutoMateriaController@get');
    Route::put('update/{id}', 'ProdutoMateriaController@update');
    Route::delete('delete/{id}', 'ProdutoMateriaController@destroy');
});
