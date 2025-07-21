"use client";

export default function Privacy() {
    return (
        <main className="min-h-screen mt-30 p-6 flex justify-center items-start">
            <article className="max-w-4xl bg-white/5 backdrop-blur-md border border-white/10 rounded-2xl shadow-xl p-10 text-slate-200 space-y-8">
                <h1 className="text-4xl font-extrabold text-transparent bg-clip-text bg-gradient-to-r from-[#39D5FF] via-white to-[#39D5FF] uppercase text-center">
                    Política de Privacidade - Atleta Digital
                </h1>

                <p className="text-lg leading-relaxed">
                    Na <strong className="text-[#39D5FF]">Atleta Digital</strong>, levamos a sua privacidade a sério. Esta Política de Privacidade descreve como coletamos, usamos, compartilhamos e protegemos suas informações pessoais quando você visita nosso site, utiliza nossos serviços ou adquire nossos produtos. Ao acessar ou usar a <strong>Atleta Digital</strong>, você concorda com os termos desta política.
                </p>

                {/* Seções principais */}
                <section className="space-y-6">
                    <Section
                        title="1. Informações que Coletamos"
                        content={
                            <>
                                <p>Podemos coletar diferentes tipos de informações pessoais, incluindo:</p>
                                <ul className="list-disc list-inside space-y-2">
                                    <li><b>Informações de Identificação Pessoal (PII):</b> Nome, endereço de e-mail, endereço postal, número de telefone, data de nascimento e outras informações semelhantes que você nos fornece ao criar uma conta, fazer um pedido, assinar nossa newsletter ou entrar em contato conosco.</li>
                                    <li><b>Informações de Pagamento:</b> Detalhes do cartão de crédito ou outras informações de pagamento necessárias para processar suas compras. Essas informações são processadas por nossos provedores de pagamento seguros e não são armazenadas diretamente em nossos servidores.</li>
                                    <li><b>Informações de Uso:</b> Dados sobre como você interage com nosso site e serviços, incluindo as páginas que você visita, os produtos que você visualiza, o tempo gasto em nosso site, os links em que você clica e outras ações.</li>
                                    <li><b>Informações do Dispositivo:</b> Informações sobre o seu dispositivo, como endereço IP, tipo de navegador, sistema operacional, identificadores exclusivos do dispositivo e informações da rede móvel.</li>
                                    <li><b>Informações de Localização (se aplicável):</b> Podemos coletar informações sobre sua localização geográfica se você habilitar os serviços de localização em seu dispositivo.</li>
                                    <li><b>Informações de Marketing e Comunicações:</b> Suas preferências para receber marketing e comunicações de nós e de terceiros.</li>
                                    <li><b>Informações de Realidade Aumentada (RA):</b> Se você utilizar nossos jogos ou funcionalidades de realidade aumentada, podemos coletar dados sobre suas interações dentro dessas experiências, como movimentos, escolhas e dados de uso do aplicativo de RA.</li>
                                </ul>
                            </>
                        }
                    />

                    <Section
                        title="2. Como Usamos Suas Informações"
                        content={
                            <>
                                <p>Utilizamos suas informações pessoais para diversos fins, incluindo:</p>
                                <ul className="list-disc list-inside space-y-2">
                                    <li><b>Processar e Gerenciar Pedidos:</b> Para processar seus pedidos de compra de roupas, acessórios e jogos de realidade aumentada, incluindo o envio de confirmações de pedidos, informações de envio e faturas.</li>
                                    <li><b>Fornecer e Personalizar Serviços:</b> Para fornecer os serviços que você solicita, personalizar sua experiência de compra, recomendar produtos relevantes e exibir conteúdo adaptado aos seus interesses (incluindo produtos para academia, natação, musculação e realidade virtual).</li>
                                    <li><b>Gerenciar sua Conta:</b> Para criar e gerenciar sua conta de usuário, incluindo o processamento de logins, recuperação de senha e atualização de informações da conta.</li>
                                    <li><b>Comunicação:</b> Para nos comunicarmos com você sobre seus pedidos, dúvidas, solicitações de suporte e para enviar informações importantes sobre nossos produtos, serviços e promoções (de acordo com suas preferências de comunicação).</li>
                                    <li><b>Marketing:</b> Para enviar newsletters, ofertas especiais e outras comunicações de marketing sobre nossos produtos e serviços que possam ser do seu interesse. Você pode optar por não receber essas comunicações a qualquer momento.</li>
                                    <li><b>Melhorar Nosso Site e Serviços:</b> Para analisar o uso do nosso site e serviços, realizar pesquisas, solucionar problemas técnicos e melhorar a funcionalidade e o design da nossa plataforma.</li>
                                    <li><b>Segurança e Prevenção de Fraudes:</b> Para proteger nosso site e nossos usuários contra fraudes, atividades não autorizadas e outras atividades ilegais.</li>
                                    <li><b>Cumprimento Legal:</b> Para cumprir obrigações legais e regulatórias.</li>
                                    <li><b>Experiências de Realidade Aumentada:</b> Para fornecer e melhorar nossos jogos e funcionalidades de realidade aumentada, incluindo o rastreamento de suas interações e a personalização da experiência.</li>
                                </ul>
                            </>
                        }
                    />

                    <Section
                        title="3. Compartilhamento de Suas Informações"
                        content={
                            <>
                                <p>Podemos compartilhar suas informações pessoais com terceiros nas seguintes circunstâncias:</p>
                                <ul className="list-disc list-inside space-y-2">
                                    <li><b>Provedores de Serviços:</b> Compartilhamos informações com empresas que nos ajudam a operar nosso negócio, como processadores de pagamento, empresas de logística para entrega de produtos, provedores de serviços de marketing, análise de dados e hospedagem de sites. Esses provedores estão contratualmente obrigados a proteger suas informações e usá-las apenas para os fins especificados.</li>
                                    <li><b>Parceiros de Marketing:</b> Podemos compartilhar informações não identificáveis ou agregadas com parceiros de marketing para fins promocionais. Com seu consentimento, podemos compartilhar suas informações de contato com parceiros para que eles possam lhe enviar informações sobre produtos ou serviços que possam ser do seu interesse.</li>
                                    <li><b>Transações de Negócios:</b> Em caso de fusão, aquisição, venda de ativos ou outra transação de negócios, suas informações podem ser transferidas como parte dos ativos da empresa.</li>
                                    <li><b>Obrigações Legais:</b> Podemos divulgar suas informações pessoais se formos obrigados a fazê-lo por lei, ordem judicial ou outro processo legal, ou se acreditarmos de boa fé que a divulgação é necessária para proteger nossos direitos, sua segurança ou a segurança de outros.</li>
                                    <li><b>Com Seu Consentimento:</b> Podemos compartilhar suas informações com terceiros com seu consentimento explícito.</li>
                                </ul>
                            </>
                        }
                    />

                    <Section
                        title="4. Seus Direitos de Privacidade"
                        content={
                            <>
                                <p>Você tem certos direitos em relação às suas informações pessoais, incluindo:</p>
                                <ul className="list-disc list-inside space-y-2">
                                    <li><b>Acesso:</b> Você tem o direito de solicitar acesso às informações pessoais que mantemos sobre você.</li>
                                    <li><b>Correção:</b> Você tem o direito de solicitar a correção de informações pessoais imprecisas ou incompletas.</li>
                                    <li><b>Exclusão:</b> Você tem o direito de solicitar a exclusão de suas informações pessoais, sujeito a certas exceções legais.</li>
                                    <li><b>Objeção ao Marketing:</b> Você tem o direito de se opor ao recebimento de comunicações de marketing direto.</li>
                                    <li><b>Restrição de Processamento:</b> Você tem o direito de solicitar a restrição do processamento de suas informações pessoais em certas circunstâncias.</li>
                                    <li><b>Portabilidade de Dados:</b> Você tem o direito de solicitar a portabilidade de suas informações pessoais para outro controlador de dados em um formato estruturado, comumente usado e legível por máquina.</li>
                                    <li><b>Retirar o Consentimento:</b> Se você tiver dado seu consentimento para o processamento de suas informações pessoais, você tem o direito de retirar seu consentimento a qualquer momento.</li>
                                </ul>
                                <p>
                                    Para exercer qualquer um desses direitos, entre em contato conosco através das informações fornecidas na seção &quot;Contato&quot; abaixo. Podemos solicitar que você verifique sua identidade antes de responder à sua solicitação.
                                </p>
                            </>
                        }
                    />

                    <Section
                        title="5. Segurança de Suas Informações"
                        content={
                            <p>
                                Implementamos medidas de segurança técnicas e organizacionais razoáveis para proteger suas informações pessoais contra acesso não autorizado, uso indevido, alteração ou destruição. Essas medidas incluem criptografia de dados sensíveis, firewalls, controles de acesso e revisões regulares de nossas práticas de segurança. No entanto, observe que nenhuma transmissão de dados pela Internet ou sistema de armazenamento eletrônico é completamente seguro. Portanto, não podemos garantir a segurança absoluta de suas informações.
                            </p>
                        }
                    />

                    <Section
                        title="6. Retenção de Suas Informações"
                        content={
                            <p>
                                Reteremos suas informações pessoais pelo tempo necessário para cumprir os fins para os quais foram coletadas, conforme descrito nesta Política de Privacidade, a menos que um período de retenção mais longo seja exigido ou permitido por lei.
                            </p>
                        }
                    />

                    <Section
                        title="7. Cookies e Tecnologias Semelhantes"
                        content={
                            <>
                                <p>
                                    Utilizamos cookies e outras tecnologias de rastreamento semelhantes (como web beacons e pixels) para coletar informações sobre sua atividade de navegação em nosso site. Esses cookies podem ser cookies de sessão (temporários e excluídos quando você fecha o navegador) ou cookies persistentes (que permanecem em seu dispositivo por um período mais longo). Usamos cookies para:
                                </p>
                                <ul className="list-disc list-inside space-y-2">
                                    <li><b>Funcionalidade do Site:</b> Permitir que nosso site funcione corretamente, como manter você conectado à sua conta e lembrar seus itens no carrinho de compras.</li>
                                    <li><b>Análise:</b> Analisar como os usuários interagem com nosso site para melhorar seu desempenho e design.</li>
                                    <li><b>Personalização:</b> Personalizar sua experiência, como lembrar suas preferências de idioma e mostrar recomendações de produtos relevantes.</li>
                                    <li><b>Marketing:</b> Exibir anúncios relevantes para você em nosso site e em outros sites.</li>
                                </ul>
                                <p>
                                    Você pode controlar o uso de cookies através das configurações do seu navegador. No entanto, desativar certos cookies pode afetar a funcionalidade do nosso site.
                                </p>
                            </>
                        }
                    />

                    <Section
                        title="8. Privacidade de Crianças"
                        content={
                            <p>
                                Nosso site e serviços não são direcionados a crianças menores de 18 anos. Não coletamos intencionalmente informações pessoais de crianças. Se descobrirmos que coletamos informações pessoais de uma criança, tomaremos medidas para excluí-las o mais rápido possível.
                            </p>
                        }
                    />

                    <Section
                        title="9. Links para Outros Sites"
                        content={
                            <p>
                                Nosso site pode conter links para outros sites que não são operados por nós. Não somos responsáveis pelo conteúdo ou pelas práticas de privacidade desses sites de terceiros. Recomendamos que você revise as políticas de privacidade de todos os sites que visitar.
                            </p>
                        }
                    />

                    <Section
                        title="10. Alterações a Esta Política de Privacidade"
                        content={
                            <p>
                                Podemos atualizar esta Política de Privacidade periodicamente para refletir mudanças em nossas práticas de informações. Publicaremos a versão atualizada em nosso site e indicaremos a data da última atualização. Recomendamos que você revise esta política regularmente para estar ciente de quaisquer alterações. As alterações entram em vigor após a publicação.
                            </p>
                        }
                    />

                    <section className="space-y-4">
                        <h2 className="text-2xl font-semibold text-[#39D5FF]">11. Contato</h2>
                        <p>Se você tiver alguma dúvida, preocupação ou solicitação em relação a esta Política de Privacidade ou ao tratamento de suas informações pessoais, entre em contato conosco através dos seguintes meios:</p>
                        <address className="not-italic space-y-1 text-lg leading-relaxed">
                            <p><strong>Atleta Digital</strong></p>
                            <p>Rodrigo Silva</p>
                            <p>Rua das Palmeiras, 123, Centro, São Paulo - SP, 01000-000</p>
                            <p>contato@atletadigital.com.br</p>
                            <p>(11) 99999-8888</p>
                        </address>
                    </section>

                    <p>
                        Ao utilizar a <strong className="text-[#39D5FF]">Atleta Digital</strong>, você reconhece que leu e compreendeu esta Política de Privacidade e concorda em estar vinculado aos seus termos.
                    </p>
                </section>
            </article>
        </main>
    );
}

// Componente auxiliar para seções
function Section({
    title,
    content,
}: {
    title: string;
    content: React.ReactNode;
}) {
    return (
        <section className="space-y-3">
            <h2 className="text-2xl font-semibold text-[#39D5FF]">{title}</h2>
            <div className="text-lg leading-relaxed">{content}</div>
        </section>
    );
}
