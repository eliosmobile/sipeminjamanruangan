@extends('layouts.superadmin')

@section('content')
<div class="container">
    <h1>Edit Password for {{ $user->name }}</h1>
    <form action="{{ route('superadmin.update_password', $user->id) }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="password">New Password:</label>
            <input type="password" name="password" id="password" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="password_confirmation">Confirm New Password:</label>
            <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Update Password</button>
    </form>
</div>
@endsection
