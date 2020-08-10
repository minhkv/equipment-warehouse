<?php

namespace App\View\Components;

use Illuminate\View\Component;

class EquipmentAmount extends Component
{

    public $name;
    public $amount;
    public $eId;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($name, $amount, $eId)
    {
        $this->name = $name;
        $this->amount = $amount;
        $this->eId = $eId;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.equipment-amount');
    }
}
