// src/app/api/auth/[...nextauth]/route.ts
import NextAuth from "next-auth";
import { authOptions } from "@/configs/auth"; // Importa as opções do arquivo de configuração

// Cria o handler do NextAuth.js usando as opções importadas
const handler = NextAuth(authOptions);

// Exporta os manipuladores GET e POST, conforme exigido pelo Next.js App Router
// NENHUMA OUTRA EXPORTAÇÃO DEVE EXISTIR NESTE ARQUIVO, APENAS ESTAS DUAS LINHAS.
export { handler as GET, handler as POST };
