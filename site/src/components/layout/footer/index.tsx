import styles from "@/components/layout/footer/Footer.module.css";
import { FaInstagram, FaWhatsapp, FaFacebook } from "react-icons/fa";

export default function Footer() {
  return (
    <footer className={styles.footer}>
      <div className={styles.container}>
        {/* Seção Sobre */}
        <div className={styles.section}>
          <h3>Sobre</h3>
          <p>
            Seu e-commerce de confiança! Produtos de qualidade, entrega rápida e
            suporte dedicado.
          </p>
        </div>

        {/* Seção Links Rápidos */}
        <div className={styles.section}>
          <h3>Links Rápidos</h3>
          <ul>
            <li><a href="/about">Sobre Nós</a></li>
            <li><a href="/contato">Contato</a></li>
            <li><a href="/privacy">Política de Privacidade</a></li>
            <li><a href="/terms">Termos de Uso</a></li>
          </ul>
        </div>

        {/* Seção Contato */}
        <div className={styles.section}>
          <h3>Contato</h3>
          <ul>
            <li>Email: suporte@seuecommerce.com</li>
            <li>Telefone: (11) 99999-9999</li>
            <li>Endereço: Rua do E-commerce, 123 - São Paulo, SP</li>
          </ul>
        </div>

        {/* Redes Sociais */}
        <div className={styles.social}>
          <h3 className="text-lg font-semibold text-white mb-2">Siga nossas redes:</h3>
          <div className="flex items-center gap-4">
            <a
              href="https://www.instagram.com"
              target="_blank"
              rel="noopener noreferrer"
              aria-label="Instagram"
              className="text-[#E1306C] hover:scale-110 transition-transform duration-300"
            >
              <FaInstagram size={28} />
            </a>
            <a
              href="https://wa.me/5511999999999"
              target="_blank"
              rel="noopener noreferrer"
              aria-label="WhatsApp"
              className="text-[#25D366] hover:scale-110 transition-transform duration-300"
            >
              <FaWhatsapp size={28} />
            </a>
            <a
              href="https://www.facebook.com"
              target="_blank"
              rel="noopener noreferrer"
              aria-label="Facebook"
              className="text-[#1877F2] hover:scale-110 transition-transform duration-300"
            >
              <FaFacebook size={28} />
            </a>
          </div>
        </div>
      </div> {/* <-- fechamento correto da div.container */}

      {/* Copyright */}
      <div className={styles.copyright}>
        <p className="text-sm text-gray-400 text-center mt-6">
          © {new Date().getFullYear()} ATLETA DIGITAL. Todos os direitos reservados.
        </p>
      </div>
    </footer>
  );
}
