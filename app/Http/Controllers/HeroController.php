<?php

namespace App\Http\Controllers;

use App\Models\Hero;
use App\Support\FileUpload;
use Illuminate\Http\Request;

class HeroController extends Controller
{
    public function index()
    {
        $hero = Hero::first();

        return view('backend.hero.index', compact('hero'));
    }

    public function create()
    {
        if (Hero::exists()) {
            return redirect()->route('admin.hero.index');
        }

        return view('backend.hero.create');
    }

    public function store(Request $request)
    {
        if (Hero::exists()) {
            return redirect()->route('admin.hero.index');
        }

        Hero::create($this->prepare($request));

        return redirect()->route('admin.hero.index')->with('success', 'Hero saved.');
    }

    public function edit(Hero $hero)
    {
        return view('backend.hero.edit', compact('hero'));
    }

    public function update(Request $request, Hero $hero)
    {
        $hero->update($this->prepare($request, $hero));

        return redirect()->route('admin.hero.index')->with('success', 'Hero updated.');
    }

    private function prepare(Request $request, ?Hero $hero = null): array
    {
        $data = $request->validate([
            'greeting'       => 'required|string|max:100',
            'name'           => 'required|string|max:150',
            'role_title'     => 'nullable|string|max:150',
            'tagline_prefix' => 'nullable|string|max:100',
            'typed_items'    => 'nullable|string|max:500',
            'intro'          => 'nullable|string|max:2000',
            'badges'         => 'nullable|string|max:500',
            'status_text'    => 'nullable|string|max:150',
            'photo_tags'     => 'nullable|string|max:300',
            'btn1_text'      => 'nullable|string|max:50',
            'btn1_link'      => 'nullable|string|max:255',
            'btn2_text'      => 'nullable|string|max:50',
            'btn2_link'      => 'nullable|string|max:255',
            'photo'          => 'nullable|image|max:3072',
        ]);

        if ($request->hasFile('photo')) {
            $data['photo'] = FileUpload::store($request->file('photo'), 'hero', 'hero', $hero?->photo);
        } else {
            unset($data['photo']); // Keep the old photo when no new photo is uploaded
        }

        return $data;
    }
}
