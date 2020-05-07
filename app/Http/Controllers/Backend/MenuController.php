<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Menus\StoreMenuRequest;
use App\Http\Requests\Menus\UpdateMenuRequest;
use App\Models\Menu;
use App\Models\MenuItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Str;
use RealRashid\SweetAlert\Facades\Alert;

class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        Gate::authorize('app.menus.index');
        $menus = Menu::latest('id')->get();
        return  view('backend.menus.index',compact('menus'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        Gate::authorize('app.menus.create');
        return view('backend.menus.form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreMenuRequest $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(StoreMenuRequest $request)
    {
        Menu::create([
            'name' => Str::slug($request->name),
            'description' => $request->description,
            'deletable' => true
        ]);
        notify()->success('Menu Successfully Added.', 'Added');
        return redirect()->route('app.menus.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Menu  $menu
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(Menu $menu)
    {
        Gate::authorize('app.menus.edit');
        return view('backend.menus.form',compact('menu'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Menu $menu
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update(UpdateMenuRequest $request, Menu $menu)
    {
        $menu->update([
            'name' => Str::slug($request->name),
            'description' => $request->description,
        ]);
        notify()->success('Menu Successfully Updated.', 'Updated');
        return redirect()->route('app.menus.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Menu $menu
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy(Menu $menu)
    {
        Gate::authorize('app.menus.destroy');
        if ($menu->deletable == true)
        {
            $menu->delete();
            notify()->success('Menu Successfully Deleted.', 'Deleted');
        } else  {
            notify()->error('Sorry you can\'t delete system menu.', 'Error');
        }
        return redirect()->back();
    }

    /**
     * Order menu items
     * @param Request $request
     */
    public function orderItem(Request $request)
    {
        Gate::authorize('app.menus.index');
        $menuItemOrder = json_decode($request->input('order'));
        $this->orderMenu($menuItemOrder, null);
    }

    /**
     * Save menu item order
     * @param array $menuItems
     * @param $parentId
     */
    private function orderMenu(array $menuItems, $parentId)
    {
        Gate::authorize('app.menus.index');
        foreach ($menuItems as $index => $menuItem) {
            $item = MenuItem::findOrFail($menuItem->id);
            $item->order = $index + 1;
            $item->parent_id = $parentId;
            $item->save();

            if (isset($menuItem->children)) {
                $this->orderMenu($menuItem->children, $item->id);
            }
        }
    }
}
