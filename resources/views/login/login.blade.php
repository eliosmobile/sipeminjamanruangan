@extends('layouts.app')

@section('title', 'Login')

@section('styles')
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.1.9/dist/sweetalert2.min.css">
<style>
    .login-container {
        display: flex;
        justify-content: center;
        align-items: center;
        min-height: 100vh;
        background-color: #f8f8fa;
    }
    .login-card {
        padding: 2rem;
        border: 1px solid #ddd;
        border-radius: 8px;
        background-color: #fff;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        max-width: 400px;
        width: 100%;
    }
    .login-card .form-group {
        margin-bottom: 1.5rem;
    }
    .login-title {
        font-size: 2rem;
        margin-bottom: 1.5rem;
        color: #007bff;
    }
    .login-btn {
        width: 100%;
        padding: 0.75rem;
        font-size: 1rem;
    }
    .register-link {
        text-align: center;
        margin-top: 1rem;
    }
    .register-link a {
        color: #007bff;
        text-decoration: none;
    }
    .register-link a:hover {
        text-decoration: underline;
    }
</style>
@endsection

@section('content')
<div class="login-container">
    <div class="login-card">
        <h2 class="login-title">Login</h2>
        <form id="loginForm">
            <div class="form-group">
                <label for="email">Email address</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <button type="submit" class="btn btn-primary login-btn">Login</button>
            <div class="register-link">
                <p>Don't have an account? <a href="{{ route('register') }}">Register here</a></p>
            </div>
        </form>
    </div>
</div>
@endsection

@section('scripts')
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.1.9/dist/sweetalert2.all.min.js"></script>
<script>
    $(document).ready(function() {
        $('#loginForm').on('submit', function(e) {
            e.preventDefault();
            var email = $('#email').val();
            var password = $('#password').val();

            $.ajax({
                url: '{{ route("login") }}',
                method: 'POST',
                data: {
                    email: email,
                    password: password,
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    if (response.success) {
                        Swal.fire({
                            title: 'Success!',
                            text: 'Login berhasil!',
                            icon: 'success',
                            confirmButtonText: 'OK'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                window.location.href = response.redirect_url;
                            }
                        });
                    } else {
                        Swal.fire({
                            title: 'Error!',
                            text: response.message,
                            icon: 'error',
                            confirmButtonText: 'Try Again'
                        });
                    }
                },
                error: function(response) {
                    Swal.fire({
                        title: 'Error!',
                        text: 'Invalid credentials.',
                        icon: 'error',
                        confirmButtonText: 'Try Again'
                    });
                }
            });
        });
    });
</script>
@endsection
