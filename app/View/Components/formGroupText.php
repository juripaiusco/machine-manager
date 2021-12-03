<?php

namespace App\View\Components;

use Illuminate\View\Component;

class formGroupText extends Component
{
    public $field_name;
    public $field;
    public $json;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($fieldName, $field, $json)
    {
        $this->field_name = $fieldName;
        $this->field = $field;
        $this->json = $json;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.form-group-text');
    }
}
