<?php

namespace App\View\Components;

use Illuminate\View\Component;
use App\Equipment;

class EditEquipmentMember extends Component
{

    public $eId;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($eId)
    {
        $this->eId = $eId;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        $equipment = Equipment::find($this->eId);
        return view('components.edit-equipment-member')->with([
            'equipment' => $equipment
        ]);
    }
}