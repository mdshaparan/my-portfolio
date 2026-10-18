<a href="{{ route('admin.messages.show', $item->id) }}" class="btn btn-info btn-sm">View</a>

<form action="{{ route('admin.messages.destroy', $item->id) }}" method="POST" class="d-inline"
      onsubmit="return confirm('Delete this message?')">
  @csrf @method('DELETE')
  <button type="submit" class="btn btn-danger btn-sm">Delete</button>
</form>
