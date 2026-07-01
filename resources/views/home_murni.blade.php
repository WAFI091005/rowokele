<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $settings['nama_kelompok'] ?? 'Website KKN Desa Rowokele' }}</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

    <style>
        @keyframes blob {
            0%, 100% { transform: translate(0, 0) scale(1); }
            33% { transform: translate(30px, -40px) scale(1.1); }
            66% { transform: translate(-20px, 20px) scale(0.95); }
        }
        .animate-blob { animation: blob 14s infinite ease-in-out; }
        .animation-delay-2000 { animation-delay: 2s; }
        .animation-delay-4000 { animation-delay: 4s; }
        
        .reveal { 
            opacity: 0; 
            transform: translateY(28px); 
            transition: opacity .8s cubic-bezier(.2,.8,.2,1), transform .8s cubic-bezier(.2,.8,.2,1); 
        }
        .reveal.in-view { opacity: 1; transform: none; }

        /* Custom Wave CSS */
        .wave-shape {
            position: absolute;
            bottom: -2px;
            left: 0;
            width: 100%;
            line-height: 0;
        }

        .menu-circle {
            width: 85px;
            height: 85px;
            border-radius: 50%;
            background: #d97706; /* Amber-600 */
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 28px;
            margin: 0 auto;
            box-shadow: 0 10px 25px rgba(217, 119, 6, 0.2);
            transition: all .3s ease;
        }
        .menu-circle:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 35px rgba(217, 119, 6, 0.4);
        }

        .map-clip {
            width: 100%;
            height: 350px;
            background: #78350f; /* Amber-900 */
            clip-path: polygon(
                20% 0%, 40% 5%, 60% 0%, 80% 15%, 100% 40%,
                95% 70%, 80% 100%, 55% 90%, 30% 100%, 5% 80%, 0% 40%
            );
        }

        .event-card-hover:hover {
            transform: translateY(-8px);
            box-shadow: 0 20px 40px rgba(120, 53, 15, 0.08);
        }

        /* Navbar backdrop glass permanen */
        .navbar-glass-permanent {
            background: rgba(253, 251, 247, 0.85);
            backdrop-filter: blur(16px) saturate(120%);
            -webkit-backdrop-filter: blur(16px) saturate(120%);
            border-bottom: 1px solid rgba(120, 53, 15, 0.1);
        }
    </style>
</head>
<body class="bg-[#fdfbf7] text-stone-800 antialiased min-h-screen flex flex-col pt-20">

