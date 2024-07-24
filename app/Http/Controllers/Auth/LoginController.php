<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index()
    {
        return view('login.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');
        
        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            
            // Determine redirection based on role
            switch ($user->role) {
                case 'admin_ruangan':
                    $redirectUrl = route('admin.dashboard');
                    break;
                case 'super_admin':
                    $redirectUrl = route('superadmin.dashboard');
                    break;
                case 'mahasiswa':
                    $redirectUrl = route('mahasiswa.dashboard');
                    break;
                default:
                    Auth::logout(); // In case of an unexpected role
                    return response()->json(['success' => false, 'message' => 'Invalid role.'], 403);
            }

            return response()->json(['success' => true, 'redirect_url' => $redirectUrl]);
        }

        return response()->json(['success' => false, 'message' => 'Invalid credentials.'], 401);
    }
}
