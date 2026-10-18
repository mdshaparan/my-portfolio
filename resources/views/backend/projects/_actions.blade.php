<a href="{{ route('admin.projects.edit', $item->id) }}" class="btn btn-warning btn-sm">Edit</a>

<form action="{{ route('admin.projects.toggle', $item->id) }}" method="POST" class="d-inline">
  @csrf @method('PATCH')
  <button type="submit" class="btn btn-info btn-sm">{{ $item->is_visible ? 'Hide' : 'Show' }}</button>
</form>

<form action="{{ route('admin.projects.destroy', $item->id) }}" method="POST" class="d-inline"
      onsubmit="return confirm('Delete this project?')">
  @csrf @method('DELETE')
  <button type="submit" class="btn btn-danger btn-sm">Delete</button>
</form>
