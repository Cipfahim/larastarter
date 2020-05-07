<?php

namespace App\View\Components;

use Illuminate\Support\Facades\Cache;
use Illuminate\View\Component;

class BackendSideMenu extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        $items = Cache::rememberForever('backend.sidebar.menu', function() {
            return menu('backend-sidebar');
        });
        return view('components.backend-side-menu',compact('items'));
    }
}
