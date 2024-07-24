<?php
namespace App\Http\Controllers;

use App\Models\Jadwal;
use App\Models\Room;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class AdminRuanganController extends Controller
{
    public function index()
{
    $pendingRequests = Jadwal::where('status', 'pending')->count();
    $approvedRequests = Jadwal::where('status', 'approved')->count();
    $rejectedRequests = Jadwal::where('status', 'rejected')->count();

    $rooms = Room::all();

    return view('admin_ruangan.home', compact('rooms', 'pendingRequests', 'approvedRequests', 'rejectedRequests'));
}

    public function notifications()
    {
        $notifications = Auth::user()->notifications;
        return view('admin_ruangan.notifications', compact('notifications'));
    }

    public function requests()
    {
        $requests = Jadwal::where('status', 'pending')->get();
        return view('admin_ruangan.request', compact('requests'));
    }

    public function approveRequest($id)
    {
        $jadwal = Jadwal::find($id);
        $jadwal->status = 'approved';
        $jadwal->save();

        return redirect()->route('admin_ruangan.request')->with('success', 'Request approved successfully.');
    }

    public function rejectRequest($id)
    {
        $jadwal = Jadwal::find($id);
        $jadwal->status = 'rejected';
        $jadwal->save();

        return redirect()->route('admin_ruangan.request')->with('success', 'Request rejected successfully.');
    }

    public function createRoom()
    {
        return view('admin_ruangan.create_room');
    }

    public function storeRoom(Request $request)
    {
        // Validate input
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:10000',
        ]);
    
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
    
        // Store the image
        $imagePath = $request->file('image')->store('public/rooms');
        $imagePath = str_replace('public/', 'storage/', $imagePath);
    
        // Save room data
        Room::create([
            'name' => $request->name,
            'image' => $imagePath,
        ]);
    
        return redirect()->route('admin.dashboard')->with('success', 'Ruangan berhasil ditambahkan.');
    }
    
    public function history()
    {
        $history = Jadwal::where('status', '!=', 'pending')->get();
        return view('admin_ruangan.history', compact('history'));
    }

    public function downloadSurat($id)
    {
        $jadwal = Jadwal::find($id);
        return Storage::download($jadwal->surat);
    }

    public function showRoom($id)
    {
        $room = Room::find($id);
        return view('admin_ruangan.show_room', compact('room'));
    }

    
}
