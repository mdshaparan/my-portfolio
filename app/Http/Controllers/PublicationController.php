<?php

namespace App\Http\Controllers;

use App\Models\Publication;
use App\Support\DataTableResponse;
use Illuminate\Http\Request;

class PublicationController extends Controller
{
    public function index()
    {
        return view('backend.publications.index');
    }

    // DataTables server-side data
    public function data(Request $request)
    {
        return DataTableResponse::make(
            $request,
            Publication::query(),
            ['title', 'authors', 'venue', 'year', 'status'],
            [1 => 'year', 2 => 'title', 3 => 'venue', 4 => 'status', 5 => 'sort_order'],
            fn ($row) => [
                'action'     => view('backend.publications._actions', ['item' => $row])->render(),
                'year' => e($row->year),
                'title' => e($row->title),
                'venue' => e($row->venue),
                'status_text' => e($row->status),
                'sort_order' => $row->sort_order,
                'status'     => $row->is_visible
                    ? '<span class="badge bg-success">Visible</span>'
                    : '<span class="badge bg-secondary">Hidden</span>',
            ],
            'sort_order'
        );
    }

    public function create()
    {
        return view('backend.publications.form', ['item' => null]);
    }

    public function store(Request $request)
    {
        Publication::create($this->prepare($request));

        return redirect()->route('admin.publications.index')->with('success', 'Publication added.');
    }

    public function edit(Publication $publication)
    {
        return view('backend.publications.form', ['item' => $publication]);
    }

    public function update(Request $request, Publication $publication)
    {
        $publication->update($this->prepare($request, $publication));

        return redirect()->route('admin.publications.index')->with('success', 'Publication updated.');
    }

    public function destroy(Publication $publication)
    {
        $publication->delete();

        return redirect()->route('admin.publications.index')->with('success', 'Publication deleted.');
    }

    // Hide / Show
    public function toggle(Publication $publication)
    {
        $publication->update(['is_visible' => ! $publication->is_visible]);

        return back()->with('success', 'Visibility changed.');
    }

    private function prepare(Request $request, ?Publication $item = null): array
    {
        $data = $request->validate([
            'title' => 'required|string|max:500',
            'authors' => 'required|string|max:500',
            'venue' => 'nullable|string|max:255',
            'year' => 'nullable|string|max:10',
            'status' => 'required|in:Published,Accepted,Under Review,Preprint',
            'url' => 'nullable|url|max:500',
            'abstract' => 'nullable|string',
            'sort_order' => 'nullable|integer|min:0',
        ]);

        $data['sort_order'] = $data['sort_order'] ?? 0;
        $data['is_visible'] = $request->boolean('is_visible');

        return $data;
    }
}
