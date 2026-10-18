@php
  $icons = ['about' => 'bi-person', 'experience' => 'bi-briefcase', 'projects' => 'bi-grid-1x2', 'publications' => 'bi-journal-text',
            'skills' => 'bi-cpu', 'resume' => 'bi-file-earmark-person', 'contact' => 'bi-chat-dots', 'custom' => 'bi-stars'];
  $centered = in_array($menu->section_type, ['projects', 'publications', 'skills', 'resume']);
@endphp
<div class="sec-head {{ $centered ? 'center' : '' }} reveal">
  <span class="sec-chip"><i class="bi {{ $icons[$menu->section_type] ?? 'bi-stars' }}"></i> {{ $menu->title }}</span>
  <h2>{{ $menu->title }}</h2>
  @if($menu->description)<p>{{ $menu->description }}</p>@endif
</div>
