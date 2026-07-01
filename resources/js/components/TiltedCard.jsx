import { useRef } from 'react';
import { motion, useMotionValue, useSpring, useTransform } from 'framer-motion';

export function TiltedCard({ children }) {
  const ref = useRef(null);
  const x = useMotionValue(0);
  const y = useMotionValue(0);

  // Nilai spring yang empuk agar ayunan tali dan kartu terasa memiliki beban fisik asli
  const springConfig = { damping: 20, stiffness: 90, mass: 0.6 };
  const mouseXSpring = useSpring(x, springConfig);
  const mouseYSpring = useSpring(y, springConfig);

  // Kalibrasi sudut rotasi: X (atas-bawah) dibuat tipis, Y (kanan-kiri) dibuat lebar
  const rotateX = useTransform(mouseYSpring, [-0.5, 0.5], ["8deg", "-8deg"]);
  const rotateY = useTransform(mouseXSpring, [-0.5, 0.5], ["-28deg", "28deg"]);
  const translateX = useTransform(mouseXSpring, [-0.5, 0.5], [-15, 15]);

  // FORMULA TALI MELIUK: Mengubah koordinat SVG Path secara realtime berdasarkan kursor mouse
  const leftCordPath = useTransform(mouseXSpring, [-0.5, 0.5], [
    "M 100 0 C 45 30, 35 70, 75 125",  // Meliuk melengkung ke kiri saat kartu ke kiri
    "M 100 0 C 95 45, 95 85, 100 125"   // Lurus menegang saat kartu ke kanan
  ]);

  const rightCordPath = useTransform(mouseXSpring, [-0.5, 0.5], [
    "M 100 0 C 105 45, 105 85, 100 125", // Lurus menegang saat kartu ke kiri
    "M 100 0 C 155 30, 165 70, 125 125"  // Meliuk melengkung ke kanan saat kartu ke kanan
  ]);

  // Pergeseran posisi cincin logam pengait tengah
  const ringCenter = useTransform(mouseXSpring, [-0.5, 0.5], [86, 114]);

  const handleMouseMove = (e) => {
    if (!ref.current) return;
    const rect = ref.current.getBoundingClientRect();
    const mouseX = e.clientX - rect.left - rect.width / 2;
    const mouseY = e.clientY - rect.top - rect.height / 2;
    
    x.set(mouseX / rect.width);
    y.set(mouseY / rect.height);
  };

  const handleMouseLeave = () => {
    x.set(0);
    y.set(0);
  };

  return (
    <div 
      ref={ref} 
      onMouseMove={handleMouseMove} 
      onMouseLeave={handleMouseLeave} 
      className="relative flex flex-col items-center select-none"
    >
      
      {/* KONTEN TALI LANYARD INTERAKTIF */}
      <div className="absolute -top-[122px] w-[200px] h-[130px] pointer-events-none z-10 overflow-visible">
        <svg width="200" height="130" viewBox="0 0 200 130" fill="none" className="overflow-visible">
          {/* Tali Sisi Kiri */}
          <motion.path 
            stroke="#1e293b" 
            strokeWidth="3.5" 
            strokeLinecap="round" 
            style={{ d: leftCordPath }} 
          />
          {/* Tali Sisi Kanan */}
          <motion.path 
            stroke="#334155" 
            strokeWidth="3.5" 
            strokeLinecap="round" 
            style={{ d: rightCordPath }} 
          />
          {/* Cincin Pengait Kartu */}
          <motion.circle 
            cy="123" 
            r="4.5" 
            fill="#64748b" 
            style={{ cx: ringCenter }} 
          />
        </svg>
      </div>

      {/* BODY UTAMA KARTU */}
      <motion.div
        style={{ 
          rotateX, 
          rotateY, 
          translateX,
          transformStyle: "preserve-3d",
          originX: 0.5,
          originY: 0 // Poros ayunan dikunci mati di atas (tempat cincin pengait)
        }}
        className="relative transition-all duration-300 ease-out will-change-transform"
      >
        {children}
      </motion.div>
    </div>
  );
}