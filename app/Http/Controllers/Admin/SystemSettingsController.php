<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SystemSetting;

class SystemSettingsController extends Controller
{
    public function index()
    {
        $settings = SystemSetting::first(); // Load current settings
        return view('admin.systemsettings.index', compact('settings'));
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'school_name' => 'required|string|max:255',
            'school_email' => 'required|email|max:255',
            'school_phone' => 'nullable|string|max:50',
            'school_address' => 'nullable|string|max:255',
            'logo' => 'nullable|image|mimes:png,jpg,jpeg|max:2048',
        ]);

        $settings = SystemSetting::firstOrNew();

        $settings->school_name = $validated['school_name'];
        $settings->school_email = $validated['school_email'];
        $settings->school_phone = $validated['school_phone'] ?? null;
        $settings->school_address = $validated['school_address'] ?? null;

        if ($request->hasFile('logo')) {
            $logoPath = $request->file('logo')->store('logos', 'public');
            $settings->logo = $logoPath;
        }

        $settings->save();

        return redirect()->route('admin.systemsettings.index')->with('success', 'Settings updated successfully.');
    }
}
