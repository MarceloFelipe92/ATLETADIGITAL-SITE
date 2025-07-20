// src/app/api/auth/[...nextauth]/route.ts
import NextAuth, { NextAuthOptions } from "next-auth";
import CredentialsProvider from "next-auth/providers/credentials";
// Certifique-se de que o caminho para IUser e ApiResponse está correto
import { IUser, ApiResponse } from "@/interfaces/IUser"; 

export const authOptions: NextAuthOptions = {
  providers: [
    CredentialsProvider({
      name: "Credentials",
      credentials: {
        email: { label: "Email", type: "text" },
        password: { label: "Password", type: "password" },
      },
      authorize: async (credentials) => {
        const { email, password } = credentials as {
          email: string;
          password: string;
        };

        // --- CORREÇÃO AQUI: URL do PHP e nome do campo da senha ---
        const response = await fetch("http://localhost:8080/clientes/login.php", { // <--- URL CORRIGIDA
          method: "POST",
          headers: { "Content-Type": "application/json" },
          body: JSON.stringify({ email, password: password }), // <--- CAMPO 'password' AGORA
        });

        // O PHP retorna { status: "success", data: { ... } } ou { status: "error", message: "..." }
        const data: ApiResponse = await response.json();

        // --- CORREÇÃO AQUI: Verificação da resposta do PHP ---
        // Verifica se o status é 'success' E se 'data' existe E não está vazio
        if (data.status === "success" && data.data && data.data.id_cliente) {
          const id = data.data.id_cliente.toString(); // id_cliente vem do PHP

          // Retorne um objeto de usuário que será armazenado na sessão do NextAuth.js
          // Mapeie os campos do PHP para o seu IUser
          return {
            id: id,
            email: data.data.email || "",
            name: data.data.nome || "", // Adicionado 'name'
            role: data.data.role || "cliente", // Use o role do PHP ou um padrão
            // Se o PHP retornar um token, adicione aqui
            // token: data.data.token, 
            image: data.data.image ? `http://localhost:8080/clientes/imagens/${data.data.image}` : null, // URL completa da imagem
          } as IUser; // Garante que o objeto retornado seja do tipo IUser
        }

        // Se a autenticação falhou (status 'error' ou dados inválidos)
        // Lança um erro para que o NextAuth.js capture e retorne em result.error
        throw new Error(data.message || "Credenciais inválidas ou erro na autenticação.");
      },
    }),
  ],
  callbacks: {
    async jwt({ token, user }) {
      if (user) {
        // user está disponível apenas na primeira vez (no login)
        // Adicione propriedades do IUser ao token
        token.id = user.id;
        token.email = user.email;
        token.name = user.name; // Adicionado name ao token
        token.role = user.role;
        token.token = user.token;
        token.picture = user.image; // Adicionado image ao token (para uso em useSession().data.user.image)
      }
      return token;
    },
    async session({ session, token }) {
      if (token) {
        // Adicione propriedades do token à sessão para acesso no cliente
        session.user = {
          id: token.id as string,
          email: token.email as string,
          name: token.name as string | undefined, // Adicionado name à sessão
          role: token.role as string | undefined,
          token: token.token as string | undefined,
          image: token.picture as string | undefined, // Adicionado image à sessão
        };
      }
      return session;
    },
  },
  pages: {
    signIn: "/login", // Redireciona para sua página de login personalizada
  },
  session: {
    strategy: "jwt",
    maxAge: 1800, // Duração da sessão em segundos (30 minutos)
  },
  secret: process.env.NEXTAUTH_SECRET, // Variável de ambiente obrigatória
  // debug: process.env.NODE_ENV === "development", // Habilita logs de depuração em desenvolvimento
};

// Crie o handler a partir das opções
const handler = NextAuth(authOptions);

// Exporte o handler com os nomes esperados pelo Next.js App Router
export { handler as GET, handler as POST };