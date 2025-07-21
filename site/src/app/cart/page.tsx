// src/app/cart/page.tsx
"use client";

import { useCallback, useEffect, useState } from "react";
import { useSession } from "next-auth/react";

import { ICart } from "@/interfaces/ICart";
import { fetchCart } from "@/services/cart/get";
import { removeCartItem } from "@/services/cart/delete";
import { updateCartItemQuantity } from "@/services/cart/put";

// Importe o componente CartList se você o tiver, para melhor organização
// import CartList from "@/components/cart/cart-list";

export default function CartPage() {
  const { data: session, status } = useSession();
  const [cart, setCart] = useState<ICart>({ items: [], total: 0 });
  const [loadingCart, setLoadingCart] = useState(true);
  const [errorCart, setErrorCart] = useState<string | null>(null);

  // Função para carregar o carrinho
  // REMOÇÃO DO eslint-disable-next-line react-hooks/exhaustive-deps pois já está no useCallback
  const loadCart = useCallback(async () => {
    if (status === "authenticated" && session?.user?.id && session.user.token) {
      setLoadingCart(true);
      setErrorCart(null);
      try {
        const fetchedCart = await fetchCart(parseInt(session.user.id), session.user.token);
        setCart(fetchedCart);
      } catch (err: unknown) { // CORREÇÃO: 'any' para 'unknown'
        console.error("Erro ao carregar carrinho:", err);
        let errorMessage = "Não foi possível carregar o carrinho. Tente novamente.";
        if (err instanceof Error) {
          errorMessage = err.message;
        } else if (typeof err === 'object' && err !== null && 'message' in err) {
          errorMessage = (err as { message: string }).message;
        }
        setErrorCart(errorMessage);
        setCart({ items: [], total: 0 });
      } finally {
        setLoadingCart(false);
      }
    } else if (status === "unauthenticated") {
      setCart({ items: [], total: 0 });
      setLoadingCart(false);
    }
  }, [status, session]); // Dependências corrigidas para o useCallback

  useEffect(() => {
    loadCart();
  }, [loadCart]); // loadCart é uma dependência estável por causa do useCallback

  const handleUpdateQuantity = async (id_produto: number, delta: number) => {
    if (status !== "authenticated" || !session?.user?.id || !session.user.token) {
      alert("Você precisa estar logado para atualizar o carrinho.");
      return;
    }

    const currentItem = cart.items.find((item) => item.product.id_produto === id_produto);

    if (!currentItem) {
      console.warn("Tentativa de atualizar quantidade de item não encontrado no carrinho.");
      return;
    }

    const newQuantity = currentItem.quantity + delta;

    try {
      if (newQuantity <= 0) {
        await removeCartItem(parseInt(session.user.id), id_produto, session.user.token);
      } else {
        await updateCartItemQuantity(
          parseInt(session.user.id),
          id_produto,
          newQuantity,
          session.user.token
        );
      }
      loadCart();
    } catch (error) {
      console.error("Erro ao atualizar quantidade:", error);
      alert("Não foi possível atualizar a quantidade do item no carrinho.");
    }
  };

  const handleRemove = async (id_produto: number) => {
    if (status !== "authenticated" || !session?.user?.id || !session.user.token) {
      alert("Você precisa estar logado para remover itens do carrinho.");
      return;
    }

    try {
      await removeCartItem(
        parseInt(session.user.id),
        id_produto,
        session.user.token
      );
      loadCart();
    } catch (error) {
      console.error("Erro ao remover item:", error);
      alert("Não foi possível remover o item do carrinho.");
    }
  };

  if (status === "loading" || loadingCart) {
    return (
      <div className="min-h-screen flex items-center justify-center text-slate-300">
        Carregando...
      </div>
    );
  }

  if (status === "unauthenticated") {
    return (
      <div className="min-h-screen flex items-center justify-center text-slate-300">
        Por favor, faça login para ver seu carrinho.
      </div>
    );
  }

  if (errorCart) {
    return (
      <div className="min-h-screen flex items-center justify-center text-red-400">
        Erro: {errorCart}
      </div>
    );
  }

  return (
    <div className="min-h-screen p-6">
      <div className="max-w-4xl mx-auto">
        <h2 className="text-3xl font-extrabold text-transparent bg-clip-text text-center mb-8 uppercase">
          Carrinho de Compras
        </h2>

        {cart.items.length === 0 ? (
          <p className="text-slate-300 text-center">O carrinho está vazio.</p>
        ) : (
          <>
            <ul className="space-y-4">
              {cart.items.map((item) => (
                <li
                  key={item.product.id_produto}
                  className="flex flex-col md:flex-row justify-between items-start md:items-center p-4 bg-white/5 border border-white/10 rounded-xl shadow-lg gap-4"
                >
                  <div>
                    <p className="text-lg font-semibold text-white">
                      {item.product.produto}
                    </p>
                    <p className="text-slate-300 text-sm">
                      Preço: R$ {item.product.preco?.toFixed(2).replace(".", ",")} {/* Adicionado ?. para preco que pode ser null */}
                    </p>
                    <p className="text-slate-300 text-sm">
                      Quantidade: {item.quantity}
                    </p>
                  </div>
                  <div className="flex gap-2">
                    <button
                      className="w-10 h-10 flex items-center justify-center border border-[#39D5FF]/50 rounded-lg text-[#39D5FF] bg-[#0c1f2e] hover:bg-[#39D5FF]/20 transition-all duration-300 text-xl font-bold disabled:opacity-50"
                      onClick={() =>
                        handleUpdateQuantity(item.product.id_produto, -1)
                      }
                      disabled={item.quantity <= 1}
                      aria-label="Diminuir quantidade"
                    >
                      −
                    </button>
                    <button
                      className="w-10 h-10 flex items-center justify-center border border-[#39D5FF]/50 rounded-lg text-[#39D5FF] bg-[#0c1f2e] hover:bg-[#39D5FF]/20 transition-all duration-300 text-xl font-bold"
                      onClick={() =>
                        handleUpdateQuantity(item.product.id_produto, 1)
                      }
                      aria-label="Aumentar quantidade"
                    >
                      +
                    </button>
                    <button
                      className="rounded-2xl border-y-4 shadow-lg hover:border-red-500 px-4 flex items-center justify-center text-white hover:text-red-400 transition duration-300"
                      onClick={() => handleRemove(item.product.id_produto)}
                      aria-label="Remover item do carrinho"
                    >
                      Remover
                    </button>
                  </div>
                </li>
              ))}
            </ul>

            <div className="mt-8 text-right">
              <p className="text-xl font-semibold text-slate-200">
                Total: R$ {cart.total.toFixed(2).replace('.', ',')}
              </p>
              <button
                className="mt-4 rounded-2xl border-y-4 shadow-lg hover:border-[#39D5FF] px-6 py-3 flex items-center justify-center text-white hover:text-[#39D5FF] transition duration-300"
              >
                Finalizar Compra
              </button>
            </div>
          </>
        )}
      </div>
    </div>
  );
}