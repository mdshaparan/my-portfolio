@include('frontend.sections._title')
@php
  $hasPhoto = !empty($about?->photo) && is_file(public_path('uploads/about/'.$about->photo));
  $langs = collect(preg_split('/[,\n]/', (string) ($about->languages ?? '')))->map(fn($s) => trim($s))->filter();
@endphp
@if($about)
<div class="about-grid">
  <div class="about-photo reveal">
    <div class="frame">
      <img src="{{ $hasPhoto ? asset('public/uploads/about/'.$about->photo) : asset('public/assets/site/img/avatar.svg') }}" alt="{{ $about->heading }}">
    </div>
    @if($about->photo_caption)<div class="caption">{{ $about->photo_caption }}</div>@endif
  </div>
  <div class="about-text reveal" style="--d:.08s">
    @if($about->eyebrow)<span class="eyebrow">{{ $about->eyebrow }}</span>@endif
    @if($about->heading)<h3 class="headline">{{ $about->heading }}</h3>@endif
    @if($about->paragraph_1)<p>{{ $about->paragraph_1 }}</p>@endif
    @if($about->paragraph_2)<p>{{ $about->paragraph_2 }}</p>@endif
    @if($langs->count())
      <div class="lang-row">@foreach($langs as $l)<span class="chip"><i class="bi bi-translate"></i>{{ $l }}</span>@endforeach</div>
    @endif
    <div class="cta-row">
      <a href="#contact" class="btn-ai">Get in touch <i class="bi bi-arrow-right"></i></a>
      @if($resumeUrl)<a href="{{ $resumeUrl }}" download class="btn-ghost"><i class="bi bi-download"></i> Download CV</a>@endif
    </div>
  </div>
</div>
@else
<div class="empty">About information has not been added yet.</div>
@endif

@if($educations->count())
  <h3 class="sub-title reveal">Education</h3>
  <div class="edu-grid">
    @foreach($educations as $e)
      <div class="gb edu reveal" style="--d:{{ min($loop->index, 4) * .07 }}s">
        <span class="edu-ic"><i class="bi bi-mortarboard"></i></span>
        <div class="edu-period">{{ $e->period }}</div>
        <h4>{{ $e->degree }}</h4>
        <p class="org">{{ $e->institution }}@if($e->location) &middot; {{ $e->location }}@endif</p>
        @if($e->grade)<span class="grade">{{ $e->grade }}</span>@endif
        @if($e->description)
          <ul>@foreach(preg_split('/\r\n|\r|\n/', $e->description) as $line)@if(trim($line) !== '')<li>{{ trim($line) }}</li>@endif @endforeach</ul>
        @endif
      </div>
    @endforeach
  </div>
@endif
