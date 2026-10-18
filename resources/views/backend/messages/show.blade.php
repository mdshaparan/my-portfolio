@extends('backend.layouts.master')

@section('title', 'Message')
@section('page_title', 'Message')

@section('content')
  <div class="card">
    <div class="card-header">
      <h3 class="card-title mb-0">{{ $message->subject ?: '(No subject)' }}</h3>
    </div>
    <div class="card-body">
      <p class="mb-1"><strong>From:</strong> {{ $message->name }} &lt;{{ $message->email }}&gt;</p>
      <p class="mb-3"><strong>Date:</strong> {{ $message->created_at->format('d M Y, h:i A') }}</p>
      <hr>
      <p style="white-space: pre-line;">{{ $message->message }}</p>
    </div>
    <div class="card-footer">
      <a href="mailto:{{ $message->email }}?subject=Re: {{ $message->subject }}" class="btn btn-primary">Reply by email</a>
      <a href="{{ route('admin.messages.index') }}" class="btn btn-secondary">Back</a>
    </div>
  </div>
@endsection
