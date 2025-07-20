import Link from "next/link";
import styles from "@/components/layout/header/header.module.css";
import Image from "next/image";



export default function Header() {
  return (

    <header className={styles.header}>
        <Image
          src="/assets/logo.jpg"
          alt="Logo"
          width={80}
          height={80}
          className="md-6 mr-10 rounded-full shadow-md hover:shadow- [#39D5FF]"
        />
           
      <nav>
        <ul className={styles.navList}>
          <li><Link href="/about" className={styles.link}>Sobre</Link></li>
          <li><Link href="/." className={styles.link}>Home</Link></li>
          <li><Link href="/product" className={styles.link}>Produtos</Link></li>
          <li><Link href="/clientes" className={styles.link}>Clientes</Link></li>
          <li><Link href="/contato" className={styles.link}>Contato</Link></li>
          <li><Link href="/cart" className={styles.link}>Carrinho</Link></li>
        </ul>
      </nav>

      {/* Buscador */}
      <form action="/product" method="get" className={styles.searchForm}>
        <input
          type="text"
          name="search"
          placeholder="Buscar..."
          className={styles.searchBox}
        />
      </form>


      {/* Botões de autenticação */}
      <div className={styles.authButtons}>
        {/* Remover a tag <button> e aplicar a classe diretamente no Link */}
        <Link href="/cadastro" className={styles.authButton}>
          Cadastrar
        </Link>
        <Link href="/login" className={styles.authButton}>
          Entrar
        </Link>
      </div>
    </header>
  );
}
