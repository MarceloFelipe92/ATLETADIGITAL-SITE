"use client";

import { useEffect, useState } from "react";
import Image from "next/image";
import { useParams, useRouter } from "next/navigation";
import { IProduct } from "@/interfaces/IProduct";
import { fetchProducts } from "@/services/product/get";
import { addToCart } from "@/services/api/cart/post";

const PageProduct = () => {
  const params = useParams();
  const router = useRouter();
  const { id } = params || {};
  const [product, setProduct] = useState<IProduct | null>(null);
  const [quantity, setQuantity] = useState<number>(1);
  const [error, setError] = useState<string | null>(null);
  const [loading, setLoading] = useState<boolean>(true);
  const [adding, setAdding] = useState<boolean>(false);
  const id_cliente = 3; // TODO: substituir pelo ID do cliente autenticado

  useEffect(() => {
    const loadProduct = async () => {
      setLoading(true);
      setError(null);
      try {
        const products = await fetchProducts();
        const foundProduct = products.find(
          (p) => Number(p.id_produto) === Number(id)
        );
        if (!foundProduct) {
          setError("Produto não encontrado.");
          setProduct(null);
        } else {
          setProduct(foundProduct);
        }
      } catch (err) {
        console.error(err);
        setError("Erro ao carregar o produto. Tente novamente mais tarde.");
        setProduct(null);
      } finally {
        setLoading(false);
      }
    };

    if (id) {
      loadProduct();
    }
  }, [id]);

  const handleAddToCart = async () => {
    if (!product) return;
    setAdding(true);
    setError(null);

    try {
      const success = await addToCart(product, id_cliente, quantity);
      if (success) {
        alert("Produto adicionado ao carrinho!");
      } else {
        setError(
          "Falha ao adicionar o produto ao carrinho. Verifique o console para detalhes."
        );
      }
    } catch (err) {
      console.error(err);
      setError("Erro inesperado ao adicionar ao carrinho.");
    } finally {
      setAdding(false);
    }
  };

  if (loading) {
    return (
      <section className="flex justify-center items-center h-64">
        <p className="text-gray-500 text-lg">Carregando produto...</p>
      </section>
    );
  }

  if (error && !product) {
    return (
      <section className="max-w-screen-md mx-auto p-6 text-center">
        <p className="text-red-600 font-semibold">{error}</p>
      </section>
    );
  }

  if (!product) {
    return null;
  }

  return (
    <>
      <div className="w-full relative">
        <div className="w-full h-[180px] sm:h-[250px] md:h-[300px] mt-22 lg:h-[600px] relative fade-bottom">
          <Image
            src="/assets/bannerfutebol.png"
            alt="Banner de Produtos"
            fill
            className="object-cover"
            priority
          />

          {/* Mensagem centralizada sobre os produtos */}
          <div className="absolute inset-0 bg-black/20 flex items-center px-30">
            <div className="text-center px-4">
              <h2 className="text-white text-xl sm:text-2xl md:text-4xl font-extrabold drop-shadow-lg">
                Conheça nossa linha exclusiva de produtos esportivos
              </h2>
              <p className="text-[#B0D9E7] text-sm sm:text-base md:text-lg mt-2 drop-shadow-md">
                Qualidade, performance e estilo para todos os atletas digitais
              </p>
            </div>
          </div>
        </div>
      </div>

      {/* Botão de Voltar fora do card */}
      <div className="max-w-screen-xl mx-auto w-full px-4 mt-5 sm:px-6 md:px-8 mb-2">
        <button
          onClick={() => router.back()}
          className={`rounded-2xl border-y-4 shadow-lg hover:border-[#39D5FF] p-3 items-center justify-center text-white hover:text-[#39D5FF] flex transition duration-300 mt-6
                  ${adding ? "cursor-not-allowed" : "cursor-pointer"}
                `}
        >
          ← Voltar
        </button>
      </div>


      <section
        className="
          mb-20
          flex justify-center items-center py-12
          w-full max-w-screen-xl mx-auto
          relative overflow-hidden rounded-3xl
          transition-all duration-500 ease-in-out
          shadow-[0_4px_30px_rgba(0,0,0,0.1)]
          backdrop-blur-md
        "
      >
        <div className="container mx-auto px-4 sm:px-6 md:px-8">
          <div
            className="
              flex flex-col md:flex-row
              gap-8 md:gap-12
              p-4 md:p-8
              bg-white/5 rounded-2xl
              border border-white/10
              shadow-inner
            "
          >
            {/* Imagem */}
            <div
              className="
                relative w-full md:w-2/3
                aspect-[4/3] overflow-hidden rounded-xl
                border border-white/10
                shadow-lg
                group
              "
            >
              <Image
                src={`http://localhost:8081/produtos/imagens/${product.imagem || "default.jpg"}`}
                alt={product.produto || "Imagem do produto"}
                fill
                sizes="(max-width: 768px) 100vw, (max-width: 1200px) 50vw, 33vw"
                className="
                  object-contain
                  transition-transform duration-300 ease-in-out
                  group-hover:scale-105 bg-white
                "
                onError={(e) => {
                  (e.target as HTMLImageElement).src = "/placeholder.jpg";
                }}
              />
            </div>

            {/* Detalhes */}
            <div className="flex flex-col flex-1 gap-4 text-slate-200">
              <h1 className="text-3xl md:text-4xl font-extrabold text-white uppercase tracking-wide bg-gradient-to-r bg-clip-text">
                {product.produto}
              </h1>

              <p className="text-base md:text-lg font-semibold text-slate-300">
                {product.marca || "Sem marca"}
              </p>

              <p className="text-base md:text-lg leading-relaxed text-slate-400">
                {product.descricao || "Sem descrição disponível."}
              </p>

              <span className="text-3xl font-bold text-emerald-400 bg-emerald-900/10 px-4 py-2 rounded-xl border border-emerald-500/30 w-fit shadow">
                R$ {Number(product.preco) ? Number(product.preco).toFixed(2).replace(".", ",") : "0,00"}
              </span>

              {/* Quantidade */}
              <div className="flex items-center gap-4 mt-4">
                <button
                  onClick={() => setQuantity((q) => Math.max(1, q - 1))}
                  className="w-10 h-10 flex justify-center items-center border border-[#39D5FF]/50 rounded-lg text-[#39D5FF] bg-[#0c1f2e] hover:bg-[#39D5FF]/20 transition-all duration-300 text-xl font-bold"
                  aria-label="Diminuir quantidade"
                >
                  −
                </button>
                <span className="text-2xl font-bold w-12 text-center text-white">
                  {quantity}
                </span>
                <button
                  onClick={() => setQuantity((q) => q + 1)}
                  className="w-10 h-10 flex justify-center items-center border border-[#39D5FF]/50 rounded-lg text-[#39D5FF] bg-[#0c1f2e] hover:bg-[#39D5FF]/20 transition-all duration-300 text-xl font-bold"
                  aria-label="Aumentar quantidade"
                >
                  +
                </button>
              </div>

              {/* Adicionar ao carrinho */}
              <button
                onClick={handleAddToCart}
                disabled={adding}
                className={`rounded-2xl border-y-4 shadow-lg hover:border-[#39D5FF] p-3 items-center justify-center text-white hover:text-[#39D5FF] flex transition duration-300 mt-6
                  ${adding ? "cursor-not-allowed" : "cursor-pointer"}
                `}
              >
                {adding ? "Adicionando..." : "Adicionar ao Carrinho"}
              </button>

              {error && (
                <p className="text-red-400 mt-3 text-base">{error}</p>
              )}
            </div>
          </div>
        </div>
      </section>
    </>
  );
};

export default PageProduct;
