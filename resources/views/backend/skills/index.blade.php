@extends('backend.layouts.master')

@section('title', 'Skills')
@section('page_title', 'Skills')

@section('content')

  <div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
      <h3 class="card-title mb-0">Skills</h3>
      <a href="{{ route('admin.skills.create') }}" class="btn btn-primary btn-sm">+ Add Skill</a>
    </div>

    <div class="card-body">
      <table id="skillsTable" class="table table-bordered align-middle w-100">
        <thead>
          <tr>
            <th>Action</th>
            <th>Skill</th>
            <th>Level (%)</th>
            <th>Description</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($skills as $skill)
            <tr>
              <td class="text-nowrap">
                <a href="{{ route('admin.skills.edit', $skill->id) }}" class="btn btn-warning btn-sm">Edit</a>

                <form action="{{ route('admin.skills.destroy', $skill->id) }}" method="POST" class="d-inline"
                      onsubmit="return confirm('Delete this skill?')">
                  @csrf @method('DELETE')
                  <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                </form>
              </td>
              <td>{{ $skill->name }}</td>
              <td>{{ $skill->level }}%</td>
              <td>{{ $skill->description }}</td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>

@endsection

@push('scripts')
<script>
  new DataTable('#skillsTable', {
    layout: {
      topStart: {
        buttons: [
          { extend: 'copy',  exportOptions: { columns: [1, 2, 3] } },
          { extend: 'csv',   exportOptions: { columns: [1, 2, 3] } },
          { extend: 'excel', exportOptions: { columns: [1, 2, 3] } },
          { extend: 'pdf',   exportOptions: { columns: [1, 2, 3] } },
          { extend: 'print', exportOptions: { columns: [1, 2, 3] } }
        ]
      }
    }
  });
</script>
@endpush