"use client";

export default function About() {
    return (
        <main className="min-h-screen mt-30 p-6 flex justify-center items-start ">
            <section className="max-w-4xl bg-white/5 backdrop-blur-md border border-white/10 rounded-2xl shadow-xl p-10 text-slate-200 space-y-8">
                <h1 className="text-4xl font-extrabold text-transparent bg-clip-text bg-gradient-to-r from-[#39D5FF] via-white to-[#39D5FF] uppercase text-center">
                    Sobre Nós
                </h1>

                <p className="text-lg leading-relaxed">
                    Bem-vindo à <strong className="text-[#39D5FF]">Atleta Digital</strong>, onde a inovação e o estilo se encontram!
                    Somos uma loja online especializada em roupas, acessórios e jogos de realidade aumentada voltados para academia, natação e musculação.
                    Nossa missão é proporcionar a melhor experiência de compra para nossos clientes, oferecendo produtos de alta qualidade que combinam tecnologia e moda.
                </p>

                <div className="space-y-4">
                    <h2 className="text-2xl font-semibold text-[#39D5FF]">Nossa Missão</h2>
                    <p className="text-lg leading-relaxed">
                        Acreditamos que a prática esportiva deve ser acessível, divertida e estilosa.
                        Por isso, selecionamos cuidadosamente cada item do nosso catálogo para garantir que você tenha o melhor desempenho, seja na academia, na piscina ou no seu treino de musculação.
                    </p>
                    <p className="text-lg leading-relaxed">
                        Estamos na vanguarda da tecnologia com nossos <strong>jogos de realidade aumentada</strong>, que transformam sua rotina de exercícios em uma experiência imersiva e interativa.
                        Com a realidade aumentada, você pode visualizar e experimentar nossos produtos de uma maneira totalmente nova, diretamente do conforto da sua casa.
                    </p>
                </div>

                <div className="space-y-4">
                    <h2 className="text-2xl font-semibold text-[#39D5FF]">Qualidade e Confiança</h2>
                    <p className="text-lg leading-relaxed">
                        Nosso compromisso é com a <strong>qualidade</strong> e a <strong>satisfação</strong> dos nossos clientes.
                        Trabalhamos com as melhores marcas e fornecedores para garantir que você receba produtos duráveis, confortáveis e com ótimo custo-benefício.
                    </p>
                    <p className="text-lg leading-relaxed">
                        Somos uma equipe apaixonada por esportes e tecnologia, dedicada a oferecer um atendimento personalizado e eficiente.
                        Estamos sempre prontos para ajudar você a encontrar o produto ideal e tirar qualquer dúvida.
                    </p>
                </div>
            </section>
        </main>
    );
}
