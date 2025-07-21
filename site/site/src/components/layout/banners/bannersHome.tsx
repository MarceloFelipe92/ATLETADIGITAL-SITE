"use client";

import React, { useEffect, useState } from "react";
import Image from "next/image";
import styles from "@/components/layout/banners/bannersHome.module.css";

const banners = [
    {
        id: "academia",
        title: "Supere Seus Limites",
        descriptions: [
            "Aumente sua força com nossos equipamentos.",
            "Descubra acessórios de última geração.",
            "Transforme seu treino e seus resultados.",
        ],
        image: "/assets/musculacao01.jpg",
        label: "ACADEMIA",
    },
    {
        id: "natacao",
        title: "Nade com Excelência",
        descriptions: [
            "Acessórios de ponta para nadadores.",
            "Sinta a diferença em cada braçada.",
            "Melhore seu desempenho na piscina.",
        ],
        image: "/assets/bannernatacao.png",
        label: "NATAÇÃO",
    },
    {
        id: "ra",
        title: "Explore Novas Realidades",
        descriptions: [
            "Tecnologia inovadora em realidade aumentada.",
            "Interaja com o mundo virtual.",
            "Experiências imersivas em qualquer lugar.",
        ],
        image: "/assets/metaverso.jpg",
        label: "RA",
    },
    {
        id: "futebol",
        title: "Viva a Emoção do Futebol",
        descriptions: [
            "Acessórios de alta performance.",
            "Domine cada jogada com qualidade.",
            "Paixão e tecnologia no seu futebol.",
        ],
        image: "/assets/bannerfutebol.png",
        label: "FUTEBOL",
    },
];

const BannersHome = () => {
    const [descIndices, setDescIndices] = useState(banners.map(() => 0));

    useEffect(() => {
        const interval = setInterval(() => {
            setDescIndices((prev) =>
                prev.map((idx, i) => (idx + 1) % banners[i].descriptions.length)
            );
        }, 3000);
        return () => clearInterval(interval);
    }, []);

    const gradientTextClass = `
    bg-gradient-to-r from-white to-gray-300 
    text-transparent bg-clip-text
    drop-shadow-[0_2px_6px_rgba(0,0,0,0.6)]
  `;

    return (
        <div className="w-full flex flex-col items-center mt-10 mb-10">
            <div className="w-full max-w-7xl flex flex-col gap-16 px-4">
                {/* Título inicial com gradiente branco */}
                <div className="w-full flex justify-center">
                    <h1 className="
                text-6xl font-extrabold items-center 
                text-transparent bg-clip-text
                bg-gradient-to-r from-[#39D5FF] via-[#B0D9E7] to-[#B0D9E7]
                uppercase tracking-wider
                drop-shadow-lg
              ">
                        Descubra Tudo o Que Você Precisa Para Superar Limites
                    </h1>
                </div>

                {banners.map((banner, index) => (
                    <React.Fragment key={banner.id}>
                        {/* Banner */}
                        <div
                            className={`w-full flex ${index % 2 === 0 ? "justify-start" : "justify-end"
                                }`}
                        >
                            <div
                                className={`${styles.bannerWrapper} relative w-full sm:w-[90%] md:w-[80%] lg:w-[65%] h-72 md:h-80 lg:h-96 mt-20 rounded-2xl overflow-hidden`}
                            >
                                <Image
                                    src={banner.image}
                                    alt={banner.title}
                                    fill
                                    className="object-cover"
                                    priority
                                />
                                <div className={`${styles.overlay} absolute inset-0`} />
                                <div className="relative z-10 flex flex-col justify-center h-full px-6 md:px-12">
                                    <h2 className={`text-2xl md:text-4xl font-extrabold uppercase tracking-wide ${gradientTextClass}`}>
                                        {banner.title}
                                    </h2>
                                    <p className={`mt-3 md:mt-5 text-base md:text-lg font-medium ${gradientTextClass} transition-all duration-500`}>
                                        {banner.descriptions[descIndices[index]]}
                                    </p>
                                    <span className="mt-5 self-start bg-white/20 text-white text-xs font-semibold px-4 py-2 rounded-full shadow-lg tracking-wide border border-white/30">
                                        {banner.label}
                                    </span>
                                </div>
                            </div>
                        </div>

                        {/* Texto chamativo entre banners */}
                        {index < banners.length - 1 && (
                            <div className="w-full flex justify-center mt-12">
                                <p className="
                text-5xl font-extrabold items-center 
                text-transparent bg-clip-text
                bg-gradient-to-r from-[#39D5FF] via-[#B0D9E7] to-[#B0D9E7]
                uppercase tracking-wider
                drop-shadow-lg
              ">
                                    Potencialize sua experiência no universo {banner.label} com produtos exclusivos e inovadores.
                                </p>
                            </div>
                        )}
                    </React.Fragment>
                ))}

                {/* Título final com gradiente branco */}
                <div className="w-full flex justify-center mt-16">
                    <h2 className="
                text-4xl font-extrabold items-center mb-20
                text-transparent bg-clip-text
                bg-gradient-to-r from-[#39D5FF] via-[#B0D9E7] to-[#B0D9E7]
                uppercase tracking-wider
                drop-shadow-lg
              ">
                        Equipamentos e tecnologias que transformam seu desempenho.
                    </h2>
                </div>
            </div>
        </div>
    );
};

export default BannersHome;
