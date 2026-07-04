@extends('layouts.app')

@section('title', 'Program Kerja KKN - Desa Rowokele')

@section('content')
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
    <div class="relative max-w-7xl mx-auto px-6 lg:px-12 py-20 w-full text-white">
        <div class="max-w-3xl">
            <div class="flex items-center gap-3 mb-6">
                <span class="inline-block w-12 h-0.5 bg-amber-400"></span>
                <span class="text-amber-300 text-xs font-semibold tracking-[0.2em] uppercase">Program Kerja</span>
            </div>
            <h1 class="text-4xl md:text-6xl font-bold leading-tight mb-4">
                Program Kerja
                <span class="text-amber-300 block mt-2">{{ $settings['nama_desa'] ?? 'Desa Rowokele' }}</span>
            </h1>
            <p class="text-amber-100/80 text-base md:text-lg max-w-xl leading-relaxed">Daftar agenda dan klasifikasi seluruh kegiatan pengabdian masyarakat yang telah, sedang, dan akan dilaksanakan.</p>
        </div>
    </div>
    <div class="absolute bottom-0 left-0 w-full leading-none overflow-hidden">
        <svg class="block w-full h-[120px]" viewBox="0 0 1440 120" preserveAspectRatio="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M0,120 C180,70 360,10 720,40 C980,65 1180,90 1440,80 L1440,120 L0,120 Z" fill="#fdfbf7"/>
        </svg>
    </div>
</section>

{{-- FILTER SECTION --}}
<section class="max-w-7xl mx-auto px-6 lg:px-12 -mt-12 relative z-10">
    <div class="bg-white rounded-3xl shadow-xl border border-stone-100 p-6 md:p-8">
        <div class="flex flex-col lg:flex-row lg:items-center justify-between gap-4">
            <div class="flex items-center gap-2">
                <i class="fas fa-filter text-stone-400"></i>
                <span class="text-sm font-semibold text-stone-700">Filter:</span>
            </div>
            
            {{-- Di mobile, bagian filter ini bisa di-geser/scroll horizontal --}}
            <div class="flex items-center gap-2 overflow-x-auto pb-2 lg:pb-0 [scrollbar-width:none] [&::-webkit-scrollbar]:hidden snap-x">
                @php
                    $filters = ['semua' => 'Semua', 'rencana' => 'Rencana', 'berjalan' => 'Berjalan', 'selesai' => 'Selesai'];
                @endphp
                @foreach ($filters as $key => $label)
                    <button type="button" id="btn-filter-proker-{{ $key }}" onclick="jalankanFilterProker('{{ $key }}')" class="filter-btn-proker flex-shrink-0 snap-start px-5 py-2.5 rounded-xl text-sm font-semibold transition-all duration-300 border-2 border-transparent {{ $key === 'semua' ? 'bg-amber-600 text-white shadow-lg border-amber-600' : 'bg-stone-50 text-stone-600 hover:bg-stone-100' }}">
                        {{ $label }}
                        <span id="badge-proker-{{ $key }}" class="inline-flex items-center justify-center w-5 h-5 ml-1 text-xs rounded-full {{ $key === 'semua' ? 'bg-white/20 text-white' : 'bg-stone-200 text-stone-600' }}">
                            @if($key === 'semua')
                                {{ count($prokers) }}
                            @else
                                {{ count(array_filter($prokers, fn($item) => strtolower($item['status'] ?? 'rencana') === $key)) }}
                            @endif
                        </span>
                    </button>
                @endforeach
            </div>
            
            <div class="flex items-center gap-2 text-sm text-stone-400 border-t pt-3 lg:border-none lg:pt-0">
                <span id="total-program-count" class="font-medium text-amber-600">{{ count($prokers) }}</span>
                <span>program ditemukan</span>
            </div>
        </div>
    </div>
</section>

