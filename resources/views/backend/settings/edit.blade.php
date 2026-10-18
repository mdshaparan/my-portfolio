@extends('backend.layouts.master')

@section('title', 'Edit Logo & Favicon')
@section('page_title', 'Edit Logo & Favicon')

@section('content')
  <div class="card">
    <div class="card-body">
      <form action="{{ route('admin.settings.update', $setting->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        @include('backend.settings._form', ['setting' => $setting])
        <button type="submit" class="btn btn-primary">Update</button>
        <a href="{{ route('admin.settings.index') }}" class="btn btn-secondary">Cancel</a>
      </form>
    </div>
  </div>
@endsection