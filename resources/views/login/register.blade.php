@extends('layouts.app')

@section('title', 'Register')

@section('styles')
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.1.9/dist/sweetalert2.min.css">
<style>
    .register-container {
        display: flex;
        justify-content: center;
        align-items: center;
        min-height: 100vh;
        background-color: #f8f8fa;
    }
    .register-card {
        padding: 2rem;
        border: 1px solid #ddd;
        border-radius: 8px;
        background-color: #fff;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        max-width: 400px;
        width: 100%;
    }
    .register-card .form-group {
        margin-bottom: 1.5rem;
    }
    .register-title {
        font-size: 2rem;
        margin-bottom: 1.5rem;
        color: #007bff;
    }
    .register-btn {
        width: 100%;
        padding: 0.75rem;
        font-size: 1rem;
    }
    .login-link {
        text-align: center;
        margin-top: 1rem;
    }
    .login-link a {
        color: #007bff;
        text-decoration: none;
    }
    .login-link a:hover {
        text-decoration: underline;
    }
</style>
@endsection

@section('content')
<div class="register-container">
    <div class="register-card">
        <h2 class="register-title">Register</h2>
        <form id="registerForm">
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>
            <div class="form-group">
                <label for="email">Email address</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <div class="form-group">
                <label for="password_confirmation">Confirm Password</label>
                <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required>
            </div>
            <button type="submit" class="btn btn-primary register-btn">Register</button>
            <div class="login-link">
                <p>Already have an account? <a href="{{ route('login') }}">Login here</a></p>
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
        $('#registerForm').on('submit', function(e) {
            e.preventDefault();
            var name = $('#name').val();
            var email = $('#email').val();
            var password = $('#password').val();
            var password_confirmation = $('#password_confirmation').val();
            
            $.ajax({
                url: '{{ route("register") }}',
                method: 'POST',
                data: {
                    name: name,
                    email: email,
                    password: password,
                    password_confirmation: password_confirmation,
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    Swal.fire({
                        title: 'Success!',
                        text: 'Registration successful. Please log in.',
                        icon: 'success',
                        confirmButtonText: 'OK'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.href = '{{ route("login") }}';
                        }
                    });
                },
                error: function(response) {
                    var errors = response.responseJSON.errors;
                    var errorMessage = '';
                    $.each(errors, function(key, value) {
                        errorMessage += value[0] + '<br>';
                    });
                    Swal.fire({
                        title: 'Error!',
                        html: errorMessage,
                        icon: 'error',
                        confirmButtonText: 'Try Again'
                    });
                }
            });
        });
    });
</script>
@endsection
