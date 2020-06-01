<?php

namespace App\View\Components\Forms;

use Illuminate\View\Component;

class Select extends Component
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
     * The field placeholder.
     *
     * @var string
     */
    public $placeholder;

    /**
     * Create a new component instance.
     *
     * @param $label
     * @param $name
     * @param $class
     * @param $placeholder
     */
    public function __construct($label, $name, $class = null, $placeholder = null)
    {
        $this->label = $label;
        $this->name = $name;
        $this->class = $class;
        $this->placeholder = $placeholder;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.forms.select');
    }
}
