<?php

namespace App\View\Components\Forms;

use Illuminate\View\Component;

class Button extends Component
{
    /**
     * The button type.
     *
     * @var string
     */
    public $type;

    /**
     * The button label.
     *
     * @var string
     */
    public $label;

    /**
     * The button class.
     *
     * @var string
     */
    public $class;

    /**
     * The button icon class.
     *
     * @var string
     */
    public $iconClass;

    /**
     * The button onClick function.
     *
     * @var string
     */
    public $onClick;


    /**
     * Create a new component instance.
     *
     * @param string $type
     * @param $label
     * @param string $class
     * @param $iconClass
     * @param null $onClick
     */
    public function __construct($type = 'button', $label, $class = 'btn-primary', $iconClass, $onClick = null)
    {
        $this->type = $type;
        $this->label = $label;
        $this->class = $class;
        $this->iconClass = $iconClass;
        $this->onClick = $onClick;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.forms.button');
    }
}
