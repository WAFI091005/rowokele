<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Services\FirebaseService;
use Livewire\Attributes\Layout;

class Dashboard extends Component
{
    use WithFileUploads;

    public string $activeTab = 'settings';
    public array $state = [];
    public $newImage;
    public ?string $editKey = null;

    // Properti Penampung Data
    public array $settings = [];
    public array $prokers = [];
    public array $kegiatan = [];
    public array $anggota = [];
    public array $berita = [];
    public array $galeri = [];

    public function mount(FirebaseService $fb)
    {
        // === CEK STATUS LOGIN ===
        // Jika session 'is_logged_in' tidak ditemukan, lempar balik ke login tanpa 'navigate: true'
        if (!session()->has('is_logged_in') || session('is_logged_in') !== true) {
            return $this->redirectRoute('login');
        }

        // Jika lolos pengecekan, muat seluruh data dari Firebase
        $this->muatUlangSemuaData($fb);
    }

    public function muatUlangSemuaData(FirebaseService $fb)
    {
        $this->settings = $fb->settings() ?? [];
        $this->prokers  = $fb->all('prokers') ?? [];
        $this->kegiatan = $fb->all('kegiatan') ?? [];
        $this->anggota  = $fb->all('anggota') ?? [];
        $this->berita   = $fb->all('berita') ?? [];
        $this->galeri   = $fb->all('galeri') ?? [];

        if ($this->activeTab === 'settings' && empty($this->state)) {
            $this->state = $this->settings;
        }
    }

    public function switchTab($tab)
    {
        $this->activeTab = $tab;
        $this->state = [];
        $this->editKey = null;
        $this->newImage = null;

        $fb = app(FirebaseService::class);
        $this->muatUlangSemuaData($fb);
    }

    public function logout()
    {
        session()->forget('is_logged_in');
        session()->invalidate();
        session()->regenerateToken();

        return $this->redirectRoute('login');
    }

    #[Layout('layouts.app')]
    public function render()
    {
        return view('livewire.admin.dashboard');
    }
}