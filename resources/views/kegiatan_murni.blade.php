<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kegiatan KKN - Desa Rowokele</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <style>
        .navbar-glass-permanent { 
            background: rgba(253, 251, 247, 0.95); 
            backdrop-filter: blur(16px); 
            border-bottom: 1px solid rgba(120, 53, 15, 0.1); 
        }
        .reveal { 
            opacity: 0; 
            transform: translateY(28px); 
            transition: opacity .8s cubic-bezier(.2,.8,.2,1), transform .8s cubic-bezier(.2,.8,.2,1); 
        }
        .reveal.in-view { opacity: 1; transform: none; }
    </style>
</head>
<body class="bg-[#fdfbf7] text-stone-800 antialiased min-h-screen flex flex-col pt-20">
    {{-- NAVBAR STABIL --}}
    <nav class="fixed top-0 inset-x-0 z-50 navbar-glass-permanent min-h-20 flex flex-col justify-center shadow-sm">
        <div class="max-w-7xl mx-auto px-6 lg:px-12 w-full flex items-center justify-between h-20">
            <a href="/" class="flex items-center gap-3 font-black text-2xl tracking-tight text-stone-900">
                <span class="inline-flex items-center justify-center w-10 h-10 rounded-xl overflow-hidden shadow-md">
                    <img src="{{ asset('img/logo.jpeg') }}" alt="Logo" class="w-full h-full object-cover">
                </span>
                <span>{{ $settings['nama_kelompok'] ?? 'KKN Rowokele' }}</span>
            </a>
            
            {{-- Desktop Navigation --}}
            <div class="hidden md:flex items-center gap-1">
                <a href="/" class="px-5 py-2 rounded-full text-sm font-medium text-stone-600 hover:text-amber-700 hover:bg-amber-600/5 transition">Home</a>
                <a href="/proker" class="px-5 py-2 rounded-full text-sm font-medium text-stone-600 hover:text-amber-700 hover:bg-amber-600/5 transition">Program</a>
                <a href="/kegiatan" class="px-5 py-2 rounded-full text-sm font-bold text-amber-700 bg-amber-600/10">Kegiatan</a>
                <a href="/anggota" class="px-5 py-2 rounded-full text-sm font-medium text-stone-600 hover:text-amber-700 hover:bg-amber-600/5 transition">Tim</a>
                <a href="/berita" class="px-5 py-2 rounded-full text-sm font-medium text-stone-600 hover:text-amber-700 hover:bg-amber-600/5 transition">Berita</a>
                <a href="/galeri" class="px-5 py-2 rounded-full text-sm font-medium text-stone-600 hover:text-amber-700 hover:bg-amber-600/5 transition">Galeri</a>
            </div>
            {{-- Tombol Hamburger Mobile --}}
            <button type="button" id="btn-menu-mobile" class="md:hidden p-2 text-stone-600 hover:text-amber-700 focus:outline-none cursor-pointer">
                <i class="fas fa-bars text-2xl" id="icon-menu-mobile"></i>
            </button>
        </div>
        {{-- Dropdown Menu Mobile --}}
        <div id="dropdown-menu-mobile" class="hidden md:hidden border-t border-stone-200 bg-[#fdfbf7]/95 backdrop-blur-md px-6 py-4 flex flex-col gap-2 shadow-inner">
            <a href="/" class="px-4 py-2.5 rounded-xl text-base font-medium text-stone-600 hover:text-amber-700 hover:bg-amber-600/5 transition">Home</a>
            <a href="/proker" class="px-4 py-2.5 rounded-xl text-base font-medium text-stone-600 hover:text-amber-700 hover:bg-amber-600/5 transition">Program</a>
            <a href="/kegiatan" class="px-4 py-2.5 rounded-xl text-base font-bold text-amber-700 bg-amber-600/10">Kegiatan</a>
            <a href="/anggota" class="px-4 py-2.5 rounded-xl text-base font-medium text-stone-600 hover:text-amber-700 hover:bg-amber-600/5 transition">Tim</a>
            <a href="/berita" class="px-4 py-2.5 rounded-xl text-base font-medium text-stone-600 hover:text-amber-700 hover:bg-amber-600/5 transition">Berita</a>
            <a href="/galeri" class="px-4 py-2.5 rounded-xl text-base font-medium text-stone-600 hover:text-amber-700 hover:bg-amber-600/5 transition">Galeri</a>
        </div>
    </nav>
    <div class="w-full bg-[#fdfbf7]">
        
        {{-- HERO SECTION --}}
        <section class="relative min-h-[450px] flex items-center overflow-hidden" style="background: linear-gradient(135deg, #78350f, #b45309);">
            <div class="absolute inset-0 opacity-10">
                <svg class="absolute inset-0 w-full h-full" xmlns="http://www.w3.org/2000/svg">
                    <pattern id="grid-kegiatan" width="40" height="40" patternUnits="userSpaceOnUse">
                        <path d="M 40 0 L 0 0 0 40" fill="none" stroke="white" stroke-width="0.5"/>
                    </pattern>
                    <rect width="100%" height="100%" fill="url(#grid-kegiatan)" />
                </svg>
            </div>
            
            <div class="absolute top-0 right-0 w-96 h-96 bg-amber-400/20 rounded-full blur-3xl"></div>
            <div class="absolute bottom-0 left-0 w-80 h-80 bg-orange-400/20 rounded-full blur-3xl"></div>
            
            <div class="relative max-w-7xl mx-auto px-6 lg:px-12 py-20 w-full">
                <div class="max-w-3xl">
                    <div class="flex items-center gap-3 mb-6">
                        <span class="inline-block w-12 h-0.5 bg-amber-400"></span>
                        <span class="text-amber-300 text-xs font-semibold tracking-[0.2em] uppercase">Agenda & Event</span>
                    </div>
                    <h1 class="text-4xl md:text-6xl font-bold text-white leading-tight mb-4">
                        Kegiatan Desa
                        <span class="text-amber-300 block mt-2">{{ $settings['nama_desa'] ?? 'Desa Rowokele' }}</span>
                    </h1>
                    <p class="text-amber-100/80 text-base md:text-lg max-w-xl leading-relaxed">Temukan rincian jadwal, dokumentasi, dan status pelaksanaan seluruh kegiatan pengabdian masyarakat kami.</p>
                </div>
            </div>
            
            <div class="absolute bottom-0 left-0 w-full leading-none overflow-hidden">
                <svg class="block w-full h-[120px]" viewBox="0 0 1440 120" preserveAspectRatio="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M0,120 C180,70 360,10 720,40 C980,65 1180,90 1440,80 L1440,120 L0,120 Z" fill="#fdfbf7"/>
                </svg>
            </div>
        </section>

        {{-- FILTER SECTION (RESPONSIF DENGAN SCROLL HORIZONTAL DI MOBILE) --}}
        <section class="max-w-7xl mx-auto px-6 lg:px-12 -mt-12 relative z-10">
            <div class="bg-white rounded-3xl shadow-xl border border-stone-100 p-6 md:p-8">
                <div class="flex flex-col lg:flex-row lg:items-center justify-between gap-4">
                    <div class="flex items-center gap-2">
                        <i class="fas fa-filter text-stone-400"></i>
                        <span class="text-sm font-semibold text-stone-700">Filter Status:</span>
                    </div>
                    
                    <div class="flex items-center gap-2 overflow-x-auto pb-2 lg:pb-0 [scrollbar-width:none] [&::-webkit-scrollbar]:hidden snap-x">
                        @php
                            $filters = ['semua' => 'Semua', 'rencana' => 'Rencana', 'berjalan' => 'Berjalan', 'selesai' => 'Selesai'];
                        @endphp
                        @foreach ($filters as $key => $label)
                            <button type="button" id="btn-filter-{{ $key }}" onclick="jalankanFilterKegiatan('{{ $key }}')" class="filter-btn-kegiatan flex-shrink-0 snap-start px-5 py-2.5 rounded-xl text-sm font-semibold transition-all duration-300 border-2 border-transparent {{ $key === 'semua' ? 'bg-amber-600 text-white shadow-lg border-amber-600' : 'bg-stone-50 text-stone-600 hover:bg-stone-100' }}">
                                {{ $label }}
                                <span id="badge-{{ $key }}" class="inline-flex items-center justify-center w-5 h-5 ml-1 text-xs rounded-full {{ $key === 'semua' ? 'bg-white/20 text-white' : 'bg-stone-200 text-stone-600' }}">
                                    @if($key === 'semua')
                                        {{ count($allKegiatan) }}
                                    @else
                                        {{ count(array_filter($allKegiatan, fn($item) => strtolower($item['status'] ?? 'rencana') === $key)) }}
                                    @endif
                                </span>
                            </button>
                        @endforeach
                    </div>

                    <div class="flex items-center gap-2 text-sm text-stone-400 border-t pt-3 lg:border-none lg:pt-0">
                        <span id="total-kegiatan-count" class="font-medium text-amber-600">{{ count($allKegiatan) }}</span>
                        <span>kegiatan ditemukan</span>
                    </div>
                </div>
            </div>
        </section>

        {{-- GRID CARDS --}}
        <section class="max-w-7xl mx-auto px-6 lg:px-12 py-12">
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                @forelse ($allKegiatan as $index => $event)
                    @php $statusGrup = strtolower($event['status'] ?? 'rencana'); @endphp
                    
                    <div class="card-item-kegiatan group bg-white rounded-2xl overflow-hidden border border-stone-200 hover:shadow-2xl hover:-translate-y-2 transition-all duration-500" data-status="{{ $statusGrup }}">
                        <div class="relative h-52 overflow-hidden bg-gradient-to-br from-amber-600 to-[#78350f]">
                            <div class="absolute inset-0 bg-cover bg-center group-hover:scale-110 transition-transform duration-700" style="background-image: url('{{ $event['img'] }}')"></div>
                            <div class="absolute inset-0 bg-gradient-to-t from-stone-900/80 via-stone-900/30 to-transparent"></div>
                            
                            <div class="absolute top-4 left-4 z-10">
                                <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full text-[10px] font-extrabold uppercase tracking-wider shadow-lg backdrop-blur-sm {{ $statusGrup === 'selesai' ? 'bg-amber-700 text-white' : ($statusGrup === 'berjalan' ? 'bg-orange-500 text-white' : 'bg-stone-100 text-stone-800') }}">
                                    {{ $event['status'] ?? 'Rencana' }}
                                </span>
                            </div>
                        </div>
                        <div class="p-5 space-y-3">
                            <h3 class="font-bold text-sm md:text-base text-stone-900 leading-tight group-hover:text-amber-600 transition line-clamp-2">{{ $event['title'] ?? ($event['judul'] ?? 'Untitled Event') }}</h3>
                            <p class="text-xs text-stone-500 leading-relaxed line-clamp-3 font-light">{{ $event['deskripsi'] ?? 'Rincian deskripsi mengenai agenda kegiatan desa ini belum diterbitkan.' }}</p>
                            
                            <div class="pt-3 border-t border-stone-100 flex items-center justify-between">
                                <div class="flex items-center gap-1.5 text-[10px] text-stone-400 font-medium">
                                    <i class="far fa-calendar-alt"></i> {{ isset($event['tanggal']) ? date('d M Y', strtotime($event['tanggal'])) : 'Coming Soon' }}
                                </div>
                                <button type="button" onclick="document.getElementById('modal-kegiatan-{{ $index }}').style.display = 'flex'; document.body.style.overflow = 'hidden';" class="text-stone-400 hover:text-amber-600 transition group-hover:translate-x-1 bg-transparent border-none" style="cursor: pointer !important;">
                                    <i class="fas fa-arrow-right"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                    {{-- MODAL BOX POPUP --}}
                    <div id="modal-kegiatan-{{ $index }}" class="fixed inset-0 z-[999] items-center justify-center bg-black/80 backdrop-blur-sm p-4 hidden">
                        <div class="relative max-w-3xl w-full max-h-[90vh] bg-white rounded-3xl overflow-hidden shadow-2xl flex flex-col" onclick="event.stopPropagation()">
                            <button type="button" onclick="document.getElementById('modal-kegiatan-{{ $index }}').style.display = 'none'; document.body.style.overflow = 'auto';" class="absolute top-4 right-4 z-20 w-10 h-10 rounded-full bg-black/50 text-white flex items-center justify-center border-none" style="cursor: pointer !important;">
                                <i class="fas fa-times"></i>
                            </button>
                            
                            <div class="overflow-y-auto w-full h-full">
                                <div class="relative h-64 md:h-80 w-full bg-stone-100 overflow-hidden">
                                    <img src="{{ $event['img'] }}" class="w-full h-full object-cover">
                                </div>
                                <div class="p-6 md:p-8 space-y-4">
                                    <h2 class="text-2xl md:text-3xl font-bold text-stone-900">{{ $event['title'] ?? ($event['judul'] ?? 'Untitled Event') }}</h2>
                                    <p class="text-xs text-stone-400 font-medium"><i class="fas fa-calendar-day mr-1"></i>{{ isset($event['tanggal']) ? date('d F Y', strtotime($event['tanggal'])) : 'Coming Soon' }}</p>
                                    <div class="text-stone-600 text-sm md:text-base leading-relaxed space-y-4 whitespace-pre-line border-t pt-4">{{ $event['deskripsi'] ?? 'Rincian deskripsi mengenai agenda kegiatan desa ini belum diterbitkan.' }}</div>
                                </div>
                            </div>
                            <div class="p-4 bg-stone-50 border-t flex items-center justify-end">
                                <button type="button" onclick="document.getElementById('modal-kegiatan-{{ $index }}').style.display = 'none'; document.body.style.overflow = 'auto';" class="px-5 py-2 bg-amber-600 text-white text-sm font-semibold rounded-xl hover:bg-amber-700" style="cursor: pointer !important;">Tutup Detail</button>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full text-center py-16 text-stone-400">Belum ada data kegiatan.</div>
                @endforelse
                {{-- BOX KONDISI JIKA FILTER KOSONG --}}
                <div id="box-kegiatan-kosong" class="col-span-full hidden">
                    <div class="py-20 text-center bg-gradient-to-br from-amber-50 to-orange-50 rounded-3xl border-2 border-dashed border-amber-200">
                        <h3 class="text-xl font-bold text-stone-700 mb-2">Tidak Ada Kegiatan</h3>
                        <p class="text-sm text-stone-500">Tidak ada data agenda kegiatan desa pada status filter ini.</p>
                        <button type="button" onclick="jalankanFilterKegiatan('semua')" class="mt-4 px-6 py-2.5 bg-amber-600 text-white rounded-xl text-sm font-semibold hover:bg-amber-700 shadow-md">Tampilkan Semua</button>
                    </div>
                </div>
            </div>
        </section>
    </div>
    {{-- FOOTER --}}
    <footer class="bg-[#b85c27] text-white/90 py-12 text-center text-sm border-t border-white/10 mt-auto">
        © {{ date('Y') }} {{ $settings['nama_kelompok'] ?? 'KKN Desa Rowokele' }} · Dibangun dengan ❤️ untuk desa
    </footer>
    {{-- FILTER ENGINE PLUG JS MURNI --}}
    <script>
        // Control Dropdown Mobile Navigation
        const btnMenuMobile = document.getElementById('btn-menu-mobile');
        const dropdownMenuMobile = document.getElementById('dropdown-menu-mobile');
        const iconMenuMobile = document.getElementById('icon-menu-mobile');
        
        if (btnMenuMobile && dropdownMenuMobile) {
            btnMenuMobile.addEventListener('click', () => {
                const isHidden = dropdownMenuMobile.classList.contains('hidden');
                if (isHidden) {
                    dropdownMenuMobile.classList.remove('hidden');
                    iconMenuMobile.classList.remove('fa-bars');
                    iconMenuMobile.classList.add('fa-times');
                } else {
                    dropdownMenuMobile.classList.add('hidden');
                    iconMenuMobile.classList.remove('fa-times');
                    iconMenuMobile.classList.add('fa-bars');
                }
            });
        }

        // Filter Kegiatan Engine
        function jalankanFilterKegiatan(statusKunci) {
            const semuaKartu = document.querySelectorAll('.card-item-kegiatan');
            const semuaTombol = document.querySelectorAll('.filter-btn-kegiatan');
            const boxKosong = document.getElementById('box-kegiatan-kosong');
            const counterText = document.getElementById('total-kegiatan-count');
            let jumlahAktif = 0;
            
            semuaTombol.forEach(tombol => {
                if (tombol.id === 'btn-filter-' + statusKunci) {
                    tombol.className = "filter-btn-kegiatan flex-shrink-0 snap-start px-5 py-2.5 rounded-xl text-sm font-semibold transition-all duration-300 cursor-pointer border-2 scale-105 bg-amber-600 text-white shadow-lg border-amber-600";
                } else {
                    tombol.className = "filter-btn-kegiatan flex-shrink-0 snap-start px-5 py-2.5 rounded-xl text-sm font-semibold transition-all duration-300 cursor-pointer border-2 border-transparent bg-stone-50 text-stone-600 hover:bg-stone-100";
                }
            });
            semuaKartu.forEach(kartu => {
                if (statusKunci === 'semua' || kartu.getAttribute('data-status') === statusKunci) {
                    kartu.style.display = 'block';
                    jumlahAktif++;
                } else {
                    kartu.style.display = 'none';
                }
            });
            
            if(counterText) counterText.textContent = jumlahAktif;
            if (jumlahAktif === 0) boxKosong.classList.remove('hidden');
            else boxKosong.classList.add('hidden');
        }

        document.addEventListener('DOMContentLoaded', () => {
            const obs = new IntersectionObserver((entries) => {
                entries.forEach((e) => { if (e.isIntersecting) { e.target.classList.add('in-view'); obs.unobserve(e.target); } });
            }, { threshold: 0.1 });
            document.querySelectorAll('.reveal').forEach((el) => obs.observe(el));
        });
    </script>
</body>
</html>