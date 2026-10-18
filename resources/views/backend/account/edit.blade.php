@extends('backend.layouts.master')

@section('content')
<div class="container-fluid">
    <h4 class="mb-3">Account Settings</h4>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('admin.account.update') }}" style="max-width:520px">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label class="form-label">Login email</label>
            <input type="email" name="email" class="form-control" value="{{ old('email', $user->email) }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">New password <small class="text-muted">(leave empty to keep the current one)</small></label>
            <input type="password" name="password" class="form-control" autocomplete="new-password">
        </div>

        <div class="mb-3">
            <label class="form-label">Confirm new password</label>
            <input type="password" name="password_confirmation" class="form-control" autocomplete="new-password">
        </div>

        <hr>

        <div class="mb-3">
            <label class="form-label">Current password <small class="text-muted">(required to save any change)</small></label>
            <input type="password" name="current_password" class="form-control" required autocomplete="current-password">
        </div>

        <button type="submit" class="btn btn-primary">Save changes</button>
    </form>
</div>
@endsection