@extends('backend.layouts.master')

@section('title', $item ? 'Edit Experience' : 'Add Experience')
@section('page_title', $item ? 'Edit Experience' : 'Add Experience')

@section('content')
  <div class="card">
    <div class="card-body">
      <form action="{{ $item ? route('admin.experiences.update', $item->id) : route('admin.experiences.store') }}"
            method="POST">
        @csrf
        @if ($item) @method('PUT') @endif

        <div class="mb-3">
          <label class="form-label">Role / Position</label>
          <input type="text" name="role" class="form-control @error('role') is-invalid @enderror" value="{{ old('role', $item?->role) }}">
          @error('role')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>
        <div class="mb-3">
          <label class="form-label">Organization / Company</label>
          <input type="text" name="organization" class="form-control @error('organization') is-invalid @enderror" value="{{ old('organization', $item?->organization) }}">
          @error('organization')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>
        <div class="mb-3">
          <label class="form-label">Location (optional)</label>
          <input type="text" name="location" class="form-control @error('location') is-invalid @enderror" value="{{ old('location', $item?->location) }}">
          @error('location')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>
        <div class="mb-3">
          <label class="form-label">Period (e.g. 2024 - Present)</label>
          <input type="text" name="period" class="form-control @error('period') is-invalid @enderror" value="{{ old('period', $item?->period) }}">
          @error('period')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>
        <div class="mb-3">
          <label class="form-label">Description (one bullet point per line)</label>
          <textarea name="description" rows="4" class="form-control @error('description') is-invalid @enderror">{{ old('description', $item?->description) }}</textarea>
          @error('description')<div class="invalid-feedback">{{ $message }}</div>@enderror
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
        <a href="{{ route('admin.experiences.index') }}" class="btn btn-secondary">Cancel</a>
      </form>
    </div>
  </div>
@endsection
