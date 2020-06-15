CREATE TABLE `ciudades` (
  `n_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `t_nombre` varchar(45) NOT NULL,
  `dt_created_at` datetime DEFAULT NULL,
  `dt_update_at` datetime DEFAULT NULL,
  `b_habilitado` tinyint(1) DEFAULT '1',
  PRIMARY KEY (`n_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



CREATE TABLE `administradores` (
  `n_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `t_nombrecompleto` varchar(155) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `t_login` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `n_idciudad` bigint(20) DEFAULT NULL,
  `t_email` varchar(50) NOT NULL,
  `t_password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `dt_created_at` datetime DEFAULT NULL,
  `dt_updated_at` datetime DEFAULT NULL,
  `b_todas` tinyint(1) DEFAULT '0',
  `b_habilitado` tinyint(1) DEFAULT '1',
  PRIMARY KEY (`n_id`),
  KEY `fk_administradores_idciudad_ciudad_id_idx` (`n_idciudad`),
  CONSTRAINT `fk_administradores_idciudad_ciudad_id` FOREIGN KEY (`n_idciudad`) REFERENCES `ciudades` (`n_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;





CREATE TABLE `auditoria_ingreso` (
  `n_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `n_idadministrador` bigint(20) NOT NULL,
  `t_ip` varchar(45) NOT NULL,
  `t_navegador` varchar(200) DEFAULT NULL,
  `dt_updated` datetime DEFAULT NULL,
  `dt_created` datetime NOT NULL,
  PRIMARY KEY (`n_id`),
  KEY `fk_auditoria_idadministrador_administrador_id_idx` (`n_idadministrador`),
  CONSTRAINT `fk_auditoria_idadministrador_administrador_id` FOREIGN KEY (`n_idadministrador`) REFERENCES `administradores` (`n_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


