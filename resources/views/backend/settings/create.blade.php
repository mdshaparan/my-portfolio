@extends('backend.layouts.master')

@section('title', 'Add Logo & Favicon')
@section('page_title', 'Add Logo & Favicon')

@section('content')
  <div class="card">
    <div class="card-body">
      <form action="{{ route('admin.settings.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @include('backend.settings._form', ['setting' => null])
        <button type="submit" class="btn btn-primary">Save</button>
        <a href="{{ route('admin.settings.index') }}" class="btn btn-secondary">Cancel</a>
      </form>
    </div>
  </div>
@endsection