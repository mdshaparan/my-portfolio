@php
  $admin = 'public/assets/admin';
  $navItems = [
    ['Dashboard',        'home',                     'home',        'bi-speedometer2',  null],
    ['sep', 'Content'],
    ['Hero',             'admin.hero.index',         'admin.hero.*',         'bi-stars',         null],
    ['About & Education','admin.about.index',        ['admin.about.*', 'admin.educations.*'], 'bi-person-badge', null],
    ['Experience',       'admin.experiences.index',  'admin.experiences.*',  'bi-briefcase',     null],
    ['Projects',         'admin.projects.index',     'admin.projects.*',     'bi-cpu',           null],
    ['Publications',     'admin.publications.index', 'admin.publications.*', 'bi-journal-text', null],
    ['Skills',           'admin.skills.index',       'admin.skills.*',       'bi-diagram-3',     null],
    ['Messages',         'admin.messages.index',     'admin.messages.*',     'bi-envelope',      'unread'],
    ['sep', 'Site'],
    ['Navbar Menu',      'admin.menus.index',        'admin.menus.*',        'bi-list-nested',   null],
    ['Site Settings',    'admin.settings.index',     'admin.settings.*',     'bi-sliders',       null],
    ['Account',          'admin.account.edit',       'admin.account.*',      'bi-person-lock',   null],
  ];