{{-- NAVBAR STABIL & RESPONSIVE --}}
<nav class="fixed top-0 inset-x-0 z-50 navbar-glass-permanent min-h-20 flex flex-col justify-center shadow-sm">
    <div class="max-w-7xl mx-auto px-6 lg:px-12 w-full h-20 flex items-center justify-between">
        <a href="/" class="flex items-center gap-3 font-black text-2xl tracking-tight text-stone-900">
            <span class="inline-flex items-center justify-center w-10 h-10 rounded-xl overflow-hidden shadow-md">
                <img src="{{ asset('img/logo.jpeg') }}" alt="Logo" class="w-full h-full object-cover">
            </span>
            <span>{{ $settings['nama_kelompok'] ?? 'KKN Rowokele' }}</span>
        </a>
        
        {{-- Desktop Menu --}}
        <div class="hidden md:flex items-center gap-1">
            <a href="/" class="px-5 py-2 rounded-full text-sm font-bold text-amber-700 bg-amber-600/10">Home</a>
            <a href="/proker" class="px-5 py-2 rounded-full text-sm font-medium text-stone-600 hover:text-amber-700 hover:bg-amber-600/5 transition">Program</a>
            <a href="/kegiatan" class="px-5 py-2 rounded-full text-sm font-medium text-stone-600 hover:text-amber-700 hover:bg-amber-600/5 transition">Kegiatan</a>
            <a href="/anggota" class="px-5 py-2 rounded-full text-sm font-medium text-stone-600 hover:text-amber-700 hover:bg-amber-600/5 transition">Tim</a>
            <a href="/berita" class="px-5 py-2 rounded-full text-sm font-medium text-stone-600 hover:text-amber-700 hover:bg-amber-600/5 transition">Berita</a>
            <a href="/galeri" class="px-5 py-2 rounded-full text-sm font-medium text-stone-600 hover:text-amber-700 hover:bg-amber-600/5 transition">Galeri</a>
        </div>

        {{-- Mobile Hamburger Button --}}
        <div class="md:hidden flex items-center">
            <button type="button" id="mobile-menu-btn" class="text-stone-700 hover:text-amber-700 focus:outline-none p-2 text-xl" aria-label="Toggle Menu">
                <i class="fas fa-bars" id="menu-icon"></i>
            </button>
        </div>
    </div>

    {{-- Mobile Dropdown Menu --}}
    <div id="mobile-menu" class="hidden md:hidden border-t border-amber-600/10 bg-[#fdfbf7]/95 backdrop-blur-md px-6 py-4 space-y-2 shadow-inner transition-all duration-300">
        <a href="/" class="block px-4 py-2.5 rounded-xl text-base font-bold text-amber-700 bg-amber-600/10">Home</a>
        <a href="/proker" class="block px-4 py-2.5 rounded-xl text-base font-medium text-stone-600 hover:text-amber-700 hover:bg-amber-600/5 transition">Program</a>
        <a href="/kegiatan" class="block px-4 py-2.5 rounded-xl text-base font-medium text-stone-600 hover:text-amber-700 hover:bg-amber-600/5 transition">Kegiatan</a>
        <a href="/anggota" class="block px-4 py-2.5 rounded-xl text-base font-medium text-stone-600 hover:text-amber-700 hover:bg-amber-600/5 transition">Tim</a>
        <a href="/berita" class="block px-4 py-2.5 rounded-xl text-base font-medium text-stone-600 hover:text-amber-700 hover:bg-amber-600/5 transition">Berita</a>
        <a href="/galeri" class="block px-4 py-2.5 rounded-xl text-base font-medium text-stone-600 hover:text-amber-700 hover:bg-amber-600/5 transition">Galeri</a>
    </div>
</nav>

