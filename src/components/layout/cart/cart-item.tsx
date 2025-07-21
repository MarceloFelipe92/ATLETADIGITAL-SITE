"use client";

import { ICartItem } from "@/interfaces/ICart";

interface CartItemProps {
  item: ICartItem;
  onUpdateQuantity: (productId: number, delta: number) => void;
  onRemove: (productId: number) => void;
}

const CartItem: React.FC<CartItemProps> = ({
  item,
  onUpdateQuantity,
  onRemove,
}) => {
  const handleQuantityChange = async (delta: number) => {
    try {
      const newQuantity = item.quantity + delta;
      if (newQuantity >= 1) {
        await onUpdateQuantity(item.product.id_produto, delta);
      } else {
        await onRemove(item.product.id_produto);
      }
    } catch (error) {
      console.error("Falha ao atualizar quantidade:", error);
      alert("Erro ao atualizar a quantidade. Verifique o console.");
    }
  };

  return (
    <div className="flex flex-col sm:flex-row sm:items-center justify-between gap-4 py-4 border-b ">
      <div className="flex flex-col">
        <span className="text-base font-semibold text-gray-800">
          {item.product.produto}
        </span>
        <span className="text-sm text-gray-500">
          Quantidade: {item.quantity}
        </span>
        <span className="text-lg font-bold text-emerald-600">
          R$ {(item.product.preco! * item.quantity).toFixed(2).replace(".", ",")}
        </span>
      </div>

      <div className="flex items-center gap-2">
        <button
          onClick={() => handleQuantityChange(-1)}
          aria-label="Diminuir quantidade"
          className="px-3 py-1 rounded border border-gray-300 text-gray-700 hover:bg-gray-100 transition"
        >
          -
        </button>
        <span className="text-base font-medium w-6 text-center">{item.quantity}</span>
        <button
          onClick={() => handleQuantityChange(1)}
          aria-label="Aumentar quantidade"
          className="px-3 py-1 rounded border border-gray-300 text-gray-700 hover:bg-gray-100 transition"
        >
          +
        </button>
        <button
          onClick={() => onRemove(item.product.id_produto)}
          aria-label="Remover item"
          className="ml-2 px-3 py-1 rounded border border-red-300 text-red-600 hover:bg-red-50 transition"
        >
          Remover
        </button>
      </div>
    </div>
  );
};

export default CartItem;
