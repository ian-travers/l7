<?php

Route::group(['middleware' => 'language'], function () {
    Route::get('/', function () {
        return view('welcome');
    })->name('root');

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
        ],
        function () {
            Route::get('/racer', 'TestsController@racerTest')->name('racer-test');
            Route::post('/racer', 'TestsController@checkRacerTest')->name('check-racer-test');
        }
    );

    Route::group([
        'middleware' => ['auth', 'admin'],
        'prefix' => '/adm',
        'namespace' => 'Backend',
        'as' => 'admin.'
    ], function () {
        Route::get('/', 'DashboardController@show')->name('dashboard');
        Route::get('/tests', 'Tests\QuestionsController@index')->name('tests.questions');
        Route::get('/tests/create', 'Tests\QuestionsController@create')->name('tests.questions.create');
        Route::post('/tests', 'Tests\QuestionsController@store')->name('tests.questions.store');
        Route::get('/tests/{question}/edit', 'Tests\QuestionsController@edit')->name('tests.questions.edit');
        Route::get('/tests/{question}', 'Tests\QuestionsController@show')->name('tests.questions.show');
        Route::patch('/tests/{question}', 'Tests\QuestionsController@update')->name('tests.questions.update');
        Route::delete('/tests/{question}', 'Tests\QuestionsController@remove')->name('tests.questions.delete');

        Route::group([
            'prefix' => '/tests/{question}/answers',
        ], function () {
            Route::get('/create', 'Tests\AnswersController@create')->name('tests.answers.create');
            Route::post('', 'Tests\AnswersController@store')->name('tests.answers.store');
            Route::get('/{answer}/edit', 'Tests\AnswersController@edit')->name('tests.answers.edit');
            Route::patch('/{answer}', 'Tests\AnswersController@update')->name('tests.answers.update');
            Route::delete('/{answer}', 'Tests\AnswersController@remove')->name('tests.answers.delete');
        });
    });

    // Static pages. Should be at the bottom
    Route::get('/{page}', 'StaticPagesController')
        ->name('page')
        ->where('page', 'rules|about|about/cup|about/contact|about/donate|help|help/gameplay|help/faq|download|download/nfsu|download/nfsu-save|download/nfsu-client|download/nfsu-save-patcher');
});
