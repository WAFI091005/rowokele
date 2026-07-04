@extends('layouts.app')

@section('title', 'Galeri Kegiatan KKN - Desa Rowokele')

@section('content')
{{-- HERO SECTION --}}
<section class="relative min-h-[350px] flex items-center overflow-hidden" style="background: linear-gradient(135deg, #78350f, #b45309);">
    <div class="absolute inset-0 opacity-10">
        <svg class="absolute inset-0 w-full h-full" xmlns="http://www.w3.org/2000/svg">
            <pattern id="grid" width="40" height="40" patternUnits="userSpaceOnUse">
                <path d="M 40 0 L 0 0 0 40" fill="none" stroke="white" stroke-width="0.5"/>
            </pattern>
            <rect width="100%" height="100%" fill="url(#grid)" />
        </svg>
    </div>
    
    <div class="absolute top-0 right-0 w-96 h-96 bg-amber-400/20 rounded-full blur-3xl"></div>
    <div class="absolute bottom-0 left-0 w-80 h-80 bg-orange-400/20 rounded-full blur-3xl"></div>
    
    <div class="relative max-w-7xl mx-auto px-6 lg:px-12 py-16 w-full text-white">
        <div class="max-w-3xl">
            <div class="flex items-center gap-3 mb-6">
                <span class="inline-block w-12 h-0.5 bg-amber-400"></span>
                <span class="text-amber-300 text-xs font-semibold tracking-[0.2em] uppercase">Dokumentasi</span>
            </div>
            <h1 class="text-4xl md:text-6xl font-bold leading-tight mb-4">
                Galeri Kegiatan
                <span class="text-amber-300 block mt-2">{{ $settings['nama_desa'] ?? 'Desa Rowokele' }}</span>
            </h1>
            <p class="hidden md:block text-amber-100/80 text-base md:text-lg max-w-xl leading-relaxed">Dokumentasi lengkap kegiatan dan program kerja yang telah dilaksanakan oleh tim.</p>
        </div>
    </div>
    
    <div class="absolute bottom-0 left-0 w-full leading-none overflow-hidden">
        <svg class="block w-full h-[120px]" viewBox="0 0 1440 120" preserveAspectRatio="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M0,120 C180,70 360,10 720,40 C980,65 1180,90 1440,80 L1440,120 L0,120 Z" fill="#fdfbf7"/>
        </svg>
    </div>
</section>

{{-- GALERI GRID --}}
<section class="max-w-7xl mx-auto px-6 lg:px-12 py-16">
    <div class="flex flex-wrap items-center justify-between gap-4 mb-10">
        <div>
            <h2 class="text-2xl md:text-3xl font-bold text-[#78350f]">Dokumentasi Kegiatan</h2>
            <p class="text-stone-500 text-sm mt-1">Klik foto untuk melihat lebih detail</p>
        </div>
        <div class="flex items-center gap-2 text-sm text-stone-400 bg-white px-4 py-2 rounded-xl shadow-sm border border-stone-100">
            <span class="font-medium text-stone-700">{{ count($galeri ?? []) }}</span>
            <span>foto</span>
        </div>
    </div>
    <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
        @forelse (($galeri ?? []) as $index => $g)
            <div onclick="bukaLightbox({{ $index }})" class="reveal group relative rounded-2xl overflow-hidden shadow-sm bg-stone-100 aspect-square cursor-pointer hover:shadow-xl transition-all duration-500 hover:-translate-y-1">
                @if (!empty($g['image_url']))
                    <img src="{{ $g['image_url'] }}" alt="{{ $g['caption'] ?? 'Foto kegiatan' }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                @else
                    <div class="w-full h-full flex items-center justify-center text-5xl text-stone-300 bg-gradient-to-br from-stone-50 to-stone-100">📸</div>
                @endif
                
                <div class="absolute inset-0 bg-gradient-to-t from-stone-900/70 via-stone-900/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500">
                    <div class="absolute inset-0 flex items-center justify-center">
                        <div class="bg-white/20 backdrop-blur-sm rounded-full p-3">
                            <i class="fas fa-search-plus text-white text-xl"></i>
                        </div>
                    </div>
                </div>
                
                @if(!empty($g['caption']))
                    <div class="absolute bottom-0 inset-x-0 p-3">
                        <p class="text-white text-xs font-medium line-clamp-2 drop-shadow-lg opacity-0 group-hover:opacity-100 transition-opacity duration-500">{{ $g['caption'] }}</p>
                    </div>
                @endif
            </div>
        @empty
            <div class="col-span-full">
                <div class="py-20 text-center bg-gradient-to-br from-amber-50 to-orange-50 rounded-3xl border-2 border-dashed border-amber-200">
                    <h3 class="text-2xl font-bold text-stone-700 mb-2">Belum Ada Foto</h3>
                    <p class="text-sm text-stone-500">Belum ada dokumentasi kegiatan yang diunggah saat ini.</p>
                </div>
            </div>
        @endforelse
    </div>
