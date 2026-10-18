@extends('backend.layouts.master')

@section('title', $education ? 'Edit Education' : 'Add Education')
@section('page_title', $education ? 'Edit Education' : 'Add Education')

@section('content')
  <div class="card">
    <div class="card-body">
      <form action="{{ $education ? route('admin.educations.update', $education->id) : route('admin.educations.store') }}" method="POST">
        @csrf
        @if ($education) @method('PUT') @endif

        <div class="mb-3">
          <label class="form-label">Degree / Program</label>
          <input type="text" name="degree" class="form-control @error('degree') is-invalid @enderror"
                 value="{{ old('degree', $education?->degree) }}">
          @error('degree')<div class="invalid-feedback">{{ $message }}</div>@enderror
          <div class="form-text">e.g. BSc in Computer Science and Engineering</div>
        </div>

        <div class="mb-3">
          <label class="form-label">Institution</label>
          <input type="text" name="institution" class="form-control @error('institution') is-invalid @enderror"
                 value="{{ old('institution', $education?->institution) }}">
          @error('institution')<div class="invalid-feedback">{{ $message }}</div>@enderror
          <div class="form-text">e.g. American International University-Bangladesh (AIUB)</div>
        </div>

        <div class="mb-3">
          <label class="form-label">Location (optional)</label>
          <input type="text" name="location" class="form-control @error('location') is-invalid @enderror"
                 value="{{ old('location', $education?->location) }}">
          @error('location')<div class="invalid-feedback">{{ $message }}</div>@enderror
          <div class="form-text">e.g. Dhaka, Bangladesh</div>
        </div>

        <div class="mb-3">
          <label class="form-label">Period</label>
          <input type="text" name="period" class="form-control @error('period') is-invalid @enderror"
                 value="{{ old('period', $education?->period) }}">
          @error('period')<div class="invalid-feedback">{{ $message }}</div>@enderror
          <div class="form-text">Free text, e.g. 2022 - Expected 2027, or 2018 - 2020</div>
        </div>

        <div class="mb-3">
          <label class="form-label">Grade / CGPA (optional)</label>
          <input type="text" name="grade" class="form-control @error('grade') is-invalid @enderror"
                 value="{{ old('grade', $education?->grade) }}">
          @error('grade')<div class="invalid-feedback">{{ $message }}</div>@enderror
          <div class="form-text">Free text, e.g. CGPA 3.80 / 4.00</div>
        </div>

        <div class="mb-3">
          <label class="form-label">Details (optional)</label>
          <textarea name="description" rows="3" class="form-control @error('description') is-invalid @enderror">{{ old('description', $education?->description) }}</textarea>
          @error('description')<div class="invalid-feedback">{{ $message }}</div>@enderror
          <div class="form-text">One line = one bullet point, e.g. coursework, thesis, honors.</div>
        </div>

        <div class="mb-3">
          <label class="form-label">Order (smaller numbers appear first)</label>
          <input type="number" name="sort_order" class="form-control @error('sort_order') is-invalid @enderror"
                 value="{{ old('sort_order', $education?->sort_order ?? 0) }}">
          @error('sort_order')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>

        <div class="form-check mb-3">
          <input type="hidden" name="is_visible" value="0">
          <input class="form-check-input" type="checkbox" name="is_visible" value="1" id="is_visible"
                 @checked(old('is_visible', $education?->is_visible ?? true))>
          <label class="form-check-label" for="is_visible">Show on website</label>
        </div>

        <button type="submit" class="btn btn-primary">{{ $education ? 'Update' : 'Save' }}</button>
        <a href="{{ route('admin.about.index') }}" class="btn btn-secondary">Cancel</a>
      </form>
    </div>
  </div>
@endsection