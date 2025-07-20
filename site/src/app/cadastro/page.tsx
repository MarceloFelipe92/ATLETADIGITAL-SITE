"use client";

import { useState } from "react";
import { useRouter } from "next/navigation";
import Link from "next/link";

export default function CadastroPage() {
    const [form, setForm] = useState({
        nome: "",
        cpf: "",
        email: "",
        senha: "",
        whatsapp: "",
        imagem: null as File | null,
        cep: "",
        logradouro: "",
        numero: "",
        complemento: "",
        bairro: "",
        cidade: "",
        estado: "",
    });

    const [message, setMessage] = useState<{ text: string; type: 'success' | 'error' } | null>(null);
    const router = useRouter();

    const handleChange = (e: React.ChangeEvent<HTMLInputElement | HTMLSelectElement>) => {
        const { name, value, files } = e.target as HTMLInputElement;

        if (name === "imagem" && files) {
            setForm((prev) => ({ ...prev, imagem: files[0] }));
        } else {
            setForm((prev) => ({ ...prev, [name]: value }));
        }
    };

    const handleSubmit = async (e: React.FormEvent) => {
        e.preventDefault();
        setMessage(null);

        const data = new FormData();

        Object.entries(form).forEach(([key, value]) => {
            if (key === "imagem") {
                if (value) data.append("imagem", value);
            } else {
                data.append(key, value as string);
            }
        });

        try {
            const res = await fetch("/api/cadastro", {
                method: "POST",
                body: data,
            });

            const result = await res.json();

            if (!res.ok) {
                setMessage({ text: result.message || "Erro ao cadastrar.", type: 'error' });
                return;
            }

            setMessage({ text: "Cadastro realizado com sucesso! Redirecionando...", type: 'success' });

            setTimeout(() => {
                router.push("/login");
            }, 3000);

        } catch (error: any) {
            setMessage({ text: error.message || "Erro inesperado. Tente novamente.", type: 'error' });
        }
    };

    return (
        <main className="min-h-screen flex mt-30 items-center justify-center p-4">
            <div className="w-full max-w-2xl bg-white/5 backdrop-blur-sm rounded-2xl border border-white/10 shadow-xl p-8 space-y-6">
                <h1 className="text-2xl font-extrabold text-transparent bg-clip-text bg-gradient-to-r from-[#39D5FF] via-white to-[#39D5FF] text-center uppercase">
                    Cadastre-se
                </h1>
                <p className="text-slate-300 text-center text-sm">
                    Preencha os campos abaixo para criar sua conta.
                </p>

                {message && (
                    <div
                        className={`text-center text-sm rounded p-2 ${message.type === 'success'
                            ? 'bg-green-500/10 border border-green-500/20 text-green-500'
                            : 'bg-red-500/10 border border-red-500/20 text-red-500'
                            }`}
                    >
                        {message.text}
                    </div>
                )}

                <form onSubmit={handleSubmit} className="grid grid-cols-1 md:grid-cols-2 gap-4">
                    {/* Dados pessoais */}
                    <Input label="Nome" name="nome" value={form.nome} onChange={handleChange} />
                    <Input label="CPF" name="cpf" value={form.cpf} onChange={handleChange} />
                    <Input label="Email" name="email" type="email" value={form.email} onChange={handleChange} />
                    <Input label="Senha" name="senha" type="password" value={form.senha} onChange={handleChange} />
                    <Input label="WhatsApp" name="whatsapp" value={form.whatsapp} onChange={handleChange} />

                    <div className="md:col-span-2">
                        <label className="text-slate-200 text-sm block mb-1" htmlFor="imagem">
                            Foto de Perfil
                        </label>
                        <input
                            type="file"
                            id="imagem"
                            name="imagem"
                            accept="image/*"
                            onChange={handleChange}
                            className="text-white bg-white/10 border border-white/10 p-2 rounded w-full"
                        />
                    </div>

                    {/* Endereço */}
                    <Input label="CEP" name="cep" value={form.cep} onChange={handleChange} />
                    <Input label="Logradouro" name="logradouro" value={form.logradouro} onChange={handleChange} />
                    <Input label="Número" name="numero" value={form.numero} onChange={handleChange} />
                    <Input label="Complemento" name="complemento" value={form.complemento} onChange={handleChange} />
                    <Input label="Bairro" name="bairro" value={form.bairro} onChange={handleChange} />
                    <Input label="Cidade" name="cidade" value={form.cidade} onChange={handleChange} />
                    <Input label="Estado" name="estado" value={form.estado} onChange={handleChange} />

                    <button
                        type="submit"
                        // Adicionada a classe 'cursor-pointer' aqui
                        className="md:col-span-2 w-full rounded-2xl border-y-4 shadow-lg hover:border-[#39D5FF] p-3 flex items-center justify-center text-white hover:text-[#39D5FF] transition duration-300 cursor-pointer"
                    >
                        Cadastrar
                    </button>
                </form>

                <p className="text-slate-300 text-center text-sm">
                    Já tem uma conta?{" "}
                    <Link href="/login" className="text-[#39D5FF] hover:underline">
                        Acesse aqui
                    </Link>
                    .
                </p>
            </div>
        </main>
    );
}

function Input({
    label,
    name,
    value,
    onChange,
    type = "text",
}: {
    label: string;
    name: string;
    value: string;
    onChange: (e: React.ChangeEvent<HTMLInputElement>) => void;
    type?: string;
}) {
    return (
        <div className="flex flex-col gap-1">
            <label htmlFor={name} className="text-slate-200 text-sm">
                {label}
            </label>
            <input
                type={type}
                id={name}
                name={name}
                value={value}
                onChange={onChange}
                className="rounded-lg border border-white/10 bg-white/10 placeholder-slate-400 text-white px-4 py-2 focus:outline-none focus:ring-2 focus:ring-[#39D5FF]/50 transition"
            />
        </div>
    );
}