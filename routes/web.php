<?php
use App\Http\Controllers\PengunjungController;
use App\Http\Controllers\JadwalController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\AdminRuanganController;
use App\Http\Controllers\SuperAdminController;
use App\Http\Controllers\MahasiswaController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [PengunjungController::class, 'index'])->name('home');
Route::get('/jadwal', [PengunjungController::class, 'jadwal'])->name('jadwal');

Route::get('/jadwal/fetch', [JadwalController::class, 'fetchJadwal'])->name('jadwal.fetch');
Route::get('/room/fetch', [JadwalController::class, 'fetchRoom'])->name('room.fetch');
Route::get('/rooms/{id}', [JadwalController::class, 'fetchRoomName'])->name('roomid.fetch');

Route::get('/about', function () {
    return view('pengunjung.about');
})->name('about');

Route::get('register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('register', [RegisterController::class, 'register']);

Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('login', [LoginController::class, 'login']);

// Middleware for role-based access
Route::middleware(['auth', 'role:admin_ruangan'])->group(function() {
    Route::get('admin/dashboard', [AdminRuanganController::class, 'index'])->name('admin.dashboard');
    Route::get('/admin-ruangan/notifications', [AdminRuanganController::class, 'notifications'])->name('admin_ruangan.notifications');
    Route::get('/admin-ruangan/requests', [AdminRuanganController::class, 'requests'])->name('admin_ruangan.requests');
    Route::post('/admin-ruangan/approve-request/{id}', [AdminRuanganController::class, 'approveRequest'])->name('admin_ruangan.approve_request');
    Route::post('/admin-ruangan/reject-request/{id}', [AdminRuanganController::class, 'rejectRequest'])->name('admin_ruangan.reject_request');
    Route::get('/admin-ruangan/rooms/create', [AdminRuanganController::class, 'createRoom'])->name('admin_ruangan.create_room');
    Route::post('/admin-ruangan/rooms/store', [AdminRuanganController::class, 'storeRoom'])->name('admin_ruangan.store_room');
    Route::get('/admin_ruangan/history', [AdminRuanganController::class, 'history'])->name('admin_ruangan.history');
    Route::get('/admin_ruangan/download_surat/{id}', [AdminRuanganController::class, 'downloadSurat'])->name('admin_ruangan.download_surat');
    Route::get('/admin_ruangan/show_room/{id}', [AdminRuanganController::class, 'showRoom'])->name('admin_ruangan.show_room');
});

// In your web.php file

Route::middleware(['auth', 'role:super_admin'])->group(function() {
    Route::get('superadmin/dashboard', [SuperAdminController::class, 'index'])->name('superadmin.dashboard');

    Route::get('superadmin/create-admin-ruangan', [SuperAdminController::class, 'createAdminRuangan'])->name('superadmin.create_admin_ruangan');
    Route::post('superadmin/store-admin-ruangan', [SuperAdminController::class, 'storeAdminRuangan'])->name('superadmin.store_admin_ruangan');
    Route::get('superadmin/list-admin-ruangan', [SuperAdminController::class, 'listAdminRuangan'])->name('superadmin.list_admin_ruangan');

    Route::get('superadmin/edit-password/{id}', [SuperAdminController::class, 'editPassword'])->name('superadmin.edit_password');
    Route::post('superadmin/update-password/{id}', [SuperAdminController::class, 'updatePassword'])->name('superadmin.update_password');

    Route::get('superadmin/list-mahasiswa', [SuperAdminController::class, 'listMahasiswa'])->name('superadmin.list_mahasiswa');
    Route::delete('superadmin/delete-user/{id}', [SuperAdminController::class, 'deleteUser'])->name('superadmin.delete_user');

    Route::get('superadmin/create-super-admin', [SuperAdminController::class, 'createSuperAdmin'])->name('superadmin.create_super_admin');
    Route::post('superadmin/store-super-admin', [SuperAdminController::class, 'storeSuperAdmin'])->name('superadmin.store_super_admin');
    Route::get('superadmin/list-super-admin', [SuperAdminController::class, 'listSuperAdmin'])->name('superadmin.list_super_admin');
});

Route::middleware(['auth', 'role:mahasiswa'])->group(function() {
    Route::get('mahasiswa/dashboard', [MahasiswaController::class, 'index'])->name('mahasiswa.dashboard');
    Route::get('/mahasiswa/requests', [MahasiswaController::class, 'requests'])->name('requests');
    Route::get('/mahasiswa/history', [MahasiswaController::class, 'history'])->name('mahasiswa.history');
    Route::post('/mahasiswa/requests', [MahasiswaController::class, 'storeRequest'])->name('mahasiswa.storeRequest');
    Route::get('/mahasiswa/download-surat/{id}', [MahasiswaController::class, 'downloadSurat'])->name('mahasiswa.download_surat');
});

Route::post('logout', function () {
    Auth::logout();
    return redirect('/'); // Redirect to the home page or any page you prefer
})->name('logout');