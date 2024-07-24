<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class SuperAdminController extends Controller
{
    public function index()
    {
        return view('super_admin.home');
    }

    public function createAdminRuangan()
    {
        return view('super_admin.create_admin_ruangan');
    }

    public function storeAdminRuangan(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'admin_ruangan',
        ]);

        return redirect()->route('superadmin.dashboard')->with('success', 'Admin Ruangan created successfully');
    }

    public function listAdminRuangan()
    {
        $adminRuangans = User::where('role', 'admin_ruangan')->get();
        return view('super_admin.list_admin_ruangan', compact('adminRuangans'));
    }

    public function editPassword($id)
    {
        $user = User::findOrFail($id);
        return view('super_admin.edit_password', compact('user'));
    }

    public function updatePassword(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'password' => 'required|string|min:8|confirmed',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $user->password = Hash::make($request->password);
        $user->save();

        return redirect()->route('superadmin.dashboard')->with('success', 'Password updated successfully');
    }

    public function listMahasiswa()
    {
        $mahasiswas = User::where('role', 'mahasiswa')->get();
        return view('super_admin.list_mahasiswa', compact('mahasiswas'));
    }

    public function deleteUser($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('superadmin.dashboard')->with('success', 'User deleted successfully');
    }

    public function createSuperAdmin()
    {
        return view('super_admin.create_super_admin');
    }

    public function storeSuperAdmin(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'super_admin',
        ]);

        return redirect()->route('superadmin.dashboard')->with('success', 'Super Admin created successfully');
    }

    public function listSuperAdmin()
    {
        $superAdmins = User::where('role', 'super_admin')->get();
        return view('super_admin.list_super_admin', compact('superAdmins'));
    }
}
