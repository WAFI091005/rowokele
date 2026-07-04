@extends('layouts.app')

@section('title', 'Tim Kelompok KKN - Desa Rowokele')

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
    
    <div class="absolute top-0 right-0 w-96 h-96 bg-amber-400/20 rounded-full blur-3xl animate-blob"></div>
    <div class="absolute bottom-0 left-0 w-80 h-80 bg-orange-400/20 rounded-full blur-3xl animate-blob"></div>
    
    <div class="relative max-w-7xl mx-auto px-6 lg:px-12 py-20 w-full text-white">
        <div class="max-w-3xl">
            <div class="flex items-center gap-3 mb-6">
                <span class="inline-block w-12 h-0.5 bg-amber-400"></span>
                <span class="text-amber-300 text-xs font-semibold tracking-[0.2em] uppercase">Tim Kami</span>
            </div>
            <h1 class="text-4xl md:text-6xl font-bold leading-tight mb-4">
                Anggota Kelompok
                <span class="text-amber-300 block mt-2">{{ $settings['nama_desa'] ?? 'Desa Rowokele' }}</span>
            </h1>
            <p class="text-amber-100/80 text-base md:text-lg max-w-xl leading-relaxed">Tim yang bertugas dalam kegiatan pengabdian masyarakat untuk kemajuan dan kesejahteraan desa.</p>
        </div>
    </div>
    
    <div class="absolute bottom-0 left-0 w-full leading-none overflow-hidden">
        <svg class="block w-full h-[120px]" viewBox="0 0 1440 120" preserveAspectRatio="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M0,120 C180,70 360,10 720,40 C980,65 1180,90 1440,80 L1440,120 L0,120 Z" fill="#fdfbf7"/>
        </svg>
    </div>
</section>

{{-- CONTAINER ROOT REACT APP (Data murni di-passing mulus ke React JSX kamu) --}}
<div id="anggota-root" data-anggota="{{ json_encode($anggota ?? []) }}"></div>

{{-- Hot Reload & Asset Injector Compiler Vite --}}
@viteReactRefresh
@vite('resources/js/app.jsx')
@endsection