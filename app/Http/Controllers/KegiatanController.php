<?php

namespace App\Http\Controllers;

use App\Services\FirebaseService;
use Illuminate\Http\Request;

class KegiatanController extends Controller
{
    public function index()
    {
        $fb = app(FirebaseService::class);

        // 1. Ambil data murni menggunakan get() yang terbukti lancar
        $settings = $fb->get('settings');
        $rawKegiatan = $fb->get('kegiatan') ?? [];

        // 2. Map data agar format key status & key gambar sinkron 100% dengan Blade
        $kegiatan = array_map(function($item) {
            // SINKRONISASI KEY GAMBAR: Map key 'gambar' dari dashboard ke key 'img' bawaan blade kamu
            $item['img'] = $item['gambar'] ?? ($item['img'] ?? 'https://images.unsplash.com/photo-1511578314322-379afb476865?auto=format&fit=crop&w=600&q=80');
            
            // Otomatisasi status jika field status kosong di Firebase
            if (!isset($item['status']) || empty($item['status'])) {
                $item['status'] = $this->determineStatus($item['tanggal'] ?? null);
            }
            return $item;
        }, $rawKegiatan);

        // 3. Urutkan berdasarkan tanggal kegiatan terbaru di atas
        usort($kegiatan, function ($a, $b) {
            $tglA = isset($a['tanggal']) ? strtotime($a['tanggal']) : 0;
            $tglB = isset($b['tanggal']) ? strtotime($b['tanggal']) : 0;
            return $tglB <=> $tglA;
        });

        $data = [
            'settings'    => $settings,
            'allKegiatan' => array_values($kegiatan)
        ];

        return view('kegiatan_murni', $data);
    }

    private function determineStatus($tanggal)
    {
        if (!$tanggal) return 'rencana';
        
        $today = strtotime(date('Y-m-d'));
        $tglEvent = strtotime($tanggal);
        
        if ($tglEvent < $today) return 'selesai';
        if ($tglEvent == $today) return 'berjalan';
        return 'rencana';
    }
}