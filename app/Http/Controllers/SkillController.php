<?php

namespace App\Http\Controllers;

use App\Models\Skill;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class SkillController extends Controller
{
    public function index()
    {
        $skills = Skill::orderBy('id')->get();
        return view('backend.skills.index', compact('skills'));
    }

    public function create()
    {
        return view('backend.skills.form', ['skill' => null]);
    }

    public function store(Request $request)
    {
        Skill::create($this->validated($request));
        return redirect()->route('admin.skills.index')->with('success', 'Skill added.');
    }

    public function edit(Skill $skill)
    {
        return view('backend.skills.form', compact('skill'));
    }

    public function update(Request $request, Skill $skill)
    {
        $skill->update($this->validated($request, $skill));
        return redirect()->route('admin.skills.index')->with('success', 'Skill updated.');
    }

    public function destroy(Skill $skill)
    {
        $skill->delete();
        return redirect()->route('admin.skills.index')->with('success', 'Skill deleted.');
    }

    private function validated(Request $request, ?Skill $skill = null): array
    {
        return $request->validate([
            'name'        => ['required', 'string', 'max:100', Rule::unique('skills', 'name')->ignore($skill?->id)],
            'level'       => 'required|integer|min:0|max:100',
            'description' => 'nullable|string|max:255',
        ]);
    }
}