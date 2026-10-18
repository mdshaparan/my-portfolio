<a href="{{ route('admin.educations.edit', $education->id) }}" class="btn btn-warning btn-sm">Edit</a>

<form action="{{ route('admin.educations.toggle', $education->id) }}" method="POST" class="d-inline">
  @csrf @method('PATCH')
  <button type="submit" class="btn btn-info btn-sm">{{ $education->is_visible ? 'Hide' : 'Show' }}</button>
</form>

<form action="{{ route('admin.educations.destroy', $education->id) }}" method="POST" class="d-inline"
      onsubmit="return confirm('Delete this education?')">
  @csrf @method('DELETE')
  <button type="submit" class="btn btn-danger btn-sm">Delete</button>
</form>