@extends('layouts.mahasiswa')

@section('title', 'Permintaan Jadwal')

@section('styles')
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.1.9/dist/sweetalert2.min.css">
@endsection

@section('content')
<div class="container">
    <h1 class="mt-4 mb-4">Permintaan Jadwal Ruangan</h1>

    <form action="{{ route('mahasiswa.storeRequest') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="nama_acara">Nama Acara</label>
            <input type="text" id="nama_acara" name="nama_acara" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="nama_organisasi">Nama Organisasi</label>
            <input type="text" id="nama_organisasi" name="nama_organisasi" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="tanggal_mulai">Tanggal Mulai</label>
            <input type="datetime-local" id="tanggal_mulai" name="tanggal_mulai" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="tanggal_selesai">Tanggal Selesai</label>
            <input type="datetime-local" id="tanggal_selesai" name="tanggal_selesai" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="ruangan_id">Pilih Ruangan</label>
            <select id="ruangan_id" name="ruangan_id" class="form-control" required>
                <option value="">Pilih ruangan</option>
                @foreach($rooms as $room)
                    <option value="{{ $room->id }}">{{ $room->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="surat">Unggah Surat (.pdf)</label>
            <input type="file" id="surat" name="surat" class="form-control" accept=".pdf" required>
        </div>
        <button type="submit" class="btn btn-primary">Kirim Permintaan</button>
    </form>
</div>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.1.9/dist/sweetalert2.all.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        @if(session('success'))
            Swal.fire({
                title: 'Success!',
                text: '{{ session('success') }}',
                icon: 'success',
                confirmButtonText: 'OK'
            });
        @endif

        @if(session('error'))
            Swal.fire({
                title: 'Error!',
                text: '{{ session('error') }}',
                icon: 'error',
                confirmButtonText: 'OK'
            });
        @endif
    });
</script>
@endsection
