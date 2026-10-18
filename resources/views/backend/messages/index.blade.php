@extends('backend.layouts.master')

@section('title', 'Messages')
@section('page_title', 'Messages')

@section('content')

  <div class="card">
    <div class="card-header">
      <h3 class="card-title mb-0">Messages (from the website contact form)</h3>
    </div>
    <div class="card-body">
      <table id="dataTable" class="table table-bordered align-middle w-100">
        <thead>
          <tr>
            <th>Action</th>
            <th>Name</th>
            <th>Email</th>
            <th>Subject</th>
            <th>Date</th>
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
    ajax: '{{ route('admin.messages.data') }}',
    columns: [
      { data: 'action', orderable: false, searchable: false },
      { data: 'name' },
      { data: 'email' },
      { data: 'subject' },
      { data: 'created_at' },
      { data: 'status', orderable: false, searchable: false }
    ],
    order: [[4, 'desc']],
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
