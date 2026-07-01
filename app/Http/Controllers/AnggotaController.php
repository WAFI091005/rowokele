<?php

namespace App\Http\Controllers;

use App\Services\FirebaseService;
use Illuminate\Http\Request;

class AnggotaController extends Controller
{
    public function index()
    {
        $fb = app(FirebaseService::class);

        // 1. Ambil data murni umum dan koleksi anggota
        $settings = $fb->get('settings');
        $rawData = $fb->get('anggota') ?? [];
        $processedAnggota = [];

        // 2. Loop langsung membaca data di bawah push-id Firebase (-Ow4J...)
        foreach ($rawData as $key => $item) {
            
            // Validasi: Cukup pastikan field 'nama' ada di node tersebut
            if (is_array($item) && isset($item['nama'])) {
                $processedAnggota[] = [
                    'id'      => $item['id'] ?? $key, 
                    'nama'    => $item['nama'],
                    'jabatan' => $item['jabatan'] ?? 'Anggota',
                    'jurusan' => $item['jurusan'] ?? '-',
                    'nim'     => $item['nim'] ?? '-',
                    
                    // Dashboard admin kamu menyimpan dengan key 'foto'
                    'foto'    => $item['foto'] ?? null,
                ];
            }
        }

        $data = [
            'settings' => $settings,
            'anggota'  => array_values($processedAnggota) // Format murni array [{}, {}] untuk dikirim ke props React
        ];

        return view('anggota_murni', $data);
    }
}