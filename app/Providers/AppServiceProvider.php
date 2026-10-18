<?php

namespace App\Providers;

use App\Models\Menu;
use App\Models\Message;
use App\Models\Setting;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        // Frontend: navbar menus (from DB), site settings, resume link.
        // Queried once and reused so partials do not hit the database repeatedly.
        View::composer('frontend.*', function ($view) {
            static $shared = null;

            if ($shared === null) {
                $site = Setting::first();
                $resumeUrl = null;
                if ($site?->resume && is_file(public_path('uploads/settings/' . $site->resume))) {
                    $resumeUrl = asset('public/uploads/settings/' . $site->resume);
                }
                $shared = [
                    'site'      => $site,
                    'navMenus'  => Menu::visible()->get(),
                    'resumeUrl' => $resumeUrl,
                ];
            }

            $view->with($shared);
        });

        // Admin: unread message count for the sidebar
        View::composer('backend.layouts.master', function ($view) {
            $view->with('unreadMessages', Message::where('is_read', false)->count());
        });
    }
}
