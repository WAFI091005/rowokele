<?php

namespace App\Http\Controllers;

use App\Services\FirebaseService;
use Illuminate\Http\Request;

class ProkerController extends Controller
{
    public function index()
    {
        $fb = app(FirebaseService::class);

        // 1. Tarik data murni menggunakan get() yang terbukti sakti
        $settings = $fb->get('settings');
        $rawProkers = $fb->get('prokers') ?? [];

        // 2. Map data agar format key gambar & statusnya aman dibaca template Blade
        $prokers = array_map(function($item) {
            $item['gambar'] = $item['gambar'] ?? ($item['thumbnail'] ?? null);
            
            // Otomatisasi status jika field status kosong di Firebase
            if (!isset($item['status']) || empty($item['status'])) {
                $item['status'] = $this->determineStatus($item['tanggal'] ?? null);
            }
            return $item;
        }, $rawProkers);

        // 3. Urutkan proker berdasarkan tanggal pelaksanaan terbaru di atas
        usort($prokers, function ($a, $b) {
            $tglA = isset($a['tanggal']) ? strtotime($a['tanggal']) : 0;
            $tglB = isset($b['tanggal']) ? strtotime($b['tanggal']) : 0;
            return $tglB <=> $tglA;
        });

        $data = [
            'settings' => $settings,
            'prokers'  => array_values($prokers)
        ];

        return view('proker_murni', $data);
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