@extends('frontend.layouts.master')

@section('content')
@php
  $name = $hero->name ?? ($site->site_name ?? 'Portfolio');
  $hasHeroPhoto = !empty($hero?->photo) && is_file(public_path('uploads/hero/'.$hero->photo));
  $heroPhoto = $hasHeroPhoto ? asset('public/uploads/hero/'.$hero->photo) : asset('public/assets/site/img/avatar.svg');
  $typed = collect(explode(',', (string) ($hero->typed_items ?? '')))->map(fn($s) => trim($s))->filter()->values();
  $photoTags = collect(explode(',', (string) ($hero->photo_tags ?? '')))->map(fn($s) => trim($s))->filter()->values();
  $badges = collect(preg_split('/[,\n]/', (string) ($hero->badges ?? '')))->map(fn($s) => trim($s))->filter()->values();
@endphp

{{-- NAVBAR --}}
<header class="nav" id="nav">
  <div class="container nav-inner">
    <a href="#home" class="brand">
      @if(!empty($site?->logo) && is_file(public_path('uploads/settings/'.$site->logo)))
        <img src="{{ asset('public/uploads/settings/'.$site->logo) }}" alt="{{ $site->site_name }}">
      @else
        <span class="brand-dot"></span>
      @endif
      <span>{{ $site->site_name ?? $name }}</span>
    </a>
    <nav class="nav-links" id="navLinks">
      @foreach($menus as $m)
        <a href="#{{ $m->slug }}" data-section="{{ $m->slug }}">{{ $m->title }}</a>
      @endforeach
      @if($resumeUrl)
        <a href="{{ $resumeUrl }}" target="_blank" class="btn-ai mobile-resume"><i class="bi bi-file-earmark-person"></i> Resume</a>
      @endif
    </nav>
    <div class="nav-right">
      @if($resumeUrl)
        <a href="{{ $resumeUrl }}" target="_blank" rel="noopener" class="btn-ai nav-cta"><i class="bi bi-file-earmark-person"></i> Resume</a>
      @endif
    </div>
    <button class="burger" id="burger" aria-label="Menu"><i class="bi bi-list"></i></button>
  </div>
</header>

{{-- HERO --}}
<section class="hero" id="home">
  <canvas id="neural"></canvas>
  <div class="container hero-grid">
    <div>
      @if(!empty($hero?->status_text))<div class="status"><i></i>{{ $hero->status_text }}</div>@endif
      <h1>
        <span class="greet">{{ $hero->greeting ?? "Hello, I'm" }}</span>
        <span class="grad-text">{{ $name }}</span>
      </h1>
      @if(!empty($hero?->role_title))<div class="role">{{ $hero->role_title }}</div>@endif
      <div class="typed-line">
        {{ $hero->tagline_prefix ?? 'I work on' }}
        <span class="typed" id="typed" data-items='@json($typed)'></span><span class="typed-cursor"></span>
      </div>
      @if(!empty($hero?->intro))<p class="intro">{{ $hero->intro }}</p>@endif
      @if($badges->count())
        <div class="chips">@foreach($badges as $b)<span class="chip">{{ $b }}</span>@endforeach</div>
      @endif
      <div class="hero-actions">
        @if(!empty($hero?->btn1_text))
          <a href="{{ $hero->btn1_link ?: '#projects' }}" class="btn-ai">{{ $hero->btn1_text }} <i class="bi bi-arrow-right"></i></a>
        @endif
        @if($resumeUrl)
          <a href="{{ $resumeUrl }}" target="_blank" rel="noopener" class="btn-ghost"><i class="bi bi-file-earmark-person"></i> Resume</a>
        @elseif(!empty($hero?->btn2_text))
          <a href="{{ $hero->btn2_link ?: '#contact' }}" class="btn-ghost">{{ $hero->btn2_text }}</a>
        @endif
      </div>
      @include('frontend.sections._social')
    </div>
    <div class="hero-visual">
      @php $chipIcons = ['bi-cpu', 'bi-eye', 'bi-braces', 'bi-stars']; @endphp
      <div class="avatar-wrap">
        <div class="avatar"><img src="{{ $heroPhoto }}" alt="{{ $name }}"></div>
        @foreach($photoTags->take(4) as $t)
          <span class="float-chip p{{ $loop->iteration }}"><i class="bi {{ $chipIcons[$loop->index] }}"></i> {{ $t }}</span>
        @endforeach
      </div>
    </div>
  </div>
</section>

{{-- SECTIONS (driven by the admin navbar menus) --}}
@foreach($menus as $i => $menu)
  <section class="section sec-{{ $menu->section_type }}" id="{{ $menu->slug }}">
    <div class="container">
      @include('frontend.sections.' . (view()->exists('frontend.sections.'.$menu->section_type) ? $menu->section_type : 'custom'), ['menu' => $menu, 'n' => $i])
    </div>
  </section>
@endforeach

<footer class="footer">
  <div class="container">
    @include('frontend.sections._social')
    <p>&copy; {{ date('Y') }} {{ $name }}. All rights reserved.</p>
  </div>
</footer>
@endsection
