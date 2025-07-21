"use client";

import { useEffect, useState } from "react";
import Image from "next/image";
import { IProduct } from "@/interfaces/IProduct";
import { fetchProducts } from "@/services/product/get";
import ProductList from "@/components/layout/product/product-list";
import ProductSidebar from "@/components/layout/product-sidebar/product-sidebar";

const AllProductsPage = () => {
  const [products, setProducts] = useState<IProduct[]>([]);
  const [currentPage, setCurrentPage] = useState(1);
  const itemsPerPage = 15;

  const totalPages = Math.ceil(products.length / itemsPerPage);
  const startIndex = (currentPage - 1) * itemsPerPage;
  const endIndex = startIndex + itemsPerPage;
  const currentProducts = products.slice(startIndex, endIndex);

  const [loading, setLoading] = useState(true);
  const [error, setError] = useState<string | null>(null);

  useEffect(() => {
    const loadAllProducts = async () => {
      setLoading(true);
      setError(null);
      try {
        const fetchedProducts = await fetchProducts();
        setProducts(fetchedProducts);
        if (fetchedProducts.length === 0) {
          setError("Não há produtos disponíveis no momento.");
        }
      } catch (err) {
        console.error("Erro ao carregar todos os produtos:", err);
        setError("Erro ao carregar produtos. Verifique sua conexão ou tente novamente mais tarde.");
      } finally {
        setLoading(false);
      }
    };

    loadAllProducts();
  }, []);

  if (loading) {
    return (
      <section className="flex justify-center items-center h-screen bg-gradient-to-br from-[#0c1f2e] via-[#142e46] to-[#0c1f2e]">
        <p className="text-[#B0D9E7] text-lg">Carregando todos os produtos...</p>
      </section>
    );
  }

  if (error) {
    return (
      <section className="flex justify-center items-center h-screen px-4 bg-gradient-to-br from-[#0c1f2e] via-[#142e46] to-[#0c1f2e]">
        <div className="max-w-screen-md mx-auto p-6 text-center bg-red-900/30 border border-red-600 rounded-lg shadow-lg">
          <p className="text-red-400 font-semibold text-lg">{error}</p>
          <p className="text-red-300 text-sm mt-2">
            Por favor, tente recarregar a página ou contate o suporte se o problema persistir.
          </p>
        </div>
      </section>
    );
  }

  return (
    <>
      {/* Banner Responsivo com mensagem sobre os produtos */}
      <div className="w-full relative">
        <div className="w-full h-[180px] sm:h-[250px] md:h-[300px]  lg:h-[600px] relative fade-bottom ">
          <Image
            src="/assets/bannerfutebol.png"
            alt="Banner de Produtos"
            fill
            className="object-cover "
            priority
          />

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

      <section
        className="
          container mx-auto 
          px-6 sm:px-10 md:px-14
          py-10 
          flex flex-col md:flex-row gap-10
          max-w-screen-xl
          rounded-xl
          mt-10
        "
      >
        <ProductSidebar />

        <div className="flex-1 flex flex-col">
          <div className="mb-12 text-center md:text-left">
            <h1
              className="
                text-2xl font-extrabold
                text-transparent bg-clip-text
                bg-gradient-to-r from-[#39D5FF] via-[#B0D9E7] to-[#B0D9E7]
                uppercase tracking-wider
                drop-shadow-lg
              "
            >
              Descubra nossa seleção exclusiva de produtos para atletas digitais. Qualidade, inovação e performance para você!
            </h1>
          </div>

          {currentProducts.length > 0 ? (
            <>
              <ProductList products={currentProducts} />

              {/* Paginação com estilo atualizado */}
              {totalPages > 1 && (
                <div className="flex justify-center items-center gap-4 mt-8 flex-wrap">
                  <button
                    onClick={() => setCurrentPage((prev) => Math.max(prev - 1, 1))}
                    disabled={currentPage === 1}
                    className={`rounded-2xl border-y-4 shadow-lg hover:border-[#39D5FF] p-3 items-center justify-center text-white hover:text-[#39D5FF] flex transition duration-300
                      ${currentPage === 1 ? "cursor-not-allowed opacity-40" : "cursor-pointer"}
                    `}
                  >
                    ⟨ Anterior
                  </button>

                  <span className="text-[#B0D9E7] font-semibold">
                    Página {currentPage} de {totalPages}
                  </span>

                  <button
                    onClick={() => setCurrentPage((prev) => Math.min(prev + 1, totalPages))}
                    disabled={currentPage === totalPages}
                    className={`rounded-2xl border-y-4 shadow-lg hover:border-[#39D5FF] p-3 items-center justify-center text-white hover:text-[#39D5FF] flex transition duration-300
                      ${currentPage === totalPages ? "cursor-not-allowed opacity-40" : "cursor-pointer"}
                    `}
                  >
                    Próxima ⟩
                  </button>
                </div>
              )}
            </>
          ) : (
            <div className="text-center text-[#B0D9E7] p-10 rounded-lg border border-[#39D5FF]/50 bg-[#0c1f2e] shadow-xl">
              <p className="text-2xl font-semibold mb-4">Nenhum produto disponível no momento.</p>
              <p className="text-lg">Volte em breve para conferir as novidades!</p>
            </div>
          )}
        </div>
      </section>
    </>
  );
};

export default AllProductsPage;
