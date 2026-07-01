<?php

namespace App\Http\Controllers;

use App\Services\FirebaseService;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $fb = app(FirebaseService::class);

        // 1. Tarik data murni menggunakan get() yang sudah kita perbaiki
        $settings    = $fb->get('settings');
        $rawProkers  = $fb->get('prokers') ?? [];
        $rawBerita   = $fb->get('berita') ?? [];
        $rawKegiatan = $fb->get('kegiatan') ?? [];
        $anggota     = $fb->get('anggota') ?? [];
        $rawGaleri   = $fb->get('galeri') ?? [];

        // 2. Proses Sorting Manual Anti-Crash (Mencegah struktur objek SDK merusak loops)
        usort($rawGaleri, function ($a, $b) {
            return ($b['created_at'] ?? 0) <=> ($a['created_at'] ?? 0);
        });

        usort($rawBerita, function ($a, $b) {
            $tglA = isset($a['tanggal']) ? strtotime($a['tanggal']) : ($a['created_at'] ?? 0);
            $tglB = isset($b['tanggal']) ? strtotime($b['tanggal']) : ($b['created_at'] ?? 0);
            return $tglB <=> $tglA;
        });

        usort($rawKegiatan, function ($a, $b) {
            $tglA = isset($a['tanggal']) ? strtotime($a['tanggal']) : 0;
            $tglB = isset($b['tanggal']) ? strtotime($b['tanggal']) : 0;
            return $tglB <=> $tglA;
        });

        // 3. Mapping Key Khusus agar Sesuai dengan Tag Blade Asli Milikmu
        $kegiatan = array_map(function($item) {
            // Template kamu nyari key 'img', mari kita oper dari file upload dashboard ('gambar')
            $item['img'] = $item['gambar'] ?? 'https://images.unsplash.com/photo-1511578314322-379afb476865';
            return $item;
        }, $rawKegiatan);

        $prokers = array_map(function($item) {
            $item['gambar'] = $item['gambar'] ?? ($item['thumbnail'] ?? null);
            return $item;
        }, $rawProkers);

        $mappedGaleri = array_map(function($item) {
            $item['image_url'] = $item['image_url'] ?? ($item['thumbnail'] ?? ($item['url'] ?? null));
            return $item;
        }, $rawGaleri);

        // 4. Potong Data ambil batas limit penampilan halaman depan
        $data = [
            'settings' => $settings,
            'prokers'  => array_values(array_slice($prokers, 0, 3)),
            'berita'   => array_values(array_slice($rawBerita, 0, 3)),
            'kegiatan' => array_values(array_slice($kegiatan, 0, 6)),
            'galeri'   => array_values(array_slice($mappedGaleri, 0, 6)),
            'stats'    => [
                'proker'  => count($rawProkers),
                'anggota' => count($anggota),
                'berita'  => count($rawBerita),
                'galeri'  => count($rawGaleri),
            ]
        ];

        return view('home_murni', $data);
    }
}