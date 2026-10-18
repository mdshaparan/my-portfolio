@extends('backend.layouts.master')

@section('title', 'Dashboard')
@section('page_title', 'Dashboard')

@section('content')

  <div class="dash-hero mb-4">
    <h2 class="h4 mb-1">Welcome back, {{ Auth::user()->name }}</h2>
    <p class="mb-0 text-muted">Manage all website content from here: Hero, About, Education, Experience, Projects, Publications, Skills and the Navbar.</p>
  </div>

  <div class="row g-3 g-lg-4 mb-4">
    @php
      $stats = [
        ['Projects',      $projectCount,     'bi-cpu',          'primary', 'admin.projects.index'],
        ['Publications',  $publicationCount, 'bi-journal-text', 'info',    'admin.publications.index'],
        ['Skills',        $skillCount,       'bi-diagram-3',    'success', 'admin.skills.index'],
        ['Unread Messages', $unreadCount,    'bi-envelope',     'danger',  'admin.messages.index'],
      ];
    @endphp
    @foreach ($stats as [$label, $count, $icon, $color, $route])
      <div class="col-sm-6 col-xl-3">
        <a href="{{ route($route) }}" class="text-decoration-none">
          <div class="card stats-card h-100">
            <div class="card-body">
              <div class="d-flex align-items-center">
                <div class="flex-shrink-0">
                  <div class="stats-icon bg-{{ $color }} bg-opacity-10 text-{{ $color }}"><i class="bi {{ $icon }}"></i></div>
                </div>
                <div class="flex-grow-1 ms-3">
                  <p class="h6 mb-0 text-muted">{{ $label }}</p>
                  <div class="h3 mb-0">{{ $count }}</div>
                </div>
              </div>
            </div>
          </div>
        </a>
      </div>
    @endforeach
  </div>

  <div class="card">
    <div class="card-header"><h2 class="h5 card-title mb-0">Quick actions</h2></div>
    <div class="card-body">
      <div class="row g-3">
        @foreach ([
          ['Add project',     'admin.projects.create',     'bi-plus-square'],
          ['Add publication', 'admin.publications.create', 'bi-journal-plus'],
          ['Add experience',  'admin.experiences.create',  'bi-briefcase'],
          ['Add skill',       'admin.skills.create',       'bi-diagram-3'],
          ['Navbar menu',     'admin.menus.index',         'bi-list-nested'],
          ['Upload resume',   'admin.settings.index',      'bi-file-earmark-arrow-up'],
        ] as [$label, $route, $icon])
          <div class="col-6 col-lg-4">
            <a href="{{ route($route) }}" class="quick-link"><i class="bi {{ $icon }}"></i><span>{{ $label }}</span></a>
          </div>
        @endforeach
      </div>
    </div>
  </div>

@endsection
