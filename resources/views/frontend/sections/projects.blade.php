@include('frontend.sections._title')
@php $cats = $projects->pluck('category')->filter()->unique()->values(); @endphp
@if($projects->count())
  @if($cats->count())
  <div class="filters reveal">
    <button class="filter active" data-filter="all">All</button>
    @foreach($cats as $c)<button class="filter" data-filter="{{ \Illuminate\Support\Str::slug($c) }}">{{ $c }}</button>@endforeach
  </div>
  @endif
  <div class="proj-grid">
    @foreach($projects as $p)
      @php $img = !empty($p->image) && is_file(public_path('uploads/projects/'.$p->image)); @endphp
      <article class="proj reveal" tabindex="0" data-cat="{{ \Illuminate\Support\Str::slug((string) $p->category) }}" style="--d:{{ min($loop->index, 4) * .07 }}s">
        <div class="proj-img">
          @if($img)<img src="{{ asset('public/uploads/projects/'.$p->image) }}" alt="{{ $p->title }}" loading="lazy">
          @else<div class="proj-ph"><i class="bi bi-diagram-3"></i></div>@endif
        </div>
        <div class="proj-shade"></div>
        @if($p->badge)<span class="proj-badge">{{ $p->badge }}</span>@endif
        <div class="proj-body">
          @if($p->category)<span class="cat">{{ $p->category }}</span>@endif
          <h3>{{ $p->title }}</h3>
          <div class="proj-more"><div>
            @if($p->summary)<p>{{ $p->summary }}</p>@endif
            @if($p->tech)<div class="tags">@foreach(array_filter(array_map('trim', explode(',', $p->tech))) as $t)<span>{{ $t }}</span>@endforeach</div>@endif
            @if($p->live_url || $p->source_url)
            <div class="proj-links">
              @if($p->live_url)<a href="{{ $p->live_url }}" target="_blank" rel="noopener">Live demo <i class="bi bi-arrow-up-right"></i></a>@endif
              @if($p->source_url)<a href="{{ $p->source_url }}" target="_blank" rel="noopener"><i class="bi bi-github"></i> Source</a>@endif
            </div>
            @endif
          </div></div>
        </div>
      </article>
    @endforeach
  </div>
@else
  <div class="empty">No projects have been added yet.</div>
@endif