{{-- LAYOUT UTAMA HALAMAN --}}
<div class="w-full bg-[#fdfbf7]">
    
    {{-- 1. HERO SECTION --}}
    <section class="relative min-h-[650px] flex items-center overflow-hidden bg-cover bg-center"
             style="background-image: linear-gradient(rgba(0,0,0,.3), rgba(0,0,0,.35)), url('{{ asset('img/1.jpeg') }}');">
        
        <div class="relative z-10 w-full max-w-7xl mx-auto px-6 lg:px-12 text-center text-white">
            <span class="hidden md:inline-block text-sm tracking-[3px] uppercase font-semibold text-amber-300">
                {{ $settings['tema'] ?? 'Selamat Datang di' }}
            </span>
            
            <h1 class="text-5xl md:text-7xl font-extrabold mt-4 mb-8 leading-tight drop-shadow-md">
                {{ $settings['hero_text'] ?? 'Desa Sukamaju' }}
            </h1>
            
            <p class="max-w-2xl mx-auto text-lg text-amber-50 font-medium mb-10 drop-shadow">
                {{ $settings['deskripsi'] ?? 'Kelompok KKN yang mengabdi untuk kemajuan dan kesejahteraan desa.' }}
            </p>
        </div>

        <div class="wave-shape absolute bottom-0 left-0 w-full">
            <svg viewBox="0 0 1440 320" class="w-full">
                <path fill="#fdfbf7" d="M0,224L48,208C96,192,192,160,288,170.7C384,181,480,235,576,234.7C672,235,768,181,864,176C960,171,1056,213,1152,218.7C1248,224,1344,192,1392,176L1440,160L1440,320L0,320Z"/>
            </svg>
        </div>
    </section>

    {{-- 2. MENU IKON --}}
    <section class="relative z-20 -mt-16 hidden md:flex justify-center gap-4 md:gap-8 flex-wrap px-4">
        @php
            $menus = [
                ['icon' => 'fa-map', 'label' => 'Wisata'],
                ['icon' => 'fa-user-graduate', 'label' => 'Pemuda'],
                ['icon' => 'fa-building', 'label' => 'UMKM'],
                ['icon' => 'fa-users', 'label' => 'Komunitas'],
                ['icon' => 'fa-handshake', 'label' => 'Layanan'],
                ['icon' => 'fa-person-cane', 'label' => 'Lansia'],
            ];
        @endphp
        @foreach($menus as $menu)
            <div class="text-center reveal">
                <div class="menu-circle bg-white text-amber-600 shadow-lg hover:text-amber-700 hover:scale-105 transition-all duration-300 border border-amber-100">
                    <i class="fas {{ $menu['icon'] }}"></i>
                </div>
                <p class="mt-3 font-semibold text-sm text-stone-700">{{ $menu['label'] }}</p>
            </div>
        @endforeach
    </section>

    {{-- 3. JELAJAHI DESA --}}
    <section class="max-w-7xl mx-auto px-6 lg:px-12 py-24 relative">
        <div class="absolute right-0 top-20 w-96 h-96 rounded-full bg-amber-100/40 -z-10 hidden lg:block"></div>
        
        <div class="grid lg:grid-cols-2 gap-16 items-center">
            <div class="reveal">
                <h2 class="text-4xl md:text-6xl font-bold text-[#78350f] leading-tight">
                    Jelajahi Desa
                </h2>
                <p class="text-stone-600 leading-relaxed mt-4 mb-8">
                    Temukan lokasi fasilitas umum, wisata, UMKM, balai desa, dan berbagai layanan masyarakat.
                </p>
                <a href="https://maps.app.goo.gl/XaQNrqxuDDQ7sa7m6" target="_blank" class="inline-flex items-center gap-2 px-8 py-4 bg-amber-600 text-white font-semibold rounded-full hover:bg-amber-700 transition shadow-lg shadow-amber-600/20">
                    <i class="fas fa-map"></i> Lihat Peta Interaktif
                </a>
            </div>
            
            <div class="flex justify-center reveal">
                <div class="map-clip shadow-2xl relative overflow-hidden w-full max-w-[500px]">
                    <img src="{{ asset('img/2.png') }}" alt="Peta Desa" class="w-full h-full object-cover">
                    <div class="absolute inset-0 pointer-events-none" style="box-shadow: inset 0 0 80px rgba(0,0,0,0.7), inset 0 0 40px rgba(0,0,0,0.5);"></div>
                </div>
            </div>
        </div>
    </section>

    {{-- 4. KEGIATAN MENDATANG --}}
    <section class="max-w-7xl mx-auto px-6 lg:px-12 pb-24">
        <div class="flex flex-wrap items-center justify-between gap-4 mb-12">
            <div>
                <h2 class="text-3xl md:text-5xl font-bold text-[#78350f]">Kegiatan Mendatang</h2>
                <p class="text-stone-500 mt-2">Jangan lewatkan agenda seru yang akan dilaksanakan</p>
            </div>
            <a href="/kegiatan" class="inline-flex items-center gap-2 px-6 py-3 bg-amber-600 text-white font-semibold rounded-full hover:bg-amber-700 transition shadow-lg text-sm">
                Semua Event <i class="fas fa-arrow-right"></i>
            </a>
        </div>

        <div class="flex gap-6 overflow-x-auto pb-6 px-2 snap-x snap-mandatory scroll-smooth [scrollbar-width:none] [&::-webkit-scrollbar]:hidden">
            @forelse($kegiatan as $event)
                <div class="reveal bg-white rounded-2xl overflow-hidden shadow-md hover:shadow-2xl event-card-hover transition duration-300 flex-shrink-0 w-[280px] sm:w-[350px] snap-start border border-stone-100">
                    <img src="{{ $event['img'] }}" alt="Event" class="w-full h-64 object-cover">
                    <div class="p-6">
                        <div class="text-amber-600 font-bold text-sm tracking-wide">
                            {{ isset($event['tanggal']) ? date('d M Y', strtotime($event['tanggal'])) : 'Coming Soon' }}
                        </div>
                        <h3 class="text-xl font-bold text-stone-900 mt-2 line-clamp-2">
                            {{ $event['title'] ?? ($event['judul'] ?? 'Judul Kegiatan') }}
                        </h3>
                    </div>
                </div>
            @empty
                <div class="w-full text-center py-16 text-stone-400 bg-white/50 rounded-2xl border border-dashed border-stone-200">
                    Belum ada kegiatan mendatang.
                </div>
            @endforelse
        </div>
    </section>

    {{-- 5. PROGRAM KERJA --}}
    <section class="max-w-7xl mx-auto px-6 lg:px-12 py-24">
        <div class="flex flex-wrap items-center justify-between gap-4 mb-12">
            <div>
                <h2 class="text-3xl md:text-5xl font-bold text-[#78350f]">Program Kerja</h2>
                <p class="text-stone-500 mt-2">Berbagai program kerja unggulan untuk kemajuan desa</p>
            </div>
            <a href="/proker" class="inline-flex items-center gap-2 px-6 py-3 bg-amber-600 text-white font-semibold rounded-full hover:bg-amber-700 transition shadow-lg text-sm">
                Lihat Semua <i class="fas fa-arrow-right"></i>
            </a>
        </div>

        <div class="flex gap-6 overflow-x-auto pb-6 px-2 snap-x snap-mandatory scroll-smooth [scrollbar-width:none] [&::-webkit-scrollbar]:hidden md:grid md:grid-cols-3 md:overflow-visible">
            @forelse ($prokers as $p)
                <div class="reveal bg-white rounded-2xl overflow-hidden shadow-md hover:shadow-2xl transition duration-300 border border-stone-100 flex-shrink-0 w-[280px] sm:w-[350px] snap-start md:w-full">
                    <div class="h-48 overflow-hidden bg-gradient-to-br from-amber-500 to-[#78350f] flex items-center justify-center text-amber-200 text-5xl">
                        @if(!empty($p['gambar']))
                            <img src="{{ $p['gambar'] }}" alt="Program" class="w-full h-full object-cover">
                        @else
                            <i class="fas fa-file-alt"></i>
                        @endif
                    </div>
                    <div class="p-6">
                        <span class="text-xs font-bold uppercase tracking-wider text-amber-600">{{ $p['status'] ?? 'Rencana' }}</span>
                        <h3 class="text-xl font-bold text-stone-900 mt-1">{{ $p['judul'] ?? 'Program' }}</h3>
                        <p class="text-stone-500 text-sm mt-2 line-clamp-2">{{ $p['deskripsi'] ?? '' }}</p>
                    </div>
                </div>
            @empty
                <div class="col-span-full w-full text-center py-16 text-stone-400 bg-white/50 rounded-2xl border border-dashed border-stone-200">
                    Belum ada program kerja
                </div>
            @endforelse
        </div>
    </section>

    {{-- 6. BERITA TERBARU --}}
    <section class="max-w-7xl mx-auto px-6 lg:px-12 pb-24">
        <div class="flex flex-wrap items-center justify-between gap-4 mb-12">
            <div>
                <h2 class="text-3xl md:text-5xl font-bold text-[#78350f]">Berita Terbaru</h2>
                <p class="text-stone-500 mt-2">Ikuti kabar perkembangan dan artikel seputar KKN desa</p>
            </div>
            <a href="/berita" class="inline-flex items-center gap-2 px-6 py-3 bg-amber-600 text-white font-semibold rounded-full hover:bg-amber-700 transition shadow-lg text-sm">
                Semua Berita <i class="fas fa-arrow-right"></i>
            </a>
        </div>

        <div class="flex gap-6 overflow-x-auto pb-6 px-2 snap-x snap-mandatory scroll-smooth [scrollbar-width:none] [&::-webkit-scrollbar]:hidden md:grid md:grid-cols-3 md:gap-8 md:overflow-visible">
            @forelse ($berita as $index => $b)
                <div class="reveal bg-white rounded-2xl overflow-hidden shadow-md hover:shadow-2xl transition duration-300 flex flex-col h-full border border-stone-100 flex-shrink-0 w-[280px] sm:w-[350px] snap-start md:w-full">
                    
                    <div class="relative h-48 overflow-hidden bg-stone-200">
                        <img src="{{ $b['thumbnail'] ?? ($b['gambar'] ?? 'https://images.unsplash.com/photo-1504711434969-e33886168f5c?auto=format&fit=crop&w=600&q=80') }}" class="w-full h-full object-cover">
                    </div>

                    <div class="p-6 flex flex-col flex-grow justify-between">
                        <div>
                            @if (!empty($b['tanggal']))
                                <div class="text-xs text-stone-400 font-medium flex items-center gap-1">
                                    <i class="far fa-clock"></i> {{ date('d M Y', strtotime($b['tanggal'])) }}
                                </div>
                            @endif
                            
                            <h3 class="text-lg font-bold text-stone-900 mt-2 line-clamp-2 hover:text-amber-600 transition" 
                                style="cursor: pointer !important;"
                                onclick="bukaModalBerita('{{ $index }}')">
                                {{ $b['judul'] ?? 'Untitled News' }}
                            </h3>

                            <p class="text-stone-500 text-sm mt-3 line-clamp-3 leading-relaxed">
                                {{ $b['isi'] ?? ($b['deskripsi'] ?? '') }}
                            </p>
                        </div>

                        <div class="pt-5 mt-4 border-t border-stone-100 flex items-center justify-end">
                            <button type="button" 
                                    onclick="bukaModalBerita('{{ $index }}')" 
                                    class="text-sm font-semibold text-amber-600 hover:text-amber-700 inline-flex items-center gap-1 bg-transparent border-none"
                                    style="cursor: pointer !important; position: relative; z-index: 40;">
                                Selengkapnya <i class="fas fa-chevron-right text-xs"></i>
                            </button>
                        </div>
                    </div>
                </div>

                {{-- POPUP BOX MODAL --}}
                <div id="modal-berita-{{ $index }}" class="fixed inset-0 z-[999] items-center justify-center bg-black/80 backdrop-blur-sm p-4 hidden animate-fade-in">
                    <div class="relative max-w-3xl w-full max-h-[90vh] bg-white rounded-3xl overflow-hidden shadow-2xl flex flex-col" onclick="event.stopPropagation()">
                        
                        <button type="button" 
                                onclick="tutupModalBerita('{{ $index }}')" 
                                class="absolute top-4 right-4 z-20 w-10 h-10 rounded-full bg-black/50 hover:bg-black/70 text-white flex items-center justify-center border-none"
                                style="cursor: pointer !important;">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                        </button>
                        
                        <div class="overflow-y-auto w-full h-full">
                            <div class="relative h-64 md:h-80 w-full bg-stone-100 flex items-center justify-center overflow-hidden">
                                <img src="{{ $b['thumbnail'] ?? ($b['gambar'] ?? 'https://images.unsplash.com/photo-1504711434969-e33886168f5c') }}" class="w-full h-full object-cover">
                            </div>

                            <div class="p-6 md:p-8 space-y-4">
                                <div class="flex flex-wrap items-center gap-4 text-xs text-stone-400 border-b border-stone-100 pb-4">
                                    <div class="flex items-center gap-1">
                                        <i class="far fa-calendar-alt text-amber-600"></i>
                                        <span>{{ $b['tanggal'] ?? '-' }}</span>
                                    </div>
                                </div>

                                <h2 class="text-2xl md:text-3xl font-bold text-stone-900 leading-tight">{{ $b['judul'] ?? 'Judul Berita' }}</h2>
                                <div class="text-stone-600 text-sm md:text-base leading-relaxed space-y-4 whitespace-pre-line pt-2">
                                    {{ $b['isi'] ?? ($b['deskripsi'] ?? '') }}
                                </div>
                            </div>
                        </div>

                        <div class="p-4 bg-stone-50 border-t border-stone-100 flex items-center justify-end shrink-0">
                            <button type="button" 
                                    onclick="tutupModalBerita('{{ $index }}')" 
                                    class="px-5 py-2 bg-amber-600 text-white text-sm font-semibold rounded-xl hover:bg-amber-700 shadow-md border-none"
                                    style="cursor: pointer !important;">
                                Selesai Membaca
                            </button>
                        </div>

                    </div>
                </div>
            @empty
                <div class="col-span-full w-full text-center py-16 text-stone-400 bg-white/50 rounded-2xl border border-dashed border-stone-200">
                    Belum ada kabar berita terbaru.
                </div>
            @endforelse
        </div>
    </section>

    {{-- 7. GALERI KEGIATAN --}}
    <section class="max-w-[1600px] mx-auto px-6 lg:px-12 pb-24 overflow-hidden">
        <div class="flex flex-wrap items-center justify-between gap-4 mb-8 max-w-7xl mx-auto">
            <div>
                <h2 class="text-3xl md:text-5xl font-bold text-[#78350f]">Galeri Kegiatan</h2>
                <p class="text-stone-500 mt-2">Dokumentasi lensa kegiatan pengabdian mahasiswa KKN</p>
            </div>
            <a href="/galeri" class="inline-flex items-center gap-2 px-6 py-3 bg-amber-600 text-white font-semibold rounded-full hover:bg-amber-700 transition shadow-lg text-sm">
                Semua Galeri <i class="fas fa-arrow-right"></i>
            </a>
        </div>

        <div class="flex justify-center items-center w-full min-h-[480px] overflow-x-auto [scrollbar-width:none] [&::-webkit-scrollbar]:hidden">
            <div class="relative w-[1500px] h-[450px] flex-shrink-0" style="perspective: 3000px;">
                @php
                    $displayGaleri = $galeri ?? [];
                    $curveConfigs = [
                        ['class' => 'left-[50px] top-[40px] w-[200px] h-[360px]', 'transform' => 'rotateY(52deg)'],
                        ['class' => 'left-[270px] top-[70px] w-[200px] h-[360px]', 'transform' => 'rotateY(30deg)'],
                        ['class' => 'left-[490px] top-[90px] w-[200px] h-[360px]', 'transform' => 'rotateY(10deg)'],
                        ['class' => 'left-[710px] top-[90px] w-[200px] h-[360px]', 'transform' => 'rotateY(-10deg)'],
                        ['class' => 'left-[930px] top-[70px] w-[200px] h-[360px]', 'transform' => 'rotateY(-30deg)'],
                        ['class' => 'left-[1150px] top-[40px] w-[200px] h-[360px]', 'transform' => 'rotateY(-52deg)'],
                    ];
                @endphp

                @for ($i = 0; $i < 6; $i++)
                    @php
                        $itemData = $displayGaleri[$i] ?? null;
                        if (!$itemData) continue;
                        $imgUrl = $itemData['image_url'] ?? ($itemData['url'] ?? null);
                        $caption = $itemData['caption'] ?? ($itemData['judul'] ?? 'Foto Kegiatan');
                        $config = $curveConfigs[$i];
                    @endphp

                    <div class="reveal absolute rounded-[24px] overflow-hidden bg-stone-300 shadow-[0_20px_40px_rgba(0,0,0,0.15)] transition-all duration-400 group cursor-pointer {{ $config['class'] }}"
                         style="transform: {{ $config['transform'] }}; transition-delay: {{ $i * 70 }}ms;"
                         onmouseenter="this.style.transform = 'translateY(-15px) scale(1.05)'; this.style.zIndex = '100';"
                         onmouseleave="this.style.transform = '{{ $config['transform'] }}'; this.style.zIndex = 'auto';">
                        
                        {{-- Foto Utama --}}
                        <img src="{{ $imgUrl }}" class="w-full h-full object-cover block group-hover:scale-110 transition-transform duration-500">
                        
                        {{-- Overlay Gelap saat Hover --}}
                        <div class="absolute inset-0 bg-black/60 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>

                        {{-- Wadah Konten Teks Vertikal di Tengah --}}
                        <div class="absolute inset-0 flex items-center justify-center p-2 text-center select-none pointer-events-none">
                            <p class="text-white text-base md:text-lg font-bold tracking-widest uppercase [writing-mode:vertical-lr] rotate-180 opacity-0 translate-y-8 group-hover:opacity-100 group-hover:translate-y-0 transition-all duration-500 delay-75 line-clamp-1 whitespace-nowrap drop-shadow-[0_2px_4px_rgba(0,0,0,0.5)]">
                                {{ $caption }}
                            </p>
                        </div>
                    </div>
                @endfor
            </div>
        </div>
    </section>
