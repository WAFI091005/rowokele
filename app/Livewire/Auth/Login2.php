<?php

namespace App\Livewire\Auth;

use Livewire\Component;
use App\Services\FirebaseService;

class Login2 extends Component
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
            
            // Mengambil node 'admin' yang berupa list dari Firebase
            $adminList = $fb->all('admin') ?? [];

            // Mengambil data pertamanya
            $adminData = $adminList[0] ?? null;

            $firebaseUsername = $adminData['username'] ?? null;
            $firebasePassword = $adminData['password'] ?? null;

            // Lakukan pencocokan data dari input form dengan index 0 Firebase
            if ($this->username === $firebaseUsername && $this->password === $firebasePassword) {
                
                // Simpan session login admin
                session()->regenerate();
                session()->put('is_logged_in', true);
                session()->save();

                // Cara redirect standar Laravel & Livewire (Lebih aman untuk Session & Token)
                return $this->redirect('/admin/dashboard', navigate: false);
            }

            session()->flash('error', 'Username atau Password Admin Versi 2 Salah!');

        } catch (\Exception $e) {
            session()->flash('error', 'Gagal terhubung ke database: ' . $e->getMessage());
        }
    }

    /**
     * FUNGSI LOGOUT UNTUK MENGHANCURKAN SESSION SAMPAI AKARNYA
     */
    public function logout()
    {
        // Hancurkan session lama dan bersihkan token CSRF
        session()->invalidate();
        session()->regenerateToken();

        // Tendang balik ke halaman login
        return $this->redirect('/login2', navigate: false);
    }

    public function render()
    {
        return view('livewire.auth.login2');
    }
}