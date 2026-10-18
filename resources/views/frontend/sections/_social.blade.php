@php
  $links = [
    'github' => 'bi-github', 'linkedin' => 'bi-linkedin', 'scholar' => 'bi-mortarboard-fill',
    'twitter' => 'bi-twitter-x', 'facebook' => 'bi-facebook', 'instagram' => 'bi-instagram',
  ];
@endphp
@if($site)
<div class="socials">
  @foreach($links as $key => $icon)
    @if(!empty($site->$key))
      <a href="{{ $site->$key }}" target="_blank" rel="noopener" aria-label="{{ ucfirst($key) }}"><i class="bi {{ $icon }}"></i></a>
    @endif
  @endforeach
</div>
@endif
