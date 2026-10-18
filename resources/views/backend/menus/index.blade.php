@extends('backend.layouts.master')

@section('title', 'Navbar Menu')
@section('page_title', 'Navbar Menu')

@section('content')

  <div class="alert alert-info">
    Menus you add here appear in the website navbar. Each menu is a section of the single-page website.
    Deleting a menu also removes its section. Smaller <strong>Order</strong> numbers appear first.
  </div>

  <div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
      <h3 class="card-title mb-0">Navbar Menu</h3>
      <a href="{{ route('admin.menus.create') }}" class="btn btn-primary btn-sm">+ Add Menu</a>
    </div>
    <div class="card-body">
      <table id="dataTable" class="table table-bordered align-middle w-100">
        <thead>
          <tr>
            <th>Action</th>
            <th>Navbar Title</th>
            <th>Anchor</th>
            <th>Section Type</th>
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
    ajax: '{{ route('admin.menus.data') }}',
    columns: [
      { data: 'action', orderable: false, searchable: false },
      { data: 'title' },
      { data: 'slug' },
      { data: 'section_type' },
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
