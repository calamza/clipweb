CREATE TABLE `admin` (
  `id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `admin` WRITE;
/*!40000 ALTER TABLE `admin` DISABLE KEYS */;
INSERT INTO `admin` VALUES (1,'tassi.javier'),(2,'martin.cristian'),(3,'angulo.fabian');
/*!40000 ALTER TABLE `admin` ENABLE KEYS */;
UNLOCK TABLES;


CREATE TABLE links (
    `id` int NOT NULL AUTO_INCREMENT,
    `usuario` varchar(255),
    `descripcion` varchar(255),
    `link` varchar(255),
    PRIMARY KEY (`id`)
);

INSERT INTO `links` (usuario, descripcion, link) VALUES ('martin.cristian', 'una prueba mas', 'https://asdasdasd/asd/as/dasd');