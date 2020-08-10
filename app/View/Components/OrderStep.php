<?php

namespace App\View\Components;

use Illuminate\View\Component;

class OrderStep extends Component
{
    public $current = 0;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($current)
    {
        $this->current = $current;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.order-step');
    }
}
