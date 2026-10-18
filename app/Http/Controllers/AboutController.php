<?php

namespace App\Http\Controllers;

use App\Models\About;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AboutController extends Controller
{
    public function index()
    {
        $about = About::first();

        return view('backend.about.index', compact('about'));
    }

    public function create()
    {
        if (About::exists()) {
            return redirect()->route('admin.about.index');
        }
        return view('backend.about.create');
    }

    public function store(Request $request)
    {
        if (About::exists()) {
            return redirect()->route('admin.about.index');
        }
        $data = $this->uploadPhoto($request, $this->validated($request));
        About::create($data);

        return redirect()->route('admin.about.index')->with('success', 'About info saved.');
    }

    public function edit(About $about)
    {
        return view('backend.about.edit', compact('about'));
    }

    public function update(Request $request, About $about)
    {
        $data = $this->uploadPhoto($request, $this->validated($request), $about);
        $about->update($data);

        return redirect()->route('admin.about.index')->with('success', 'About info updated.');
    }

    private function validated(Request $request): array
    {
        $data = $request->validate([
            'eyebrow'        => 'nullable|string|max:100',
            'heading'        => 'required|string|max:255',
            'heading_size'   => 'required|in:sm,md,lg,xl',
            'photo_caption'  => 'nullable|string|max:255',
            'paragraph_1'    => 'nullable|string',
            'paragraph_2'    => 'nullable|string',
            'paragraph_size' => 'required|in:sm,md,lg',
            'languages'      => 'nullable|string|max:255',
            'photo'          => 'nullable|image|max:2048',
        ]);
        return $data;
    }

    private function uploadPhoto(Request $request, array $data, ?About $about = null): array
    {
        if ($request->hasFile('photo')) {
            $file = $request->file('photo');
            $name = 'about_' . Str::random(10) . '.' . $file->extension();
            $file->move(public_path('uploads/about'), $name);

            if ($about && $about->photo) {
                $old = public_path('uploads/about/' . $about->photo);
                if (is_file($old)) {
                    unlink($old);
                }
            }
            $data['photo'] = $name;
        } else {
            unset($data['photo']); // Keep the old photo when no new photo is uploaded
        }

        return $data;
    }
}