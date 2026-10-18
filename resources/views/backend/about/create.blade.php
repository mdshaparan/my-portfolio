@extends('backend.layouts.master')

@section('title', 'Add About')
@section('page_title', 'Add About')

@section('content')
  <div class="card">
    <div class="card-body">
      <form action="{{ route('admin.about.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @include('backend.about._form', ['about' => null])
        <button type="submit" class="btn btn-primary">Save</button>
        <a href="{{ route('admin.about.index') }}" class="btn btn-secondary">Cancel</a>
      </form>
    </div>
  </div>
@endsection