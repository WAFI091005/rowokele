<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title ?? 'Website KKN Desa Rowokele' }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    {{-- Font Awesome --}}
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
        .reveal { opacity: 0; transform: translateY(28px); transition: opacity .8s cubic-bezier(.2,.8,.2,1), transform .8s cubic-bezier(.2,.8,.2,1); }
        .reveal.in-view { opacity: 1; transform: none; }
        [x-cloak] { display: none !important; }

        /* Custom Wave */
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

        /* Floating Elements */
        .float-animation {
            animation: float 6s ease-in-out infinite;
        }
        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-15px); }
        }

        /* Hero overlay gradient yang lebih soft */
        .hero-overlay {
            background: linear-gradient(135deg, rgba(0,0,0,.35) 0%, rgba(0,0,0,.1) 100%);
        }

        /* Navbar Selalu Transparan Menggunakan Backdrop Blur */
        .navbar-glass-permanent {
            background: rgba(253, 251, 247, 0.15); /* Transparan berbasis warna tema */
            backdrop-filter: blur(16px) saturate(120%);
            -webkit-backdrop-filter: blur(16px) saturate(120%);
            border-bottom: 1px solid rgba(255, 255, 255, 0.12);
        }

        /* Shadow tipis saat di-scroll agar memisah dari konten di bawahnya */
        .navbar-scrolled-shadow {
            box-shadow: 0 4px 30px rgba(120, 53, 15, 0.05);
            border-bottom: 1px solid rgba(120, 53, 15, 0.1);
            background: rgba(253, 251, 247, 0.4); /* Sedikit lebih tebal saat di-scroll agar kontras dengan teks gelap */
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
    </style>
</head>
<body class="bg-[#fdfbf7] text-stone-800 antialiased min-h-screen flex flex-col">

    {{-- NAVBAR --}}
    @php($__nav = app(\App\Services\FirebaseService::class)->settings())

    <nav x-data="{ 
        open: false, 
        scrolled: false
    }" 
    x-init="window.addEventListener('scroll', () => { 
        scrolled = window.scrollY > 50 
    })"
    class="fixed top-0 inset-x-0 z-50 transition-all duration-500 navbar-glass-permanent"
    :class="{ 'navbar-scrolled-shadow': scrolled }">
        <div class="max-w-7xl mx-auto px-6 lg:px-12">
            <div class="flex items-center justify-between h-20">
                {{-- Logo --}}
                <a href="/" class="flex items-center gap-3 font-black text-2xl tracking-tight">
                    <span class="inline-flex items-center justify-center w-10 h-10 rounded-xl shadow-md overflow-hidden bg-white/20 backdrop-blur">
                        <img src="{{ asset('img/logo.jpeg') }}" alt="Logo" class="w-full h-full object-cover">
                    </span>
                    <span class="transition-colors duration-300" :class="scrolled ? 'text-stone-900' : 'text-white'">
                        {{ $__nav['nama_kelompok'] ?? 'KKN Rowokele' }}
                    </span>
                </a>

                {{-- Desktop Links --}}
                @php($__links = ['/' => 'Home', '/proker' => 'Program', '/kegiatan' => 'Kegiatan', '/anggota' => 'Tim', '/berita' => 'Berita', '/galeri' => 'Galeri'])

                <div class="hidden md:flex items-center gap-1">
                    @foreach ($__links as $href => $label)
                        <a href="{{ $href }}"
                           class="px-5 py-2 rounded-full text-sm font-medium transition duration-300"
                           :class="{
                               'text-amber-300 bg-white/10 shadow-sm font-semibold': '{{ request()->is(trim($href, '/') ?: '/') }}' && !scrolled,
                               'text-white/80 hover:text-white hover:bg-white/10': !'{{ request()->is(trim($href, '/') ?: '/') }}' && !scrolled,
                               'text-amber-700 bg-amber-600/10 font-bold': '{{ request()->is(trim($href, '/') ?: '/') }}' && scrolled,
                               'text-stone-600 hover:text-amber-700 hover:bg-amber-600/5': !'{{ request()->is(trim($href, '/') ?: '/') }}' && scrolled
                           }">
                            {{ $label }}
                        </a>
                    @endforeach
                </div>

                {{-- Mobile Toggle --}}
                <button x-on:click="open = !open" class="md:hidden p-2 rounded-xl transition-colors" :class="scrolled ? 'text-stone-800' : 'text-white'">
                    <svg x-show="!open" class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16"/></svg>
                    <svg x-show="open" x-cloak class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg>
                </button>
            </div>
        </div>

        {{-- Mobile Menu (SUDAH BERSIH TANPA TOMBOL MASUK) --}}
        <div x-show="open" x-cloak x-transition.opacity class="md:hidden border-t shadow-xl"
             :class="scrolled ? 'bg-[#fdfbf7]/95 backdrop-blur border-stone-200' : 'bg-stone-900/95 backdrop-blur border-white/10'">
            <div class="px-6 py-4 space-y-1">
                @foreach ($__links as $href => $label)
                    <a href="{{ $href }}" 
                       class="block px-4 py-3 rounded-xl text-base font-medium transition"
                       :class="scrolled ? 'text-stone-800 hover:bg-stone-100' : 'text-white/90 hover:bg-white/10'">
                        {{ $label }}
                    </a>
                @endforeach
            </div>
        </div>
    </nav>

    {{-- MAIN CONTENT --}}
    <main class="flex-1 w-full">
        {{ $slot }}
    </main>

    {{-- FOOTER --}}
    <footer class="bg-[#b85c27] text-white/90 mt-16">
        <div class="max-w-7xl mx-auto px-6 lg:px-12 py-16 grid md:grid-cols-3 gap-10">
            <div>
                <h3 class="text-2xl font-bold mb-3 flex items-center gap-3">
                    <img src="{{ asset('img/logo.jpeg') }}" alt="Logo KKN" class="w-10 h-10 rounded-xl object-cover shadow-lg">
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
        <div class="border-t border-white/10 bg-black/10">
            <div class="max-w-7xl mx-auto px-6 lg:px-12 py-6 text-center text-xs text-white/60 font-medium">
                &copy; {{ date('Y') }} {{ $__nav['nama_kelompok'] ?? 'KKN Desa Sukamaju' }} &middot; Dibangun dengan ❤️ untuk desa
            </div>
        </div>
    </footer>

    {{-- Script Animasi --}}
    <script>
        function initReveal() {
            const obs = new IntersectionObserver((entries) => {
                entries.forEach((e) => {
                    if (e.isIntersecting) { e.target.classList.add('in-view'); obs.unobserve(e.target); }
                });
            }, { threshold: 0.1 });
            document.querySelectorAll('.reveal:not(.in-view)').forEach((el) => obs.observe(el));
        }
        document.addEventListener('DOMContentLoaded', initReveal);
    </script>
    
</body>
</html>