@extends('backend.layouts.master')

@section('title', 'Site Settings')
@section('page_title', 'Site Settings')

@section('content')

  <div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
      <h3 class="card-title mb-0">Site Settings (Logo, Favicon, Contact, Social, Resume)</h3>
      @unless ($setting)
        <a href="{{ route('admin.settings.create') }}" class="btn btn-primary btn-sm">+ Add</a>
      @endunless
    </div>
    <div class="card-body table-responsive">
      <table class="table table-bordered align-middle">
        <thead>
          <tr>
            <th>Action</th>
            <th>Logo</th>
            <th>Favicon</th>
            <th>Site Name</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Address</th>
            <th>Social Links</th>
            <th>Resume</th>
          </tr>
        </thead>
        <tbody>
          @if ($setting)
            <tr>
              <td><a href="{{ route('admin.settings.edit', $setting->id) }}" class="btn btn-warning btn-sm">Edit</a></td>
              <td>@if ($setting->logo)<img src="{{ asset('public/uploads/settings/' . $setting->logo) }}" height="40" alt="">@endif</td>
              <td>@if ($setting->favicon)<img src="{{ asset('public/uploads/settings/' . $setting->favicon) }}" height="32" alt="">@endif</td>
              <td>{{ $setting->site_name }}</td>
              <td>{{ $setting->email }}</td>
              <td>{{ $setting->phone }}</td>
              <td>{{ $setting->address }}</td>
              <td>
                @foreach (['facebook', 'linkedin', 'github', 'twitter', 'instagram', 'scholar'] as $s)
                  @if ($setting->$s)<span class="badge bg-secondary">{{ $s }}</span>@endif
                @endforeach
              </td>
              <td>@if ($setting->resume)<a href="{{ asset('public/uploads/settings/' . $setting->resume) }}" target="_blank">Open</a>@endif</td>
            </tr>
          @else
            <tr><td colspan="9" class="text-center text-muted">No data yet. Click "+ Add".</td></tr>
          @endif
        </tbody>
      </table>
    </div>
  </div>

@endsection
