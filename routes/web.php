<?php

Route::group(['middleware' => 'language'], function () {
    Route::get('/', function () {
        return view('welcome');
    })->name('root');

    Auth::routes(['confirm' => false]);

    Route::get('/home', 'HomeController@index')->name('home');

    Route::group([
        'prefix' => 'blogs',
        'as' => 'blogs'
    ],
        function () {
            Route::get('', 'BlogsController@index');
            Route::get('/{slug}', 'BlogsController@show')->middleware('throttle:4,1')->name('.show');
            Route::post('/{slug}/comment', 'BlogsController@comment')->middleware('auth')->name('.comment');

            Route::post('/{post}/like', 'BlogsController@like')->middleware('auth')->name('.like');
            Route::post('/{post}/unlike', 'BlogsController@unlike')->middleware('auth')->name('.unlike');

            Route::post('/{post}/dislike', 'BlogsController@dislike')->middleware('auth')->name('.dislike');
            Route::post('/{post}/undislike', 'BlogsController@undislike')->middleware('auth')->name('.undislike');
        });

    Route::group([
        'prefix' => 'news',
        'as' => 'news'
    ],
        function () {
            Route::get('', 'NewsController@index');
            Route::get('/{slug}', 'NewsController@show')->name('.show');
            Route::post('/{slug}/comment', 'NewsController@comment')->middleware('auth')->name('.comment');

            Route::post('/{news}/like', 'NewsController@like')->middleware('auth')->name('.like');
            Route::post('/{news}/unlike', 'NewsController@unlike')->middleware('auth')->name('.unlike');

            Route::post('/{news}/dislike', 'NewsController@dislike')->middleware('auth')->name('.dislike');
            Route::post('/{news}/undislike', 'NewsController@undislike')->middleware('auth')->name('.undislike');
        });

    Route::group([
        'prefix' => 'comments',
        'as' => 'comments',
        'middleware' => ['auth'],
    ],
        function () {
            Route::patch('/{comment}', 'CommentsController@update')->name('.update');
            Route::delete('/{comment}', 'CommentsController@remove')->name('.delete');

            Route::post('/{comment}/like', 'CommentsController@like')->name('.like');
            Route::post('/{comment}/unlike', 'CommentsController@unlike')->name('.unlike');

            Route::post('/{comment}/dislike', 'CommentsController@dislike')->name('.dislike');
            Route::post('/{comment}/undislike', 'CommentsController@undislike')->name('.undislike');
        });

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
            'prefix' => 'user',
            'as' => 'user.',
            'namespace' => 'User',
            'middleware' => ['auth'],
        ],
        function () {
            Route::get('/posts', 'PostsController@index')->name('posts');
            Route::get('/posts/create', 'PostsController@create')->name('posts.create');
            Route::post('/posts', 'PostsController@store')->name('posts.store');
            Route::get('/posts/{post}/edit', 'PostsController@edit')->name('posts.edit');
            Route::patch('/posts/{post}', 'PostsController@update')->name('posts.update');
            Route::patch('/posts/{post}/no-image', 'PostsController@removeImage')->name('posts.no-image');
            Route::patch('/posts/{post}/publish', 'PostsController@publish')->name('posts.publish');
            Route::patch('/posts/{post}/unpublish', 'PostsController@unpublish')->name('posts.unpublish');
            Route::delete('/posts/{post}', 'PostsController@remove')->name('posts.delete');
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

    Route::group(
        [
            'prefix' => 'rules',
            'as' => 'rules.',
            'namespace' => 'Rules',
        ],
        function () {
            Route::get('', 'RulesController@show')->name('rules-show');
            Route::post('', 'RulesController@check')->name('rules-check');
        }
    );

    Route::group(
        [
            'prefix' => 'server',
            'as' => 'server.',
        ],
        function () {
            Route::get('monitor', 'NFSUServerController@monitor')->name('monitor');
            Route::get('ratings', 'NFSUServerController@ratings')->middleware('throttle:12,1')->name('ratings');
            Route::get('best-performers', 'NFSUServerController@bestPerformers')->name('best-performers');
        }
    );

    Route::group(
        [
            'prefix' => 'contact',
            'as' => 'contact.',
        ],
        function () {
            Route::get('', 'ContactController@create')->name('contact-show');
            Route::post('', 'ContactController@store')->name('contact-send');
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

        Route::get('/pages', 'Pages\PagesController@index')->name('pages');
        Route::get('/pages/create', 'Pages\PagesController@create')->name('pages.create');
        Route::post('/pages', 'Pages\PagesController@store')->name('pages.store');
        Route::get('/pages/{page}/edit', 'Pages\PagesController@edit')->name('pages.edit');
        Route::patch('/pages/{page}', 'Pages\PagesController@update')->name('pages.update');
        Route::get('/pages/{page}', 'Pages\PagesController@show')->name('pages.show');
        Route::delete('/pages/{page}', 'Pages\PagesController@remove')->name('pages.delete');

        Route::group([
            'prefix' => '/posts',
            'as' => 'posts',
            'namespace' => 'Posts',
        ], function () {
            Route::get('', 'PostsController@index');
            Route::get('/{id}/edit', 'PostsController@edit')->name('.edit');
            Route::patch('/{post}/restore', 'PostsController@restore')->name('.restore');
            Route::patch('/{post}', 'PostsController@update')->name('.update');
            Route::delete('/{post}', 'PostsController@remove')->name('.delete');
            Route::patch('/{post}/publish', 'PostsController@publish')->name('.publish');
            Route::patch('/{post}/unpublish', 'PostsController@unpublish')->name('.unpublish');
        });

        Route::group([
            'prefix' => '/news',
            'as' => 'news',
            'namespace' => 'News',
        ], function () {
            Route::get('', 'NewsController@index');
            Route::get('/create', 'NewsController@create')->name('.create');
            Route::post('', 'NewsController@store')->name('.store');
            Route::get('/{news}/edit', 'NewsController@edit')->name('.edit');
            Route::patch('/{news}', 'NewsController@update')->name('.update');
            Route::delete('/{news}', 'NewsController@remove')->name('.delete');
            Route::delete('/{news}/force-delete', 'NewsController@forceRemove')->name('.force-delete');
            Route::patch('/{news}/restore', 'NewsController@restore')->name('.restore');
        });
    });

    // Static pages. Should be at the bottom
    Route::get('/{path}', 'StaticPagesController')
        ->name('page')
        ->where('path', 'rules|about|about/cup|about/server|about/contact|about/donate|help|help/gameplay|help/faq|download|download/nfsu|download/nfsu-save|download/nfsu-client|download/nfsu-save-patcher');
});
