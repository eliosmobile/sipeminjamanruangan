<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Room;
class PengunjungController extends Controller
{
    public function index()
    {
        $rooms = Room::all();
        return view('pengunjung.home', compact('rooms'));
    }

    public function jadwal()
    {
        $rooms = Room::all();
        return view('pengunjung.jadwal', compact('rooms'));
    }

}
