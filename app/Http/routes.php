<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    Mail::raw('Hello world', function ($message){
        $message->to('foo@bar.com');
        $message->from('bar@foo.com');
    });

    return 'Email was sent';
});

Route::get('feedback', function () {
    return "You've been clicked, punk.";
});