{{-- GRID CARDS --}}
<section class="max-w-7xl mx-auto px-6 lg:px-12 py-16">
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
        @forelse ($prokers as $index => $p)
            @php $statusProker = strtolower($p['status'] ?? 'rencana'); @endphp
            
            <div class="card-item-proker group bg-white rounded-2xl overflow-hidden border border-stone-200 hover:shadow-2xl hover:-translate-y-2 transition-all duration-500" data-status="{{ $statusProker }}">
                <div class="relative h-52 overflow-hidden bg-gradient-to-br from-amber-500 to-[#78350f]">
                    <div class="absolute inset-0 bg-cover bg-center group-hover:scale-110 transition-transform duration-700" style="background-image: url('{{ $p['gambar'] ?? 'https://images.unsplash.com/photo-1464822759023-fed622ff2c3b?auto=format&fit=crop&w=600&q=80' }}')"></div>
                    <div class="absolute inset-0 bg-gradient-to-t from-stone-900/80 via-stone-900/30 to-transparent"></div>
                    
                    <div class="absolute top-4 left-4 z-10">
                        <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full text-[10px] font-extrabold uppercase tracking-wider shadow-lg backdrop-blur-sm {{ $statusProker === 'selesai' ? 'bg-amber-700 text-white' : ($statusProker === 'berjalan' ? 'bg-orange-500 text-white' : 'bg-stone-100 text-stone-800') }}">
                            {{ $p['status'] ?? 'Rencana' }}
                        </span>
                    </div>
                </div>

                <div class="p-5 space-y-3">
                    <h3 class="font-bold text-sm md:text-base text-stone-900 leading-tight group-hover:text-amber-600 transition line-clamp-2">{{ $p['judul'] ?? 'Untitled Activity' }}</h3>
                    <p class="text-xs text-stone-500 leading-relaxed line-clamp-3 font-light">{{ $p['deskripsi'] ?? 'Deskripsi kegiatan belum tersedia.' }}</p>
                    
                    <div class="pt-3 border-t border-stone-100 flex items-center justify-between">
                        <div class="flex items-center gap-1.5 text-[10px] text-stone-400 font-medium">
                            <i class="far fa-calendar-alt"></i> {{ !empty($p['tanggal']) ? date('d M Y', strtotime($p['tanggal'])) : 'Coming Soon' }}
                        </div>
                        <button type="button" onclick="document.getElementById('modal-proker-{{ $index }}').style.display = 'flex'; document.body.style.overflow = 'hidden';" class="text-stone-400 hover:text-amber-600 transition group-hover:translate-x-1 bg-transparent border-none" style="cursor: pointer !important;">
                            <i class="fas fa-arrow-right"></i>
                        </button>
                    </div>
                </div>
            </div>

            {{-- MODAL BOX POPUP --}}
            <div id="modal-proker-{{ $index }}" class="fixed inset-0 z-[999] items-center justify-center bg-black/80 backdrop-blur-sm p-4 hidden">
                <div class="relative max-w-3xl w-full max-h-[90vh] bg-white rounded-3xl overflow-hidden shadow-2xl flex flex-col" onclick="event.stopPropagation()">
                    <button type="button" onclick="document.getElementById('modal-proker-{{ $index }}').style.display = 'none'; document.body.style.overflow = 'auto';" class="absolute top-4 right-4 z-20 w-10 h-10 rounded-full bg-black/50 hover:bg-black/70 text-white flex items-center justify-center border-none" style="cursor: pointer !important;">
                        <i class="fas fa-times"></i>
                    </button>
                    
                    <div class="overflow-y-auto w-full h-full">
                        <div class="relative h-64 md:h-80 w-full bg-stone-100 overflow-hidden">
                            <img src="{{ $p['gambar'] ?? 'https://images.unsplash.com/photo-1464822759023-fed622ff2c3b?auto=format&fit=crop&w=600&q=80' }}" class="w-full h-full object-cover">
                        </div>
                        <div class="p-6 md:p-8 space-y-4">
                            <h2 class="text-2xl md:text-3xl font-bold text-stone-900">{{ $p['judul'] ?? 'Untitled Activity' }}</h2>
                            <p class="text-xs text-stone-400 font-medium"><i class="fas fa-calendar-day mr-1"></i>{{ !empty($p['tanggal']) ? date('d F Y', strtotime($p['tanggal'])) : 'Coming Soon' }}</p>
                            <div class="text-stone-600 text-sm md:text-base leading-relaxed whitespace-pre-line border-t pt-4">{{ $p['deskripsi'] ?? 'Deskripsi program kerja belum tersedia.' }}</div>
                        </div>
                    </div>
                    <div class="p-4 bg-stone-50 border-t flex items-center justify-end">
                        <button type="button" onclick="document.getElementById('modal-proker-{{ $index }}').style.display = 'none'; document.body.style.overflow = 'auto';" class="px-5 py-2 bg-amber-600 text-white text-sm font-semibold rounded-xl hover:bg-amber-700 transition shadow-md border-none" style="cursor: pointer !important;">Tutup Detail</button>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-span-full text-center py-16 text-stone-400">Belum ada data program kerja.</div>
        @endforelse

        {{-- INFOMORFIK JIKA HASIL FILTER KOSONG --}}
        <div id="box-proker-kosong" class="col-span-full hidden">
            <div class="py-20 text-center bg-gradient-to-br from-amber-50 to-orange-50 rounded-3xl border-2 border-dashed border-amber-200">
                <h3 class="text-xl font-bold text-stone-700 mb-2">Tidak Ada Program Kerja</h3>
                <p class="text-sm text-stone-500">Tidak ada agenda program kerja pada kategori ini.</p>
                <button type="button" onclick="jalankanFilterProker('semua')" class="mt-4 px-6 py-2.5 bg-amber-600 text-white rounded-xl text-sm font-semibold hover:bg-amber-700 shadow-md border-none" style="cursor: pointer !important;">Tampilkan Semua</button>
            </div>
        </div>
    </div>
</section>

{{-- FILTER ENGINE PLUG JS MURNI --}}
<script>
    // Engine Filter Kategori
    function jalankanFilterProker(statusKunci) {
        const semuaKartu = document.querySelectorAll('.card-item-proker');
        const semuaTombol = document.querySelectorAll('.filter-btn-proker');
        const boxKosong = document.getElementById('box-proker-kosong');
        const counterText = document.getElementById('total-program-count');
        let jumlahAktif = 0;

        semuaTombol.forEach(tombol => {
            if (tombol.id === 'btn-filter-proker-' + statusKunci) {
                tombol.className = "filter-btn-proker flex-shrink-0 snap-start px-5 py-2.5 rounded-xl text-sm font-semibold transition-all duration-300 cursor-pointer border-2 scale-105 bg-amber-600 text-white shadow-lg border-amber-600";
            } else {
                tombol.className = "filter-btn-proker flex-shrink-0 snap-start px-5 py-2.5 rounded-xl text-sm font-semibold transition-all duration-300 cursor-pointer border-2 border-transparent bg-stone-50 text-stone-600 hover:bg-stone-100";
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

    // Init Reveal Transisi Efek Scroll
    document.addEventListener('DOMContentLoaded', () => {
        const obs = new IntersectionObserver((entries) => {
            entries.forEach((e) => { if (e.isIntersecting) { e.target.classList.add('in-view'); obs.unobserve(e.target); } });
        }, { threshold: 0.1 });
        document.querySelectorAll('.reveal').forEach((el) => obs.observe(el));
    });
</script>
@endsection