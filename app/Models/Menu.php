<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    protected $guarded = [];

    protected $casts = ['is_visible' => 'boolean'];

    // Section types (shown in the admin dropdown)
    public const TYPES = [
        'about'        => 'About (photo, paragraph, education)',
        'experience'   => 'Experience',
        'projects'     => 'Projects',
        'publications' => 'Publications',
        'skills'       => 'Skills',
        'resume'       => 'Resume (preview + download)',
        'contact'      => 'Contact (form + info)',
        'custom'       => 'Custom (your own text)',
    ];

    public function scopeVisible($query)
    {
        return $query->where('is_visible', true)->orderBy('sort_order')->orderBy('id');
    }
}
