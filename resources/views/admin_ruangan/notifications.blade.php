@extends('layouts.admin')

@section('title', 'Notifikasi')

@section('content')
<div class="container">
    <h1 class="mt-4 mb-4">Notifikasi</h1>
    @if($notifications->isEmpty())
        <div class="alert alert-info">
            Tidak ada notifikasi.
        </div>
    @else
        <ul class="list-group">
            @foreach($notifications as $notification)
                <li class="list-group-item">
                    <div>
                        <strong>{{ $notification->data['title'] }}</strong>
                        <p>{{ $notification->data['message'] }}</p>
                        <small class="text-muted">{{ $notification->created_at->diffForHumans() }}</small>
                    </div>
                </li>
            @endforeach
        </ul>
    @endif
</div>
@endsection
