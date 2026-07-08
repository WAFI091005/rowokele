<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title ?? 'Website KKN Desa Rowokele' }}</title>
    
    {{-- Favicon --}}
    <link rel="icon" type="image/webp" href="{{ asset('img/logo1.webp') }}">
    <link rel="apple-touch-icon" href="{{ asset('img/logo1.webp') }}">
    
    {{-- Preconnect untuk CDN --}}
    <link rel="preconnect" href="https://cdnjs.cloudflare.com">
    <link rel="dns-prefetch" href="https://cdnjs.cloudflare.com">
    
    {{-- Vite (biarin aja) --}}
    @vite(['resources/css/app.css'])
    
    {{-- Font Awesome --}}
    <link rel="preload" as="style" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    
    <style>
        /* Critical CSS - langsung dirender */
        @keyframes blob {
            0%, 100% { transform: translate(0, 0) scale(1); }
            33% { transform: translate(30px, -40px) scale(1.1); }
            66% { transform: translate(-20px, 20px) scale(0.95); }
        }
        .animate-blob { animation: blob 14s infinite ease-in-out; }
        .animation-delay-2000 { animation-delay: 2s; }
        .animation-delay-4000 { animation-delay: 4s; }
        .reveal { opacity: 0; transform: translateY(28px); transition: opacity .8s cubic-bezier(.2,.8,.2,1), transform .8s cubic-bezier(.2,.8,.2,1); }
        .reveal.in-view { opacity: 1; transform: none; }
        [x-cloak] { display: none !important; }

        /* Custom Wave */
        .wave-shape {
            position: absolute;
            bottom: -3px;
            left: 0;
            width: 100%;
            line-height: 0;
        }

        .menu-circle {
            width: 85px;
            height: 85px;
            border-radius: 50%;
            background: #d97706;
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
            background: #78350f;
            clip-path: polygon(
                20% 0%, 40% 5%, 60% 0%, 80% 15%, 100% 40%,
                95% 70%, 80% 100%, 55% 90%, 30% 100%, 5% 80%, 0% 40%
            );
        }

        .event-card-hover:hover {
            transform: translateY(-8px);
            box-shadow: 0 20px 40px rgba(120, 53, 15, 0.08);
        }

        .float-animation {
            animation: float 6s ease-in-out infinite;
        }
        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-15px); }
        }

        .hero-overlay {
            background: linear-gradient(135deg, rgba(0,0,0,.35) 0%, rgba(0,0,0,.1) 100%);
        }

        /* Navbar dari file kedua - lebih solid */
        .navbar-glass-permanent {
            background: rgba(253, 251, 247, 0.85);
            backdrop-filter: blur(16px) saturate(120%);
            -webkit-backdrop-filter: blur(16px) saturate(120%);
            border-bottom: 1px solid rgba(120, 53, 15, 0.1);
        }

        @media (max-width: 768px) {
            .menu-circle {
                width: 65px;
                height: 65px;
                font-size: 22px;
            }
            .hero-content h1 {
                font-size: 42px !important;
            }
        }

        /* Tambahan untuk smooth scroll */
        .scroll-smooth {
            scroll-behavior: smooth;
        }
    </style>
