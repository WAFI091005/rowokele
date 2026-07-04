@extends('layouts.app')

@section('title', 'Berita KKN - Desa Rowokele')

@section('content')
{{-- HERO SECTION --}}
<section class="relative min-h-[400px] flex items-center overflow-hidden" style="background: linear-gradient(135deg, #78350f, #b45309);">
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
    
    <div class="relative max-w-7xl mx-auto px-6 lg:px-12 py-20 w-full">
        <div class="max-w-3xl">
            <div class="flex items-center gap-3 mb-6">
                <span class="inline-block w-12 h-0.5 bg-amber-400"></span>
                <span class="text-amber-300 text-xs font-semibold tracking-[0.2em] uppercase">Berita & Kegiatan</span>
            </div>
            <h1 class="text-4xl md:text-6xl font-bold text-white leading-tight mb-4">
                Berita Terbaru
                <span class="text-amber-300 block mt-2">{{ $settings['nama_desa'] ?? 'Desa Rowokele' }}</span>
            </h1>
            <p class="text-amber-100/80 text-base md:text-lg max-w-xl leading-relaxed">Update terkini tentang kegiatan dan program kerja yang dilaksanakan oleh tim KKN.</p>
        </div>
    </div>
    
    <div class="absolute bottom-0 left-0 w-full leading-none overflow-hidden">
        <svg class="block w-full h-[120px]" viewBox="0 0 1440 120" preserveAspectRatio="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M0,120 C180,70 360,10 720,40 C980,65 1180,90 1440,80 L1440,120 L0,120 Z" fill="#fdfbf7"/>
        </svg>
    </div>
</section>

