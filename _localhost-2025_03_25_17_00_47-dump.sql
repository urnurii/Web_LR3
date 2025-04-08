-- MariaDB dump 10.19  Distrib 10.4.32-MariaDB, for Win64 (AMD64)
--
-- Host: 127.0.0.1    .core\Database: nebo_db
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
-- Table structure for table `wedding`
--

DROP TABLE IF EXISTS `wedding`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `wedding` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `fio_bride` varchar(255) NOT NULL,
  `fio_groom` varchar(255) NOT NULL,
  `budget` varchar(255) NOT NULL,
  `photo_couple` varchar(255) NOT NULL,
  `text_invitation` text NOT NULL,
  `id_host` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `wedding_wedding_host_id_fk` (`id_host`),
  CONSTRAINT `wedding_wedding_host_id_fk` FOREIGN KEY (`id_host`) REFERENCES `wedding_host` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `wedding`
--

LOCK TABLES `wedding` WRITE;
/*!40000 ALTER TABLE `wedding` DISABLE KEYS */;
INSERT INTO `wedding` VALUES (1,'Сальникова Таисия Гордеевна','Ильин Артём Маркович','1','1','Lorem',1),(2,'Любимова Мирослава Максимовна','Чернышев Иван Тимофеевич','2','2','Fuga libero atque inventore rem aliquam quam corrupti excepturi',2),(3,'Максимова Мария Дмитриевна','Орлов Артём Олегович','3','3','Architecto dignissimos delectus repellat distinctio! Deserunt fugit quas error earum magnam. Ipsum officiis explicabo architecto praesentium reprehenderit id incidunt possimus tenetur provident',3),(4,'Сергеева Арина Романовна','Леонов Роман Даниилович','4','4','Molestias tempore dolor libero accusantium',4),(5,'Воробьева Ульяна Васильевна','Прохоров Андрей Иванович','5','5','Ad placeat odit quaerat. Facere incidunt voluptatem',5),(6,'Суворова Мирослава Мироновна','Костин Сергей Константинович','6','6','Sequi fugit',6),(7,'Короткова Злата Тимофеевна','Васильев Алексей Степанович','7','7','Veritatis',7),(8,'Суслова Милана Фёдоровна','Кудряшов Михаил Артёмович','8','8','Velit iste',8),(9,'Коровина Татьяна Ибрагимовна','Софронов Кирилл Олегович','9','9','Dolore minima at illo accusamus optio harum ducimus a',9),(10,'Быкова Злата Марковна','Зуев Артём Дмитриевич','10','10','Earum quisquam nisi repellendus voluptates quo error laboriosam in ad dolor numquam. Voluptatem',10);
/*!40000 ALTER TABLE `wedding` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `wedding_host`
--

DROP TABLE IF EXISTS `wedding_host`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `wedding_host` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `fio_host` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `wedding_host`
--

LOCK TABLES `wedding_host` WRITE;
/*!40000 ALTER TABLE `wedding_host` DISABLE KEYS */;
INSERT INTO `wedding_host` VALUES (1,'Максимова Кира Тимофеевна'),(2,'Копылов Леонид Данилович'),(3,'Зубов Максим Иванович'),(4,'Максимов Ян Арсентьевич'),(5,'Алексеев Максим Давидович'),(6,'Макеев Виктор Назарович'),(7,'Фролов Давид Михайлович'),(8,'Коновалов Мирослав Константинович'),(9,'Рябинин Иван Германович'),(10,'Ерофеева Вероника Георгиевна');
/*!40000 ALTER TABLE `wedding_host` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2025-03-25 17:00:47
