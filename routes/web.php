<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\AnggotaController;
use App\Http\Controllers\BeritaController;
use App\Http\Controllers\GaleriController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\KegiatanController;
use App\Http\Controllers\ProkerController;
use App\Services\FirebaseService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// --- Public Routes ---
Route::get('/', [HomeController::class, 'index']);
Route::get('/proker', [ProkerController::class, 'index']);
Route::get('/kegiatan', [KegiatanController::class, 'index']);
Route::get('/anggota', [AnggotaController::class, 'index']);
Route::get('/berita', [BeritaController::class, 'index']);
Route::get('/galeri', [GaleriController::class, 'index']);

// --- Auth Routes ---
// Gunakan view biasa, bukan Livewire
Route::get('/login2', function () {
    return view('login2');
})->name('login2');

// --- Engine Login Murni ---
Route::post('/proses-login-murni', function (Request $request) {
    $credentials = $request->json()->all();
    $inputUsername = $credentials['username'] ?? '';
    $inputPassword = $credentials['password'] ?? '';

    try {
        $fb = app(FirebaseService::class);
        $rawAdmin = $fb->get('admin');
        $adminArray = json_decode(json_encode($rawAdmin), true);

        $adminData = null;
        if (isset($adminArray['username'])) {
            $adminData = $adminArray;
        } elseif (isset($adminArray[0]) && is_array($adminArray[0])) {
            $adminData = $adminArray[0];
        } elseif (is_array($adminArray) && count($adminArray) > 0) {
            $adminData = reset($adminArray);
        }

        if (!$adminData || !isset($adminData['username']) || !isset($adminData['password'])) {
            return response()->json(['success' => false, 'message' => 'Format database Firebase tidak sesuai atau kosong.']);
        }

        if ($inputUsername === $adminData['username'] && $inputPassword === $adminData['password']) {
            session()->regenerate();
            session()->put('is_logged_in', true);
            session()->save();
            return response()->json(['success' => true]);
        }
        return response()->json(['success' => false, 'message' => 'Username atau Password Admin Salah!']);
    } catch (\Exception $e) {
        return response()->json(['success' => false, 'message' => 'Eror Sistem: ' . $e->getMessage()]);
    }
});

// =========================================================
//  PROTEKSI HALAMAN & API ADMIN DENGAN MIDDLEWARE 'admin.auth'
// =========================================================
Route::middleware(['admin.auth'])->group(function () {

    // --- ROUTE DASHBOARD ADMIN ---
    Route::get('/admin/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');

    // --- API UNTUK KEBUTUHAN AJAX CRUD DENGAN COMPATIBLE UPLOAD GAMBAR ALL TABS ---
    Route::post('/admin/api/simpan-data', function (Request $request) {
        $node = $request->input('node');
        $id = $request->input('id'); 

        try {
            $fb = app(FirebaseService::class);
            $payload = [];

            // Handling File Upload Gambar
            $imageUrl = null;
            if ($request->hasFile('foto')) {
                $file = $request->file('foto');
                $filename = time() . '_' . $file->getClientOriginalName();
                $file->move(public_path('uploads'), $filename);
                $imageUrl = url('uploads/' . $filename);
            }

            // Sesuaikan key gambar dengan key data masing-masing tab kamu di Firebase
            if ($node === 'prokers') {
                $payload = [
                    'judul' => $request->input('judul'),
                    'tanggal' => $request->input('tanggal'),
                    'status' => $request->input('status', 'berjalan')
                ];
                if ($imageUrl) $payload['gambar'] = $imageUrl;
            } elseif ($node === 'kegiatan') {
                $payload = [
                    'title' => $request->input('judul'),
                    'tanggal' => $request->input('tanggal'),
                    'deskripsi' => $request->input('deskripsi')
                ];
                if ($imageUrl) $payload['gambar'] = $imageUrl;
            } elseif ($node === 'anggota') {
                $payload = [
                    'nama' => $request->input('nama'),
                    'jabatan' => $request->input('jabatan'),
                    'nim' => $request->input('nim'),
                    'jurusan' => $request->input('jurusan')
                ];
                if ($imageUrl) $payload['foto'] = $imageUrl;
            } elseif ($node === 'berita') {
                $payload = [
                    'judul' => $request->input('judul'),
                    'tanggal' => $request->input('tanggal'),
                    'isi' => $request->input('deskripsi')
                ];
                if ($imageUrl) $payload['thumbnail'] = $imageUrl;
            } elseif ($node === 'galeri') {
                $payload = [
                    'caption' => $request->input('deskripsi')
                ];
                if ($imageUrl) $payload['image_url'] = $imageUrl;
            }

            // Eksekusi Simpan (Tambah Baru / Edit Update)
            if (empty($id)) {
                $fb->create($node, $payload);
            } else {
                $fb->update($node, $id, $payload);
            }

            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()]);
        }
    });

    // Universal Delete API
    Route::post('/admin/api/hapus-data', function (Request $request) {
        $node = $request->json('node');
        $id = $request->json('id');
        try {
            app(FirebaseService::class)->delete($node, $id);
            return response()->json(['success' => true]);
        } catch (\Exception $e) { 
            return response()->json(['success' => false, 'message' => $e->getMessage()]); 
        }
    });

    // Save Settings API
    Route::post('/admin/api/simpan-settings', function (Request $request) {
        $payload = $request->json('payload');
        try {
            app(FirebaseService::class)->update('settings', '', $payload);
            return response()->json(['success' => true]);
        } catch (\Exception $e) { 
            return response()->json(['success' => false, 'message' => $e->getMessage()]); 
        }
    });
    
});