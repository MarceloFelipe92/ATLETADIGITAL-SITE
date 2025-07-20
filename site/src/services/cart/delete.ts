export const removeCartItem  = async (
  id_cliente: number,
  id_produto: number,
  token?: string
): Promise<void> => {
  const response = await fetch(
    `http://localhost:8080/carrinho`,
    {
      method: "DELETE",
      headers: {
        "Content-Type": "application/json",
        ...(token && { Authorization: `Bearer ${token}` }),
      },
      body: JSON.stringify({ id_cliente, id_produto}),
    }
  );
  if (!response.ok) throw new Error("Falha ao remover do carrinho");
};
