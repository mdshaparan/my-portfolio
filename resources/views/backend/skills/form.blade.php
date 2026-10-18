@extends('backend.layouts.master')

@section('title', $skill ? 'Edit Skill' : 'Add Skill')
@section('page_title', $skill ? 'Edit Skill' : 'Add Skill')

@section('content')
  <div class="card">
    <div class="card-body">
      <form action="{{ $skill ? route('admin.skills.update', $skill->id) : route('admin.skills.store') }}" method="POST">
        @csrf
        @if ($skill) @method('PUT') @endif

        <div class="mb-3">
          <label class="form-label">Skill Name (e.g. Python)</label>
          <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                 value="{{ old('name', $skill?->name) }}">
          @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>

        <div class="mb-3">
          <label class="form-label">Level (0 to 100, used for the progress bar)</label>
          <input type="number" name="level" min="0" max="100"
                 class="form-control @error('level') is-invalid @enderror"
                 value="{{ old('level', $skill?->level ?? 80) }}">
          @error('level')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>

        <div class="mb-3">
          <label class="form-label">Short Description (one short line)</label>
          <input type="text" name="description" class="form-control @error('description') is-invalid @enderror"
                 value="{{ old('description', $skill?->description) }}">
          @error('description')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>

        <button type="submit" class="btn btn-primary">{{ $skill ? 'Update' : 'Save' }}</button>
        <a href="{{ route('admin.skills.index') }}" class="btn btn-secondary">Cancel</a>
      </form>
    </div>
  </div>
@endsection