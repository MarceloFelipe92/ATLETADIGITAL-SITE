-- MariaDB dump 10.19  Distrib 10.4.32-MariaDB, for Win64 (AMD64)
--
-- Host: localhost    Database: db_backend
-- ------------------------------------------------------
-- Server version	10.4.32-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `carrinhos`
--

DROP TABLE IF EXISTS `carrinhos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `carrinhos` (
  `id_carrinho` int(11) NOT NULL AUTO_INCREMENT,
  `id_cliente` int(11) NOT NULL,
  `data` date NOT NULL DEFAULT curdate(),
  PRIMARY KEY (`id_carrinho`),
  KEY `id_cliente` (`id_cliente`),
  CONSTRAINT `carrinhos_ibfk_1` FOREIGN KEY (`id_cliente`) REFERENCES `clientes` (`id_cliente`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `carrinhos`
--

LOCK TABLES `carrinhos` WRITE;
/*!40000 ALTER TABLE `carrinhos` DISABLE KEYS */;
/*!40000 ALTER TABLE `carrinhos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `clientes`
--

DROP TABLE IF EXISTS `clientes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `clientes` (
  `id_cliente` int(11) NOT NULL AUTO_INCREMENT,
  `nome` char(100) NOT NULL,
  `imagem` varchar(80) DEFAULT NULL,
  `logradouro` char(150) NOT NULL,
  `numero` char(20) NOT NULL,
  `complemento` char(40) NOT NULL,
  `bairro` char(40) NOT NULL,
  `cidade` char(30) NOT NULL,
  `cep` char(9) NOT NULL,
  `estado` char(2) DEFAULT NULL,
  `email` char(100) DEFAULT NULL,
  `whatsapp` char(16) DEFAULT NULL,
  `cpf` char(14) DEFAULT NULL,
  `senha` varchar(255) NOT NULL,
  PRIMARY KEY (`id_cliente`)
) ENGINE=InnoDB AUTO_INCREMENT=40 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `clientes`
--

LOCK TABLES `clientes` WRITE;
/*!40000 ALTER TABLE `clientes` DISABLE KEYS */;
/*!40000 ALTER TABLE `clientes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `fornecedores`
--

