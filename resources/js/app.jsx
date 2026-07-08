import React, { Suspense } from 'react';
import { createRoot } from 'react-dom/client';

// Gunakan lazy load agar komponen 3D yang berat dipecah otomatis oleh Vite
const AnggotaList = React.lazy(() => import('./components/AnggotaList'));

const container = document.getElementById('anggota-root');

if (container) {
    const dataMentah = container.getAttribute('data-anggota');
    let listAnggota = [];

    try {
        listAnggota = dataMentah ? JSON.parse(dataMentah) : [];
    } catch (e) {
        console.error("Gagal mengekstrak data anggota:", e);
    }

    const root = createRoot(container);
    root.render(
        // Bungkus dengan Suspense untuk memberikan loading text saat file 3D dimuat
        <Suspense fallback={<div style={{ textAlign: 'center', padding: '2rem', color: '#78350f', fontWeight: 'bold' }}>Memuat Komponen Tim 3D...</div>}>
            <AnggotaList anggota={listAnggota} />
        </Suspense>
    );
}