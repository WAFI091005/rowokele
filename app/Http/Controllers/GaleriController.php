<?php

namespace App\Http\Controllers;

use App\Services\FirebaseService;
use Illuminate\Http\Request;

class GaleriController extends Controller
{
    public function index()
    {
        $fb = app(FirebaseService::class);

        // 1. Tarik data murni menggunakan get() yang terbukti lancar
        $settings = $fb->get('settings');
        $rawGaleri = $fb->get('galeri') ?? [];

        // 2. Map data agar format properti image_url dan caption sinkron dengan template Blade
        $galeri = array_map(function($item) {
            // Sinkronisasi key gambar dari dashboard ('gambar') ke template ('image_url')
            $item['image_url'] = $item['image_url'] ?? ($item['gambar'] ?? ($item['thumbnail'] ?? ($item['url'] ?? null)));
            $item['caption'] = $item['caption'] ?? ($item['deskripsi'] ?? 'Foto kegiatan KKN');
            return $item;
        }, $rawGaleri);

        // 3. Urutkan galeri berdasarkan tanggal input terbaru di atas
        usort($galeri, function ($a, $b) {
            return ($b['created_at'] ?? 0) <=> ($a['created_at'] ?? 0);
        });

        $data = [
            'settings' => $settings,
            'galeri'   => array_values($galeri)
        ];

        return view('galeri_murni', $data);
    }
}