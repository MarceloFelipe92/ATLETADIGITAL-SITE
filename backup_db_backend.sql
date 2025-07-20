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
-- Table structure for table `carrinho_itens`
--

DROP TABLE IF EXISTS `carrinho_itens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `carrinho_itens` (
  `id_item` int(11) NOT NULL AUTO_INCREMENT,
  `id_carrinho` int(11) NOT NULL,
  `id_produto` int(11) NOT NULL,
  `quantidade` int(11) NOT NULL,
  PRIMARY KEY (`id_item`),
  KEY `id_carrinho` (`id_carrinho`),
  KEY `id_produto` (`id_produto`),
  CONSTRAINT `carrinho_itens_ibfk_1` FOREIGN KEY (`id_carrinho`) REFERENCES `carrinhos` (`id_carrinho`),
  CONSTRAINT `carrinho_itens_ibfk_2` FOREIGN KEY (`id_produto`) REFERENCES `produtos` (`id_produto`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `carrinho_itens`
--

LOCK TABLES `carrinho_itens` WRITE;
/*!40000 ALTER TABLE `carrinho_itens` DISABLE KEYS */;
/*!40000 ALTER TABLE `carrinho_itens` ENABLE KEYS */;
UNLOCK TABLES;

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
  `complemento` char(40) DEFAULT NULL,
  `bairro` char(40) NOT NULL,
  `cidade` char(30) NOT NULL,
  `cep` char(9) NOT NULL,
  `estado` char(2) DEFAULT NULL,
  `email` char(100) DEFAULT NULL,
  `whatsapp` char(16) DEFAULT NULL,
  `cpf` char(14) DEFAULT NULL,
  `senha` varchar(255) NOT NULL,
  PRIMARY KEY (`id_cliente`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `clientes`
--

LOCK TABLES `clientes` WRITE;
/*!40000 ALTER TABLE `clientes` DISABLE KEYS */;
INSERT INTO `clientes` VALUES (14,'MARCELO FELIPE PEREDA SANTOSsssssssss','612dd08a32b75cd162581578d20efe5f.png','Rua Thiers de Carvalho','340','sada','Jardim do Sol','Taubaté','12070-660','SP','marcelo@bnhjbabnb','(11) 2 1111-1111','111.111.111-11','3875de952aced38e4ff6a229f27c3e18b748e472');
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
  `razao_social` char(100) NOT NULL,
  `cnpj` char(18) DEFAULT NULL,
  `telefone` char(14) DEFAULT NULL,
  `email` char(100) DEFAULT NULL,
  `logradouro` char(150) NOT NULL,
  `numero` char(20) NOT NULL,
  `complemento` char(40) NOT NULL,
  `bairro` char(40) NOT NULL,
  `cidade` char(30) NOT NULL,
  `cep` char(9) NOT NULL,
  `estado` char(2) DEFAULT NULL,
  PRIMARY KEY (`id_fornecedor`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `fornecedores`
--

LOCK TABLES `fornecedores` WRITE;
/*!40000 ALTER TABLE `fornecedores` DISABLE KEYS */;
INSERT INTO `fornecedores` VALUES (8,'MARCELO FELIPE PEREDA SANTOS','33.333.333/3333-33','(12) 9914-5962','gdgdgs@fgdsd','Rua Thiers de Carvalho','340','','Jardim do Sol','Taubaté','12070-660','SP');
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
  `marca` char(40) DEFAULT NULL,
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
  `produto` char(100) DEFAULT NULL,
  `descricao` text DEFAULT NULL,
  `id_marca` int(11) DEFAULT NULL,
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
INSERT INTO `produtos` VALUES (31,'bike eletrica','bike moderna e eletrica',6,'16894178c73871f0ea6bef737889e2fb.png',10,12.00),(32,'bike','nova bike+',8,'442b2a8321469eb61a51aeaac9f74f9c.jpg',2,2.00),(33,'bike nova','nova geração',2,'ea79a4c7eabf70dd01dd79c6afa65143.jpg',32,32.00),(34,'bike nova','nova geração',2,'ea79a4c7eabf70dd01dd79c6afa65143.jpg',32,32.00),(44,'CAMISA DRIFYT','Novo modelo da marca Everlast',7,'c671c4823ad130f7a92eee49ed8760a5.png',2,2.00),(46,'Camisa Drifit','Nova coleção da Adidasdfg',1,'d68077d6e11f06de8ca29216fbacc50e.png',3,2.00),(47,'CAMISA DRIFYTd','Novo modelo da marca Everlasttgtr',7,'0be2610c9b9463b3a75217a301199d10.png',2,2.00),(48,'marcelo','fgdghdfg',2,'43b29d0ea69fafcead4cd5112e603fef.png',43,43.00),(49,'marcelo','fgdghdfg',2,'ba2219f9389663b53842842c7000924a.png',43,43.00),(50,'marcelo','fgdghdfg',2,'e49ea7c72e608954154ae9c3107ae6a1.png',43,43.00),(51,'CAMISA DRIFYT','Novo modelo da marca Everlast',7,'e319121414534f302762b820d158f73f.png',2,2.00),(52,'bike de aluminio','bike moderna',7,'caec1723cb9d783a8d95fc555ad28e3c.png',5,12.00),(53,'bike de aluminio','bike moderna',7,'3f342c7268735e74b980a5dcd8b0e450.png',5,12.00),(54,'marcelo','2edfssfgv',7,'5c061b4fbb9f02b5e320618d93f8ada7.png',2,3.00),(55,'wfasdf','fad',7,'7e095ba629b29adf5c4a77cd15d43140.png',3,23.00),(56,'marcelo','komoiol',2,'f78cbfa8cb533b7597e9bd8ee279ece6.png',2,1.00),(57,'marcelo','fdsfs',2,'3288b1133c2be64778fccebf417cf61e.png',4,4.00);
/*!40000 ALTER TABLE `produtos` ENABLE KEYS */;
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

-- Dump completed on 2025-07-14 19:38:04
