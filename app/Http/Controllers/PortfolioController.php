<?php

namespace App\Http\Controllers;

use App\Models\About;
use App\Models\Education;
use App\Models\Experience;
use App\Models\Hero;
use App\Models\Menu;
use App\Models\Project;
use App\Models\Publication;
use App\Models\Skill;

class PortfolioController extends Controller
{
    // Everything is one page. Sections follow the navbar menus managed in the admin.
    public function index()
    {
        $hero  = Hero::first();
        $menus = Menu::visible()->get();
        $types = $menus->pluck('section_type')->all();
        $has   = fn (string $t) => in_array($t, $types);

        return view('frontend.pages.home', [
            'hero'         => $hero,
            'menus'        => $menus,
            'about'        => $has('about') ? About::first() : null,
            'educations'   => $has('about') ? Education::where('is_visible', true)->orderBy('sort_order')->get() : collect(),
            'skills'       => $has('skills') ? Skill::orderBy('id')->get() : collect(),
            'experiences'  => $has('experience') ? Experience::visible()->get() : collect(),
            'projects'     => $has('projects') ? Project::visible()->get() : collect(),
            'publications' => $has('publications') ? Publication::visible()->get() : collect(),
        ]);
    }
}
