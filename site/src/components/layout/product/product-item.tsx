"use client";

import { IProduct } from "@/interfaces/IProduct";
import Image from "next/image";
import Link from "next/link";
import React from "react";

interface ProductItemProps {
  product: IProduct;
}

const ProductItem = ({ product }: ProductItemProps) => {
  const imageUrl = product.imagem
    ? `http://localhost:8081/produtos/imagens/${product.imagem}`
    : "/images/placeholder-product.jpg";

  // CORREÇÃO AQUI: Lidar com 'null' e garantir que 'preco' seja tratado como string para parseFloat
  const precoNumerico =
    product.preco !== null ? parseFloat(product.preco.toString()) : 0;
  // Explicação:
  // 1. `product.preco !== null`: Verifica se o preço não é nulo.
  // 2. `product.preco.toString()`: Converte o número (ou o que quer que seja `product.preco` se não for nulo) para string.
  //    Isso é seguro porque `parseFloat` espera uma string.
  // 3. `parseFloat(...)`: Tenta converter a string para um número.
  // 4. `|| 0`: Se o resultado de parseFloat for NaN (Not a Number), define como 0.

  return (
    <Link href={`/product/${product.id_produto}`} className="block h-full group">
      <div
        className="
          bg-[#142e46]
          border border-white/10
          rounded-2xl
          shadow-[0_4px_20px_rgba(0,0,0,0.4)]
          hover:shadow-[0_10px_40px_rgba(0,0,0,0.6)]
          transition-shadow duration-300
          p-5
          flex flex-col
          h-full
        "
      >
        <div
          className="
            relative w-full aspect-square overflow-hidden rounded-xl mb-4
            shadow-inner
          "
        >
          <Image
            src={imageUrl}
            alt={product.produto || "Imagem do produto"}
            fill
            sizes="(max-width: 768px) 100vw, (max-width: 1200px) 50vw, 33vw"
            className="
              object-contain
              transition-transform duration-300 ease-in-out
              group-hover:scale-105
              bg-white
            "
          />
        </div>

        <h3
          className="
            text-lg md:text-xl font-extrabold uppercase tracking-wide
            text-transparent bg-clip-text
            bg-gradient-to-r from-[#39D5FF] via-[#B0D9E7] to-[#39D5FF]
            mb-2
            transition-colors
            line-clamp-2
          "
        >
          {product.produto}
        </h3>

        {product.descricao && (
          <p className="text-sm text-slate-300 mb-4 line-clamp-2 font-medium">
            {product.descricao}
          </p>
        )}

        <div className="mt-auto flex items-center justify-between">
          <span
            className="
              text-lg font-extrabold
              text-emerald-400
              bg-emerald-900/10
              px-3 py-1
              rounded-lg
              border border-emerald-500/30
              drop-shadow-sm
            "
          >
            R$ {precoNumerico.toFixed(2).replace(".", ",")}
          </span>
        </div>
      </div>
    </Link>
  );
};

export default ProductItem;