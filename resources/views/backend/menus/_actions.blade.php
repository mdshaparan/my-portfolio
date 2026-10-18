<a href="{{ route('admin.menus.edit', $item->id) }}" class="btn btn-warning btn-sm">Edit</a>

<form action="{{ route('admin.menus.toggle', $item->id) }}" method="POST" class="d-inline">
  @csrf @method('PATCH')
  <button type="submit" class="btn btn-info btn-sm">{{ $item->is_visible ? 'Hide' : 'Show' }}</button>
</form>

<form action="{{ route('admin.menus.destroy', $item->id) }}" method="POST" class="d-inline"
      onsubmit="return confirm('Delete this menu? The section will also be removed from the website.')">
  @csrf @method('DELETE')
  <button type="submit" class="btn btn-danger btn-sm">Delete</button>
</form>
