@extends('layouts.superadmin')

@section('content')
<div class="container">
    <h1>List of Mahasiswa</h1>
    <table class="table">
        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($mahasiswas as $mahasiswa)
            <tr>
                <td>{{ $mahasiswa->name }}</td>
                <td>{{ $mahasiswa->email }}</td>
                <td>
                    <a href="{{ route('superadmin.edit_password', $mahasiswa->id) }}" class="btn btn-warning">Edit Password</a>
                    <form action="{{ route('superadmin.delete_user', $mahasiswa->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