</section>

{{-- LIGHTBOX MODAL MASTER (VANILLA JS) --}}
<div id="master-lightbox" class="fixed inset-0 z-[999] items-center justify-center bg-black/95 backdrop-blur-sm p-4 hidden">
    <div class="relative max-w-4xl w-full max-h-[90vh] bg-white rounded-3xl overflow-hidden shadow-2xl flex flex-col">
        <button type="button" onclick="tutupLightbox()" class="absolute top-4 right-4 z-20 w-10 h-10 rounded-full bg-black/50 hover:bg-black/70 text-white flex items-center justify-center border-none" style="cursor: pointer !important;">
            <i class="fas fa-times"></i>
        </button>
        
        <button type="button" onclick="slideSebelumnya()" class="absolute left-4 top-1/2 -translate-y-1/2 z-20 w-10 h-10 rounded-full bg-black/50 hover:bg-black/70 text-white flex items-center justify-center border-none shadow-md" style="cursor: pointer !important;">
            <i class="fas fa-chevron-left"></i>
        </button>
        
        <button type="button" onclick="slideBerikutnya()" class="absolute right-4 top-1/2 -translate-y-1/2 z-20 w-10 h-10 rounded-full bg-black/50 hover:bg-black/70 text-white flex items-center justify-center border-none shadow-md" style="cursor: pointer !important;">
            <i class="fas fa-chevron-right"></i>
        </button>
        
        <div class="relative w-full h-[60vh] bg-stone-100 flex items-center justify-center overflow-hidden border-b">
            <img id="lightbox-img" src="" class="w-full h-full object-contain">
        </div>
        
        <div class="p-6 bg-white shrink-0">
            <div class="flex items-center justify-between">
                <div class="space-y-1">
                    <p id="lightbox-caption" class="text-sm font-semibold text-stone-800"></p>
                    <p id="lightbox-counter" class="text-xs text-stone-400"></p>
                </div>
                <button type="button" onclick="tutupLightbox()" class="px-5 py-2 bg-amber-600 text-white text-sm font-semibold rounded-xl hover:bg-amber-700 transition shadow-md border-none" style="cursor: pointer !important;">Tutup</button>
            </div>
        </div>
    </div>
</div>

{{-- JAVASCRIPT MASTER CONTROLLER --}}
<script>
    // Parsing data dari backend murni
    const daftarFoto = @json($galeri ?? []);
    let indeksAktif = 0;

    function bukaLightbox(index) {
        if (!daftarFoto[index]) return;
        indeksAktif = index;
        
        document.getElementById('lightbox-img').src = daftarFoto[index].image_url;
        document.getElementById('lightbox-caption').textContent = daftarFoto[index].caption ?? 'Foto Kegiatan';
        document.getElementById('lightbox-counter').textContent = `${index + 1} dari ${daftarFoto.length} foto`;
        
        const lightbox = document.getElementById('master-lightbox');
        lightbox.classList.remove('hidden');
        lightbox.classList.add('flex');
        document.body.style.overflow = 'hidden';
    }

    function tutupLightbox() {
        const lightbox = document.getElementById('master-lightbox');
        lightbox.classList.remove('flex');
        lightbox.classList.add('hidden');
        document.body.style.overflow = 'auto';
    }

    function slideBerikutnya() {
        if (indeksAktif < daftarFoto.length - 1) {
            bukaLightbox(indeksAktif + 1);
        } else {
            bukaLightbox(0); 
        }
    }

    function slideSebelumnya() {
        if (indeksAktif > 0) {
            bukaLightbox(indeksAktif - 1);
        } else {
            bukaLightbox(daftarFoto.length - 1); 
        }
    }

    // Keyboard navigation support
    document.addEventListener('keydown', (e) => {
        const lightbox = document.getElementById('master-lightbox');
        if (lightbox.classList.contains('flex')) {
            if (e.key === 'Escape') tutupLightbox();
            if (e.key === 'ArrowRight') slideBerikutnya();
            if (e.key === 'ArrowLeft') slideSebelumnya();
        }
    });

    // Init scroll animation
    document.addEventListener('DOMContentLoaded', () => {
        const obs = new IntersectionObserver((entries) => {
            entries.forEach((e) => { if (e.isIntersecting) { e.target.classList.add('in-view'); obs.unobserve(e.target); } });
        }, { threshold: 0.1 });
        document.querySelectorAll('.reveal').forEach((el) => obs.observe(el));
    });
</script>
@endsection