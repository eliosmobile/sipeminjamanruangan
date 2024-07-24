@extends('layouts.app')

@section('title', 'About Us')

@section('styles')
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<style>
    .about-container {
        text-align: center;
        padding: 50px 0;
    }
    .about-title {
        font-size: 2.5rem;
        margin-bottom: 1.5rem;
        color: #007bff;
    }
    .about-text {
        font-size: 1.2rem;
        line-height: 1.8;
        margin-bottom: 2rem;
        color: #6c757d;
    }
    .team-section {
        background-color: #f8f8fa;
        padding: 50px 0;
    }
    .team-title {
        font-size: 2rem;
        margin-bottom: 1rem;
        color: #343a40;
    }
    .team-member {
        margin-bottom: 1.5rem;
        text-align: center;
    }
    .member-photo {
        width: 150px;
        height: 150px;
        border-radius: 50%;
        margin-bottom: 1rem;
        border: 2px solid #007bff;
    }
    .member-name {
        font-size: 1.2rem;
        font-weight: bold;
        color: #007bff;
    }
    .member-role {
        font-size: 1rem;
        color: #6c757d;
    }
</style>
@endsection

@section('content')
<div class="container about-container">
    <h1 class="about-title">About Our Website</h1>
    <p class="about-text">Welcome to our room reservation website! We aim to provide a seamless and efficient platform for booking rooms at Poliban. Our website allows users to easily view available rooms, make reservations, and manage their bookings. We strive to enhance your experience by offering a user-friendly interface and professional service.</p>
</div>

<div class="container team-section">
    <h2 class="team-title">Our Team</h2>
    <div class="row">
        <div class="col-md-3 team-member">
            <img src="path/to/photo1.jpg" class="member-photo" alt="Team Member 1">
            <div class="member-name">Team Member 1</div>
            <div class="member-role">Role 1</div>
        </div>
        <div class="col-md-3 team-member">
            <img src="path/to/photo2.jpg" class="member-photo" alt="Team Member 2">
            <div class="member-name">Team Member 2</div>
            <div class="member-role">Role 2</div>
        </div>
        <div class="col-md-3 team-member">
            <img src="path/to/photo3.jpg" class="member-photo" alt="Team Member 3">
            <div class="member-name">Team Member 3</div>
            <div class="member-role">Role 3</div>
        </div>
        <div class="col-md-3 team-member">
            <img src="path/to/photo4.jpg" class="member-photo" alt="Team Member 4">
            <div class="member-name">Team Member 4</div>
            <div class="member-role">Role 4</div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
@endsection
