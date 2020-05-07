<?php

if (!function_exists('menu')) {

    /**
     * Get menu with items and child's by name
     *
     * @param
     * @return
     */
    function menu($name)
    {
        $menu = \App\Models\Menu::where('name',$name)->first();
        return $menu->menuItems()->with('childs')->get();
    }
}
