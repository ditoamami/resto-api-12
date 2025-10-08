<?php
namespace App\Services;

use App\Models\Menu;

class MenuService
{
    public function list()
    {
        return Menu::orderBy('created_at', 'asc')->get();
    }

    public function create(array $data)
    {
        return Menu::create($data);
    }

    public function update(Menu $menu, array $data)
    {
        $menu->update($data);
        return $menu;
    }

    public function delete(Menu $menu)
    {
        $menu->delete();
        return true;
    }
}