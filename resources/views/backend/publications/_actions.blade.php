<a href="{{ route('admin.publications.edit', $item->id) }}" class="btn btn-warning btn-sm">Edit</a>

<form action="{{ route('admin.publications.toggle', $item->id) }}" method="POST" class="d-inline">
  @csrf @method('PATCH')
  <button type="submit" class="btn btn-info btn-sm">{{ $item->is_visible ? 'Hide' : 'Show' }}</button>
</form>

<form action="{{ route('admin.publications.destroy', $item->id) }}" method="POST" class="d-inline"
      onsubmit="return confirm('Delete this publication?')">
  @csrf @method('DELETE')
  <button type="submit" class="btn btn-danger btn-sm">Delete</button>
</form>
