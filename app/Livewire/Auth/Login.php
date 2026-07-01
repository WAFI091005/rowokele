<?php

namespace App\Livewire\Auth;

use Livewire\Component;
use App\Services\FirebaseService;

class Login extends Component
{
    public $username;
    public $password;

    public function login()
    {
        $this->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        try {
            $fb = app(FirebaseService::class);
            
            // Menggunakan method get() baru untuk mengambil node object tunggal 'admin'
            $adminAuth = $fb->get('admin');

            $firebaseUsername = $adminAuth['username'] ?? null;
            $firebasePassword = $adminAuth['password'] ?? null;

            // Memastikan kecocokan data (Sudah diperbaiki dari $adminPassword ke $firebasePassword)
            if ($this->username === $firebaseUsername && $this->password === $firebasePassword) {
                
                // Regenerasi session dan simpan status login ke file storage lokal
                session()->regenerate();
                session()->put('is_logged_in', true);
                session()->save(); // Paksa Laravel menulis file session ke disk saat ini juga

                // NATIVE REDIRECT: Jalan pintas mutlak untuk memutus intervensi SPA/wire:navigate
                header("Location: /admin/dashboard");
                exit();
            }

            session()->flash('error', 'Username atau Password Admin Salah!');

        } catch (\Exception $e) {
            session()->flash('error', 'Gagal terhubung ke database: ' . $e->getMessage());
        }
    }

    public function render()
    {
        return view('livewire.auth.login')->layout('layouts.app');
    }
}