import React from 'react';
import { createRoot } from 'react-dom/client';
import AnggotaList from './components/AnggotaList';

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
        <AnggotaList anggota={listAnggota} />
    );
}