</div>

{{-- FOOTER --}}
<footer class="bg-[#b85c27] text-white/90 py-12 text-center text-sm border-t border-white/10 mt-auto">
    &copy; {{ date('Y') }} {{ $settings['nama_kelompok'] ?? 'KKN Desa Rowokele' }} &middot; Dibangun dengan ❤️ untuk desa
</footer>

{{-- JAVASCRIPT CONTROLLER --}}
<script>
    // Intersection Observer untuk animasi reveal
    function initReveal() {
        const obs = new IntersectionObserver((entries) => {
            entries.forEach((e) => {
                if (e.isIntersecting) { e.target.classList.add('in-view'); obs.unobserve(e.target); }
            });
        }, { threshold: 0.1 });
        document.querySelectorAll('.reveal').forEach((el) => obs.observe(el));
    }
    document.addEventListener('DOMContentLoaded', initReveal);

    // Controller Modal Berita
    function bukaModalBerita(index) {
        const modal = document.getElementById(`modal-berita-${index}`);
        if (modal) {
            modal.style.display = 'flex';
            document.body.style.overflow = 'hidden';
        }
    }

    function tutupModalBerita(index) {
        const modal = document.getElementById(`modal-berita-${index}`);
        if (modal) {
            modal.style.display = 'none';
            document.body.style.overflow = 'auto';
        }
    }

    // Controller Mobile Navbar Dropdown (Murni JS)
    document.addEventListener('DOMContentLoaded', function() {
        const menuBtn = document.getElementById('mobile-menu-btn');
        const mobileMenu = document.getElementById('mobile-menu');
        const menuIcon = document.getElementById('menu-icon');

        if (menuBtn && mobileMenu) {
            menuBtn.addEventListener('click', function() {
                mobileMenu.classList.toggle('hidden');
                
                // Ganti ikon hamburger (fa-bars) menjadi silang (fa-xmark) saat menu terbuka
                if (mobileMenu.classList.contains('hidden')) {
                    menuIcon.classList.remove('fa-xmark');
                    menuIcon.classList.add('fa-bars');
                } else {
                    menuIcon.classList.remove('fa-bars');
                    menuIcon.classList.add('fa-xmark');
                }
            });
        }
    });
</script>
</body>
</html>