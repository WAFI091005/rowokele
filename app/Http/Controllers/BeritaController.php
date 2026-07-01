<?php

namespace App\Http\Controllers;

use App\Services\FirebaseService;
use Illuminate\Http\Request;

class BeritaController extends Controller
{
    public function index()
    {
        $fb = app(FirebaseService::class);

        // 1. Tarik data murni menggunakan get() yang terbukti lancar
        $settings = $fb->get('settings');
        $rawBerita = $fb->get('berita') ?? [];

        // 2. Map data agar format properti gambar, tanggal, dan deskripsi sinkron dengan template Blade
        $berita = array_map(function($item) {
            // Sinkronisasi tanggal
            $item['tanggal_formatted'] = !empty($item['tanggal']) ? date('d M Y', strtotime($item['tanggal'])) : '-';

            // Sinkronisasi key gambar dari dashboard ('gambar') ke template ('thumbnail')
            $item['gambar'] = $item['gambar'] ?? ($item['thumbnail'] ?? null);

            // Sinkronisasi isi konten
            $item['deskripsi'] = $item['isi'] ?? ($item['deskripsi'] ?? 'Deskripsi berita belum tersedia.');

            return $item;
        }, $rawBerita);

        // 3. Urutkan berita berdasarkan tanggal rilis terbaru di atas
        usort($berita, function ($a, $b) {
            $tglA = isset($a['tanggal']) ? strtotime($a['tanggal']) : 0;
            $tglB = isset($b['tanggal']) ? strtotime($b['tanggal']) : 0;
            return $tglB <=> $tglA;
        });

        $data = [
            'settings' => $settings,
            'berita'   => array_values($berita)
        ];

        return view('berita_murni', $data);
    }
}