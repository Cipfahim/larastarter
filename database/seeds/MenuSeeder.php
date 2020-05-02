<?php

use App\Models\Menu;
use App\Models\MenuItem;
use Illuminate\Database\Seeder;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $menu = Menu::updateOrCreate(['name' => 'backend-sidebar', 'description' => 'This is backend sidebar', 'deletable' => false]);

        MenuItem::updateOrCreate(['menu_id' => $menu->id, 'parent_id' => null, 'order' => 1, 'title' => 'Dashboard', 'url' => "/app/dashboard", 'icon_class' => 'fas fa-tachometer-alt']);
        MenuItem::updateOrCreate(['menu_id' => $menu->id, 'parent_id' => null, 'order' => 1, 'title' => 'Dashboard', 'url' => "/app/dashboard", 'icon_class' => 'fas fa-tachometer-alt']);
        MenuItem::updateOrCreate(['menu_id' => $menu->id, 'parent_id' => null, 'order' => 2, 'title' => 'Pages', 'url' => "/app/pages", 'icon_class' => 'far fa-file-alt']);
        MenuItem::updateOrCreate(['menu_id' => $menu->id, 'parent_id' => null, 'order' => 3, 'title' => 'Menu Builder', 'url' => "/app/menus", 'icon_class' => 'fas fa-list-ul']);
        MenuItem::updateOrCreate(['menu_id' => $menu->id, 'parent_id' => null, 'order' => 4, 'title' => 'Access Control', 'url' => "#", 'icon_class' => 'fas fa-fingerprint']);
        MenuItem::updateOrCreate(['menu_id' => $menu->id, 'parent_id' => 4, 'order' => 1, 'title' => 'Roles', 'url' => "/app/roles", 'icon_class' => 'fas fa-user-secret']);
        MenuItem::updateOrCreate(['menu_id' => $menu->id, 'parent_id' => 4, 'order' => 2, 'title' => 'Users', 'url' => "/app/users", 'icon_class' => 'fas fa-users']);
        MenuItem::updateOrCreate(['menu_id' => $menu->id, 'parent_id' => null, 'order' => 5, 'title' => 'Settings', 'url' => "/app/settings", 'icon_class' => 'fas fa-cog']);
    }
}