@endphp
<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="robots" content="noindex, nofollow">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>@yield('title', 'Admin') · Portfolio AI</title>
  <link rel="icon" type="image/svg+xml" href="{{ asset($admin . '/images/favicon.svg') }}">

  {{-- Default dark theme (a user's toggle choice is kept afterwards) --}}
  <script>try { if (!localStorage.getItem('theme')) localStorage.setItem('theme', 'dark'); } catch (e) {}</script>

  <script type="module" crossorigin src="{{ asset($admin . '/app/main-BqKkk_Lj.js') }}"></script>
  <script type="module" crossorigin src="{{ asset($admin . '/app/rolldown-runtime-hePW80VL.js') }}"></script>
  <script type="module" crossorigin src="{{ asset($admin . '/app/vendor-ui-Be8JR3ju.js') }}"></script>
  <script type="module" crossorigin src="{{ asset($admin . '/app/vendor-bootstrap-Dj44xPS1.js') }}"></script>
  <script type="module" crossorigin src="{{ asset($admin . '/app/main-1Eks1J0_.js') }}"></script>
  <link rel="stylesheet" crossorigin href="{{ asset($admin . '/app/main-Kuf3cpUe.css') }}">

  <link rel="stylesheet" href="{{ asset($admin . '/vendor/dataTables.bootstrap5.min.css') }}">
  <link rel="stylesheet" href="{{ asset($admin . '/vendor/buttons.bootstrap5.min.css') }}">
  <link rel="stylesheet" href="{{ asset('public/assets/site/vendor/bootstrap-icons/bootstrap-icons.min.css') }}">
  <link rel="stylesheet" href="{{ asset($admin . '/admin-ai.css') }}">
  @stack('styles')
</head>

<body data-page="portfolio-admin" class="admin-layout">
  <a href="#main-content" class="skip-link">Skip to main content</a>

  <div class="admin-app">
    <div class="admin-wrapper" id="admin-wrapper">

      {{-- Header --}}
      <header class="admin-header">
        <nav class="navbar navbar-expand-lg navbar-light bg-white border-bottom">
          <div class="container-fluid">
            <a class="navbar-brand d-flex align-items-center" href="{{ route('home') }}">
              <img src="{{ asset($admin . '/images/logo.svg') }}" alt="Logo" height="32" class="d-inline-block align-text-top me-2">
              <span class="h4 mb-0 fw-bold">Portfolio AI</span>
            </a>

            <button class="hamburger-menu" type="button" data-sidebar-toggle aria-label="Toggle sidebar">
              <i class="bi bi-list"></i>
            </button>

            <div class="flex-grow-1"></div>

            <div class="navbar-nav flex-row">
              <div x-data="themeSwitch">
                <button class="btn btn-outline-secondary me-2" type="button" @click="toggle()" title="Toggle theme">
                  <i class="bi bi-sun-fill" x-show="currentTheme === 'light'"></i>
                  <i class="bi bi-moon-fill" x-show="currentTheme === 'dark'"></i>
                </button>
              </div>

              <a href="{{ url('/') }}" target="_blank" class="btn btn-outline-secondary me-2 d-none d-sm-inline-flex align-items-center">
                <i class="bi bi-box-arrow-up-right me-2"></i> View Website
              </a>

              <div class="dropdown">
                <button class="btn btn-outline-secondary d-flex align-items-center" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                  <img src="{{ asset($admin . '/images/avatar-placeholder.svg') }}" alt="" width="24" height="24" class="rounded-circle me-2">
                  <span class="d-none d-md-inline">{{ Auth::user()->name }}</span>
                  <i class="bi bi-chevron-down ms-1"></i>
                </button>
                <ul class="dropdown-menu dropdown-menu-end">
                  <li><a class="dropdown-item" href="{{ route('admin.settings.index') }}"><i class="bi bi-sliders me-2"></i>Site Settings</a></li>
                  <li><a class="dropdown-item" href="{{ route('admin.account.edit') }}"><i class="bi bi-person-lock me-2"></i>Account</a></li>
                  <li><hr class="dropdown-divider"></li>
                  <li>
                    <a class="dropdown-item" href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                      <i class="bi bi-box-arrow-right me-2"></i>Logout
                    </a>
                  </li>
                </ul>
              </div>
            </div>
          </div>
        </nav>
      </header>

      {{-- Sidebar --}}
      <aside class="admin-sidebar" id="admin-sidebar">
        <div class="sidebar-content">
          <nav class="sidebar-nav">
            <ul class="nav flex-column">
              @foreach ($navItems as $item)
                @if ($item[0] === 'sep')
                  <li class="sidebar-label">{{ $item[1] }}</li>
                @else
                  <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs($item[2]) ? 'active' : '' }}" href="{{ route($item[1]) }}">
                      <i class="bi {{ $item[3] }}"></i>
                      <span>{{ $item[0] }}</span>
                      @if ($item[4] === 'unread' && !empty($unreadMessages))
                        <span class="badge bg-danger rounded-pill ms-auto">{{ $unreadMessages }}</span>
                      @endif
                    </a>
                  </li>
                @endif
              @endforeach
            </ul>
          </nav>
        </div>
      </aside>
      <div class="sidebar-backdrop" aria-hidden="true"></div>

      {{-- Main --}}
      <main id="main-content" class="admin-main">
        <div class="container-fluid p-4 p-lg-4">
          <div class="mb-4">
            <div class="page-kicker">// admin</div>
            <h1 class="h3 page-title-ai mb-0">@yield('page_title', 'Dashboard')</h1>
          </div>

          @if (session('success'))
            <div class="alert alert-success d-flex align-items-center" role="alert">
              <i class="bi bi-check-circle me-2"></i> {{ session('success') }}
            </div>
          @endif
          @if ($errors->any() && !View::hasSection('hide_error_summary'))
            <div class="alert alert-danger" role="alert">
              <strong>Please fix the following:</strong>
              <ul class="mb-0 mt-1">
                @foreach ($errors->all() as $err)<li>{{ $err }}</li>@endforeach
              </ul>
            </div>
          @endif

          @yield('content')
        </div>
      </main>

      <footer class="admin-footer">
        <div class="container-fluid">
          <div class="row">
            <div class="col-md-6"><p class="mb-0 text-muted">© {{ date('Y') }} Portfolio AI · Admin</p></div>
            <div class="col-md-6 text-md-end"><p class="mb-0 text-muted">Built with Laravel</p></div>
          </div>
        </div>
      </footer>
    </div>
  </div>

  <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">@csrf</form>

  <div aria-live="polite" aria-atomic="true" class="position-fixed top-0 end-0 p-3" style="z-index: 11">
    <div id="toast-container"></div>
  </div>

  {{-- DataTables (local files, no CDN needed) --}}
  <script src="{{ asset($admin . '/vendor/jquery.min.js') }}"></script>
  <script src="{{ asset($admin . '/vendor/jszip.min.js') }}"></script>
  <script src="{{ asset($admin . '/vendor/pdfmake.min.js') }}"></script>
  <script src="{{ asset($admin . '/vendor/vfs_fonts.js') }}"></script>
  <script src="{{ asset($admin . '/vendor/dataTables.min.js') }}"></script>
  <script src="{{ asset($admin . '/vendor/dataTables.bootstrap5.min.js') }}"></script>
  <script src="{{ asset($admin . '/vendor/dataTables.buttons.min.js') }}"></script>
  <script src="{{ asset($admin . '/vendor/buttons.bootstrap5.min.js') }}"></script>
  @stack('scripts')
</body>
</html>