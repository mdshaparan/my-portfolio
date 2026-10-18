<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PortfolioController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\EducationController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\SkillController;
use App\Http\Controllers\HeroController;
use App\Http\Controllers\ExperienceController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\PublicationController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\MessageController;

// ---------- Public portfolio (single scrolling page) ----------
Route::get('/', [PortfolioController::class, 'index'])->name('site');
Route::post('/contact', [ContactController::class, 'send'])->middleware('throttle:5,1')->name('contact.send');

// ---------- Secret admin login (only the owner knows this URL) ----------
Route::get('/shaparan-panel-7x9k', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/shaparan-panel-7x9k', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// ---------- Admin (login required) ----------
Route::middleware('auth')->group(function () {

    Route::get('/my-dashboard', [HomeController::class, 'index'])->name('home');

    Route::prefix('my-dashboard-4m2q')->name('admin.')->group(function () {

        // Hero
        Route::resource('hero', HeroController::class)->only(['index', 'create', 'store', 'edit', 'update']);

        // About
        Route::resource('about', AboutController::class)->only(['index', 'create', 'store', 'edit', 'update']);

        // Education
        Route::get('educations-data', [EducationController::class, 'data'])->name('educations.data');
        Route::resource('educations', EducationController::class)->except(['index', 'show']);
        Route::patch('educations/{education}/toggle', [EducationController::class, 'toggle'])->name('educations.toggle');

        // Skills
        Route::resource('skills', SkillController::class)->except(['show']);

        // Experience
        Route::get('experiences-data', [ExperienceController::class, 'data'])->name('experiences.data');
        Route::resource('experiences', ExperienceController::class)->except(['show']);
        Route::patch('experiences/{experience}/toggle', [ExperienceController::class, 'toggle'])->name('experiences.toggle');

        // Projects
        Route::get('projects-data', [ProjectController::class, 'data'])->name('projects.data');
        Route::resource('projects', ProjectController::class)->except(['show']);
        Route::patch('projects/{project}/toggle', [ProjectController::class, 'toggle'])->name('projects.toggle');

        // Publications
        Route::get('publications-data', [PublicationController::class, 'data'])->name('publications.data');
        Route::resource('publications', PublicationController::class)->except(['show']);
        Route::patch('publications/{publication}/toggle', [PublicationController::class, 'toggle'])->name('publications.toggle');

        // Navbar Menu
        Route::get('menus-data', [MenuController::class, 'data'])->name('menus.data');
        Route::resource('menus', MenuController::class)->except(['show']);
        Route::patch('menus/{menu}/toggle', [MenuController::class, 'toggle'])->name('menus.toggle');

        // Messages
        Route::get('messages-data', [MessageController::class, 'data'])->name('messages.data');
        Route::resource('messages', MessageController::class)->only(['index', 'show', 'destroy']);

        Route::get('account', [\App\Http\Controllers\AccountController::class, 'edit'])->name('account.edit');
        Route::put('account', [\App\Http\Controllers\AccountController::class, 'update'])->name('account.update');

        // Site Settings (logo, favicon, contact, social, resume)
        Route::resource('settings', SettingController::class)->except(['show', 'destroy']);
    });
});
