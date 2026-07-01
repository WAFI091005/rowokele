<div class="w-full bg-[#fdfbf7] min-h-screen text-stone-800">
    
    {{-- HERO SECTION --}}
    <section class="relative min-h-[380px] flex items-center overflow-hidden"
             style="background: linear-gradient(135deg, #78350f, #b45309);">
        
        <div class="absolute inset-0 opacity-10">
            <svg class="absolute inset-0 w-full h-full" xmlns="http://www.w3.org/2000/svg">
                <defs>
                    <pattern id="grid" width="40" height="40" patternUnits="userSpaceOnUse">
                        <path d="M 40 0 L 0 0 0 40" fill="none" stroke="white" stroke-width="0.5"/>
                    </pattern>
                </defs>
                <rect width="100%" height="100%" fill="url(#grid)" />
            </svg>
        </div>
        
        <div class="absolute top-0 right-0 w-96 h-96 bg-amber-400/20 rounded-full blur-3xl animate-blob"></div>
        <div class="absolute bottom-0 left-0 w-80 h-80 bg-orange-400/20 rounded-full blur-3xl animate-blob animation-delay-2000"></div>
        
        <div class="relative max-w-7xl mx-auto px-6 lg:px-12 py-16 w-full z-10">
            <div class="max-w-3xl">
                <div class="flex items-center gap-3 mb-4">
                    <span class="inline-block w-12 h-0.5 bg-amber-400"></span>
                    <span class="text-amber-300 text-xs font-semibold tracking-[0.2em] uppercase">Panel Manajemen Konten</span>
                </div>
                
                <h1 class="text-4xl md:text-5xl font-black text-white leading-tight mb-3">
                    Dashboard Admin
                    <span class="text-amber-300 block text-2xl md:text-3xl font-bold mt-1">Website KKN Desa Rowokele</span>
                </h1>
                
                <p class="text-amber-100/80 text-sm md:text-base max-w-xl leading-relaxed">
                    Kelola data informasi website, program kerja, agenda kegiatan, anggota tim, hingga galeri foto secara real-time.
                </p>
            </div>
        </div>
        
        <div class="absolute bottom-0 left-0 w-full leading-none overflow-hidden z-0">
            <svg class="block w-full h-[80px]" viewBox="0 0 1440 120" preserveAspectRatio="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M0,120 C180,70 360,10 720,40 C980,65 1180,90 1440,80 L1440,120 L0,120 Z" fill="#fdfbf7"/>
            </svg>
        </div>
    </section>

    {{-- KONTEN UTAMA DASHBOARD --}}
    <div class="max-w-7xl mx-auto px-6 lg:px-12 pb-24 -mt-4 relative z-10">
        
        @if(session()->has('success'))
            <div class="bg-emerald-50 text-emerald-700 px-6 py-4 rounded-2xl text-sm font-semibold border border-emerald-100 mb-8 flex items-center gap-3 shadow-sm">
                <i class="fas fa-check-circle text-lg text-emerald-600"></i>
                <div>{{ session('success') }}</div>
            </div>
        @endif

        <div class="grid lg:grid-cols-4 gap-8">
            
            {{-- Menu Navigasi Samping (Sidebar - Vanilla JS) --}}
            <div class="bg-white rounded-3xl shadow-sm border border-stone-100 p-4 h-fit space-y-1.5">
                @php
                    $menus = [
                        'settings' => ['icon' => 'fa-cogs', 'label' => 'Pengaturan Umum'],
                        'prokers'  => ['icon' => 'fa-tasks', 'label' => 'Program Kerja'],
                        'kegiatan' => ['icon' => 'fa-calendar-alt', 'label' => 'Agenda Kegiatan'],
                        'anggota'  => ['icon' => 'fa-users', 'label' => 'Anggota Tim'],
                        'berita'   => ['icon' => 'fa-newspaper', 'label' => 'Berita Desa'],
                        'galeri'   => ['icon' => 'fa-images', 'label' => 'Galeri Foto'],
                    ];
                @endphp

                @foreach($menus as $key => $menu)
                    <button type="button" 
                            id="btn-tab-{{ $key }}"
                            onclick="switchTabAdmin('{{ $key }}')"
                            class="sidebar-tab-btn w-full flex items-center gap-3 px-5 py-3.5 rounded-2xl text-sm font-bold transition-all cursor-pointer {{ $loop->first ? 'bg-amber-600 text-white shadow-md' : 'text-stone-600 hover:bg-stone-50' }}">
                        <i class="fas {{ $menu['icon'] }} w-5 text-center"></i>
                        <span>{{ $menu['label'] }}</span>
                    </button>
                @endforeach

                <hr class="border-stone-100 my-2">
                <button type="button" wire:click="logout" wire:confirm="Apakah Anda yakin ingin keluar dari Dashboard?"
                    class="w-full flex items-center gap-3 px-5 py-3.5 rounded-2xl text-sm font-bold transition-all text-rose-600 hover:bg-rose-50 cursor-pointer">
                    <i class="fas fa-sign-out-alt w-5 text-center"></i>
                    <span>Keluar Sistem</span>
                </button>
            </div>

            {{-- Area Form Input Konten & Tabel Data (Dicetak Semua, Diatur Show/Hide lewat CSS JS) --}}
            <div class="lg:col-span-3 space-y-8">
                
                {{-- 1. PANEL TAB: SETTINGS --}}
                <div id="panel-tab-settings" class="admin-panel-content bg-white rounded-3xl shadow-sm border border-stone-100 p-8">
                    <h2 class="text-xl font-bold text-stone-900 mb-6"><i class="fas fa-sliders-h text-amber-600 mr-2"></i>Pengaturan Utama Website</h2>
                    <form wire:submit.prevent="saveSettings" class="grid md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-xs font-bold text-stone-700 uppercase mb-2">Nama Desa</label>
                            <input type="text" wire:model="state.nama_desa" class="w-full rounded-xl border-stone-200 text-sm p-3 bg-stone-50">
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-stone-700 uppercase mb-2">Nama Kelompok</label>
                            <input type="text" wire:model="state.nama_kelompok" class="w-full rounded-xl border-stone-200 text-sm p-3 bg-stone-50">
                        </div>
                        <div class="md:col-span-2">
                            <label class="block text-xs font-bold text-stone-700 uppercase mb-2">Judul Besar Utama (Hero Text)</label>
                            <input type="text" wire:model="state.hero_text" class="w-full rounded-xl border-stone-200 text-sm p-3 bg-stone-50">
                        </div>
                        <div class="md:col-span-2">
                            <label class="block text-xs font-bold text-stone-700 uppercase mb-2">Deskripsi Singkat Kelompok KKN</label>
                            <textarea rows="3" wire:model="state.deskripsi" class="w-full rounded-xl border-stone-200 text-sm p-3 bg-stone-50"></textarea>
                        </div>
                        <div class="md:col-span-2 flex justify-end">
                            <button type="submit" class="px-6 py-3 bg-amber-600 text-white text-sm font-bold rounded-xl hover:bg-amber-700 transition cursor-pointer">
                                Simpan Pengaturan
                            </button>
                        </div>
                    </form>
                </div>

                {{-- LOOP UNTUK TAB MASTER CRUD LAINNYA --}}
                @foreach(['prokers', 'kegiatan', 'anggota', 'berita', 'galeri'] as $tabName)
                    <div id="panel-tab-{{ $tabName }}" class="admin-panel-content bg-white rounded-3xl shadow-sm border border-stone-100 p-8" style="display: none;">
                        <h2 class="text-xl font-bold text-stone-900 mb-6">
                            <i class="fas fa-plus-circle text-amber-600 mr-2"></i>
                            Kelola Data - {{ ucfirst($tabName === 'prokers' ? 'Program Kerja' : ($tabName === 'kegiatan' ? 'Agenda Kegiatan' : $tabName)) }}
                        </h2>

                        {{-- Tombol Pemicu Sinkronisasi Tab ke Backend agar Livewire tahu context CRUD-nya --}}
                        <div class="mb-4 text-right">
                            <button type="button" wire:click="switchTab('{{ $tabName }}')" class="text-xs bg-amber-50 text-amber-700 px-3 py-1.5 rounded-lg border border-amber-200 font-semibold cursor-pointer">
                                <i class="fas fa-sync mr-1"></i> Sinkronkan Form Livewire
                            </button>
                        </div>

                        {{-- Form Input (Akan otomatis menyesuaikan ketika form disinkronkan) --}}
                        <div class="space-y-6 bg-stone-50/50 p-6 rounded-2xl border border-stone-100 mb-8">
                            <p class="text-xs text-stone-400 font-medium"><i class="fas fa-info-circle"></i> Pastikan mengklik tombol sinkronisasi di atas sebelum menambah/mengubah data.</p>
                            
                            <div class="grid md:grid-cols-2 gap-6">
                                @if(in_array($tabName, ['prokers', 'kegiatan', 'anggota', 'berita']))
                                    <div class="md:col-span-2">
                                        <label class="block text-xs font-bold text-stone-700 uppercase mb-2">
                                            {{ $tabName === 'anggota' ? 'Nama Lengkap Mahasiswa' : 'Judul/Nama Konten' }}
                                        </label>
                                        <input type="text" wire:model="state.judul" class="w-full rounded-xl border-stone-200 text-sm p-3 bg-white shadow-sm">
                                    </div>
                                @endif

                                @if($tabName === 'anggota')
                                    <div>
                                        <label class="block text-xs font-bold text-stone-700 uppercase mb-2">NIM</label>
                                        <input type="text" wire:model="state.nim" class="w-full rounded-xl border-stone-200 text-sm p-3 bg-white shadow-sm">
                                    </div>
                                    <div>
                                        <label class="block text-xs font-bold text-stone-700 uppercase mb-2">Jabatan</label>
                                        <input type="text" wire:model="state.jabatan" class="w-full rounded-xl border-stone-200 text-sm p-3 bg-white shadow-sm" placeholder="Ketua / Sekretaris">
                                    </div>
                                    <div>
                                        <label class="block text-xs font-bold text-stone-700 uppercase mb-2">Jurusan</label>
                                        <input type="text" wire:model="state.jurusan" class="w-full rounded-xl border-stone-200 text-sm p-3 bg-white shadow-sm" placeholder="Informatika">
                                    </div>
                                @endif

                                @if(in_array($tabName, ['prokers', 'kegiatan', 'berita']))
                                    <div>
                                        <label class="block text-xs font-bold text-stone-700 uppercase mb-2">Tanggal</label>
                                        <input type="date" wire:model="state.tanggal" class="w-full rounded-xl border-stone-200 text-sm p-3 bg-white shadow-sm">
                                    </div>
                                @endif

                                @if(in_array($tabName, ['prokers', 'kegiatan']))
                                    <div>
                                        <label class="block text-xs font-bold text-stone-700 uppercase mb-2">Status Progress</label>
                                        <select wire:model="state.status" class="w-full rounded-xl border-stone-200 text-sm p-3 bg-white shadow-sm">
                                            <option value="rencana">Rencana</option>
                                            <option value="berjalan">Berjalan</option>
                                            <option value="selesai">Selesai</option>
                                        </select>
                                    </div>
                                @endif

                                @if($tabName === 'galeri')
                                    <div class="md:col-span-2">
                                        <label class="block text-xs font-bold text-stone-700 uppercase mb-2">Caption / Keterangan Foto</label>
                                        <input type="text" wire:model="state.caption" class="w-full rounded-xl border-stone-200 text-sm p-3 bg-white shadow-sm" placeholder="Tulis deskripsi foto...">
                                    </div>
                                @endif

                                @if(in_array($tabName, ['prokers', 'kegiatan', 'berita']))
                                    <div class="md:col-span-2">
                                        <label class="block text-xs font-bold text-stone-700 uppercase mb-2">Isi Deskripsi / Detail Cerita</label>
                                        <textarea rows="4" wire:model="state.deskripsi" class="w-full rounded-xl border-stone-200 text-sm p-3 bg-white shadow-sm"></textarea>
                                    </div>
                                @endif

                                <div class="md:col-span-2 bg-white p-4 rounded-2xl border border-dashed border-stone-200 space-y-4">
                                    <label class="block text-xs font-bold text-stone-700 uppercase">Upload Gambar</label>
                                    <input type="file" wire:model="newImage" class="text-sm text-stone-500">
                                    <div wire:loading wire:target="newImage" class="text-xs text-amber-600 mt-2"><i class="fas fa-spinner fa-spin mr-1"></i>Sedang memproses file...</div>
                                </div>
                            </div>

                            <div class="flex justify-end gap-2 pt-4">
                                <button type="button" wire:click="saveData" class="px-6 py-2.5 bg-amber-600 text-white text-sm font-bold rounded-xl hover:bg-amber-700 shadow-md cursor-pointer">
                                    Simpan ke Firebase
                                </button>
                            </div>
                        </div>

                        {{-- TABEL DATA LOG UTK SETIAP TAB --}}
                        <div class="bg-white rounded-2xl border border-stone-100 overflow-hidden shadow-sm">
                            <div class="px-6 py-3 bg-stone-50 border-b border-stone-100">
                                <h3 class="font-bold text-stone-800 text-xs uppercase tracking-wider">Riwayat Data</h3>
                            </div>
                            <div class="overflow-x-auto">
                                <table class="w-full text-left border-collapse">
                                    <thead>
                                        <tr class="border-b border-stone-100 text-xs font-bold text-stone-400 bg-stone-50/50 uppercase">
                                            <th class="p-4 pl-6">Nama Konten</th>
                                            <th class="p-4">Info Utama</th>
                                            <th class="p-4 pr-6 text-right">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody class="divide-y divide-stone-100 text-sm text-stone-700">
                                        @php 
                                            // Mengambil array secara dinamis langsung dari properti komponen
                                            $itemsLog = $this->{$tabName} ?? []; 
                                        @endphp
                                        @forelse($itemsLog as $item)
                                            @php $itemId = $item['id'] ?? $loop->index; @endphp
                                            <tr class="hover:bg-stone-50/30 transition">
                                                <td class="p-4 pl-6 font-semibold text-stone-900">
                                                    {{ $item['judul'] ?? ($item['caption'] ?? ($item['nama'] ?? 'Tanpa Judul')) }}
                                                </td>
                                                <td class="p-4 text-xs">
                                                    @if(isset($item['status']))
                                                        <span class="px-2 py-0.5 rounded bg-amber-100 text-amber-800 font-bold uppercase text-[10px]">{{ $item['status'] }}</span>
                                                    @endif
                                                    @if(isset($item['tanggal']))
                                                        <span class="text-stone-400 ml-2"><i class="far fa-calendar-alt"></i> {{ $item['tanggal'] }}</span>
                                                    @endif
                                                </td>
                                                <td class="p-4 pr-6 text-right">
                                                    <div class="inline-flex gap-2">
                                                        <button type="button" wire:click="startEdit('{{ $itemId }}')" onclick="window.scrollTo({top: 400, behavior: 'smooth'})" class="text-amber-600 p-2 hover:bg-amber-50 rounded-lg cursor-pointer">
                                                            <i class="fas fa-edit"></i>
                                                        </button>
                                                        <button type="button" wire:click="deleteData('{{ $tabName }}', '{{ $itemId }}')" wire:confirm="Hapus data secara permanen dari Firebase?" class="text-rose-600 p-2 hover:bg-rose-50 rounded-lg cursor-pointer">
                                                            <i class="fas fa-trash-alt"></i>
                                                        </button>
                                                    </div>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="3" class="p-8 text-center text-stone-400">
                                                    <i class="fas fa-box-open block text-xl mb-1 text-stone-300"></i> Belum ada data di Firebase.
                                                </td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                @endforeach

            </div>
        </div>

    </div>

    {{-- INTERACTION SIDEBAR NAVIGATION ENGINE (VANILLA JS) --}}
    <script>
        function switchTabAdmin(targetTabKey) {
            // 1. Dapatkan semua panel konten dan tombol sidebar
            const semuaPanel = document.querySelectorAll('.admin-panel-content');
            const semuaTombolTab = document.querySelectorAll('.sidebar-tab-btn');

            // 2. Sembunyikan semua panel tab kontainer
            semuaPanel.forEach(panel => {
                panel.style.display = 'none';
            });

            // 3. Tampilkan hanya panel tab yang diklik
            const panelTarget = document.getElementById('panel-tab-' + statusKunci || 'panel-tab-' + targetTab);
            if(document.getElementById('panel-tab-' + targetTab)) {
                document.getElementById('panel-tab-' + targetbox || 'panel-tab-' + targetTab).style.display = 'block';
            }

            // 4. Kelola status visual class tombol sidebar aktif
            semuaTombol.forEach(tombol => {
                if (tombol.id === 'btn-tab-' + targetTab) {
                    tombol.className = "sidebar-tab-btn w-full flex items-center gap-3 px-5 py-3.5 rounded-2xl text-sm font-bold transition-all cursor-pointer bg-amber-600 text-white shadow-md";
                } else {
                    tombol.className = "sidebar-tab-btn w-full flex items-center gap-3 px-5 py-3.5 rounded-2xl text-sm font-bold transition-all cursor-pointer text-stone-600 hover:bg-stone-50";
                }
            });
        }

        // Jalankan fungsi alias fallback agar parameter terbaca fleksibel saat dipanggil onclick
        function switchTabAdmin(key) {
            const panels = document.querySelectorAll('.admin-panel-content');
            const buttons = document.querySelectorAll('.sidebar-tab-btn');
            
            panels.forEach(p => p.style.display = 'none');
            const target = document.getElementById('panel-tab-' + key);
            if(target) target.style.display = 'block';

            semuaTombol = document.querySelectorAll('.sidebar-tab-btn');
            semuaTombol.forEach(btn => {
                if(btn.id === 'btn-tab-' + key) {
                    btn.className = "sidebar-tab-btn w-full flex items-center gap-3 px-5 py-3.5 rounded-2xl text-sm font-bold transition-all cursor-pointer bg-amber-600 text-white shadow-md";
                } else {
                    btn.className = "sidebar-tab-btn w-full flex items-center gap-3 px-5 py-3.5 rounded-2xl text-sm font-bold transition-all cursor-pointer text-stone-600 hover:bg-stone-50";
                }
            });
        }
    </script>
</div>