<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Masuk Admin V2 - KKN Rowokele</title>
    
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
</head>
<body class="bg-[#fdfbf7] antialiased min-h-screen flex flex-col justify-between">

    <main class="flex-1 flex items-center justify-center py-12 px-4 z-10">
        
        <div class="w-full max-w-md p-8 bg-white rounded-3xl shadow-xl border border-stone-100 transition-all">
            
            <div class="text-center mb-8">
                <span class="px-3 py-1 bg-amber-100 text-amber-800 text-xs font-bold rounded-full uppercase tracking-wider">Sistem Engine V2 (Murni)</span>
                <h1 class="text-2xl font-black text-[#78350f] mt-3">Masuk Admin</h1>
                <p class="text-stone-500 text-sm mt-1">Verifikasi enkripsi langsung ke database kelompok.</p>
            </div>

            {{-- Wadah Alert Error JavaScript --}}
            <div id="alert-error-js" class="bg-rose-50 text-rose-700 p-4 rounded-xl text-sm font-semibold border border-rose-100 mb-5 flex items-center gap-2 hidden">
                <i class="fas fa-exclamation-circle text-rose-500"></i>
                <span id="error-text-js"></span>
            </div>

            {{-- Form Inputs --}}
            <div class="space-y-5">
                <div>
                    <label class="block text-xs font-bold text-stone-700 uppercase mb-2">Username</label>
                    <input type="text" 
                           id="input-username" 
                           class="w-full rounded-xl border border-stone-200 text-sm p-3 bg-stone-50 focus:border-amber-500 focus:ring-amber-500 shadow-sm outline-none transition-all" 
                           placeholder="Masukkan username admin_kkn" required>
                </div>

                <div>
                    <label class="block text-xs font-bold text-stone-700 uppercase mb-2">Password</label>
                    <input type="password" 
                           id="input-password" 
                           class="w-full rounded-xl border border-stone-200 text-sm p-3 bg-stone-50 focus:border-amber-500 focus:ring-amber-500 shadow-sm outline-none transition-all" 
                           placeholder="Masukkan password rowokele112" required>
                </div>

                {{-- Tombol Submit --}}
                <button type="button" 
                        onclick="eksekusiLoginMurni()"
                        id="btn-submit-js"
                        class="w-full py-3.5 bg-amber-600 hover:bg-amber-700 text-white font-bold rounded-xl shadow-md transition-all flex items-center justify-center gap-2 cursor-pointer disabled:opacity-50 disabled:cursor-not-allowed">
                    <span id="btn-text-normal"><i class="fas fa-sign-in-alt"></i> Verifikasi & Masuk</span>
                    <span id="btn-text-loading" class="hidden"><i class="fas fa-spinner fa-spin"></i> Menghubungkan...</span>
                </button>
            </div>
        </div>
    </main>

    {{-- JAVASCRIPT NATIVE CONTROLLER --}}
    <script>
        document.getElementById('input-password').addEventListener('keydown', function(e) {
            if (e.key === 'Enter') eksekusiLoginMurni();
        });

        function eksekusiLoginMurni() {
            const username = document.getElementById('input-username').value;
            const password = document.getElementById('input-password').value;
            const alertBox = document.getElementById('alert-error-js');
            const errorText = document.getElementById('error-text-js');
            const btnNormal = document.getElementById('btn-text-normal');
            const btnLoading = document.getElementById('btn-text-loading');
            const btnSubmit = document.getElementById('btn-submit-js');

            if (!username || !password) {
                errorText.innerText = "Username dan Password wajib diisi!";
                alertBox.classList.remove('hidden');
                return;
            }

            alertBox.classList.add('hidden');
            btnNormal.classList.add('hidden');
            btnLoading.classList.remove('hidden');
            btnSubmit.disabled = true;

            fetch('/proses-login-murni', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ username: username, password: password })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    window.location.href = "/admin/dashboard";
                } else {
                    errorText.innerText = data.message;
                    alertBox.classList.remove('hidden');
                    resetTombol();
                }
            })
            .catch(error => {
                errorText.innerText = "Terjadi gangguan sistem koneksi!";
                alertBox.classList.remove('hidden');
                resetTombol();
            });
        }

        function resetTombol() {
            document.getElementById('btn-text-normal').classList.remove('hidden');
            document.getElementById('btn-text-loading').classList.add('hidden');
            document.getElementById('btn-submit-js').disabled = false;
        }
    </script>
</body>
</html>