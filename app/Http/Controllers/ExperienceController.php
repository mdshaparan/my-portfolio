<?php

namespace App\Http\Controllers;

use App\Models\Experience;
use App\Support\DataTableResponse;
use Illuminate\Http\Request;

class ExperienceController extends Controller
{
    public function index()
    {
        return view('backend.experience.index');
    }

    // DataTables server-side data
    public function data(Request $request)
    {
        return DataTableResponse::make(
            $request,
            Experience::query(),
            ['role', 'organization', 'location', 'period'],
            [1 => 'role', 2 => 'organization', 3 => 'period', 4 => 'sort_order'],
            fn ($row) => [
                'action'     => view('backend.experience._actions', ['item' => $row])->render(),
                'role' => e($row->role),
                'organization' => e($row->organization),
                'period' => e($row->period),
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
        return view('backend.experience.form', ['item' => null]);
    }

    public function store(Request $request)
    {
        Experience::create($this->prepare($request));

        return redirect()->route('admin.experiences.index')->with('success', 'Experience added.');
    }

    public function edit(Experience $experience)
    {
        return view('backend.experience.form', ['item' => $experience]);
    }

    public function update(Request $request, Experience $experience)
    {
        $experience->update($this->prepare($request, $experience));

        return redirect()->route('admin.experiences.index')->with('success', 'Experience updated.');
    }

    public function destroy(Experience $experience)
    {
        $experience->delete();

        return redirect()->route('admin.experiences.index')->with('success', 'Experience deleted.');
    }

    // Hide / Show
    public function toggle(Experience $experience)
    {
        $experience->update(['is_visible' => ! $experience->is_visible]);

        return back()->with('success', 'Visibility changed.');
    }

    private function prepare(Request $request, ?Experience $item = null): array
    {
        $data = $request->validate([
            'role' => 'required|string|max:255',
            'organization' => 'required|string|max:255',
            'location' => 'nullable|string|max:255',
            'period' => 'required|string|max:100',
            'description' => 'nullable|string',
            'sort_order' => 'nullable|integer|min:0',
        ]);

        $data['sort_order'] = $data['sort_order'] ?? 0;
        $data['is_visible'] = $request->boolean('is_visible');

        return $data;
    }
}
