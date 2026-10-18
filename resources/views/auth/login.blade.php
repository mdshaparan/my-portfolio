@php $admin = 'public/assets/admin'; @endphp
<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="robots" content="noindex, nofollow">
  <title>Sign in · Portfolio AI</title>
  <link rel="icon" type="image/svg+xml" href="{{ asset($admin . '/images/favicon.svg') }}">
  <script>try { if (!localStorage.getItem('theme')) localStorage.setItem('theme', 'dark'); } catch (e) {}</script>
  <script type="module" crossorigin src="{{ asset($admin . '/app/main-BqKkk_Lj.js') }}"></script>
  <script type="module" crossorigin src="{{ asset($admin . '/app/rolldown-runtime-hePW80VL.js') }}"></script>
  <script type="module" crossorigin src="{{ asset($admin . '/app/vendor-ui-Be8JR3ju.js') }}"></script>
  <script type="module" crossorigin src="{{ asset($admin . '/app/password-strength-CR79XtXF.js') }}"></script>
  <script type="module" crossorigin src="{{ asset($admin . '/app/auth-Cxu0M6Hr.js') }}"></script>
  <link rel="stylesheet" crossorigin href="{{ asset($admin . '/app/main-Kuf3cpUe.css') }}">
  <link rel="stylesheet" href="{{ asset($admin . '/admin-ai.css') }}">
</head>
<body data-page="login">
  <div class="auth-layout">
    <main class="auth-main">
      <div class="auth-topbar">
        <a class="auth-brand" href="{{ url('/') }}">
          <img src="{{ asset($admin . '/images/logo.svg') }}" alt="" width="32" height="32">
          <span>Portfolio AI</span>
        </a>
      </div>

      <div class="auth-body">
        <div class="auth-heading">
          <h1>Admin sign in</h1>
          <p>Restricted to the portfolio owner.</p>
        </div>

        @if (session('message'))
          <div class="alert alert-success py-2 px-3 small">{{ session('message') }}</div>
        @endif
        @if ($errors->any())
          <div class="alert alert-danger py-2 px-3 small" role="alert">{{ $errors->first() }}</div>
        @endif

        <form class="auth-form" method="POST" action="{{ route('login') }}">
          @csrf
          <div class="mb-3">
            <label class="form-label" for="login-email">Email address</label>
            <input type="email" class="form-control" id="login-email" name="email" value="{{ old('email') }}"
                   autocomplete="username" placeholder="you@example.com" required autofocus>
          </div>

          <div class="mb-3">
            <label class="form-label" for="login-password">Password</label>
            <input type="password" class="form-control" id="login-password" name="password"
                   autocomplete="current-password" placeholder="Enter your password" required>
          </div>

          <div class="form-check mb-4">
            <input class="form-check-input" type="checkbox" id="login-remember" name="remember" value="1">
            <label class="form-check-label small" for="login-remember">Remember me</label>
          </div>

          <button type="submit" class="btn btn-primary w-100">Sign in</button>
        </form>
      </div>

      <p class="auth-legal"><a href="{{ url('/') }}">&larr; Back to website</a></p>
    </main>

    <aside class="auth-aside">
      <div class="auth-aside-inner">
        <p class="auth-quote">Manage your portfolio like a model pipeline.</p>
        <div class="ai-terminal mb-4">
          <div><span class="dim">$</span> load <span class="ok">hero, about, projects, papers</span></div>
          <div><span class="dim">$</span> sync navbar &rarr; <span class="ok">single page</span></div>
          <div><span class="dim">$</span> status: <span class="ok">ready</span><span class="dim"> _</span></div>
        </div>
        <ul class="auth-points">
          <li><i class="bi bi-check"></i><span>Manage Hero, About, Experience, Projects, Publications and Skills in one place.</span></li>
          <li><i class="bi bi-check"></i><span>Add or remove navbar menus and the website updates automatically.</span></li>
          <li><i class="bi bi-check"></i><span>Upload a resume and visitors can preview and download it.</span></li>
        </ul>
      </div>
    </aside>
  </div>
</body>
</html>
