@include('frontend.sections._title')
@if($menu->content)<div class="custom-text reveal">{!! nl2br(e($menu->content)) !!}</div>@endif
