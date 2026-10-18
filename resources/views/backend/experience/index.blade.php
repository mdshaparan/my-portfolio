@extends('backend.layouts.master')

@section('title', 'Experience')
@section('page_title', 'Experience')

@section('content')

  <div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
      <h3 class="card-title mb-0">Experience</h3>
      <a href="{{ route('admin.experiences.create') }}" class="btn btn-primary btn-sm">+ Add Experience</a>
    </div>
    <div class="card-body">
      <table id="dataTable" class="table table-bordered align-middle w-100">
        <thead>
          <tr>
            <th>Action</th>
            <th>Role</th>
            <th>Organization</th>
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
  new DataTable('#dataTable', {
    processing: true,
    serverSide: true,
    ajax: '{{ route('admin.experiences.data') }}',
    columns: [
      { data: 'action', orderable: false, searchable: false },
      { data: 'role' },
      { data: 'organization' },
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
