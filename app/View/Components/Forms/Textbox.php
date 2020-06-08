<?php

namespace App\View\Components\Forms;

use Illuminate\View\Component;

class Textbox extends Component
{
    /**
     * The field type.
     *
     * @var string
     */
    public $type;

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
     * @param string $type
     * @param $label
     * @param $name
     * @param null $placeholder
     * @param null $class
     * @param null $value
     * @param null $fieldAttributes
     */
    public function __construct($type = 'text', $label, $name, $placeholder = null, $class = null, $value= null, $fieldAttributes = null)
    {
        $this->type = $type;
        $this->label = $label;
        $this->name = $name;
        $this->placeholder = $placeholder;
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
        return view('components.forms.textbox');
    }
}
