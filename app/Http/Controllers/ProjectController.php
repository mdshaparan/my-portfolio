<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Support\DataTableResponse;
use App\Support\FileUpload;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index()
    {
        return view('backend.projects.index');
    }

    // DataTables server-side data
    public function data(Request $request)
    {
        return DataTableResponse::make(
            $request,
            Project::query(),
            ['title', 'category', 'tech', 'summary'],
            [2 => 'title', 3 => 'category', 4 => 'sort_order'],
            fn ($row) => [
                'action'     => view('backend.projects._actions', ['item' => $row])->render(),
                'image'      => $row->image
                    ? '<img src="' . asset('public/uploads/projects/' . $row->image) . '" height="40" alt="">'
                    : '',
                'title' => e($row->title),
                'category' => e($row->category),
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
        return view('backend.projects.form', ['item' => null]);
    }

    public function store(Request $request)
    {
        Project::create($this->prepare($request));

        return redirect()->route('admin.projects.index')->with('success', 'Project added.');
    }

    public function edit(Project $project)
    {
        return view('backend.projects.form', ['item' => $project]);
    }

    public function update(Request $request, Project $project)
    {
        $project->update($this->prepare($request, $project));

        return redirect()->route('admin.projects.index')->with('success', 'Project updated.');
    }

    public function destroy(Project $project)
    {
        FileUpload::delete('projects', $project->image);
        $project->delete();

        return redirect()->route('admin.projects.index')->with('success', 'Project deleted.');
    }

    // Hide / Show
    public function toggle(Project $project)
    {
        $project->update(['is_visible' => ! $project->is_visible]);

        return back()->with('success', 'Visibility changed.');
    }

    private function prepare(Request $request, ?Project $item = null): array
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'nullable|string|max:100',
            'summary' => 'nullable|string',
            'tech' => 'nullable|string|max:255',
            'badge' => 'nullable|string|max:60',
            'image' => 'nullable|image|max:3072',
            'live_url' => 'nullable|url|max:255',
            'source_url' => 'nullable|url|max:255',
            'sort_order' => 'nullable|integer|min:0',
        ]);

        $data['sort_order'] = $data['sort_order'] ?? 0;
        $data['is_visible'] = $request->boolean('is_visible');

        if ($request->hasFile('image')) {
            $data['image'] = FileUpload::store($request->file('image'), 'projects', 'project', $item?->image);
        } else {
            unset($data['image']);
        }

        return $data;
    }
}
