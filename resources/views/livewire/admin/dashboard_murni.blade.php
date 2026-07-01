<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin - KKN Desa Rowokele</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <style>[x-cloak] { display: none !important; }</style>
</head>
<body class="bg-stone-50 text-stone-800 antialiased flex min-h-screen">

    <!-- SIDEBAR -->
    <div class="w-64 bg-amber-900 text-white flex flex-col p-6 min-h-screen shadow-xl fixed">
        <div class="flex items-center gap-3 mb-8 pb-4 border-b border-amber-800">
            <span class="inline-flex items-center justify-center w-10 h-10 rounded-xl bg-white/10">
                <i class="fas fa-user-shield text-amber-300 text-lg"></i>
            </span>
            <div>
                <h2 class="text-base font-black tracking-wide">Admin Panel</h2>
                <p class="text-xs text-amber-300/70">KKN Kelompok 112</p>
            </div>
        </div>
        
        <nav class="space-y-1.5 flex-1 overflow-y-auto">
            <a href="/admin/dashboard?tab=settings" class="flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-bold transition {{ $activeTab === 'settings' ? 'bg-amber-700 text-white shadow-md' : 'text-amber-100/80 hover:bg-amber-800/60' }}">
                <i class="fas fa-cog w-5"></i> Pengaturan Umum
            </a>
            <a href="/admin/dashboard?tab=prokers" class="flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-bold transition {{ $activeTab === 'prokers' ? 'bg-amber-700 text-white shadow-md' : 'text-amber-100/80 hover:bg-amber-800/60' }}">
                <i class="fas fa-tasks w-5"></i> Program Kerja
            </a>
            <a href="/admin/dashboard?tab=kegiatan" class="flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-bold transition {{ $activeTab === 'kegiatan' ? 'bg-amber-700 text-white shadow-md' : 'text-amber-100/80 hover:bg-amber-800/60' }}">
                <i class="fas fa-calendar-alt w-5"></i> Kegiatan Desa
            </a>
            <a href="/admin/dashboard?tab=anggota" class="flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-bold transition {{ $activeTab === 'anggota' ? 'bg-amber-700 text-white shadow-md' : 'text-amber-100/80 hover:bg-amber-800/60' }}">
                <i class="fas fa-users w-5"></i> Anggota Tim
            </a>
            <a href="/admin/dashboard?tab=berita" class="flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-bold transition {{ $activeTab === 'berita' ? 'bg-amber-700 text-white shadow-md' : 'text-amber-100/80 hover:bg-amber-800/60' }}">
                <i class="fas fa-newspaper w-5"></i> Berita Desa
            </a>
            <a href="/admin/dashboard?tab=galeri" class="flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-bold transition {{ $activeTab === 'galeri' ? 'bg-amber-700 text-white shadow-md' : 'text-amber-100/80 hover:bg-amber-800/60' }}">
                <i class="fas fa-images w-5"></i> Galeri Foto
            </a>
        </nav>

        <a href="/login2" class="flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-bold text-rose-200 hover:bg-rose-950/40 mt-auto border-t border-amber-800/50 pt-4">
            <i class="fas fa-sign-out-alt w-5"></i> Keluar Sistem
        </a>
    </div>

    <!-- MAIN CONTENT AREA -->
    <div class="flex-1 pl-64 p-10 min-h-screen">
        
        <!-- ================= TAB: SETTINGS ================= -->
        @if($activeTab === 'settings')
            <div class="bg-white p-8 rounded-3xl shadow-sm border border-stone-100 max-w-4xl">
                <h3 class="text-xl font-black text-stone-900 mb-1">Pengaturan Website KKN</h3>
                <p class="text-sm text-stone-500 mb-6">Kelola deskripsi, alamat, dan profil utama desa.</p>
                
                <form id="form-settings" class="space-y-5">
                    <div class="grid md:grid-cols-2 gap-5">
                        <div>
                            <label class="block text-xs font-bold uppercase text-stone-500 mb-2">Nama Kelompok</label>
                            <input type="text" name="nama_kelompok" value="{{ $settings['nama_kelompok'] ?? '' }}" class="w-full border border-stone-200 rounded-xl p-3 bg-stone-50 text-sm focus:border-amber-500 focus:ring-1 focus:ring-amber-500 outline-none">
                        </div>
                        <div>
                            <label class="block text-xs font-bold uppercase text-stone-500 mb-2">Nama Desa</label>
                            <input type="text" name="nama_desa" value="{{ $settings['nama_desa'] ?? '' }}" class="w-full border border-stone-200 rounded-xl p-3 bg-stone-50 text-sm focus:border-amber-500 focus:ring-1 focus:ring-amber-500 outline-none">
                        </div>
                    </div>
                    <div>
                        <label class="block text-xs font-bold uppercase text-stone-500 mb-2">Deskripsi KKN / Tema</label>
                        <textarea name="deskripsi" rows="3" class="w-full border border-stone-200 rounded-xl p-3 bg-stone-50 text-sm focus:border-amber-500 focus:ring-1 focus:ring-amber-500 outline-none">{{ $settings['deskripsi'] ?? '' }}</textarea>
                    </div>
                    <div class="grid md:grid-cols-2 gap-5">
                        <div>
                            <label class="block text-xs font-bold uppercase text-stone-500 mb-2">WhatsApp</label>
                            <input type="text" name="whatsapp" value="{{ $settings['whatsapp'] ?? '' }}" class="w-full border border-stone-200 rounded-xl p-3 bg-stone-50 text-sm">
                        </div>
                        <div>
                            <label class="block text-xs font-bold uppercase text-stone-500 mb-2">Instagram</label>
                            <input type="text" name="instagram" value="{{ $settings['instagram'] ?? '' }}" class="w-full border border-stone-200 rounded-xl p-3 bg-stone-50 text-sm">
                        </div>
                    </div>
                    <div class="pt-4">
                        <button type="button" onclick="eksekusiSimpanSettings()" class="px-6 py-3 bg-amber-600 hover:bg-amber-700 text-white text-sm font-bold rounded-xl shadow-md transition">Simpan Perubahan</button>
                    </div>
                </form>
            </div>
        @endif

        <!-- ================= TAB: PROKERS ================= -->
        @if($activeTab === 'prokers')
            <div class="bg-white p-8 rounded-3xl shadow-sm border border-stone-100">
                <div class="flex justify-between items-center mb-6">
                    <div>
                        <h3 class="text-xl font-black text-stone-900">Program Kerja KKN</h3>
                        <p class="text-sm text-stone-500">Daftar proker beserta foto pelaksanaannya.</p>
                    </div>
                    <button onclick="bukaModalTambah('prokers')" class="px-5 py-2.5 bg-amber-600 text-white text-xs font-bold rounded-xl shadow hover:bg-amber-700 transition">
                        <i class="fas fa-plus mr-1"></i> Tambah Proker
                    </button>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="border-b border-stone-100 text-xs font-bold uppercase text-stone-400">
                                <th class="py-3 px-4">Gambar</th>
                                <th class="py-3 px-4">Judul Proker</th>
                                <th class="py-3 px-4">Tanggal</th>
                                <th class="py-3 px-4">Status</th>
                                <th class="py-3 px-4 text-right">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-stone-50 text-sm">
                            @forelse($prokers as $id => $proker)
                                <tr class="hover:bg-stone-50/50 transition">
                                    <td class="py-3 px-4">
                                        <img src="{{ $proker['gambar'] ?? 'https://via.placeholder.com/150' }}" class="w-12 h-12 object-cover rounded-xl border">
                                    </td>
                                    <td class="py-4 px-4 font-bold text-stone-800">{{ $proker['judul'] ?? 'Tanpa Judul' }}</td>
                                    <td class="py-4 px-4 text-stone-500">{{ $proker['tanggal'] ?? '-' }}</td>
                                    <td class="py-4 px-4">
                                        <span class="px-2.5 py-1 text-xs font-bold rounded-full {{ ($proker['status'] ?? '') === 'selesai' ? 'bg-green-50 text-green-700 border border-green-100' : 'bg-amber-50 text-amber-700 border border-amber-100' }}">
                                            {{ $proker['status'] ?? 'berjalan' }}
                                        </span>
                                    </td>
                                    <td class="py-4 px-4 text-right space-x-3">
                                        <button onclick="bukaModalEdit('prokers', '{{ $proker['id'] ?? $id }}', {{ json_encode($proker) }})" class="text-amber-600 hover:text-amber-700 font-bold text-xs"><i class="fas fa-edit"></i> Edit</button>
                                        <button onclick="eksekusiHapusData('prokers', '{{ $proker['id'] ?? $id }}')" class="text-rose-600 hover:text-rose-700 font-bold text-xs"><i class="fas fa-trash mr-0.5"></i> Hapus</button>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="py-8 text-center text-stone-400 text-sm">Belum ada data program kerja di Firebase.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        @endif

        <!-- ================= TAB: KEGIATAN ================= -->
        @if($activeTab === 'kegiatan')
            <div class="bg-white p-8 rounded-3xl shadow-sm border border-stone-100">
                <div class="flex justify-between items-center mb-6">
                    <div>
                        <h3 class="text-xl font-black text-stone-900">Kegiatan Kelompok KKN</h3>
                        <p class="text-sm text-stone-500">Manajemen dokumentasi rilis kegiatan kelompok harian.</p>
                    </div>
                    <button onclick="bukaModalTambah('kegiatan')" class="px-5 py-2.5 bg-amber-600 text-white text-xs font-bold rounded-xl shadow hover:bg-amber-700 transition">
                        <i class="fas fa-plus mr-1"></i> Tambah Kegiatan
                    </button>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="border-b border-stone-100 text-xs font-bold uppercase text-stone-400">
                                <th class="py-3 px-4">Gambar</th>
                                <th class="py-3 px-4">Judul Kegiatan</th>
                                <th class="py-3 px-4">Tanggal</th>
                                <th class="py-3 px-4">Deskripsi</th>
                                <th class="py-3 px-4 text-right">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-stone-50 text-sm">
                            @forelse($kegiatan as $id => $item)
                                <tr class="hover:bg-stone-50/50 transition">
                                    <td class="py-3 px-4">
                                        <img src="{{ $item['gambar'] ?? 'https://via.placeholder.com/150' }}" class="w-12 h-12 object-cover rounded-xl border">
                                    </td>
                                    <td class="py-4 px-4 font-bold text-stone-800">{{ $item['title'] ?? $item['judul'] ?? 'Tanpa Judul' }}</td>
                                    <td class="py-4 px-4 text-stone-500">{{ $item['tanggal'] ?? '-' }}</td>
                                    <td class="py-4 px-4 text-stone-500 max-w-xs truncate">{{ $item['deskripsi'] ?? '-' }}</td>
                                    <td class="py-4 px-4 text-right space-x-3">
                                        <button onclick="bukaModalEdit('kegiatan', '{{ $item['id'] ?? $id }}', {{ json_encode($item) }})" class="text-amber-600 hover:text-amber-700 font-bold text-xs"><i class="fas fa-edit"></i> Edit</button>
                                        <button onclick="eksekusiHapusData('kegiatan', '{{ $item['id'] ?? $id }}')" class="text-rose-600 hover:text-rose-700 font-bold text-xs"><i class="fas fa-trash"></i> Hapus</button>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="py-8 text-center text-stone-400 text-sm">Belum ada data kegiatan di Firebase.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        @endif

        <!-- ================= TAB: ANGGOTA ================= -->
        @if($activeTab === 'anggota')
            <div class="bg-white p-8 rounded-3xl shadow-sm border border-stone-100">
                <div class="flex justify-between items-center mb-6">
                    <div>
                        <h3 class="text-xl font-black text-stone-900">Anggota Tim KKN</h3>
                        <p class="text-sm text-stone-500">Kelola informasi foto profil mahasiswa kelompok 112.</p>
                    </div>
                    <button onclick="bukaModalTambah('anggota')" class="px-5 py-2.5 bg-amber-600 text-white text-xs font-bold rounded-xl shadow hover:bg-amber-700 transition">
                        <i class="fas fa-plus mr-1"></i> Tambah Anggota
                    </button>
                </div>

                <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @forelse($anggota as $id => $mhs)
                        <div class="border border-stone-100 rounded-2xl p-5 bg-stone-50/50 flex gap-4 items-center relative group">
                            <div class="w-14 h-14 rounded-full bg-stone-200 overflow-hidden shadow-inner flex-shrink-0 border">
                                <img src="{{ $mhs['foto'] ?? 'https://via.placeholder.com/150' }}" alt="Foto" class="w-full h-full object-cover">
                            </div>
                            <div>
                                <h4 class="font-bold text-stone-900 text-sm">{{ $mhs['nama'] ?? 'Tanpa Nama' }}</h4>
                                <p class="text-xs text-stone-500">{{ $mhs['jabatan'] ?? 'Anggota' }}</p>
                                <p class="text-[11px] text-amber-700 font-semibold mt-0.5">{{ $mhs['nim'] ?? '-' }} &middot; {{ $mhs['jurusan'] ?? '-' }}</p>
                            </div>
                            <div class="absolute top-3 right-3 space-x-1.5 opacity-0 group-hover:opacity-100 transition-opacity">
                                <button onclick="bukaModalEdit('anggota', '{{ $mhs['id'] ?? $id }}', {{ json_encode($mhs) }})" class="text-amber-600 hover:text-amber-700 bg-white p-1.5 rounded-lg border border-stone-100 shadow-sm text-xs"><i class="fas fa-edit"></i></button>
                                <button onclick="eksekusiHapusData('anggota', '{{ $mhs['id'] ?? $id }}')" class="text-rose-600 hover:text-rose-700 bg-white p-1.5 rounded-lg border border-stone-100 shadow-sm text-xs"><i class="fas fa-trash"></i></button>
                            </div>
                        </div>
                    @empty
                        <p class="text-stone-400 text-sm col-span-full py-4 text-center">Belum ada data anggota tim di Firebase.</p>
                    @endforelse
                </div>
            </div>
        @endif

        <!-- ================= TAB: BERITA ================= -->
        @if($activeTab === 'berita')
            <div class="bg-white p-8 rounded-3xl shadow-sm border border-stone-100">
                <div class="flex justify-between items-center mb-6">
                    <div>
                        <h3 class="text-xl font-black text-stone-900">Artikel & Berita Desa</h3>
                        <p class="text-sm text-stone-500">Rilis berita seputar pengabdian KKN di Desa Rowokele.</p>
                    </div>
                    <button onclick="bukaModalTambah('berita')" class="px-5 py-2.5 bg-amber-600 text-white text-xs font-bold rounded-xl shadow hover:bg-amber-700 transition">
                        <i class="fas fa-plus mr-1"></i> Buat Artikel
                    </button>
                </div>

                <div class="space-y-4">
                    @forelse($berita as $id => $post)
                        <div class="border border-stone-100 rounded-2xl p-5 bg-white shadow-sm flex gap-5 items-center justify-between hover:border-amber-200 transition">
                            <div class="flex gap-4 items-center">
                                <div class="w-16 h-16 rounded-xl bg-stone-100 overflow-hidden flex-shrink-0 border">
                                    <img src="{{ $post['thumbnail'] ?? 'https://via.placeholder.com/150' }}" class="w-full h-full object-cover">
                                </div>
                                <div>
                                    <h4 class="font-bold text-stone-900 text-sm line-clamp-1">{{ $post['judul'] ?? 'Tanpa Judul' }}</h4>
                                    <p class="text-xs text-stone-400 mt-1"><i class="fas fa-calendar-day mr-1"></i>{{ $post['tanggal'] ?? '-' }}</p>
                                    <p class="text-xs text-stone-500 mt-1 line-clamp-1">{{ $post['isi'] ?? '' }}</p>
                                </div>
                            </div>
                            <div class="flex gap-2">
                                <button onclick="bukaModalEdit('berita', '{{ $post['id'] ?? $id }}', {{ json_encode($post) }})" class="px-3 py-1.5 bg-stone-100 hover:bg-stone-200 rounded-lg text-xs font-bold text-stone-700"><i class="fas fa-edit mr-1"></i>Edit</button>
                                <button onclick="eksekusiHapusData('berita', '{{ $post['id'] ?? $id }}')" class="px-3 py-1.5 bg-rose-50 hover:bg-rose-100 rounded-lg text-xs font-bold text-rose-700"><i class="fas fa-trash mr-1"></i>Hapus</button>
                            </div>
                        </div>
                    @empty
                        <p class="text-stone-400 text-sm py-4 text-center">Belum ada rilis berita di Firebase.</p>
                    @endforelse
                </div>
            </div>
        @endif

        <!-- ================= TAB: GALERI ================= -->
        @if($activeTab === 'galeri')
            <div class="bg-white p-8 rounded-3xl shadow-sm border border-stone-100">
                <div class="flex justify-between items-center mb-6">
                    <div>
                        <h3 class="text-xl font-black text-stone-900">Galeri Foto Kegiatan</h3>
                        <p class="text-sm text-stone-500">Dokumentasi visual pengabdian masyarakat kelompok 112.</p>
                    </div>
                    <button onclick="bukaModalTambah('galeri')" class="px-5 py-2.5 bg-amber-600 text-white text-xs font-bold rounded-xl shadow hover:bg-amber-700 transition">
                        <i class="fas fa-upload mr-1"></i> Upload Foto
                    </button>
                </div>

                <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
                    @forelse($galeri as $id => $foto)
                        <div class="group relative rounded-2xl overflow-hidden aspect-square border bg-stone-100 shadow-inner">
                            <img src="{{ $foto['image_url'] ?? 'https://via.placeholder.com/300' }}" class="w-full h-full object-cover transition duration-500 group-hover:scale-105">
                            <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity p-4 flex flex-col justify-end">
                                <p class="text-xs text-white font-medium line-clamp-2 mb-2">{{ $foto['caption'] ?? 'Dokumentasi' }}</p>
                                <div class="flex gap-2">
                                    <button onclick="bukaModalEdit('galeri', '{{ $foto['id'] ?? $id }}', {{ json_encode($foto) }})" class="flex-1 py-1.5 bg-amber-600 hover:bg-amber-700 text-white text-[11px] font-bold rounded-lg"><i class="fas fa-edit mr-1"></i>Edit</button>
                                    <button onclick="eksekusiHapusData('galeri', '{{ $foto['id'] ?? $id }}')" class="py-1.5 px-2 bg-rose-600 hover:bg-rose-700 text-white text-[11px] font-bold rounded-lg"><i class="fas fa-trash"></i></button>
                                </div>
                            </div>
                        </div>
                    @empty
                        <p class="text-stone-400 text-sm col-span-full py-4 text-center">Belum ada dokumentasi foto di Firebase.</p>
                    @endforelse
                </div>
            </div>
        @endif

    </div>

    <!-- ========================================================
         MODAL MASTER: BERLAKU UNTUK UPLOAD GAMBAR DI SEMUA TAB
         ======================================================== -->
    <div id="modal-crud" class="fixed inset-0 z-[999] items-center justify-center bg-black/50 hidden p-4">
        <div class="bg-white rounded-3xl p-8 max-w-md w-full shadow-2xl relative border border-stone-100">
            <h3 id="modal-title" class="text-lg font-black text-stone-900 mb-1">Tambah Data</h3>
            <p id="modal-desc" class="text-xs text-stone-500 mb-6">Lengkapi data berkas berikut untuk disinkronisasi ke Firebase.</p>
            
            <form id="form-crud" enctype="multipart/form-data" class="space-y-4">
                <input type="hidden" name="node" id="hidden-node">
                <input type="hidden" name="id" id="hidden-id">

                <!-- FIELD: JUDUL -->
                <div class="field-group" id="group-judul">
                    <label class="block text-xs font-bold text-stone-600 uppercase mb-2">Judul / Title</label>
                    <input type="text" name="judul" id="input-judul" class="w-full border rounded-xl p-3 bg-stone-50 text-sm outline-none focus:border-amber-500">
                </div>
                <!-- FIELD: TANGGAL -->
                <div class="field-group" id="group-tanggal">
                    <label class="block text-xs font-bold text-stone-600 uppercase mb-2">Tanggal</label>
                    <input type="date" name="tanggal" id="input-tanggal" class="w-full border rounded-xl p-3 bg-stone-50 text-sm outline-none focus:border-amber-500">
                </div>
                <!-- FIELD: STATUS PROKER -->
                <div class="field-group" id="group-status">
                    <label class="block text-xs font-bold text-stone-600 uppercase mb-2">Status</label>
                    <select name="status" id="input-status" class="w-full border rounded-xl p-3 bg-stone-50 text-sm outline-none">
                        <option value="berjalan">Berjalan</option>
                        <option value="selesai">Selesai</option>
                    </select>
                </div>
                <!-- FIELD: DESKRIPSI -->
                <div class="field-group" id="group-deskripsi">
                    <label id="label-deskripsi" class="block text-xs font-bold text-stone-600 uppercase mb-2">Deskripsi / Isi Konten</label>
                    <textarea name="deskripsi" id="input-deskripsi" rows="3" class="w-full border rounded-xl p-3 bg-stone-50 text-sm outline-none focus:border-amber-500"></textarea>
                </div>

                <!-- FIELD: MAHASISWA -->
                <div class="field-group" id="group-nama">
                    <label class="block text-xs font-bold text-stone-600 uppercase mb-2">Nama Lengkap</label>
                    <input type="text" name="nama" id="input-nama" class="w-full border rounded-xl p-3 bg-stone-50 text-sm outline-none">
                </div>
                <div class="field-group" id="group-jabatan">
                    <label class="block text-xs font-bold text-stone-600 uppercase mb-2">Jabatan</label>
                    <input type="text" name="jabatan" id="input-jabatan" class="w-full border rounded-xl p-3 bg-stone-50 text-sm outline-none">
                </div>
                <div class="field-group" id="group-nim">
                    <label class="block text-xs font-bold text-stone-600 uppercase mb-2">NIM</label>
                    <input type="text" name="nim" id="input-nim" class="w-full border rounded-xl p-3 bg-stone-50 text-sm outline-none">
                </div>
                <div class="field-group" id="group-jurusan">
                    <label class="block text-xs font-bold text-stone-600 uppercase mb-2">Jurusan</label>
                    <input type="text" name="jurusan" id="input-jurusan" class="w-full border rounded-xl p-3 bg-stone-50 text-sm outline-none">
                </div>

                <!-- UTAMA: DIKUNCI AKTIF UNTUK SEMUA NODE YANG BUTUH FILE UPLOAD GAMBAR -->
                <div class="field-group" id="group-foto">
                    <label class="block text-xs font-bold text-stone-600 uppercase mb-2">Pilih File Gambar / Foto</label>
                    <input type="file" name="foto" id="input-foto" accept="image/*" class="w-full border rounded-xl p-2.5 bg-stone-50 text-sm outline-none">
                    <p class="text-[10px] text-stone-400 mt-1">*Kosongkan jika tidak ingin mengganti gambar lama.</p>
                </div>

                <div class="flex gap-3 pt-4">
                    <button type="button" onclick="tutupModal()" class="flex-1 py-3 bg-stone-100 hover:bg-stone-200 text-stone-700 text-sm font-bold rounded-xl transition">Batal</button>
                    <button type="button" onclick="eksekusiSimpanCRUD()" class="flex-1 py-3 bg-amber-600 hover:bg-amber-700 text-white text-sm font-bold rounded-xl shadow-md transition">Simpan Data</button>
                </div>
            </form>
        </div>
    </div>

    <!-- ================= AJAX CONTROLLER JAVASCRIPT ================= -->
    <script>
        const modal = document.getElementById('modal-crud');
        const form = document.getElementById('form-crud');

        function sembunyikanSemuaFields() {
            document.querySelectorAll('.field-group').forEach(el => el.classList.add('hidden'));
        }

        // AKSI: TRIGGER TAMBAH DATA BARU
        function bukaModalTambah(node) {
            form.reset();
            sembunyikanSemuaFields();
            document.getElementById('hidden-node').value = node;
            document.getElementById('hidden-id').value = '';
            document.getElementById('modal-title').innerText = 'Tambah Konten ' + node.toUpperCase();
            document.getElementById('label-deskripsi').innerText = 'Deskripsi / Isi Konten';

            // Seluruh node kini dibuka akses upload file gambar / foto-nya secara default
            document.getElementById('group-foto').classList.remove('hidden');

            if(node === 'prokers' || node === 'kegiatan') {
                document.getElementById('group-judul').classList.remove('hidden');
                document.getElementById('group-tanggal').classList.remove('hidden');
                if(node === 'prokers') document.getElementById('group-status').classList.remove('hidden');
                if(node === 'kegiatan') document.getElementById('group-deskripsi').classList.remove('hidden');
            } else if(node === 'anggota') {
                document.getElementById('group-nama').classList.remove('hidden');
                document.getElementById('group-jabatan').classList.remove('hidden');
                document.getElementById('group-nim').classList.remove('hidden');
                document.getElementById('group-jurusan').classList.remove('hidden');
            } else if(node === 'berita') {
                document.getElementById('group-judul').classList.remove('hidden');
                document.getElementById('group-tanggal').classList.remove('hidden');
                document.getElementById('group-deskripsi').classList.remove('hidden');
            } else if(node === 'galeri') {
                document.getElementById('group-deskripsi').classList.remove('hidden');
                document.getElementById('label-deskripsi').innerText = 'Keterangan Foto (Caption)';
            }

            modal.classList.remove('hidden');
            modal.classList.add('flex');
        }

        // AKSI: TRIGGER EDIT DATA LAMA
        function bukaModalEdit(node, id, dataObj) {
            form.reset();
            sembunyikanSemuaFields();
            document.getElementById('hidden-node').value = node;
            document.getElementById('hidden-id').value = id;
            document.getElementById('modal-title').innerText = 'Edit Konten ' + node.toUpperCase();
            document.getElementById('label-deskripsi').innerText = 'Deskripsi / Isi Konten';
            
            // Tampilkan field file upload gambar untuk semua mode edit
            document.getElementById('group-foto').classList.remove('hidden');

            if(node === 'prokers' || node === 'kegiatan') {
                document.getElementById('group-judul').classList.remove('hidden');
                document.getElementById('group-tanggal').classList.remove('hidden');
                document.getElementById('input-judul').value = dataObj.judul || dataObj.title || '';
                document.getElementById('input-tanggal').value = dataObj.tanggal || '';
                if(node === 'prokers') {
                    document.getElementById('group-status').classList.remove('hidden');
                    document.getElementById('input-status').value = dataObj.status || 'berjalan';
                }
                if(node === 'kegiatan') {
                    document.getElementById('group-deskripsi').classList.remove('hidden');
                    document.getElementById('input-deskripsi').value = dataObj.deskripsi || '';
                }
            } else if(node === 'anggota') {
                document.getElementById('group-nama').classList.remove('hidden');
                document.getElementById('group-jabatan').classList.remove('hidden');
                document.getElementById('group-nim').classList.remove('hidden');
                document.getElementById('group-jurusan').classList.remove('hidden');

                document.getElementById('input-nama').value = dataObj.nama || '';
                document.getElementById('input-jabatan').value = dataObj.jabatan || '';
                document.getElementById('input-nim').value = dataObj.nim || '';
                document.getElementById('input-jurusan').value = dataObj.jurusan || '';
            } else if(node === 'berita') {
                document.getElementById('group-judul').classList.remove('hidden');
                document.getElementById('group-tanggal').classList.remove('hidden');
                document.getElementById('group-deskripsi').classList.remove('hidden');

                document.getElementById('input-judul').value = dataObj.judul || '';
                document.getElementById('input-tanggal').value = dataObj.tanggal || '';
                document.getElementById('input-deskripsi').value = dataObj.isi || '';
            } else if(node === 'galeri') {
                document.getElementById('group-deskripsi').classList.remove('hidden');
                document.getElementById('label-deskripsi').innerText = 'Keterangan Foto (Caption)';
                document.getElementById('input-deskripsi').value = dataObj.caption || '';
            }

            modal.classList.remove('hidden');
            modal.classList.add('flex');
        }

        function tutupModal() {
            modal.classList.remove('flex');
            modal.classList.add('hidden');
        }

        function eksekusiSimpanCRUD() {
            const formData = new FormData(form);
            fetch('/admin/api/simpan-data', {
                method: 'POST',
                headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
                body: formData
            })
            .then(res => res.json())
            .then(data => data.success ? window.location.reload() : alert('Gagal menyimpan data: ' + data.message))
            .catch(err => alert('Gangguan berkas data upload!'));
        }

        function eksekusiHapusData(node, id) {
            if (!confirm(`Apakah kamu yakin ingin menghapus data ini dari '${node}'?`)) return;
            fetch('/admin/api/hapus-data', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
                body: JSON.stringify({ node: node, id: id })
            })
            .then(res => res.json()).then(data => data.success ? window.location.reload() : alert(data.message));
        }

        function eksekusiSimpanSettings() {
            const settingsForm = document.getElementById('form-settings');
            const dataObj = {
                nama_kelompok: settingsForm.querySelector('[name="nama_kelompok"]').value,
                nama_desa: settingsForm.querySelector('[name="nama_desa"]').value,
                deskripsi: settingsForm.querySelector('[name="deskripsi"]').value,
                whatsapp: settingsForm.querySelector('[name="whatsapp"]').value,
                instagram: settingsForm.querySelector('[name="instagram"]').value
            };
            fetch('/admin/api/simpan-settings', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
                body: JSON.stringify({ payload: dataObj })
            })
            .then(res => res.json()).then(data => data.success ? alert('Settings disimpan!') : alert(data.message));
        }
    </script>
</body>
</html>