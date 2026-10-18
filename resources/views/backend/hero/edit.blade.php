@extends('backend.layouts.master')

@section('title', 'Edit Hero')
@section('page_title', 'Edit Hero')

@section('content')
  <div class="card">
    <div class="card-body">
      <form action="{{ route('admin.hero.update', $hero->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        @include('backend.hero._form', ['hero' => $hero])
        <button type="submit" class="btn btn-primary">Update</button>
        <a href="{{ route('admin.hero.index') }}" class="btn btn-secondary">Cancel</a>
      </form>
    </div>
  </div>
@endsection
