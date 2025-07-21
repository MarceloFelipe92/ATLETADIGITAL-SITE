// src/services/cart/delete.ts
export const removeCartItem = async (
  id_cliente: number,
  id_produto: number,
  token: string // 'token' agora está sendo usado
): Promise<void> => {
  const response = await fetch(
    `http://localhost:8080/carrinho?id_cliente=${id_cliente}&id_produto=${id_produto}`,
    {
      method: "DELETE",
      headers: {
        "Content-Type": "application/json",
        // Adicione o token de autorização aqui se o seu backend PHP espera por ele
        Authorization: `Bearer ${token}`, // CORREÇÃO: Usando o token
      },
    }
  );

  // O Promise<void> significa que não há retorno esperado.
  // Se seu backend retorna um JSON de sucesso/erro, você pode querer verificar aqui.
  if (!response.ok) {
    const errorData = await response.json();
    throw new Error(errorData.message || "Falha ao remover item do carrinho.");
  }
  // Se a resposta for OK e não houver conteúdo JSON relevante, apenas retorna.
  // Se o seu PHP retorna algo (ex: { status: "success" }), você pode ler:
  // return response.json(); // Se você precisa do JSON de resposta, mude o Promise<void> para Promise<any> ou o tipo do JSON.
};
