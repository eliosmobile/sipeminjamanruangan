<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Room;
use App\Models\Jadwal;

class JadwalController extends Controller
{
    public function fetchJadwal(Request $request)
    {
        $ruangan_id = $request->input('ruangan_id');
        $jadwal = Jadwal::where('ruangan_id', $ruangan_id)
                        ->where('status', 'approved')
                        ->get()
                        ->transform(function ($item) {
                            return [
                                'id' => $item->id,
                                'title' => $item->nama_acara,
                                'start' => $item->tanggal_mulai,
                                'end' => $item->tanggal_selesai,
                                'organization' => $item->nama_organisasi,
                                'ruangan_id' => $item->ruangan_id,
                            ];
                        });

        return response()->json($jadwal);
    }

    public function fetchRoom(Request $request)
    {
        $room = Room::find($request->id);
        return response()->json($room);
    }

    public function fetchRoomName($id)
    {
        $room = Room::find($id);

        if ($room) {
            return response()->json(['name' => $room->name]);
        } else {
            return response()->json(['name' => 'Nama ruangan tidak ditemukan'], 404);
        }
    }
}
