<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Illuminate\View\View;
use Route;

class SettingsMenu extends Component
{
    /**
     * Get the view / contents that represent the component.
     *
     * @return View|string
     */
    public function render()
    {
        return view('components.settings-menu', ['current' => Route::currentRouteName()]);
    }
}
