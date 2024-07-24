@extends('layouts.superadmin')

@section('content')
<div class="container mt-5">
    <h1 class="text-center mb-4">Selamat Datang di Admin Panel</h1>
    
    <div class="row">
        <div class="col-md-4">
            <div class="card text-center mb-4">
                <div class="card-body">
                    <i class="fas fa-user-plus fa-3x mb-3"></i>
                    <h5 class="card-title">Create Admin Ruangan</h5>
                    <p class="card-text">Add new Admin Ruangan to the system.</p>
                    <a href="{{ route('superadmin.create_admin_ruangan') }}" class="btn btn-primary">Create</a>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-center mb-4">
                <div class="card-body">
                    <i class="fas fa-users fa-3x mb-3"></i>
                    <h5 class="card-title">View Admin Ruangan</h5>
                    <p class="card-text">View and manage Admin Ruangan</p>
                    <a href="{{ route('superadmin.list_admin_ruangan') }}" class="btn btn-primary">View</a>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-center mb-4">
                <div class="card-body">
                    <i class="fas fa-user-graduate fa-3x mb-3"></i>
                    <h5 class="card-title">View Mahasiswa</h5>
                    <p class="card-text">View and manage Mahasiswa accounts.</p>
                    <a href="{{ route('superadmin.list_mahasiswa') }}" class="btn btn-primary">View</a>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-4">
        <div class="col-md-4">
            <div class="card text-center mb-4">
                <div class="card-body">
                    <i class="fas fa-user-shield fa-3x mb-3"></i>
                    <h5 class="card-title">Create Super Admin</h5>
                    <p class="card-text">Add new Super Admin to the system.</p>
                    <a href="{{ route('superadmin.create_super_admin') }}" class="btn btn-primary">Create</a>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-center mb-4">
                <div class="card-body">
                    <i class="fas fa-users-cog fa-3x mb-3"></i>
                    <h5 class="card-title">View Super Admin</h5>
                    <p class="card-text">View and manage Super Admin accounts.</p>
                    <a href="{{ route('superadmin.list_super_admin') }}" class="btn btn-primary">View</a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Footer -->
<footer class="footer mt-5">
    <div class="container text-center">
        <span>&copy; 2024 Politeknik Negeri Banjarmasin. All Rights Reserved.</span>
    </div>
</footer>
@endsection
