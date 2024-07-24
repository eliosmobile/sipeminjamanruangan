@extends('layouts.app')

@section('title', 'Home')

@section('content')
<div class="container mt-5">
    <!-- Welcome Section -->
    <h1 class="text-center display-4 font-weight-bold animate__animated animate__fadeIn">Selamat Datang di Website Peminjaman Ruang Poliban</h1>

    <!-- Carousel Section -->
    <div id="imageCarousel" class="carousel slide mt-5" data-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="{{ asset('img/gambar1.jpeg') }}" class="d-block w-100 img-rectangle" alt="Image 1">
            </div>
            <div class="carousel-item">
                <img src="{{ asset('img/gambar2.jpeg') }}" class="d-block w-100 img-rectangle" alt="Image 2">
            </div>
            <div class="carousel-item">
                <img src="{{ asset('img/gambar3.jpeg') }}" class="d-block w-100 img-rectangle" alt="Image 3">
            </div>
        </div>
        <a class="carousel-control-prev" href="#imageCarousel" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#imageCarousel" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>

    <!-- Cards Section -->
    <div class="row mt-5">
        @foreach ($rooms as $room)
        <div class="col-md-4 mb-4">
            <div class="card h-100 shadow-sm animate__animated animate__fadeIn">
                <img src="{{ asset($room->image) }}" class="card-img-top img-rectangle" alt="{{ $room->name }}">
                <div class="card-body">
                    <h5 class="card-title">{{ $room->name }}</h5>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>

<style>
    .img-rectangle {
        width: 100%;
        height: 500px; /* Adjust height as needed for HD */
        object-fit: cover;
    }

    /* Add some styling to the footer */
    footer a {
        text-decoration: none;
        font-weight: bold;
    }

    footer a:hover {
        text-decoration: underline;
    }
</style>
@endsection
