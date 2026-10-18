<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\Project;
use App\Models\Publication;
use App\Models\Skill;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('backend.dashboard', [
            'projectCount'     => Project::count(),
            'publicationCount' => Publication::count(),
            'skillCount'       => Skill::count(),
            'unreadCount'      => Message::where('is_read', false)->count(),
        ]);
    }
}
