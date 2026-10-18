@include('frontend.sections._title')
@if($publications->count())
<div class="pub-list">
  @foreach($publications as $p)
    <article class="pub reveal" style="--d:{{ min($loop->index, 4) * .06 }}s">
      <span class="pub-ic"><i class="bi bi-journal-richtext"></i></span>
      <div>
        <h4>{{ $p->title }}</h4>
        <p class="authors">{{ $p->authors }}</p>
        <div class="pub-tags">
          <span class="{{ strtolower($p->status) === 'published' ? 'ok' : 'pending' }}">{{ $p->status }}</span>
          @if($p->year)<span>{{ $p->year }}</span>@endif
          @if($p->venue)<span>{{ $p->venue }}</span>@endif
        </div>
        @if($p->abstract)<p class="abs">{{ \Illuminate\Support\Str::limit($p->abstract, 240) }}</p>@endif
      </div>
      @if($p->url)<a class="pub-go" href="{{ $p->url }}" target="_blank" rel="noopener" aria-label="Read paper"><i class="bi bi-arrow-up-right"></i></a>@endif
    </article>
  @endforeach
</div>
@else
<div class="empty">No publications have been added yet.</div>
@endif
