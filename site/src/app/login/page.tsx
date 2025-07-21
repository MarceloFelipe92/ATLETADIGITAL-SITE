// src/app/login/page.tsx
"use client";

import { useState } from "react";
import { useRouter } from "next/navigation";
import { signIn } from "next-auth/react"; // Importa a função signIn do NextAuth.js
import Link from "next/link";

export default function LoginPage() {
  const [email, setEmail] = useState("");
  const [password, setPassword] = useState("");
  const [message, setMessage] = useState<string | null>(null); // Para exibir mensagens de erro/sucesso
  const router = useRouter(); // Para redirecionamento

  const handleSubmit = async (e: React.FormEvent) => {
    e.preventDefault();
    setMessage(null); // Limpa mensagens anteriores

    // Chama a função signIn do NextAuth.js com o provedor 'credentials'
    const result = await signIn("credentials", {
      email,
      password,
      redirect: false, // Importante para que o NextAuth.js não redirecione automaticamente e você possa tratar o erro
    });

    if (result?.error) {
      // Se houver um erro (retornado do NextAuth.js/authorize), exibe-o
      setMessage(result.error);
    } else {
      // Se o login for bem-sucedido, redireciona para a página home
      setMessage("Login bem-sucedido! Redirecionando...");
      router.push("/");
    }
  };

  return (
    <main className="min-h-screen flex items-center justify-center p-4">
      <div className="w-full max-w-md bg-white/5 backdrop-blur-sm rounded-2xl border border-white/10 shadow-xl p-8 space-y-6">
        <h1 className="text-2xl font-extrabold text-transparent bg-clip-text bg-gradient-to-r from-[#39D5FF] via-white to-[#39D5FF] text-center uppercase">
          Acesse sua Conta
        </h1>
        <p className="text-slate-300 text-center text-sm">
          Faça login para continuar suas compras e aproveitar todas as funcionalidades.
        </p>

        {message && ( // Exibe a mensagem de erro se houver
          <div className="text-red-500 text-center text-sm bg-red-500/10 border border-red-500/20 rounded p-2">
            {message}
          </div>
        )}

        <form onSubmit={handleSubmit} className="space-y-4">
          <div className="flex flex-col gap-1">
            <label htmlFor="email" className="text-slate-200 font-medium text-sm">
              Email
            </label>
            <input
              type="email"
              id="email"
              value={email}
              onChange={(e) => setEmail(e.target.value)}
              placeholder="Digite seu email"
              required
              className="rounded-lg border border-white/10 bg-white/10 placeholder-slate-400 text-white px-4 py-2 focus:outline-none focus:ring-2 focus:ring-[#39D5FF]/50 transition"
            />
          </div>

          <div className="flex flex-col gap-1">
            <label htmlFor="password" className="text-slate-200 font-medium text-sm">
              Senha
            </label>
            <input
              type="password"
              id="password"
              value={password}
              onChange={(e) => setPassword(e.target.value)}
              placeholder="Digite sua senha"
              required
              className="rounded-lg border border-white/10 bg-white/10 placeholder-slate-400 text-white px-4 py-2 focus:outline-none focus:ring-2 focus:ring-[#39D5FF]/50 transition"
            />
          </div>

          <button
            type="submit"
            className={`w-full rounded-2xl border-y-4 shadow-lg hover:border-[#39D5FF] p-3 flex items-center justify-center text-white hover:text-[#39D5FF] transition duration-300
              ${false ? "cursor-not-allowed" : "cursor-pointer"}
            `}
          >
            Entrar
          </button>
        </form>

        <p className="text-slate-300 text-center text-sm">
          Não tem uma conta?{" "}
          <Link href="/cadastro" className="text-[#39D5FF] hover:underline">
            Cadastre-se aqui
          </Link>.
        </p>
      </div>
    </main>
  );
}
