<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Support\DataTableResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class MenuController extends Controller
{
    // The hero section already uses the id 'hero', so it cannot be a menu slug
    private const RESERVED = ['hero', 'top'];

    public function index()
    {
        return view('backend.menus.index');
    }

    // DataTables server-side data
    public function data(Request $request)
    {
        return DataTableResponse::make(
            $request,
            Menu::query(),
            ['title', 'slug', 'section_type'],
            [1 => 'title', 2 => 'slug', 3 => 'section_type', 4 => 'sort_order'],
            fn ($row) => [
                'action'       => view('backend.menus._actions', ['item' => $row])->render(),
                'title'        => e($row->title),
                'slug'         => '#' . e($row->slug),
                'section_type' => e(Menu::TYPES[$row->section_type] ?? $row->section_type),
                'sort_order'   => $row->sort_order,
                'status'       => $row->is_visible
                    ? '<span class="badge bg-success">Visible</span>'
                    : '<span class="badge bg-secondary">Hidden</span>',
            ],
            'sort_order'
        );
    }

    public function create()
    {
        return view('backend.menus.form', ['item' => null]);
    }

    public function store(Request $request)
    {
        Menu::create($this->prepare($request));

        return redirect()->route('admin.menus.index')->with('success', 'Menu added. The new section now appears on the website.');
    }

    public function edit(Menu $menu)
    {
        return view('backend.menus.form', ['item' => $menu]);
    }

    public function update(Request $request, Menu $menu)
    {
        $menu->update($this->prepare($request, $menu));

        return redirect()->route('admin.menus.index')->with('success', 'Menu updated.');
    }

    public function destroy(Menu $menu)
    {
        $menu->delete();

        return redirect()->route('admin.menus.index')->with('success', 'Menu deleted. The section was removed from the website.');
    }

    // Hide / Show
    public function toggle(Menu $menu)
    {
        $menu->update(['is_visible' => ! $menu->is_visible]);

        return back()->with('success', 'Visibility changed.');
    }

    private function prepare(Request $request, ?Menu $menu = null): array
    {
        $data = $request->validate([
            'title'        => 'required|string|max:100',
            'slug'         => ['nullable', 'alpha_dash', 'max:60', Rule::notIn(self::RESERVED), Rule::unique('menus', 'slug')->ignore($menu?->id)],
            'section_type' => ['required', Rule::in(array_keys(Menu::TYPES))],
            'description'  => 'nullable|string|max:1000',
            'content'      => 'nullable|string',
            'sort_order'   => 'nullable|integer|min:0',
        ]);

        $data['slug']       = ! empty($data['slug']) ? Str::lower($data['slug']) : $this->uniqueSlug($data['title'], $menu);
        $data['sort_order'] = $data['sort_order'] ?? 0;
        $data['is_visible'] = $request->boolean('is_visible');

        return $data;
    }

    // If no slug is given, generate one from the title (about, about-2 ...)
    private function uniqueSlug(string $title, ?Menu $menu): string
    {
        $base = Str::slug($title) ?: 'section';
        $slug = $base;
        $i = 2;

        while (
            in_array($slug, self::RESERVED)
            || Menu::where('slug', $slug)->where('id', '!=', $menu?->id ?? 0)->exists()
        ) {
            $slug = $base . '-' . $i++;
        }

        return $slug;
    }
}