DROP TABLE IF EXISTS `fornecedores`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `fornecedores` (
  `id_fornecedor` int(11) NOT NULL AUTO_INCREMENT,
  `razao_social` char(100) DEFAULT NULL,
  `cnpj` char(18) DEFAULT NULL,
  `telefone` char(14) DEFAULT NULL,
  `email` char(100) DEFAULT NULL,
  `logradouro` char(150) DEFAULT NULL,
  `numero` char(20) DEFAULT NULL,
  `complemento` char(40) DEFAULT NULL,
  `bairro` char(40) DEFAULT NULL,
  `cidade` char(30) DEFAULT NULL,
  `cep` char(9) DEFAULT NULL,
  `estado` char(2) DEFAULT NULL,
  PRIMARY KEY (`id_fornecedor`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `fornecedores`
--

LOCK TABLES `fornecedores` WRITE;
/*!40000 ALTER TABLE `fornecedores` DISABLE KEYS */;
/*!40000 ALTER TABLE `fornecedores` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `marcas`
--

DROP TABLE IF EXISTS `marcas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `marcas` (
  `id_marca` int(11) NOT NULL AUTO_INCREMENT,
  `marca` char(40) NOT NULL,
  PRIMARY KEY (`id_marca`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `marcas`
--

LOCK TABLES `marcas` WRITE;
/*!40000 ALTER TABLE `marcas` DISABLE KEYS */;
INSERT INTO `marcas` VALUES (1,'Nike'),(2,'Adidas'),(3,'Puma'),(4,'Penalty'),(5,'Xiaomi'),(6,'Speedo'),(7,'Everlast'),(8,'PowerGym');
/*!40000 ALTER TABLE `marcas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `produtos`
--

DROP TABLE IF EXISTS `produtos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `produtos` (
  `id_produto` int(11) NOT NULL AUTO_INCREMENT,
  `produto` char(100) NOT NULL,
  `descricao` text DEFAULT NULL,
  `id_marca` int(11) NOT NULL,
  `imagem` char(80) DEFAULT NULL,
  `quantidade` int(11) DEFAULT NULL,
  `preco` decimal(8,2) DEFAULT NULL,
  PRIMARY KEY (`id_produto`),
  KEY `id_marca` (`id_marca`),
  CONSTRAINT `produtos_ibfk_1` FOREIGN KEY (`id_marca`) REFERENCES `marcas` (`id_marca`)
) ENGINE=InnoDB AUTO_INCREMENT=58 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `produtos`
--

LOCK TABLES `produtos` WRITE;
/*!40000 ALTER TABLE `produtos` DISABLE KEYS */;
INSERT INTO `produtos` VALUES (31,'Camisa Masculina - Algodão Premium','Renove seu estilo com a camisa Urban Roots: moderna, versátil e feita para quem valoriza conforto e autenticidade. Confeccionada em algodão premium 100% orgânico, esta peça oferece toque suave, respirabilidade e caimento impecável. A modelagem slim ajusta-se ao corpo sem apertar, valorizando a silhueta com elegância.\r\n\r\nCom estampa geométrica discreta em tons terrosos e botões de madeira ecológica, a Urban Roots une o urbano ao natural. Ideal para transitar com estilo do trabalho ao happy hour, essa camisa é a escolha certa para quem quer se destacar sem exageros.',6,'16894178c73871f0ea6bef737889e2fb.png',10,89.90),(44,'Camisa Wave Club – Estilo e Liberdade em Cada Costura','Aposte na vibe descontraída com a camisa oversized Wave Club. Feita em tecido misto de algodão e linho, essa peça traz leveza, textura e um visual naturalmente estiloso. O corte amplo e reto proporciona liberdade de movimento e um visual moderno que combina com qualquer ocasião.\r\n\r\nCom estampa tie-dye em tons suaves de azul e areia, bolsos frontais utilitários e gola cubana, ela é perfeita para quem curte um look relaxado, mas cheio de personalidade. Use aberta sobre uma camiseta ou fechada com jeans – o resultado é sempre autêntico.',6,'c671c4823ad130f7a92eee49ed8760a5.png',16,82.00),(46,'Camisa  Fit Verona NIKE – Sofisticação em Cada Detalhe','A Camisa Verona é o equilíbrio perfeito entre elegância clássica e design moderno. Confeccionada em tecido tricoline de alta qualidade, ela apresenta um toque macio e acabamento acetinado que garante sofisticação em qualquer ocasião.\r\n\r\nCom modelagem slim fit, gola italiana estruturada e punhos ajustáveis, a Verona valoriza o caimento e traz um visual impecável do escritório ao jantar especial. Os botões personalizados em madrepérola e a costura refinada demonstram atenção aos mínimos detalhes.\r\n\r\nDisponível em cores neutras e atemporais, é a escolha ideal para quem quer impressionar com discrição e bom gosto.\r\n\r\n',1,'d68077d6e11f06de8ca29216fbacc50e.png',18,89.00),(49,'Camisa Street Unissex RAW Layer – Atitude e Conforto no Mesmo Look','A RAW Layer chegou para elevar seu visual urbano. Com um design oversized e tecido leve de viscose com toque aveludado, essa camisa é perfeita para quem curte estilo com personalidade e conforto de sobra.\r\n\r\nA estampa abstrata em tons contrastantes dá um ar ousado e artístico, enquanto os botões frontais e a gola reta mantêm o visual alinhado. Use como sobreposição ou peça principal — a RAW Layer combina com calça cargo, jeans rasgado ou até bermuda para um look autêntico e cheio de presença.\r\n\r\nIdeal para quem vive o ritmo da cidade e não abre mão de se expressar pela roupa.',2,'ba2219f9389663b53842842c7000924a.png',43,43.00),(50,'Camisa Minimal Essence – Menos é Mais','A Camisa Minimal Essence é a escolha certa para quem valoriza simplicidade com estilo. Feita em algodão egípcio de gramatura leve, oferece um caimento fluido e toque macio, perfeito para os dias em que conforto e elegância precisam andar juntos.\r\n\r\nSeu design clean, sem bolsos ou estampas, destaca a silhueta com sofisticação discreta. Gola padre e botões invisíveis completam o visual contemporâneo e refinado. Ideal para compor desde looks casuais até produções mais arrumadas com apenas alguns acessórios.\r\n\r\nDisponível em tons neutros como off-white, grafite e verde oliva, é uma peça-curinga que vai do trabalho ao fim de semana sem esforço.',2,'e49ea7c72e608954154ae9c3107ae6a1.png',43,43.00),(51,'Camisa Tropical Vibe – Leveza e Estilo em Clima de Verão','Sinta o clima das férias o ano inteiro com a Camisa Tropical Vibe. Feita em tecido rayon leve e respirável, ela traz conforto térmico e um toque macio ideal para os dias mais quentes. A estampa floral em cores vibrantes remete à energia do verão, com palmeiras, folhagens e tons quentes que chamam atenção sem exageros.\r\n\r\nCom modelagem regular, gola cubana e fechamento por botões de coco, essa peça combina com bermudas, calças leves ou até por cima de uma regata. Perfeita para o fim de semana, festas ao ar livre ou uma tarde à beira-mar.\r\n\r\nAposte na Tropical Vibe e leve o espírito do verão com você, onde for.',7,'e319121414534f302762b820d158f73f.png',2,62.00),(52,'Camisa Tech Performance – Movimento e Tecnologia para seu Dia a Dia','A Camisa Tech Performance foi desenvolvida para quem busca máxima mobilidade e conforto sem abrir mão do estilo. Confeccionada em tecido tecnológico com alta respirabilidade e secagem rápida, ela é ideal para atividades físicas ou para quem tem uma rotina dinâmica.\r\n\r\nSeu design moderno conta com detalhes refletivos para maior segurança à noite, gola com zíper oculto e costuras reforçadas que garantem durabilidade. A modelagem ergonômica acompanha os movimentos do corpo, proporcionando liberdade total.\r\n\r\nPerfeita para treinos, passeios ou até para o visual casual esportivo, a Tech Performance é a escolha certa para quem não para.',7,'caec1723cb9d783a8d95fc555ad28e3c.png',5,52.00),(53,'Camisa Vintage Heritage – Estilo Clássico com Toque Retrô','A Camisa Vintage Heritage resgata a elegância dos anos 70 com um design atemporal. Confeccionada em tecido algodão-poliéster de alta qualidade, ela traz conforto aliado a uma estética única, com padronagem xadrez clássica e cores sóbrias.\r\n\r\nDetalhes como a gola tradicional com ponta arredondada, botões envelhecidos e punhos ajustáveis reforçam o charme vintage da peça. A modelagem regular fit garante conforto e versatilidade para usar tanto no dia a dia quanto em ocasiões especiais.\r\n\r\nCombine com jeans ou calças de sarja para um visual autêntico, cheio de personalidade e história.',7,'3f342c7268735e74b980a5dcd8b0e450.png',5,61.99);
/*!40000 ALTER TABLE `produtos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `rl_carrinho_produto`
--

DROP TABLE IF EXISTS `rl_carrinho_produto`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `rl_carrinho_produto` (
  `id_rl` int(11) NOT NULL AUTO_INCREMENT,
  `id_carrinho` int(11) NOT NULL,
  `id_produto` int(11) NOT NULL,
  `qtde` int(11) NOT NULL,
  `valor` decimal(8,2) NOT NULL,
  PRIMARY KEY (`id_rl`),
  KEY `id_carrinho` (`id_carrinho`),
  KEY `id_produto` (`id_produto`),
  CONSTRAINT `rl_carrinho_produto_ibfk_1` FOREIGN KEY (`id_carrinho`) REFERENCES `carrinhos` (`id_carrinho`),
  CONSTRAINT `rl_carrinho_produto_ibfk_2` FOREIGN KEY (`id_produto`) REFERENCES `produtos` (`id_produto`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `rl_carrinho_produto`
--

LOCK TABLES `rl_carrinho_produto` WRITE;
/*!40000 ALTER TABLE `rl_carrinho_produto` DISABLE KEYS */;
/*!40000 ALTER TABLE `rl_carrinho_produto` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `usuarios` (
  `id_usuario` int(11) NOT NULL AUTO_INCREMENT,
  `nome` char(100) NOT NULL,
  `email` char(100) NOT NULL,
  `senha` varchar(80) NOT NULL,
  PRIMARY KEY (`id_usuario`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuarios`
--

LOCK TABLES `usuarios` WRITE;
/*!40000 ALTER TABLE `usuarios` DISABLE KEYS */;
INSERT INTO `usuarios` VALUES (1,'Felipe','marcelo@hotmail.com','8cb2237d0679ca88db6464eac60da96345513964'),(4,'Felipe','mar@gmail.com','40bd001563085fc35165329ea1ff5c5ecbdbbeef');
/*!40000 ALTER TABLE `usuarios` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2025-07-20 22:20:26
