import { NextResponse } from "next/server";

export async function POST(request: Request) {
  try {
    // 1. Recebe os dados do formulário diretamente do frontend Next.js
    // Como o frontend envia FormData, podemos usá-lo diretamente aqui
    const formData = await request.formData();

    // 2. Envia esses mesmos dados (FormData) para o seu Backend PHP
    // Certifique-se de que a URL do seu backend PHP esteja correta
    const phpBackendUrl = "http://localhost:8080/clientes/post.php"; // <--- VERIFIQUE ESTA URL

    const phpResponse = await fetch(phpBackendUrl, {
      method: "POST",
      body: formData, // Envia o FormData recebido do frontend para o PHP
      // Next.js (e o navegador) lida automaticamente com o Content-Type: multipart/form-data com o 'body: FormData'
    });

    // 3. Lê a resposta do Backend PHP
    const phpResult = await phpResponse.json(); // Assume que seu PHP retorna JSON

    // 4. Se o PHP indicou um erro (status diferente de 2xx), retransmite o erro
    if (!phpResponse.ok) {
      console.error("Erro do Backend PHP:", phpResult.message);
      return NextResponse.json(
        { message: phpResult.message || "Erro no serviço de cadastro (PHP)." },
        { status: phpResponse.status }
      );
    }

    // 5. Se o PHP indicou sucesso, retransmite o sucesso para o frontend
    return NextResponse.json(phpResult, { status: phpResponse.status });
  } catch (error: unknown) {
    // <--- CORREÇÃO AQUI: 'any' para 'unknown'
    // Captura erros que ocorreram na API Route do Next.js (ex: problema de rede ao chamar o PHP)
    console.error("Erro na API Route /api/cadastro:", error);

    // Adicione uma verificação de tipo para acessar 'message' com segurança
    let errorMessage = "Erro interno do servidor ao processar o cadastro.";
    if (error instanceof Error) {
      errorMessage = error.message;
    } else if (
      typeof error === "object" &&
      error !== null &&
      "message" in error
    ) {
      errorMessage = (error as { message: string }).message;
    }

    return NextResponse.json(
      { message: errorMessage }, // <--- Usa a mensagem de erro mais específica
      { status: 500 }
    );
  }
}
