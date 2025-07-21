// Definir a estrutura do usuário retornado pela API
export interface IUser {
  id: string;
  email: string;
  name?: string | null; // Adicionado: Nome do usuário
  image?: string | null; // Adicionado: URL da imagem de perfil
  role?: string;
  token?: string;
}

// Interface para os dados da API (o que o PHP retorna dentro de 'data')
export interface ApiUserData {
  id_cliente: number | string;
  email: string;
  nome?: string | null; // Adicionado: Nome do usuário (como o PHP o chama)
  imagem?: string | null; // Adicionado: Nome do arquivo da imagem (como o PHP o chama)
  role?: string;
  token?: string;
}

// Interface para a resposta completa da API (status, data, message)
export interface ApiResponse {
  status: "success" | "error"; // Definir como literal para melhor tipagem
  data?: ApiUserData; // Pode ser opcional se o status for 'error'
  message?: string;
}

// Extender as interfaces padrão do NextAuth
import { DefaultSession, DefaultUser } from "next-auth"; // Importe DefaultSession também

declare module "next-auth" {
  // Estender a interface User do NextAuth para incluir suas propriedades personalizadas
  interface User extends DefaultUser {
    id: string;
    email: string;
    name?: string | null; // Corresponde ao IUser
    image?: string | null; // Corresponde ao IUser
    role?: string;
    token?: string;
  }

  // Estender a interface Session do NextAuth para incluir suas propriedades personalizadas
  interface Session extends DefaultSession {
    user: User; // Agora o 'user' dentro da Session terá o tipo estendido
    error?: string;
  }
}

// Estender a interface JWT do NextAuth para incluir suas propriedades personalizadas
import { DefaultJWT } from "next-auth/jwt";

declare module "next-auth/jwt" {
  interface JWT extends DefaultJWT {
    id: string;
    email: string;
    name?: string | null; // Corresponde ao token.name
    picture?: string | null; // Usado por NextAuth para a URL da imagem no token JWT
    role?: string;
    token?: string;
  }
}