"use client";

export default function Terms() {
  return (
    <main className="min-h-screen mt-30 p-6 flex justify-center items-start">
      <section className="max-w-4xl bg-white/5 backdrop-blur-md border border-white/10 rounded-2xl shadow-xl p-10 text-slate-200 space-y-8">
        <h1 className="text-4xl font-extrabold text-transparent bg-clip-text bg-gradient-to-r from-[#39D5FF] via-white to-[#39D5FF] uppercase text-center">
          Termos de Uso
        </h1>

        <p className="text-lg leading-relaxed">
          Bem-vindo(a) à <strong className="text-[#39D5FF]">Atleta Digital</strong>! Ao acessar e utilizar nosso site e serviços, você concorda com os seguintes termos e condições. Leia atentamente este documento.
        </p>

        <div className="space-y-8">
          <section>
            <h2 className="text-2xl font-semibold text-[#39D5FF] mb-2">1. Aceitação dos Termos</h2>
            <p className="text-lg leading-relaxed">
              Ao acessar ou usar qualquer parte deste site ou nossos serviços, você concorda em ficar vinculado por estes Termos de Uso. Se você não concordar com todos os termos e condições deste acordo, então você não pode acessar o site ou usar quaisquer serviços.
            </p>
          </section>

          <section>
            <h2 className="text-2xl font-semibold text-[#39D5FF] mb-2">2. Descrição dos Serviços</h2>
            <p className="text-lg leading-relaxed">
              A <strong className="text-[#39D5FF]">Atleta Digital</strong> é uma loja online especializada em roupas, acessórios e jogos de realidade aumentada voltados para praticantes de musculação, natação, futebol e realidade virtual.
            </p>
          </section>

          <section>
            <h2 className="text-2xl font-semibold text-[#39D5FF] mb-2">3. Uso do Site</h2>
            <ul className="list-disc list-inside space-y-2 text-lg leading-relaxed">
              <li>Você concorda em usar o site apenas para fins legais e de maneira que não infrinja os direitos de terceiros.</li>
              <li>Você não deve transmitir material difamatório, obsceno ou ilegal.</li>
              <li>Você é responsável por manter a confidencialidade de suas informações de login.</li>
              <li>Reservamo-nos o direito de modificar ou descontinuar o site a qualquer momento.</li>
            </ul>
          </section>

          <section>
            <h2 className="text-2xl font-semibold text-[#39D5FF] mb-2">4. Produtos e Preços</h2>
            <ul className="list-disc list-inside space-y-2 text-lg leading-relaxed">
              <li>Todos os produtos estão sujeitos à disponibilidade.</li>
              <li>Preços podem ser alterados sem aviso prévio.</li>
              <li>As cores e imagens podem variar dependendo da tela do usuário.</li>
              <li>Erros nas descrições podem ser corrigidos sem aviso prévio.</li>
            </ul>
          </section>

          <section>
            <h2 className="text-2xl font-semibold text-[#39D5FF] mb-2">5. Pedidos e Pagamentos</h2>
            <ul className="list-disc list-inside space-y-2 text-lg leading-relaxed">
              <li>Ao fazer um pedido, você concorda com estes termos.</li>
              <li>Pedidos podem ser recusados por diversos motivos.</li>
              <li>Você deve fornecer informações de pagamento precisas.</li>
            </ul>
          </section>

          <section>
            <h2 className="text-2xl font-semibold text-[#39D5FF] mb-2">6. Envio e Entrega</h2>
            <p className="text-lg leading-relaxed">Consulte a página de envio para detalhes sobre prazos e custos.</p>
          </section>

          <section>
            <h2 className="text-2xl font-semibold text-[#39D5FF] mb-2">7. Devoluções e Trocas</h2>
            <p className="text-lg leading-relaxed">Consulte a página de devoluções para mais informações sobre procedimentos e condições.</p>
          </section>

          <section>
            <h2 className="text-2xl font-semibold text-[#39D5FF] mb-2">8. Propriedade Intelectual</h2>
            <p className="text-lg leading-relaxed">O conteúdo deste site é protegido por direitos autorais pertencentes à <strong className="text-[#39D5FF]">Atleta Digital</strong> ou a seus parceiros.</p>
          </section>

          <section>
            <h2 className="text-2xl font-semibold text-[#39D5FF] mb-2">9. Limitação de Responsabilidade</h2>
            <p className="text-lg leading-relaxed">A <strong className="text-[#39D5FF]">Atleta Digital</strong> não se responsabiliza por danos indiretos decorrentes do uso do site ou de seus serviços.</p>
          </section>

          <section>
            <h2 className="text-2xl font-semibold text-[#39D5FF] mb-2">10. Indenização</h2>
            <p className="text-lg leading-relaxed">Você concorda em isentar a <strong className="text-[#39D5FF]">Atleta Digital</strong> de qualquer responsabilidade relacionada ao uso do site.</p>
          </section>

          <section>
            <h2 className="text-2xl font-semibold text-[#39D5FF] mb-2">11. Lei Aplicável</h2>
            <p className="text-lg leading-relaxed">Estes termos são regidos pelas leis do Brasil.</p>
          </section>

          <section>
            <h2 className="text-2xl font-semibold text-[#39D5FF] mb-2">12. Alterações aos Termos de Uso</h2>
            <p className="text-lg leading-relaxed">Podemos alterar estes termos a qualquer momento. O uso contínuo do site constitui aceitação.</p>
          </section>

          <section>
            <h2 className="text-2xl font-semibold text-[#39D5FF] mb-2">13. Contato</h2>
            <p className="text-lg leading-relaxed">Dúvidas? Fale conosco:</p>
            <ul className="list-none text-lg leading-relaxed space-y-1">
              <li><strong className="text-[#39D5FF]">Atleta Digital</strong></li>
              <li>Rodrigo Silva</li>
              <li>Rua das Palmeiras, 123 - Centro, São Paulo/SP</li>
              <li>contato@atletadigital.com.br</li>
              <li>(11) 91234-5678</li>
            </ul>
          </section>
        </div>
      </section>
    </main>
  );
}
