@extends('backend.layouts.master')

@section('title', $item ? 'Edit Project' : 'Add Project')
@section('page_title', $item ? 'Edit Project' : 'Add Project')

@section('content')
  <div class="card">
    <div class="card-body">
      <form action="{{ $item ? route('admin.projects.update', $item->id) : route('admin.projects.store') }}"
            method="POST"
            enctype="multipart/form-data">
        @csrf
        @if ($item) @method('PUT') @endif

        <div class="mb-3">
          <label class="form-label">Project Title</label>
          <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" value="{{ old('title', $item?->title) }}">
          @error('title')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>
        <div class="mb-3">
          <label class="form-label">Category (used for the filter buttons, e.g. Web / Research)</label>
          <input type="text" name="category" class="form-control @error('category') is-invalid @enderror" value="{{ old('category', $item?->category) }}">
          @error('category')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>
        <div class="mb-3">
          <label class="form-label">Short Description</label>
          <textarea name="summary" rows="4" class="form-control @error('summary') is-invalid @enderror">{{ old('summary', $item?->summary) }}</textarea>
          @error('summary')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>
        <div class="mb-3">
          <label class="form-label">Technologies (comma separated, e.g. Laravel, MySQL)</label>
          <input type="text" name="tech" class="form-control @error('tech') is-invalid @enderror" value="{{ old('tech', $item?->tech) }}">
          @error('tech')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>
        <div class="mb-3">
          <label class="form-label">Badge (optional, e.g. Award Winner)</label>
          <input type="text" name="badge" class="form-control @error('badge') is-invalid @enderror" value="{{ old('badge', $item?->badge) }}">
          @error('badge')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>
        <div class="mb-3">
          <label class="form-label">Project Image</label>
          @if ($item?->image)
          <div class="mb-2"><img src="{{ asset('public/uploads/projects/' . $item->image) }}" height="90" alt=""></div>
          @endif
          <input type="file" name="image" accept="image/*" class="form-control @error('image') is-invalid @enderror">
          @error('image')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>
        <div class="mb-3">
          <label class="form-label">Live Link (include https://)</label>
          <input type="text" name="live_url" class="form-control @error('live_url') is-invalid @enderror" value="{{ old('live_url', $item?->live_url) }}">
          @error('live_url')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>
        <div class="mb-3">
          <label class="form-label">Source Code Link (GitHub, include https://)</label>
          <input type="text" name="source_url" class="form-control @error('source_url') is-invalid @enderror" value="{{ old('source_url', $item?->source_url) }}">
          @error('source_url')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>

        <div class="mb-3">
          <label class="form-label">Order (smaller numbers appear first)</label>
          <input type="number" name="sort_order" min="0" class="form-control @error('sort_order') is-invalid @enderror"
                 value="{{ old('sort_order', $item?->sort_order ?? 0) }}">
          @error('sort_order')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>

        <div class="form-check mb-3">
          <input type="hidden" name="is_visible" value="0">
          <input class="form-check-input" type="checkbox" name="is_visible" value="1" id="is_visible"
                 @checked(old('is_visible', $item?->is_visible ?? true))>
          <label class="form-check-label" for="is_visible">Show on website</label>
        </div>

        <button type="submit" class="btn btn-primary">{{ $item ? 'Update' : 'Save' }}</button>
        <a href="{{ route('admin.projects.index') }}" class="btn btn-secondary">Cancel</a>
      </form>
    </div>
  </div>
@endsection
