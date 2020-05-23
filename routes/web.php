<?php

Route::group(['middleware' => 'language'], function () {
    Route::get('/', function () {
        return view('welcome');
    });

    Auth::routes(['confirm' => false]);

    Route::get('/home', 'HomeController@index')->name('home');

    Route::group(
        [
            'prefix' => 'settings',
            'as' => 'settings.',
            'namespace' => 'Settings',
            'middleware' => ['auth'],
        ],
        function () {
            Route::get('/profile', 'AccountController@profile')->name('profile');
            Route::post('/profile', 'AccountController@updateProfile')->name('profile.update');
            Route::post('/profile/avatar', 'AccountController@updateAvatar')->name('profile.avatar');
            Route::post('/profile/no-avatar', 'AccountController@removeAvatar')->name('profile.no-avatar');

            Route::get('/account', 'AccountController@account')->name('account');
            Route::post('/account', 'AccountController@deleteAccount')->name('account.delete');
            Route::post('/account/email', 'AccountController@updateEmail')->name('account.email');
            Route::post('/account/password', 'AccountController@changePassword')->name('account.password');

            Route::get('/team', 'AccountController@team')->name('team');
        }
    );

    Route::group(
        [
            'prefix' => 'tests',
            'as' => 'tests.',
            'namespace' => 'Tests',
            'middleware' => ['auth'],
        ],
        function () {
            Route::get('/racer', 'TestsController@racerTest')->name('racer-test');
        }
    );
});
