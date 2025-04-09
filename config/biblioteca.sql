-- MySQL dump 10.13  Distrib 8.0.41, for Linux (x86_64)
--
-- Host: localhost    Database: BIBLIOTECA
-- ------------------------------------------------------
-- Server version	8.0.41-0ubuntu0.24.04.1

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `books`
--

DROP TABLE IF EXISTS `books`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `books` (
  `id` int NOT NULL AUTO_INCREMENT,
  `title` varchar(255) DEFAULT NULL,
  `author` varchar(255) DEFAULT NULL,
  `published_year` int DEFAULT NULL,
  `isbn` varchar(13) DEFAULT NULL,
  `description` text,
  `created_at` timestamp NULL DEFAULT (now()),
  `update_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `books`
--

LOCK TABLES `books` WRITE;
/*!40000 ALTER TABLE `books` DISABLE KEYS */;
INSERT INTO `books` VALUES (1,'El señor de los anillos','J.R.R. Tolkien ',1928,'9780618260274','Una épica historia de fantasía sobre un anillo mágico y la lucha contra el mal. ','2025-04-08 20:26:12','2025-04-09 18:08:39'),(12,'El libro de la selva','Rudyard Kipling',1894,'9788491050453','Una colección de historias sobre un niño criado por lobos.','2025-04-09 12:11:21',NULL),(13,'Cien años de soledad','Gabriel García Márquez',1967,'9780307474728','Una saga de la familia Buendía en el pueblo ficticio de Macondo.','2025-04-09 12:11:21',NULL),(14,'1984','George Orwell',1949,'9780451524935','Una novela distópica sobre un régimen totalitario.','2025-04-09 12:11:21',NULL),(15,'Don Quijote de la Mancha','Miguel de Cervantes',1605,'9788491050033','Un hidalgo enloquecido por los libros de caballería.','2025-04-09 12:11:21',NULL),(16,'Crimen y castigo','Fyodor Dostoevsky',1866,'9780140449136','Un estudiante pobre comete un crimen y lidia con las consecuencias.','2025-04-09 12:11:21',NULL),(17,'Orgullo y prejuicio','Jane Austen',1813,'9780141439518','Una historia de amor y sociedad en la Inglaterra del siglo XIX.','2025-04-09 12:11:21',NULL),(18,'El Principito','Antoine de Saint-Exupéry',1943,'9780156012195','Un piloto conoce a un pequeño príncipe de otro planeta.','2025-04-09 12:11:21',NULL),(19,'Matar a un ruiseñor','Harper Lee',1960,'9780060935467','Una mirada crítica al racismo en el sur de Estados Unidos.','2025-04-09 12:11:21',NULL),(20,'El Gran Gatsby','F. Scott Fitzgerald',1925,'9780743273565','Una crítica a la alta sociedad americana de los años 20.','2025-04-09 12:11:21',NULL),(21,'La Odisea','Homero',-800,'9780140268867','Las aventuras de Odiseo tras la guerra de Troya.','2025-04-09 12:11:21',NULL),(22,'Rayuela','Julio Cortázar',1963,'9788437603587','Una novela experimental que se puede leer de varias formas.','2025-04-09 12:11:21',NULL),(23,'La sombra del viento','Carlos Ruiz Zafón',2001,'9788408172178','Un joven descubre un libro que cambia su vida.','2025-04-09 12:11:21',NULL),(24,'Ensayo sobre la ceguera','José Saramago',1995,'9788466318620','Una epidemia de ceguera blanca azota una ciudad.','2025-04-09 12:11:21',NULL),(25,'Fahrenheit 451','Ray Bradbury',1953,'9781451673319','Un futuro donde los libros están prohibidos y son quemados.','2025-04-09 12:11:21',NULL),(26,'La Metamorfosis','Franz Kafka',1915,'9780140184785','Un hombre se despierta convertido en un insecto.','2025-04-09 12:11:21',NULL),(27,'Los miserables','Victor Hugo',1862,'9780140444308','La redención de un exconvicto en la Francia postrevolucionaria.','2025-04-09 12:11:21',NULL),(28,'Drácula','Bram Stoker',1897,'9780141439846','La historia del famoso vampiro y sus víctimas.','2025-04-09 12:11:21',NULL),(29,'Frankenstein','Mary Shelley',1818,'9780141439471','Un científico crea vida con consecuencias terribles.','2025-04-09 12:11:21',NULL),(30,'Los juegos del hambre','Suzanne Collins',2008,'9780439023528','Una joven debe sobrevivir a una lucha mortal televisada.','2025-04-09 12:11:21',NULL),(31,'Harry Potter y la piedra filosofal','J.K. Rowling',1997,'9788478884452','Un niño descubre que es un mago y va a Hogwarts.','2025-04-09 12:11:21',NULL),(32,'La chica del tren','Paula Hawkins',2015,'9788408141471','Una mujer se ve envuelta en un misterio tras ver algo sospechoso desde el tren.','2025-04-09 12:11:21',NULL),(33,'El código Da Vinci','Dan Brown',2003,'9780307474278','Un thriller de conspiraciones religiosas e historia.','2025-04-09 12:11:21',NULL),(34,'It','Stephen King',1986,'9780450411434','Un grupo de niños enfrentan a un mal antiguo que toma forma de payaso.','2025-04-09 12:11:21',NULL),(35,'El alquimista','Paulo Coelho',1988,'9780062315007','Un joven pastor sigue sus sueños a través del desierto.','2025-04-09 12:11:21',NULL),(36,'La ladrona de libros','Markus Zusak',2005,'9780375842207','Una niña roba libros en la Alemania nazi mientras la Muerte narra la historia.','2025-04-09 12:11:21',NULL);
/*!40000 ALTER TABLE `books` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2025-04-09  6:17:08
