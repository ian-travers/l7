<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\View\View;
use Route;

class ComposerServiceProvider extends ServiceProvider
{
    public function boot()
    {
        view()->composer('components.dashboard-left-menu', function (View $view) {
            [$controller, $action] = explode('@', class_basename(Route::getCurrentRoute()->action['controller']));

            return $view->with(compact('controller', 'action'));
        });
    }
}