</head>
<body class="bg-[#fdfbf7] text-stone-800 antialiased min-h-screen flex flex-col">

    {{-- NAVBAR - Menggunakan desain dari file kedua --}}
    @php($__nav = app(\App\Services\FirebaseService::class)->settings())

    <nav class="fixed top-0 inset-x-0 z-50 navbar-glass-permanent min-h-20 flex flex-col justify-center shadow-sm border-b-0 md:border-b border-[#78350f]/10">
        <div class="max-w-7xl mx-auto px-6 lg:px-12 w-full h-20 flex items-center justify-between">
            {{-- Logo --}}
            <a href="/" class="flex items-center gap-3 font-black text-2xl tracking-tight text-stone-900">
                <span class="inline-flex items-center justify-center w-10 h-10 rounded-xl overflow-hidden shadow-md">
                    <img src="{{ asset('img/logo.webp') }}" alt="Logo" class="w-full h-full object-cover" width="40" height="40">
                </span>
                <span>{{ $__nav['nama_kelompok'] ?? 'KKN Rowokele' }}</span>
            </a>

            {{-- Desktop Menu --}}
            @php($__links = ['/' => 'Home', '/proker' => 'Program', '/kegiatan' => 'Kegiatan', '/anggota' => 'Tim', '/berita' => 'Berita', '/galeri' => 'Galeri'])
            
            <div class="hidden md:flex items-center gap-1">
                @foreach ($__links as $href => $label)
                    <a href="{{ $href }}"
                       class="px-5 py-2 rounded-full text-sm font-medium transition duration-300
                       {{ request()->is(trim($href, '/') ?: '/') 
                           ? 'text-amber-700 bg-amber-600/10 font-bold' 
                           : 'text-stone-600 hover:text-amber-700 hover:bg-amber-600/5' }}">
                        {{ $label }}
                    </a>
                @endforeach
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
            @foreach ($__links as $href => $label)
                <a href="{{ $href }}" 
                   class="block px-4 py-2.5 rounded-xl text-base font-medium transition
                   {{ request()->is(trim($href, '/') ?: '/') 
                       ? 'text-amber-700 bg-amber-600/10 font-bold' 
                       : 'text-stone-600 hover:text-amber-700 hover:bg-amber-600/5' }}">
                    {{ $label }}
                </a>
            @endforeach
        </div>
    </nav>

    {{-- MAIN CONTENT --}}
    <main class="flex-1 w-full pt-20">
        @yield('content')
    </main>

    {{-- FOOTER - Menggunakan desain dari file kedua --}}
    <footer class="bg-[#b85c27] text-white/90 py-12 text-center text-sm border-t border-white/10 mt-auto">
        <div class="max-w-7xl mx-auto px-6 lg:px-12">
            <div class="grid md:grid-cols-3 gap-10 text-left pb-8">
                <div>
                    <h3 class="text-2xl font-bold mb-3 flex items-center gap-3">
                        <img src="{{ asset('img/logo.webp') }}" alt="Logo KKN" class="w-10 h-10 rounded-xl object-cover shadow-lg" width="40" height="40" loading="lazy">
                        {{ $__nav['nama_kelompok'] ?? 'KKN Sukamaju' }}
                    </h3>
                    <p class="text-sm leading-relaxed text-amber-100/80">{{ $__nav['deskripsi'] ?? 'Kelompok KKN yang mengabdi untuk kemajuan dan kesejahteraan desa.' }}</p>
                </div>
                <div>
                    <h4 class="font-bold text-sm uppercase tracking-wider mb-4 text-amber-300">Navigasi</h4>
                    <ul class="space-y-2.5 text-sm font-medium">
                        <li><a href="/proker" class="text-white/70 hover:text-amber-300 transition">Program Kerja</a></li>
                        <li><a href="/kegiatan" class="text-white/70 hover:text-amber-300 transition">Kegiatan Desa</a></li>
                        <li><a href="/anggota" class="text-white/70 hover:text-amber-300 transition">Anggota Tim</a></li>
                        <li><a href="/berita" class="text-white/70 hover:text-amber-300 transition">Berita</a></li>
                        <li><a href="/galeri" class="text-white/70 hover:text-amber-300 transition">Galeri</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="font-bold text-sm uppercase tracking-wider mb-4 text-amber-300">Kontak</h4>
                    <ul class="space-y-2.5 text-sm text-white/70">
                        @if (!empty($__nav['alamat']))<li class="flex gap-2"><i class="fas fa-map-pin mt-1 text-amber-400"></i> {{ $__nav['alamat'] }}</li>@endif
                        @if (!empty($__nav['email']))<li class="flex gap-2"><i class="fas fa-envelope mt-1 text-amber-400"></i> {{ $__nav['email'] }}</li>@endif
                        @if (!empty($__nav['instagram']))<li class="flex gap-2"><i class="fab fa-instagram mt-1 text-amber-400"></i> {{ $__nav['instagram'] }}</li>@endif
                    </ul>
                </div>
            </div>
            <div class="border-t border-white/10 pt-6 text-center text-xs text-white/60 font-medium">
                &copy; {{ date('Y') }} {{ $__nav['nama_kelompok'] ?? 'KKN Desa Sukamaju' }} &middot; Dibangun dengan ❤️ untuk desa
            </div>
        </div>
    </footer>

    {{-- Script untuk Mobile Menu --}}
    <script>
        // Intersection Observer untuk animasi reveal
        function initReveal() {
            const obs = new IntersectionObserver((entries) => {
                entries.forEach((e) => {
                    if (e.isIntersecting) { e.target.classList.add('in-view'); obs.unobserve(e.target); }
                });
            }, { threshold: 0.1 });
            document.querySelectorAll('.reveal:not(.in-view)').forEach((el) => obs.observe(el));
        }
        document.addEventListener('DOMContentLoaded', initReveal);

        // Mobile Navbar Dropdown
        document.addEventListener('DOMContentLoaded', function() {
            const menuBtn = document.getElementById('mobile-menu-btn');
            const mobileMenu = document.getElementById('mobile-menu');
            const menuIcon = document.getElementById('menu-icon');

            if (menuBtn && mobileMenu) {
                menuBtn.addEventListener('click', function() {
                    mobileMenu.classList.toggle('hidden');
                    
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