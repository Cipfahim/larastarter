<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Settings\UpdateGeneralSettingsRequest;
use App\Http\Requests\Settings\UpdateLogoRequest;
use App\Http\Requests\Settings\UpdateMailSettingsRequest;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;

class SettingController extends Controller
{
    /**
     * Show General Settings Page
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('backend.settings.general');
    }

    /**
     * Update General Settings
     * @param UpdateGeneralSettingsRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateGeneralSettingsRequest $request)
    {
        Setting::updateSettings($request->validated());
        notify()->success('Settings Successfully Updated.','Success');
        return back();
    }

    /**
     * Show Logo Settings Page
     * @return \Illuminate\View\View
     */
    public function logo()
    {
        return view('backend.settings.logo');
    }

    /**
     * Update Logo
     * @param UpdateLogoRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateLogo(UpdateLogoRequest $request)
    {
        if ($request->hasFile('site_logo')) {
            $this->deleteOldLogo(config('settings.site_logo'));
            Setting::set('site_logo',Storage::disk('public')->putFile('logos', $request->file('site_logo')));
        }
        if ($request->hasFile('site_favicon')) {
            $this->deleteOldLogo(config('settings.site_favicon'));
            Setting::set('site_favicon', Storage::disk('public')->putFile('logos', $request->file('site_favicon')));
        }
        notify()->success('Settings Successfully Updated.','Success');
        return back();
    }

    /**
     * Delete old logos from storage
     * @param $path
     */
    private function deleteOldLogo($path)
    {
        Storage::disk('public')->delete($path);
    }

    /**
     * Show Mail Settings Page
     * @return \Illuminate\View\View
     */
    public function mail()
    {
        return view('backend.settings.mail');
    }

    /**
     * Update Mail Settings
     * @param UpdateMailSettingsRequest $request
     */
    public function updateMailSettings(UpdateMailSettingsRequest $request)
    {
        Setting::updateSettings($request->validated());
        notify()->success('Settings Successfully Updated.','Success');
        return back();
    }
}
