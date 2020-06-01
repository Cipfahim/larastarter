<?php

namespace App\View\Components\Forms;

use Illuminate\View\Component;

class Dropify extends Component
{
    /**
     * The field label.
     *
     * @var string
     */
    public $label;

    /**
     * The field name.
     *
     * @var string
     */
    public $name;

    /**
     * The field class.
     *
     * @var string
     */
    public $class;

    /**
     * The field value.
     *
     * @var string
     */
    public $value;

    /**
     * The field attributes.
     *
     * @var string
     */
    public $fieldAttributes;

    /**
     * Create a new component instance.
     *
     * @param $label
     * @param $name
     * @param null $class
     * @param null $value
     * @param null $fieldAttributes
     */
    public function __construct($label, $name, $class = null, $value = null, $fieldAttributes = null)
    {
        $this->label = $label;
        $this->name = $name;
        $this->class = $class;
        $this->value = $value;
        $this->fieldAttributes = $fieldAttributes;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.forms.dropify');
    }
}
