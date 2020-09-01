<?php

namespace App\View\Components;

use Illuminate\View\Component;
use App\Supplier;

class AddEquipmentMember extends Component
{
    public $templateId;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($templateId)
    {
        $this->templateId = $templateId;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        $suppliers = Supplier::all();
        return view('components.add-equipment-member')->with([
            'suppliers' => $suppliers
        ]);
    }
}