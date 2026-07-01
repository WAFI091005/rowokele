import React, { useState, useEffect } from 'react';
import Lanyard from './Lanyard';

export default function AnggotaList({ anggota = [] }) {
  const [selectedAnggota, setSelectedAnggota] = useState(null);
  const [frontCard, setFrontCard] = useState(null);
  const [backCard, setBackCard] = useState(null);

  const placeholderImage = 'https://images.unsplash.com/photo-1535713875002-d1d0cf377fde?w=500';

  useEffect(() => {
    if (anggota && anggota.length > 0) {
      setSelectedAnggota(anggota[0]);
    }
  }, [anggota]);

  useEffect(() => {
    if (!selectedAnggota) return;

    const cleanUrl = (url) => {
      if (!url) return null;
      return url.replace('http://127.0.0.1:8000', '').replace('http://localhost:8000', '');
    };

    const imagePath = selectedAnggota.foto ? cleanUrl(selectedAnggota.foto) : placeholderImage;

    setFrontCard(imagePath);
    setBackCard(imagePath);
  }, [selectedAnggota]);

  if (!anggota || anggota.length === 0 || !selectedAnggota) {
    return (
      <div className="w-full bg-[#fdfbf7] min-h-[400px] flex items-center justify-center text-stone-500">
        <p className="font-medium animate-pulse">Memuat data anggota kelompok...</p>
      </div>
    );
  }

  return (
    <div className="w-full bg-[#fdfbf7] text-stone-800 py-12 px-6">
      <div className="max-w-6xl mx-auto flex flex-col md:flex-row gap-12 items-center md:items-start justify-center pt-10">
        
        {/* PANEL KIRI: Canvas Lanyard 3D WebGL (Kunci Utama Tampilan 3D Lanyard) */}
        <div className="w-full md:w-5/12 flex justify-center items-center h-[500px] bg-stone-900/5 rounded-3xl p-4 border border-stone-200/40 relative overflow-hidden shadow-inner">
          
          {frontCard && backCard ? (
            <div className="w-full h-full absolute inset-0">
                <Lanyard 
                  key={selectedAnggota?.id || selectedAnggota?.nama}
                  position={[0, 0, 20]} 
                  gravity={[0, -40, 0]} 
                  fov={24}
                  frontImage={frontCard} 
                  backImage={backCard}   
                  lanyardImage={null}    
                  imageFit="cover"       
                  lanyardWidth={1}
                />
            </div>
          ) : (
            <div className="text-xs text-stone-400 animate-pulse">Menyiapkan frame 3D...</div>
          )}
          
          <div className="absolute bottom-3 text-center pointer-events-none z-10">
            <span className="text-[10px] uppercase tracking-wider font-bold text-stone-400 bg-white/80 backdrop-blur px-3 py-1 rounded-full border border-stone-100 shadow-sm">
                Klik & Geser Kartu untuk Memutar
            </span>
          </div>
        </div>

        {/* PANEL KANAN: Detail Informasi Lengkap Anggota */}
        <div className="w-full md:w-7/12 space-y-6">
          <div>
            <div className="flex flex-wrap items-center gap-3">
              <h1 className="text-4xl font-extrabold text-[#78350f] tracking-tight">{selectedAnggota?.nama}</h1>
              <span className="bg-amber-600 text-white text-[10px] font-extrabold px-3 py-1 rounded-full uppercase tracking-wider">
                {selectedAnggota?.jabatan}
              </span>
            </div>
            <p className="text-stone-500 text-sm font-semibold mt-2">
              {selectedAnggota?.jurusan} • NIM. {selectedAnggota?.nim}
            </p>
          </div>

          <hr className="border-stone-200" />

          <div className="bg-white border border-stone-150 rounded-xl p-4 shadow-sm flex justify-between items-center">
            <div>
              <p className="text-xs font-bold text-stone-400 uppercase tracking-wider">Status Registrasi</p>
              <p className="text-sm font-semibold text-stone-700 mt-1">Terverifikasi di Sistem</p>
            </div>
            <span className="bg-emerald-50 text-emerald-700 border border-emerald-100 text-xs font-bold px-3 py-1 rounded-full flex items-center gap-1.5">
              <span className="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
              Anak KKN Aktif
            </span>
          </div>

          {/* NAVIGATOR PILIHAN ANGGOTA */}
          <div className="pt-4">
            <h3 className="text-xs font-bold text-stone-400 uppercase tracking-wider mb-3">Pilih Anggota Kelompok</h3>
            <div className="flex flex-wrap gap-2">
              {anggota.map((item) => (
                <button
                  key={item.id || item.nama}
                  onClick={() => setSelectedAnggota(item)}
                  className={`px-4 py-2 rounded-xl border text-sm font-semibold transition-all ${
                    selectedAnggota.id === item.id 
                      ? 'bg-amber-700 border-amber-700 text-white shadow-md scale-105' 
                      : 'bg-white border-stone-200 text-stone-600 hover:border-amber-600 hover:text-amber-700'
                  }`}
                >
                  {item.nama}
                </button>
              ))}
            </div>
          </div>

        </div>

      </div>
    </div>
  );
}