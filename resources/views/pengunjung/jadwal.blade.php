@extends('layouts.app')

@section('title', 'Jadwal Ruangan')

@section('styles')
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/fullcalendar@5.10.2/main.min.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.1.9/dist/sweetalert2.min.css">
<style>
    .calendar-container {
        margin-bottom: 2rem;
        flex: 1;
    }
    .table-container {
        flex: 1;
        margin-left: 2rem;
    }
    .layout-container {
        display: flex;
    }
    .fc-event {
        background-color: #007bff;
        border: 1px solid #007bff;
    }
    .fc-event:hover {
        background-color: #0056b3;
    }
</style>
@endsection

@section('content')
<div class="container">
    <h1 class="mt-4 mb-4">Jadwal Ruangan</h1>
    <div class="form-group">
        <label for="roomSelect">Pilih Ruangan</label>
        <select id="roomSelect" class="form-control">
            <option value="">Silahkan Untuk Melihat Ruangan Dulu Untuk Melihat Jadwal disini </option>
            @foreach($rooms as $room)
                <option value="{{ $room->id }}">{{ $room->name }}</option>
            @endforeach
        </select>
    </div>

    <div class="layout-container">
        <div id="calendar" class="calendar-container"></div>

        <div id="scheduleTable" class="table-container">
            <h3>Table Jadwal</h3>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Nama Acara</th>
                        <th>Organisasi</th>
                        <th>Tanggal Mulai</th>
                        <th>Tanggal Selesai</th>
                    </tr>
                </thead>
                <tbody id="scheduleTableBody">
                    <!-- Table rows will be populated by JavaScript -->
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.10.2/main.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.1.9/dist/sweetalert2.all.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('calendar');
        var calendar = new FullCalendar.Calendar(calendarEl, {
            headerToolbar: {
                left: 'prev,next today',
                center: 'title',
                right: 'dayGridMonth,timeGridWeek,timeGridDay'
            },
            initialView: 'dayGridMonth',
            events: function(fetchInfo, successCallback, failureCallback) {
                var ruanganId = $('#roomSelect').val();
                $.ajax({
                    url: '{{ route('jadwal.fetch') }}',
                    method: 'GET',
                    data: { ruangan_id: ruanganId },
                    success: function(data) {
                        console.log("Fetched events: ", data); // Debugging
                        successCallback(data);
                    },
                    error: function() {
                        failureCallback();
                    }
                });
            },
            eventClick: function(info) {
                fetchRoomName(info.event.extendedProps.ruangan_id).then(roomName => {
                    Swal.fire({
                        title: info.event.title,
                        html: `<p>Organisasi: ${info.event.extendedProps.organization}</p>
                               <p>Ruangan: ${roomName}</p>
                               <p>Tanggal Mulai: ${formatDateTime(info.event.start)}</p>
                               <p>Tanggal Selesai: ${formatDateTime(info.event.end)}</p>`,
                        icon: 'info'
                    });
                });
            }
        });
        calendar.render();

        $('#roomSelect').change(function() {
            calendar.refetchEvents();
            fetchTableData();
        });

        function fetchTableData() {
            var ruanganId = $('#roomSelect').val();
            $.ajax({
                url: '{{ route('jadwal.fetch') }}',
                method: 'GET',
                data: { ruangan_id: ruanganId },
                success: function(data) {
                    console.log("Fetched table data: ", data); // Debugging
                    var rows = '';
                    data.forEach(function(jadwal) {
                        rows += '<tr>' +
                            '<td>' + jadwal.title + '</td>' +
                            '<td>' + jadwal.organization + '</td>' +
                            '<td>' + formatDateTime(jadwal.start) + '</td>' +
                            '<td>' + formatDateTime(jadwal.end) + '</td>' +
                            '</tr>';
                    });
                    $('#scheduleTableBody').html(rows);
                },
                error: function() {
                    $('#scheduleTableBody').html('<tr><td colspan="4">Data tidak ditemukan</td></tr>');
                }
            });
        }

        function fetchRoomName(roomId) {
            return new Promise((resolve, reject) => {
                $.ajax({
                    url: '{{ route('roomid.fetch', '') }}/' + roomId,
                    method: 'GET',
                    success: function(data) {
                        resolve(data.name);
                    },
                    error: function() {
                        reject('Nama ruangan tidak ditemukan');
                    }
                });
            });
        }

        function formatDateTime(dateString) {
            var date = new Date(dateString);
            return date.toLocaleString(); // Customize format as needed
        }
    });
</script>
@endsection
