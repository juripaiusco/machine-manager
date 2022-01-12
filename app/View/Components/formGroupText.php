<?php

namespace App\View\Components;

use Illuminate\View\Component;

class formGroupText extends Component
{
    public $fieldName;
    public $field;
    public $json;
    public $classFormElementGroup;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($fieldName, $field, $json, $classFormElementGroup)
    {
        $this->fieldName = $fieldName;
        $this->field = $field;
        $this->json = $json;
        $this->classFormElementGroup = $classFormElementGroup;
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
