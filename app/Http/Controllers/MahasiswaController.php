<?php
namespace App\Http\Controllers;

use App\Models\Room;
use App\Models\Jadwal;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; 
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use App\Notifications\NewRoomRequestNotification;

class MahasiswaController extends Controller
{

    public function index()
{
    $user_id = auth()->user()->id;
    $sentRequests = Jadwal::where('user_id', $user_id)->count();
    $rejectedRequests = Jadwal::where('user_id', $user_id)->where('status', 'rejected')->count();
    
    // Grafik permintaan
    $requestData = Jadwal::select(
        DB::raw('DATE(created_at) as date'),
        DB::raw('count(*) as count')
    )
    ->where('user_id', $user_id)
    ->groupBy('date')
    ->get();

    $rooms = Room::all(); // Fetch all rooms

    return view('mahasiswa.home', compact('rooms', 'sentRequests', 'rejectedRequests', 'requestData'));
}


    public function requests()
    {
        $rooms = Room::all(); // Fetch all rooms
        return view('mahasiswa.request_room', compact('rooms'));
    }

    public function history()
    {
        // Fetch history for the logged-in student
        $user_id = auth()->user()->id;
        $history = Jadwal::where('user_id', $user_id)->get();
        return view('mahasiswa.history', compact('history'));
    }

    public function storeRequest(Request $request)
    {
        // Validasi input
        $validator = Validator::make($request->all(), [
            'nama_acara' => 'required|string|max:255',
            'nama_organisasi' => 'required|string|max:255',
            'tanggal_mulai' => 'required|date|after_or_equal:now',
            'tanggal_selesai' => 'required|date|after:tanggal_mulai',
            'surat' => 'required|file|mimes:pdf|max:2048',
            'ruangan_id' => 'required|exists:ruangans,id',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Cek apakah ada jadwal bentrok
        $existingSchedule = Jadwal::where('ruangan_id', $request->ruangan_id)
            ->where(function ($query) use ($request) {
                $query->whereBetween('tanggal_mulai', [$request->tanggal_mulai, $request->tanggal_selesai])
                      ->orWhereBetween('tanggal_selesai', [$request->tanggal_mulai, $request->tanggal_selesai])
                      ->orWhere(function ($query) use ($request) {
                          $query->where('tanggal_mulai', '<=', $request->tanggal_mulai)
                                ->where('tanggal_selesai', '>=', $request->tanggal_selesai);
                      });
            })->exists();

        if ($existingSchedule) {
            return redirect()->back()->with('error', 'Tanggal yang dipilih sudah terisi jadwal lain.')->withInput();
        }

        // Simpan file surat
        $suratPath = $request->file('surat')->storeAs('public/surat', $request->file('surat')->getClientOriginalName());

        // Simpan data jadwal
        $jadwal = Jadwal::create([
            'nama_acara' => $request->nama_acara,
            'nama_organisasi' => $request->nama_organisasi,
            'tanggal_mulai' => $request->tanggal_mulai,
            'tanggal_selesai' => $request->tanggal_selesai,
            'surat' => $suratPath,
            'ruangan_id' => $request->ruangan_id,
            'user_id' => auth()->user()->id,
            'status' => 'pending', // Status default adalah pending
        ]);

        // Kirim notifikasi ke admin ruangan
        $adminRuangan = User::whereHas('role', function ($query) {
            $query->where('name', 'admin_ruangan');
        })->get();

        foreach ($adminRuangan as $admin) {
            $admin->notify(new NewRoomRequestNotification($jadwal));
        }

        return redirect()->back()->with('success', 'Permintaan jadwal berhasil dikirim.');
    }

    public function downloadSurat($id)
    {
        $jadwal = Jadwal::find($id);
        return Storage::download($jadwal->surat);
    }
}
