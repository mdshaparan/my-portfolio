<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>@yield('title', ($site->site_name ?? 'Portfolio'))</title>
  <meta name="description" content="@yield('description', ($hero->tagline_prefix ?? '') . ' ' . ($hero->typed_items ?? ''))">
  <meta name="theme-color" content="#0a0e17">
  @if(!empty($site?->favicon) && is_file(public_path('uploads/settings/'.$site->favicon)))
    <link rel="icon" href="{{ asset('public/uploads/settings/'.$site->favicon) }}">
  @else
    <link rel="icon" href="{{ asset('public/assets/admin/images/favicon.svg') }}" type="image/svg+xml">
  @endif
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&family=JetBrains+Mono:wght@400;500&family=Space+Grotesk:wght@500;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('public/assets/site/vendor/bootstrap-icons/bootstrap-icons.min.css') }}">
  <link rel="stylesheet" href="{{ asset('public/assets/site/css/site.css') }}?v=3">
  <script>document.documentElement.classList.add('js');</script>
</head>
<body>
  <div id="progress"></div>
  @yield('content')
  <a href="#home" class="to-top" id="toTop" aria-label="Back to top"><i class="bi bi-arrow-up-short"></i></a>
  <script src="{{ asset('public/assets/site/js/site.js') }}?v=3"></script>
</body>
</html>
