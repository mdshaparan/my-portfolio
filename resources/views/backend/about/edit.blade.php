@extends('backend.layouts.master')

@section('title', 'Edit About')
@section('page_title', 'Edit About')

@section('content')
  <div class="card">
    <div class="card-body">
      <form action="{{ route('admin.about.update', $about->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        @include('backend.about._form', ['about' => $about])
        <button type="submit" class="btn btn-primary">Update</button>
        <a href="{{ route('admin.about.index') }}" class="btn btn-secondary">Cancel</a>
      </form>
    </div>
  </div>
@endsection