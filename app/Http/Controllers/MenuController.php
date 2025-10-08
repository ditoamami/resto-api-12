<?php
namespace App\Http\Controllers;

use App\Http\Requests\MenuRequest;
use App\Models\Menu;
use App\Services\MenuService;

class MenuController extends Controller
{
    protected $service;

    public function __construct(MenuService $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        return $this->service->list();
    }

    public function store(MenuRequest $req)
    {
        return $this->service->create($req->validated());
    }

    public function show(Menu $menu)
    {
        return $menu;
    }

    public function update(MenuRequest $req, Menu $menu)
    {
        return $this->service->update($menu, $req->validated());
    }

    public function destroy(Menu $menu)
    {
        $this->service->delete($menu);
        
        return response()->noContent();
    }
}