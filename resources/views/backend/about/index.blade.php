@extends('backend.layouts.master')

@section('title', 'About')
@section('page_title', 'About')

@section('content')

  {{-- About Info --}}
  <div class="card mb-4">
    <div class="card-header d-flex justify-content-between align-items-center">
      <h3 class="card-title mb-0">About Info</h3>
      @unless ($about)
        <a href="{{ route('admin.about.create') }}" class="btn btn-primary btn-sm">+ Add About</a>
      @endunless
    </div>
    <div class="card-body table-responsive">
      <table class="table table-bordered align-middle">
        <thead>
          <tr>
            <th>Action</th>
            <th>Photo</th>
            <th>Eyebrow</th>
            <th>Heading</th>
            <th>Heading Size</th>
            <th>Caption</th>
            <th>Paragraph 1</th>
            <th>Paragraph 2</th>
            <th>Paragraph Size</th>
            <th>Languages</th>
          </tr>
        </thead>
        <tbody>
          @if ($about)
            <tr>
              <td><a href="{{ route('admin.about.edit', $about->id) }}" class="btn btn-warning btn-sm">Edit</a></td>
              <td>
                @if ($about->photo)
                  <img src="{{ asset('public/uploads/about/' . $about->photo) }}" height="60" alt="">
                @endif
              </td>
              <td>{{ $about->eyebrow }}</td>
              <td>{{ $about->heading }}</td>
              <td>{{ strtoupper($about->heading_size) }}</td>
              <td>{{ $about->photo_caption }}</td>
              <td>{{ \Illuminate\Support\Str::limit($about->paragraph_1, 60) }}</td>
              <td>{{ \Illuminate\Support\Str::limit($about->paragraph_2, 60) }}</td>
              <td>{{ strtoupper($about->paragraph_size) }}</td>
              <td>{{ $about->languages }}</td>
            </tr>
          @else
            <tr>
              <td colspan="10" class="text-center text-muted">No data yet. Click "+ Add About".</td>
            </tr>
          @endif
        </tbody>
      </table>
    </div>
  </div>

  {{-- Education --}}
  <div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
      <h3 class="card-title mb-0">Education</h3>
      <a href="{{ route('admin.educations.create') }}" class="btn btn-primary btn-sm">+ Add Education</a>
    </div>
    <div class="card-body">
      <table id="educationTable" class="table table-bordered align-middle w-100">
        <thead>
          <tr>
            <th>Action</th>
            <th>Degree</th>
            <th>Institution</th>
            <th>Period</th>
            <th>Order</th>
            <th>Status</th>
          </tr>
        </thead>
      </table>
    </div>
  </div>

@endsection

@push('scripts')
<script>
  new DataTable('#educationTable', {
    processing: true,
    serverSide: true,
    ajax: '{{ route('admin.educations.data') }}',
    columns: [
      { data: 'action', orderable: false, searchable: false },
      { data: 'degree' },
      { data: 'institution' },
      { data: 'period' },
      { data: 'sort_order' },
      { data: 'status', orderable: false, searchable: false }
    ],
    order: [[4, 'asc']],
    lengthMenu: [[10, 25, 50, -1], [10, 25, 50, 'All']],
    layout: {
      topStart: {
        buttons: [
          { extend: 'copy',  exportOptions: { columns: [1, 2, 3, 4] } },
          { extend: 'csv',   exportOptions: { columns: [1, 2, 3, 4] } },
          { extend: 'excel', exportOptions: { columns: [1, 2, 3, 4] } },
          { extend: 'pdf',   exportOptions: { columns: [1, 2, 3, 4] } },
          { extend: 'print', exportOptions: { columns: [1, 2, 3, 4] } }
        ]
      },
      top2Start: 'pageLength',
      topEnd: 'search',
      bottomStart: 'info',
      bottomEnd: 'paging'
    }
  });
</script>
@endpush