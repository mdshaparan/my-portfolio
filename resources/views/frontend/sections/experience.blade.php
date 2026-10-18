@include('frontend.sections._title')
@if($experiences->count())
<div class="zz">
  @foreach($experiences as $x)
    <div class="gb zz-item reveal">
      <span class="zz-period">{{ $x->period }}</span>
      <h4>{{ $x->role }}</h4>
      <p class="org">{{ $x->organization }}@if($x->location) &middot; {{ $x->location }}@endif</p>
      @if($x->description)
        <ul>@foreach(preg_split('/\r\n|\r|\n/', $x->description) as $line)@if(trim($line) !== '')<li>{{ trim($line) }}</li>@endif @endforeach</ul>
      @endif
    </div>
  @endforeach
</div>
@else
<div class="empty">No experience has been added yet.</div>
@endif
