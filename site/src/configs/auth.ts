// src/configs/auth.ts
import type { AuthOptions } from "next-auth";
import CredentialsProvider from "next-auth/providers/credentials";
import { IUser, ApiResponse } from "@/interfaces/IUser"; // Certifique-se de que o caminho está correto

export const authOptions: AuthOptions = {
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

        // URL do seu Backend PHP para login
        const response = await fetch(
          "http://localhost:8080/clientes/login.php",
          {
            method: "POST",
            headers: { "Content-Type": "application/json" },
            body: JSON.stringify({ email, password: password }), // O nome do campo da senha deve corresponder ao seu PHP
          }
        );

        // Assume que o PHP retorna { status: "success", data: { ... } } ou { status: "error", message: "..." }
        const data: ApiResponse = await response.json();

        // Verifica se o status é 'success' E se 'data' existe E se 'id_cliente' está presente
        if (data.status === "success" && data.data && data.data.id_cliente) {
          const id = data.data.id_cliente.toString(); // O ID do cliente do PHP

          // Retorna um objeto de usuário que será armazenado na sessão do NextAuth.js
          // Mapeie os campos do PHP para a sua interface IUser
          return {
            id: id,
            email: data.data.email || "",
            name: data.data.nome || "", // 'nome' do PHP mapeado para 'name' do NextAuth.js
            role: data.data.role || "cliente", // 'role' do PHP ou um padrão
            token: data.data.token, // Certifique-se de que seu PHP retorna um 'token' (JWT, etc.)
            image: data.data.imagem // 'imagem' do PHP mapeado para 'image' do NextAuth.js
              ? `http://localhost:8080/clientes/imagens/${data.data.imagem}`
              : null, // URL completa da imagem
          } as IUser; // Garante que o objeto retornado seja do tipo IUser
        }

        // Se a autenticação falhou, lança um erro para que o NextAuth.js capture e retorne em result.error
        throw new Error(
          data.message || "Credenciais inválidas ou erro na autenticação."
        );
      },
    }),
  ],
  callbacks: {
    // Callback JWT: Adiciona informações do usuário ao token JWT
    async jwt({ token, user }) {
      if (user) {
        // 'user' está disponível apenas na primeira vez que o token JWT é criado (no login)
        // Adicione propriedades da sua interface IUser ao token
        token.id = user.id;
        token.email = user.email;
        token.name = user.name;
        token.role = user.role;
        token.token = (user as IUser).token; // Assegura o tipo para 'token'
        token.picture = (user as IUser).image; // Adiciona 'image' ao token (será 'picture' na sessão)
      }
      return token;
    },
    // Callback Session: Adiciona informações do token à sessão para acesso no cliente
    async session({ session, token }) {
      if (token) {
        // Mapeia as propriedades do token para o objeto session.user
        session.user = {
          id: token.id as string,
          email: token.email as string,
          name: token.name as string | undefined,
          role: token.role as string | undefined,
          token: token.token as string | undefined,
          image: token.picture as string | undefined, // Mapeia 'picture' do token para 'image' na sessão
        };
      }
      return session;
    },
  },
  pages: {
    signIn: "/login", // Redireciona para sua página de login personalizada
    error: "/login", // Redireciona para sua página de login em caso de erro
  },
  session: {
    strategy: "jwt", // Usa estratégia JWT para sessões
    maxAge: 1800, // Duração da sessão em segundos (30 minutos)
  },
  secret: process.env.NEXTAUTH_SECRET, // Variável de ambiente obrigatória (definida em .env.local)
  // debug: process.env.NODE_ENV === "development", // Habilita logs de depuração em desenvolvimento
};
