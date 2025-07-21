"use client";

import { IProduct } from "@/interfaces/IProduct";
import ProductItem from "@/components/layout/product/product-item";
import { Swiper, SwiperSlide } from "swiper/react";
import { Autoplay } from "swiper/modules";
import "swiper/css";
import styles from "@/components/layout/carousel/CarouselProductSwiper.module.css";

interface ProductListProps {
  products: IProduct[];
}

const CarouselProductSwiper = ({ products }: ProductListProps) => {
  if (!products || products.length === 0) {
    return (
      <div className="text-center py-8 text-gray-500">
        Nenhum produto disponível.
      </div>
    );
  }

  return (
    <div className={styles.carouselWrapper}>
      <Swiper
        modules={[Autoplay]}
        spaceBetween={20}
        slidesPerView={1}
        autoplay={{
          delay: 3000,
          disableOnInteraction: false,
          pauseOnMouseEnter: true, // <--- ADICIONE ESTA LINHA AQUI!
        }}
        loop={true}
        breakpoints={{
          640: {
            slidesPerView: 2,
            spaceBetween: 24,
          },
          768: {
            slidesPerView: 3,
            spaceBetween: 28,
          },
          1024: {
            slidesPerView: 4,
            spaceBetween: 32,
          },
          1280: {
            slidesPerView: 5,
            spaceBetween: 36,
          },
        }}
        className={styles.swiperCustom}
      >
        {products.map((product) => (
          <SwiperSlide key={product.id_produto} className={styles.swiperSlide}>
            <ProductItem product={product} />
          </SwiperSlide>
        ))}
      </Swiper>
    </div>
  );
};

export default CarouselProductSwiper;