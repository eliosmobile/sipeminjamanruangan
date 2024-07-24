@extends('layouts.admin')

@section('title', 'Create room')

@section('content')
<div class="container">
    <h1>Tambah Ruangan</h1>
    <form action="{{ route('admin_ruangan.store_room') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="name">Nama Ruangan</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}" required>
            @if ($errors->has('name'))
                <span class="text-danger">{{ $errors->first('name') }}</span>
            @endif
        </div>
        <div class="form-group">
            <label for="image">Gambar Ruangan</label>
            <input type="file" name="image" id="image" class="form-control" required>
            @if ($errors->has('image'))
                <span class="text-danger">{{ $errors->first('image') }}</span>
            @endif
        </div>
        <button type="submit" class="btn btn-primary">Tambah Ruangan</button>
    </form>
</div>
@endsection
