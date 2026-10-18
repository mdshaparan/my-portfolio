@extends('backend.layouts.master')

@section('title', 'Hero')
@section('page_title', 'Hero (first section of the website)')

@section('content')

  <div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
      <h3 class="card-title mb-0">Hero</h3>
      @unless ($hero)
        <a href="{{ route('admin.hero.create') }}" class="btn btn-primary btn-sm">+ Add Hero</a>
      @endunless
    </div>
    <div class="card-body table-responsive">
      <table class="table table-bordered align-middle">
        <thead>
          <tr>
            <th>Action</th>
            <th>Photo</th>
            <th>Greeting</th>
            <th>Name</th>
            <th>Tagline</th>
            <th>Typed Words</th>
            <th>Intro</th>
            <th>Button 1</th>
            <th>Button 2</th>
          </tr>
        </thead>
        <tbody>
          @if ($hero)
            <tr>
              <td><a href="{{ route('admin.hero.edit', $hero->id) }}" class="btn btn-warning btn-sm">Edit</a></td>
              <td>@if ($hero->photo)<img src="{{ asset('public/uploads/hero/' . $hero->photo) }}" height="60" alt="">@endif</td>
              <td>{{ $hero->greeting }}</td>
              <td>{{ $hero->name }}</td>
              <td>{{ $hero->tagline_prefix }}</td>
              <td>{{ $hero->typed_items }}</td>
              <td>{{ \Illuminate\Support\Str::limit($hero->intro, 60) }}</td>
              <td>{{ $hero->btn1_text }}</td>
              <td>{{ $hero->btn2_text }}</td>
            </tr>
          @else
            <tr>
              <td colspan="9" class="text-center text-muted">No data yet. Click "+ Add Hero".</td>
            </tr>
          @endif
        </tbody>
      </table>
    </div>
  </div>

@endsection
