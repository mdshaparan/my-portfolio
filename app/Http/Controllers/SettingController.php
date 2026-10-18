<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use App\Support\FileUpload;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function index()
    {
        $setting = Setting::first();

        return view('backend.settings.index', compact('setting'));
    }

    public function create()
    {
        if (Setting::exists()) {
            return redirect()->route('admin.settings.index');
        }

        return view('backend.settings.create');
    }

    public function store(Request $request)
    {
        if (Setting::exists()) {
            return redirect()->route('admin.settings.index');
        }

        Setting::create($this->prepare($request));

        return redirect()->route('admin.settings.index')->with('success', 'Saved.');
    }

    public function edit(Setting $setting)
    {
        return view('backend.settings.edit', compact('setting'));
    }

    public function update(Request $request, Setting $setting)
    {
        $setting->update($this->prepare($request, $setting));

        return redirect()->route('admin.settings.index')->with('success', 'Updated.');
    }

    private function prepare(Request $request, ?Setting $setting = null): array
    {
        $data = $request->validate([
            'site_name' => 'nullable|string|max:150',
            'email'     => 'nullable|email|max:150',
            'phone'     => 'nullable|string|max:50',
            'address'   => 'nullable|string|max:255',
            'facebook'  => 'nullable|url|max:255',
            'linkedin'  => 'nullable|url|max:255',
            'github'    => 'nullable|url|max:255',
            'twitter'   => 'nullable|url|max:255',
            'instagram' => 'nullable|url|max:255',
            'scholar'   => 'nullable|url|max:255',
            'logo'      => 'nullable|image|max:2048',
            'favicon'   => 'nullable|mimes:png,ico,jpg,jpeg,svg,webp|max:1024',
            'resume'    => 'nullable|mimes:pdf,doc,docx|max:5120',
        ]);

        // Keep the old file when no new file is uploaded
        foreach (['logo', 'favicon', 'resume'] as $field) {
            if ($request->hasFile($field)) {
                $data[$field] = FileUpload::store($request->file($field), 'settings', $field, $setting?->$field);
            } else {
                unset($data[$field]);
            }
        }

        return $data;
    }
}
