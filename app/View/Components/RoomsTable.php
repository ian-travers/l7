<?php

namespace App\View\Components;

use Illuminate\View\Component;

class RoomsTable extends Component
{
    public $rooms;

    public function __construct(array $rooms)
    {
        $this->rooms = $rooms;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('frontend.server._room-table', [
            'rooms' => $this->rooms,
        ]);
    }
}
