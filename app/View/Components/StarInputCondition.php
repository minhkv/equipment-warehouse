<?php

namespace App\View\Components;

use Illuminate\View\Component;

class StarInputCondition extends Component
{
    public $name;
    public $id;
    public $value;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($name, $id, $value)
    {
        $this->name = $name;
        $this->id = $id;
        $this->value = $value;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.star-input-condition');
    }
}
