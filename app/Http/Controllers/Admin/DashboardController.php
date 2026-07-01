<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\FirebaseService;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // 1. Pengecekan Session Standar
        if (!session()->has('is_logged_in') || session('is_logged_in') !== true) {
            return redirect()->route('login2');
        }

        $fb = app(FirebaseService::class);

        // 2. Ambil semua data menggunakan method get() yang sudah kita perbaiki dan terbukti bisa jalan
        $data = [
            'activeTab' => request('tab', 'settings'),
            'settings'  => $fb->get('settings'),
            'prokers'   => $fb->get('prokers'),
            'kegiatan'  => $fb->get('kegiatan'),
            'anggota'   => $fb->get('anggota'),
            'berita'    => $fb->get('berita'),
            'galeri'    => $fb->get('galeri'),
        ];

        // 3. Lempar langsung ke view blade biasa
        return view('admin.dashboard_murni', $data);
    }
}