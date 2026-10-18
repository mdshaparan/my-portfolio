@include('frontend.sections._title')
@if($skills->count())
<div class="skill-grid">
  @foreach($skills as $s)
    <div class="gb skill reveal" style="--d:{{ min($loop->index, 8) * .05 }}s">
      <div class="ring" data-level="{{ (int) $s->level }}"><b>{{ (int) $s->level }}<small>%</small></b></div>
      <h4>{{ $s->name }}</h4>
      @if($s->description)<p>{{ $s->description }}</p>@endif
    </div>
  @endforeach
</div>
@else
<div class="empty">No skills have been added yet.</div>
@endif
