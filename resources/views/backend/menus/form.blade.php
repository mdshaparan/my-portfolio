@extends('backend.layouts.master')

@section('title', $item ? 'Edit Menu' : 'Add Menu')
@section('page_title', $item ? 'Edit Menu' : 'Add Menu')

@section('content')
  <div class="card">
    <div class="card-body">
      <form action="{{ $item ? route('admin.menus.update', $item->id) : route('admin.menus.store') }}" method="POST">
        @csrf
        @if ($item) @method('PUT') @endif

        <div class="mb-3">
          <label class="form-label">Navbar Title (e.g. Contact me)</label>
          <input type="text" name="title" class="form-control @error('title') is-invalid @enderror"
                 value="{{ old('title', $item?->title) }}">
          @error('title')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>

        <div class="mb-3">
          <label class="form-label">Section Type</label>
          <select name="section_type" id="section_type" class="form-select @error('section_type') is-invalid @enderror">
            @foreach (\App\Models\Menu::TYPES as $val => $label)
              <option value="{{ $val }}" @selected(old('section_type', $item?->section_type ?? 'custom') === $val)>{{ $label }}</option>
            @endforeach
          </select>
          @error('section_type')<div class="invalid-feedback">{{ $message }}</div>@enderror
          <div class="form-text">The section content comes from the matching module (for example, the Projects type shows your Projects).</div>
        </div>

        <div class="mb-3">
          <label class="form-label">Anchor / Slug (optional)</label>
          <input type="text" name="slug" class="form-control @error('slug') is-invalid @enderror"
                 value="{{ old('slug', $item?->slug) }}" placeholder="Leave empty to generate from the title">
          @error('slug')<div class="invalid-feedback">{{ $message }}</div>@enderror
          <div class="form-text">English letters, numbers and dashes (-) only. The link on the website will be <code>/#slug</code>.</div>
        </div>

        <div class="mb-3">
          <label class="form-label">Section Description (short text under the section title)</label>
          <textarea name="description" rows="2" class="form-control @error('description') is-invalid @enderror">{{ old('description', $item?->description) }}</textarea>
          @error('description')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>

        <div class="mb-3" id="content_group">
          <label class="form-label">Content (only for the Custom type)</label>
          <textarea name="content" rows="8" class="form-control @error('content') is-invalid @enderror">{{ old('content', $item?->content) }}</textarea>
          @error('content')<div class="invalid-feedback">{{ $message }}</div>@enderror
          <div class="form-text">Leave a blank line to start a new paragraph.</div>
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
        <a href="{{ route('admin.menus.index') }}" class="btn btn-secondary">Cancel</a>
      </form>
    </div>
  </div>
@endsection

@push('scripts')
<script>
  // Show the content box only for the Custom type
  const typeSelect = document.getElementById('section_type');
  const contentGroup = document.getElementById('content_group');
  function toggleContent() {
    contentGroup.style.display = typeSelect.value === 'custom' ? '' : 'none';
  }
  typeSelect.addEventListener('change', toggleContent);
  toggleContent();
</script>
@endpush
