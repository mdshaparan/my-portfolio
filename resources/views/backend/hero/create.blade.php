@extends('backend.layouts.master')

@section('title', 'Add Hero')
@section('page_title', 'Add Hero')

@section('content')
  <div class="card">
    <div class="card-body">
      <form action="{{ route('admin.hero.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @include('backend.hero._form', ['hero' => null])
        <button type="submit" class="btn btn-primary">Save</button>
        <a href="{{ route('admin.hero.index') }}" class="btn btn-secondary">Cancel</a>
      </form>
    </div>
  </div>
@endsection