{{-- BERITA GRID --}}
<section class="max-w-7xl mx-auto px-6 lg:px-12 py-16">
    <div class="flex flex-wrap items-center justify-between gap-4 mb-10">
        <div>
            <h2 class="text-2xl md:text-3xl font-bold text-[#78350f]">Daftar Berita</h2>
            <p class="text-stone-500 text-sm mt-1">Update kegiatan dan program kerja terbaru</p>
        </div>
        <div class="flex items-center gap-2 text-sm text-stone-400 bg-white px-4 py-2 rounded-xl shadow-sm border border-stone-100">
            <span class="font-medium text-stone-700">{{ count($berita ?? []) }}</span>
            <span>berita</span>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse ($berita ?? [] as $index => $item)
            <div class="reveal group bg-white rounded-2xl overflow-hidden border border-stone-100 shadow-sm hover:shadow-xl hover:-translate-y-2 transition-all duration-500">
                <div class="relative h-56 overflow-hidden bg-gradient-to-br from-amber-500 to-[#78350f]">
                    @if (!empty($item['gambar']))
                        <img src="{{ $item['gambar'] }}" alt="{{ $item['judul'] ?? 'Berita' }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                    @else
                        <div class="w-full h-full flex items-center justify-center text-white text-6xl opacity-30">
                            <i class="fas fa-newspaper"></i>
                        </div>
                    @endif
                    <div class="absolute inset-0 bg-gradient-to-t from-stone-900/60 via-transparent to-transparent"></div>
                    
                    @if(!empty($item['tanggal_formatted']))
                        <div class="absolute bottom-4 left-4 z-10">
                            <span class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-white/90 backdrop-blur-sm rounded-lg text-xs font-semibold text-stone-700 shadow-sm">
                                <i class="far fa-calendar-alt text-amber-600"></i> {{ $item['tanggal_formatted'] }}
                            </span>
                        </div>
                    @endif
                </div>
                
                <div class="p-6 space-y-3">
                    <h3 class="font-bold text-base md:text-lg text-stone-900 leading-tight group-hover:text-amber-600 transition line-clamp-2">{{ $item['judul'] ?? 'Judul Berita' }}</h3>
                    <p class="text-sm text-stone-500 leading-relaxed line-clamp-3">{{ $item['deskripsi'] ?? '' }}</p>
                    
                    <div class="pt-3 border-t border-stone-100 flex items-center justify-between">
                        <span class="text-[10px] text-stone-400 font-medium"><i class="fas fa-user-edit mr-1"></i> Admin Kelompok</span>
                        <button type="button" onclick="bukaModalBerita('{{ $index }}')" class="text-amber-600 text-sm font-semibold hover:underline flex items-center gap-1 group-hover:translate-x-1 transition-transform bg-transparent border-none" style="cursor: pointer !important;">
                            Baca <i class="fas fa-arrow-right text-xs"></i>
                        </button>
                    </div>
                </div>
            </div>

            {{-- DETAIL BERITA MODAL LIGHTBOX --}}
            <div id="modal-berita-{{ $index }}" class="fixed inset-0 z-[999] items-center justify-center bg-black/80 backdrop-blur-sm p-4 hidden">
                <div class="relative max-w-3xl w-full max-h-[90vh] bg-white rounded-3xl overflow-hidden shadow-2xl flex flex-col" onclick="event.stopPropagation()">
                    <button type="button" onclick="tutupModalBerita('{{ $index }}')" class="absolute top-4 right-4 z-20 w-10 h-10 rounded-full bg-black/50 hover:bg-black/70 text-white flex items-center justify-center border-none" style="cursor: pointer !important;">
                        <i class="fas fa-times"></i>
                    </button>
                    
                    <div class="overflow-y-auto w-full h-full">
                        <div class="relative h-64 md:h-80 w-full bg-stone-100 overflow-hidden">
                            <img src="{{ $item['gambar'] ?? 'https://images.unsplash.com/photo-1504711434969-e33886168f5c?auto=format&fit=crop&w=600&q=80' }}" class="w-full h-full object-cover">
                        </div>
                        <div class="p-6 md:p-8 space-y-4">
                            <div class="flex items-center gap-1.5 text-xs text-stone-400 border-b pb-4">
                                <i class="far fa-calendar-alt text-amber-600"></i> <span>{{ $item['tanggal_formatted'] ?? '-' }}</span>
                            </div>
                            <h2 class="text-2xl md:text-3xl font-bold text-stone-900 leading-tight">{{ $item['judul'] ?? 'Judul Berita' }}</h2>
                            <div class="text-stone-600 text-sm md:text-base leading-relaxed space-y-4 whitespace-pre-line pt-2">{{ $item['deskripsi'] ?? '' }}</div>
                        </div>
                    </div>
                    <div class="p-4 bg-stone-50 border-t flex items-center justify-between shrink-0">
                        <span class="text-xs text-stone-400 font-medium">Berita Ke-{{ $index + 1 }}</span>
                        <button type="button" onclick="tutupModalBerita('{{ $index }}')" class="px-5 py-2 bg-amber-600 text-white text-sm font-semibold rounded-xl hover:bg-amber-700 transition shadow-md border-none" style="cursor: pointer !important;">Selesai Membaca</button>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-span-full">
                <div class="py-20 text-center bg-gradient-to-br from-amber-50 to-orange-50 rounded-3xl border-2 border-dashed border-amber-200">
                    <h3 class="text-2xl font-bold text-stone-700 mb-2">Belum Ada Berita</h3>
                    <p class="text-sm text-stone-500">Belum ada kabar berita atau kegiatan yang dipublikasikan saat ini.</p>
                </div>
            </div>
        @endforelse
    </div>
</section>

{{-- JAVASCRIPT CONTROLLER MURNI --}}
<script>
    // Logic Modal Box Berita
    function bukaModalBerita(index) {
        const modal = document.getElementById('modal-berita-' + index);
        if (modal) {
            modal.classList.remove('hidden');
            modal.classList.add('flex');
            document.body.style.overflow = 'hidden';
        }
    }

    function tutupModalBerita(index) {
        const modal = document.getElementById('modal-berita-' + index);
        if (modal) {
            modal.classList.remove('flex');
            modal.classList.add('hidden');
            document.body.style.overflow = 'auto';
        }
    }

    // Animation Reveal Observer
    document.addEventListener('DOMContentLoaded', () => {
        const obs = new IntersectionObserver((entries) => {
            entries.forEach((e) => { if (e.isIntersecting) { e.target.classList.add('in-view'); obs.unobserve(e.target); } });
        }, { threshold: 0.1 });
        document.querySelectorAll('.reveal').forEach((el) => obs.observe(el));
    });
</script>
@endsection