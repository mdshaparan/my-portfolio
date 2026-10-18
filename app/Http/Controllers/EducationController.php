<?php

namespace App\Http\Controllers;

use App\Models\Education;
use Illuminate\Http\Request;

class EducationController extends Controller
{
    // DataTables server-side data
    public function data(Request $request)
    {
        $columns = [1 => 'degree', 2 => 'institution', 3 => 'period', 4 => 'sort_order'];

        $total = Education::count();
        $query = Education::query();

        if ($search = $request->input('search.value')) {
            $query->where(function ($q) use ($search) {
                $q->where('period', 'like', "%{$search}%")
                  ->orWhere('institution', 'like', "%{$search}%")
                  ->orWhere('degree', 'like', "%{$search}%");
            });
        }

        $filtered = $query->count();

        $orderCol = $columns[$request->input('order.0.column')] ?? 'sort_order';
        $orderDir = $request->input('order.0.dir') === 'desc' ? 'desc' : 'asc';
        $query->orderBy($orderCol, $orderDir);

        $length = (int) $request->input('length', 10);
        if ($length > 0) {
            $query->skip((int) $request->input('start', 0))->take($length);
        }

        $rows = $query->get()->map(fn ($e) => [
            'action'      => view('backend.education._actions', ['education' => $e])->render(),
            'degree'      => e($e->degree),
            'institution' => e($e->institution),
            'period'      => e($e->period),
            'sort_order'  => $e->sort_order,
            'status'      => $e->is_visible
                ? '<span class="badge bg-success">Visible</span>'
                : '<span class="badge bg-secondary">Hidden</span>',
        ]);

        return response()->json([
            'draw'            => (int) $request->input('draw'),
            'recordsTotal'    => $total,
            'recordsFiltered' => $filtered,
            'data'            => $rows,
        ]);
    }

    public function create()
    {
        return view('backend.education.form', ['education' => null]);
    }

    public function store(Request $request)
    {
        Education::create($this->validated($request));
        return redirect()->route('admin.about.index')->with('success', 'Education added.');
    }

    public function edit(Education $education)
    {
        return view('backend.education.form', compact('education'));
    }

    public function update(Request $request, Education $education)
    {
        $education->update($this->validated($request));
        return redirect()->route('admin.about.index')->with('success', 'Education updated.');
    }

    public function destroy(Education $education)
    {
        $education->delete();
        return redirect()->route('admin.about.index')->with('success', 'Education deleted.');
    }

    public function toggle(Education $education)
    {
        $education->update(['is_visible' => ! $education->is_visible]);
        return back()->with('success', 'Visibility changed.');
    }

    private function validated(Request $request): array
    {
        $data = $request->validate([
            'degree'      => 'required|string|max:255',
            'institution' => 'required|string|max:255',
            'location'    => 'nullable|string|max:255',
            'period'      => 'required|string|max:100',
            'grade'       => 'nullable|string|max:100',
            'description' => 'nullable|string|max:2000',
            'sort_order'  => 'nullable|integer|min:0',
        ]);
        $data['sort_order'] = $data['sort_order'] ?? 0;
        $data['is_visible'] = $request->boolean('is_visible');

        return $data;
    }
}