<?php

namespace Database\Seeders;

use App\Models\Education;
use App\Models\Hero;
use App\Models\Menu;
use App\Models\Setting;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    // Default data. Safe to run more than once (no duplicates).
    public function run(): void
    {
        User::firstOrCreate(
            ['email' => 'admin@gmail.com'],
            ['name' => 'Admin', 'password' => Hash::make('Admin@12345')]
        );

        if (! Menu::exists()) {
            $menus = [
                ['About', 'about', 'about', 'A little about my background, education and what I enjoy building.'],
                ['Experience', 'experience', 'experience', 'Internships and hands-on work I have done so far.'],
                ['Projects', 'projects', 'projects', 'Selected projects I have built and contributed to.'],
                ['Publications', 'publications', 'publications', 'My research papers and presentations.'],
                ['Skills', 'skills', 'skills', 'Technologies and tools I work with.'],
                ['Contact me', 'contact', 'contact', 'Have a project or opportunity in mind? Send me a message.'],
            ];
            foreach ($menus as $i => [$title, $slug, $type, $desc]) {
                Menu::create([
                    'title' => $title, 'slug' => $slug, 'section_type' => $type,
                    'description' => $desc, 'sort_order' => ($i + 1) * 10, 'is_visible' => true,
                ]);
            }
        }

        if (! Hero::exists()) {
            Hero::create([
                'greeting'       => "Hello, I'm",
                'name'           => 'Md. Shaparan Ahammed',
                'role_title'     => 'Student · Intern · Early-stage Researcher',
                'tagline_prefix' => 'Building with',
                'typed_items'    => 'Laravel, Deep Learning, Computer Vision, Explainable AI',
                'intro'          => 'Undergraduate student at AIUB. I build web applications and do research on robust, explainable fire and smoke detection.',
                'status_text'    => 'Open to research collaborations',
                'photo_tags'     => 'Deep Learning, Computer Vision, Laravel',
                'badges'         => 'IEEE CSDE 2026, 1 Research Paper, Laravel Developer',
                'btn1_text'      => 'Explore projects',
                'btn1_link'      => '#projects',
                'btn2_text'      => 'View resume',
                'btn2_link'      => '#contact',
            ]);
        }

        if (! Education::exists()) {
            Education::create([
                'degree'      => 'BSc in Computer Science and Engineering',
                'institution' => 'American International University-Bangladesh (AIUB)',
                'location'    => 'Dhaka, Bangladesh',
                'period'      => '2022 - Expected 2027',
                'sort_order'  => 10,
                'is_visible'  => true,
            ]);
        }

        if (! Setting::exists()) {
            Setting::create(['site_name' => 'Md. Shaparan Ahammed']);
        }
    }
}
