// src/app/page.tsx
"use client";

import { useEffect, useState } from "react";
import { IProduct } from "@/interfaces/IProduct"; // Corrected path to IProduct if needed
import { fetchProducts } from "@/services/product/get";
import BannersHome from "@/components/layout/banners/bannersHome";
import CarouselProductSwiper from "@/components/layout/carousel/carouselHome";
import BannerVideo from "@/components/layout/banners/bannerHomeVideo";



export default function Home() {
  const [products, setProducts] = useState<IProduct[]>([]);
  const [loading, setLoading] = useState(true); // Added loading state
  const [error, setError] = useState<string | null>(null); // Added error state

  useEffect(() => {
    const loadProducts = async () => {
      try {
        const fetchedProducts = await fetchProducts();
        setProducts(fetchedProducts);
      } catch (err) {
        console.error("Erro ao carregar produtos:", err);
        setError("Não foi possível carregar os produtos.");
      } finally {
        setLoading(false);
      }
    };
    loadProducts();
  }, []);

  // Display loading state
  if (loading) {
    return (
      <main>
        <section style={{ height: '800px', display: 'flex', justifyContent: 'center', alignItems: 'center', backgroundColor: '#f0f0f0' }}>
          <p>Carregando produtos...</p>
        </section>
      </main>
    );
  }

  // Display error state
  if (error) {
    return (
      <main>
        <section style={{ height: '800px', display: 'flex', justifyContent: 'center', alignItems: 'center', backgroundColor: '#f0f0f0' }}>
          <p>Erro: {error}</p>
        </section>
      </main>
    );
  }

  return (
    <main>

      <BannerVideo />
      <section className="w-full -mt-18  mb-10">
        <CarouselProductSwiper products={products} />
        <BannersHome />

        <CarouselProductSwiper products={products} />
      </section>
     

    </main>
  );
}