@extends('backend.layouts.master')

@section('title', 'Projects')
@section('page_title', 'Projects')

@section('content')

  <div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
      <h3 class="card-title mb-0">Projects</h3>
      <a href="{{ route('admin.projects.create') }}" class="btn btn-primary btn-sm">+ Add Project</a>
    </div>
    <div class="card-body">
      <table id="dataTable" class="table table-bordered align-middle w-100">
        <thead>
          <tr>
            <th>Action</th>
            <th>Image</th>
            <th>Title</th>
            <th>Category</th>
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
    ajax: '{{ route('admin.projects.data') }}',
    columns: [
      { data: 'action', orderable: false, searchable: false },
      { data: 'image', orderable: false, searchable: false },
      { data: 'title' },
      { data: 'category' },
      { data: 'sort_order' },
      { data: 'status', orderable: false, searchable: false }
    ],
    order: [[4, 'asc']],
    lengthMenu: [[10, 25, 50, -1], [10, 25, 50, 'All']],
    layout: {
      topStart: {
        buttons: [
          { extend: 'copy',  exportOptions: { columns: [2, 3, 4] } },
          { extend: 'csv',   exportOptions: { columns: [2, 3, 4] } },
          { extend: 'excel', exportOptions: { columns: [2, 3, 4] } },
          { extend: 'pdf',   exportOptions: { columns: [2, 3, 4] } },
          { extend: 'print', exportOptions: { columns: [2, 3, 4] } }
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
