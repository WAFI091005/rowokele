<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tim Kelompok KKN - Desa Rowokele</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <style>
        .navbar-glass-permanent { 
            background: rgba(253, 251, 247, 0.95); 
            backdrop-filter: blur(16px); 
            border-bottom: 1px solid rgba(120, 53, 15, 0.1); 
        }
    </style>
</head>
<body class="bg-[#fdfbf7] text-stone-800 antialiased min-h-screen flex flex-col pt-20">

    {{-- NAVBAR STABIL --}}
    <nav class="fixed top-0 inset-x-0 z-50 navbar-glass-permanent flex flex-col shadow-sm">
        <div class="max-w-7xl mx-auto px-6 lg:px-12 w-full h-20 flex items-center justify-between">
            <a href="/" class="flex items-center gap-3 font-black text-2xl tracking-tight text-stone-900">
                <span class="inline-flex items-center justify-center w-10 h-10 rounded-xl overflow-hidden shadow-md">
                    <img src="{{ asset('img/logo.jpeg') }}" alt="Logo" class="w-full h-full object-cover">
                </span>
                <span>{{ $settings['nama_kelompok'] ?? 'KKN Rowokele' }}</span>
            </a>
            
            {{-- Desktop Menu --}}
            <div class="hidden md:flex items-center gap-1">
                <a href="/" class="px-5 py-2 rounded-full text-sm font-medium text-stone-600 hover:text-amber-700 hover:bg-amber-600/5 transition">Home</a>
                <a href="/proker" class="px-5 py-2 rounded-full text-sm font-medium text-stone-600 hover:text-amber-700 hover:bg-amber-600/5 transition">Program</a>
                <a href="/kegiatan" class="px-5 py-2 rounded-full text-sm font-medium text-stone-600 hover:text-amber-700 hover:bg-amber-600/5 transition">Kegiatan</a>
                <a href="/anggota" class="px-5 py-2 rounded-full text-sm font-bold text-amber-700 bg-amber-600/10">Tim</a>
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
            <a href="/" class="block px-4 py-2.5 rounded-xl text-base font-medium text-stone-600 hover:text-amber-700 hover:bg-amber-600/5 transition">Home</a>
            <a href="/proker" class="block px-4 py-2.5 rounded-xl text-base font-medium text-stone-600 hover:text-amber-700 hover:bg-amber-600/5 transition">Program</a>
            <a href="/kegiatan" class="block px-4 py-2.5 rounded-xl text-base font-medium text-stone-600 hover:text-amber-700 hover:bg-amber-600/5 transition">Kegiatan</a>
            <a href="/anggota" class="block px-4 py-2.5 rounded-xl text-base font-bold text-amber-700 bg-amber-600/10">Tim</a>
            <a href="/berita" class="block px-4 py-2.5 rounded-xl text-base font-medium text-stone-600 hover:text-amber-700 hover:bg-amber-600/5 transition">Berita</a>
            <a href="/galeri" class="block px-4 py-2.5 rounded-xl text-base font-medium text-stone-600 hover:text-amber-700 hover:bg-amber-600/5 transition">Galeri</a>
        </div>
    </nav>

    <div class="w-full bg-[#fdfbf7]">
        
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
        <div id="anggota-root" data-anggota="{{ json_encode($anggota) }}"></div>

    </div>

    {{-- FOOTER --}}
    <footer class="bg-[#b85c27] text-white/90 py-12 text-center text-sm border-t border-white/10 mt-auto">
        © {{ date('Y') }} {{ $settings['nama_kelompok'] ?? 'KKN Desa Rowokele' }} · Dibangun dengan ❤️ untuk desa
    </footer>

    {{-- Hot Reload & Asset Injector Compiler Vite (Wajib dicetak agar app.jsx mengenali kontainer di atas) --}}
    @viteReactRefresh
    @vite('resources/js/app.jsx')

    {{-- Mobile Navbar Dropdown Controller --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const menuBtn = document.getElementById('mobile-menu-btn');
            const mobileMenu = document.getElementById('mobile-menu');
            const menuIcon = document.getElementById('menu-icon');

            if (menuBtn && mobileMenu) {
                menuBtn.addEventListener('click', function() {
                    mobileMenu.classList.toggle('hidden');
                    
                    // Toggle icon antara hamburger (fa-bars) dan silang (fa-xmark)
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