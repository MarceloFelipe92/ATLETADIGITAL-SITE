// src/services/cart/get.ts
import { ICart } from "@/interfaces/ICart";
import { IProduct } from "@/interfaces/IProduct"; // Adicionado para tipagem de produto

// Definindo a interface para o item de carrinho retornado pela API PHP
interface ApiCartItemResponse {
  id_produto: number;
  produto: string;
  descricao: string | null; // Pode ser null conforme sua IProduct
  id_marca: number;
  imagem: string | null; // Pode ser null
  preco: number | null; // Pode ser null
  marca: string;
  quantidade: number; // A quantidade do item no carrinho
}

// Definindo a interface para a resposta total da API PHP de carrinho
interface ApiCartResponse {
  data: {
    // O seu backend está retornando um objeto com 'data'
    items: ApiCartItemResponse[];
    total: number;
  };
  // Adicione outras propriedades de resposta do PHP, se houver (ex: status, message)
  status?: string;
  message?: string;
}

export const fetchCart = async (
  id_cliente: number,
  token: string
): Promise<ICart> => {
  const response = await fetch(
    `http://localhost:8080/carrinho?id_cliente=${id_cliente}`,
    {
      method: "GET",
      headers: {
        "Content-Type": "application/json",
        Authorization: `Bearer ${token}`, // CORREÇÃO: Usando o token
      },
    }
  );

  if (!response.ok) {
    const errorData = await response.json();
    throw new Error(errorData.message || "Falha ao carregar o carrinho.");
  }

  const data: ApiCartResponse = await response.json();

  // Verifique se 'data' e 'data.data' existem para evitar erros de runtime
  if (!data || !data.data || !data.data.items) {
    throw new Error("Formato de dados do carrinho inesperado do backend.");
  }

  // Mapeia os itens do carrinho para o formato ICart
  const mappedItems = data.data.items.map((item: ApiCartItemResponse) => ({
    product: {
      id_produto: item.id_produto,
      produto: item.produto,
      descricao: item.descricao,
      id_marca: item.id_marca,
      imagem: item.imagem,
      preco: item.preco,
      marca: item.marca,
    } as IProduct, // Assegura que está conforme IProduct
    quantity: item.quantidade,
  }));

  return {
    items: mappedItems,
    total: data.data.total,
  };
};
