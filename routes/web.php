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
Auth::routes();
 
Route::get('/', function () {
    return view('welcome');
});

Route::get('/mqttsubscriber', 
        ['as' => 'mqtt.monitor',
    'uses' => 'MQTTController@monitor']);

Route::get('/mqttsendmessage', 
        ['as' => 'mqtt.sendmessage',
    'uses' => 'MQTTController@sendmessage']);

Route::get('/mqttiframe', 
        ['as' => 'mqtt.mqttiframe',
    'uses' => 'MQTTController@iframe']);

