@extends('backend.layouts.master')

@section('title', $item ? 'Edit Publication' : 'Add Publication')
@section('page_title', $item ? 'Edit Publication' : 'Add Publication')

@section('content')
  <div class="card">
    <div class="card-body">
      <form action="{{ $item ? route('admin.publications.update', $item->id) : route('admin.publications.store') }}"
            method="POST">
        @csrf
        @if ($item) @method('PUT') @endif

        <div class="mb-3">
          <label class="form-label">Paper Title</label>
          <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" value="{{ old('title', $item?->title) }}">
          @error('title')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>
        <div class="mb-3">
          <label class="form-label">Authors (e.g. Md. Shaparan Ahammed, A. Rahman)</label>
          <input type="text" name="authors" class="form-control @error('authors') is-invalid @enderror" value="{{ old('authors', $item?->authors) }}">
          @error('authors')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>
        <div class="mb-3">
          <label class="form-label">Journal / Conference</label>
          <input type="text" name="venue" class="form-control @error('venue') is-invalid @enderror" value="{{ old('venue', $item?->venue) }}">
          @error('venue')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>
        <div class="mb-3">
          <label class="form-label">Year</label>
          <input type="text" name="year" class="form-control @error('year') is-invalid @enderror" value="{{ old('year', $item?->year) }}">
          @error('year')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>
        <div class="mb-3">
          <label class="form-label">Status</label>
          <select name="status" class="form-select @error('status') is-invalid @enderror">
            <option value="Published" @selected(old('status', $item?->status ?? 'Published') === 'Published')>Published</option>
            <option value="Accepted" @selected(old('status', $item?->status ?? 'Published') === 'Accepted')>Accepted</option>
            <option value="Under Review" @selected(old('status', $item?->status ?? 'Published') === 'Under Review')>Under Review</option>
            <option value="Preprint" @selected(old('status', $item?->status ?? 'Published') === 'Preprint')>Preprint</option>
          </select>
          @error('status')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>
        <div class="mb-3">
          <label class="form-label">Paper Link (DOI or PDF link, include https://)</label>
          <input type="text" name="url" class="form-control @error('url') is-invalid @enderror" value="{{ old('url', $item?->url) }}">
          @error('url')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>
        <div class="mb-3">
          <label class="form-label">Abstract / Short Summary (optional)</label>
          <textarea name="abstract" rows="4" class="form-control @error('abstract') is-invalid @enderror">{{ old('abstract', $item?->abstract) }}</textarea>
          @error('abstract')<div class="invalid-feedback">{{ $message }}</div>@enderror
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
        <a href="{{ route('admin.publications.index') }}" class="btn btn-secondary">Cancel</a>
      </form>
    </div>
  </div>
@endsection
