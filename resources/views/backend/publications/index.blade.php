@extends('backend.layouts.master')

@section('title', 'Publications')
@section('page_title', 'Publications')

@section('content')

  <div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
      <h3 class="card-title mb-0">Publications</h3>
      <a href="{{ route('admin.publications.create') }}" class="btn btn-primary btn-sm">+ Add Publication</a>
    </div>
    <div class="card-body">
      <table id="dataTable" class="table table-bordered align-middle w-100">
        <thead>
          <tr>
            <th>Action</th>
            <th>Year</th>
            <th>Title</th>
            <th>Venue</th>
            <th>Paper Status</th>
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
  new DataTable('#dataTable', {
    processing: true,
    serverSide: true,
    ajax: '{{ route('admin.publications.data') }}',
    columns: [
      { data: 'action', orderable: false, searchable: false },
      { data: 'year' },
      { data: 'title' },
      { data: 'venue' },
      { data: 'status_text' },
      { data: 'sort_order' },
      { data: 'status', orderable: false, searchable: false }
    ],
    order: [[5, 'asc']],
    lengthMenu: [[10, 25, 50, -1], [10, 25, 50, 'All']],
    layout: {
      topStart: {
        buttons: [
          { extend: 'copy',  exportOptions: { columns: [1, 2, 3, 4, 5] } },
          { extend: 'csv',   exportOptions: { columns: [1, 2, 3, 4, 5] } },
          { extend: 'excel', exportOptions: { columns: [1, 2, 3, 4, 5] } },
          { extend: 'pdf',   exportOptions: { columns: [1, 2, 3, 4, 5] } },
          { extend: 'print', exportOptions: { columns: [1, 2, 3, 4, 5] } }
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
