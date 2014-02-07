/*
Navicat MySQL Data Transfer

Source Server         : local
Source Server Version : 50524
Source Host           : localhost:3306
Source Database       : apf_bd

Target Server Type    : MYSQL
Target Server Version : 50524
File Encoding         : 65001

Date: 2014-02-07 04:41:55
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `cnf_correos`
-- ----------------------------
DROP TABLE IF EXISTS `cnf_correos`;
CREATE TABLE `cnf_correos` (
  `id_mail` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID Correo',
  `origen_mail` varchar(150) NOT NULL COMMENT 'Origen',
  `destinio_mail` varchar(150) NOT NULL COMMENT 'Destinatario',
  `asunto_mail` varchar(150) NOT NULL COMMENT 'Asunto',
  `fechaenvio_mail` datetime NOT NULL COMMENT 'Fecha de envio',
  `mensaje_mail` longtext NOT NULL COMMENT 'Mensaje',
  `fechahora_mod` datetime NOT NULL,
  `fechahora_ins` datetime NOT NULL,
  `usuario_mod` int(11) NOT NULL,
  `usuario_ins` int(11) NOT NULL,
  PRIMARY KEY (`id_mail`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of cnf_correos
-- ----------------------------

-- ----------------------------
-- Table structure for `cnf_gestiones`
-- ----------------------------
DROP TABLE IF EXISTS `cnf_gestiones`;
CREATE TABLE `cnf_gestiones` (
  `id_gst` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID Gestion',
  `nombre_gst` varchar(50) NOT NULL COMMENT 'Nombre Gestion',
  `activo_gst` varchar(1) NOT NULL COMMENT 'Activo',
  `fechahora_mod` datetime NOT NULL,
  `fechahora_ins` datetime NOT NULL,
  `usuario_mod` int(11) NOT NULL,
  `usuario_ins` int(11) NOT NULL,
  PRIMARY KEY (`id_gst`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of cnf_gestiones
-- ----------------------------
INSERT INTO `cnf_gestiones` VALUES ('1', '2012', 'S', '2013-03-29 12:54:10', '2013-03-29 12:54:10', '1', '1');
INSERT INTO `cnf_gestiones` VALUES ('2', '2013', 'S', '2013-03-29 12:54:18', '2013-03-29 12:54:18', '1', '1');

-- ----------------------------
-- Table structure for `cnf_tipocirculares`
-- ----------------------------
DROP TABLE IF EXISTS `cnf_tipocirculares`;
CREATE TABLE `cnf_tipocirculares` (
  `id_tcc` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID Tipo Circular',
  `nombre_tcc` varchar(75) NOT NULL COMMENT 'Nombre',
  `activo_tcc` varchar(1) NOT NULL,
  `rol_tcc` int(11) DEFAULT NULL,
  `fechahora_mod` datetime NOT NULL,
  `fechahora_ins` datetime NOT NULL,
  `usuario_mod` int(11) NOT NULL,
  `usuario_ins` int(11) NOT NULL,
  PRIMARY KEY (`id_tcc`),
  KEY `rol_tcc` (`rol_tcc`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of cnf_tipocirculares
-- ----------------------------
INSERT INTO `cnf_tipocirculares` VALUES ('1', 'Circulares Padres', 'S', '0', '2014-02-07 03:43:45', '2014-02-07 01:59:34', '1', '1');
INSERT INTO `cnf_tipocirculares` VALUES ('2', 'Circulares Directiva', 'S', '3', '2014-02-07 03:43:51', '2014-02-07 01:59:46', '1', '1');

-- ----------------------------
-- Table structure for `reg_registropadres`
-- ----------------------------
DROP TABLE IF EXISTS `reg_registropadres`;
CREATE TABLE `reg_registropadres` (
  `id_rgp` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `nombrepadre_rgp` varchar(200) DEFAULT NULL COMMENT 'Nombre Padre',
  `nombremadre_rgp` varchar(200) DEFAULT NULL COMMENT 'Nombre Madre',
  `nombrealumno_rgp` varchar(200) DEFAULT NULL COMMENT 'Nombre Alumno',
  `curso_rpg` varchar(200) DEFAULT NULL COMMENT 'Curso',
  `telefono1_rgp` varchar(20) DEFAULT NULL COMMENT 'Telefono 1',
  `telefono2_rgp` varchar(20) DEFAULT NULL COMMENT 'Telefono 2',
  `correo1_rgp` varchar(200) DEFAULT NULL COMMENT 'Correo 1',
  `correo2_rgp` varchar(200) DEFAULT NULL COMMENT 'Correo 2',
  `fecharegistro_rgp` datetime DEFAULT NULL COMMENT 'Fecha de registro',
  `fechahora_mod` datetime NOT NULL,
  `fechahora_ins` datetime NOT NULL,
  `usuario_mod` int(11) NOT NULL,
  `usuario_ins` int(11) NOT NULL,
  PRIMARY KEY (`id_rgp`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of reg_registropadres
-- ----------------------------

-- ----------------------------
-- Table structure for `seg_loginlog`
-- ----------------------------
DROP TABLE IF EXISTS `seg_loginlog`;
CREATE TABLE `seg_loginlog` (
  `id_llo` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Id',
  `persona_llo` int(11) NOT NULL COMMENT 'Persona',
  `activity_llo` varchar(150) COLLATE utf8_spanish_ci NOT NULL COMMENT 'Actividad',
  `date_llo` datetime NOT NULL COMMENT 'Fecha',
  `ip_llo` varchar(20) COLLATE utf8_spanish_ci NOT NULL COMMENT 'Dirección IP',
  `sessionid_llo` varchar(128) COLLATE utf8_spanish_ci NOT NULL COMMENT 'Sesión',
  `url_llo` varchar(150) COLLATE utf8_spanish_ci NOT NULL COMMENT 'Dirección URL',
  PRIMARY KEY (`id_llo`),
  KEY `persona_llo` (`persona_llo`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=70 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- ----------------------------
-- Records of seg_loginlog
-- ----------------------------
INSERT INTO `seg_loginlog` VALUES ('1', '1', 'Login Exitoso.', '2013-03-29 01:51:04', '127.0.0.1', 'n0d7nmac21aplsvav6pd0lho46', 'localhost:81/apf2/ingreso.php?');
INSERT INTO `seg_loginlog` VALUES ('2', '1', 'Login Exitoso.', '2013-03-29 02:48:59', '127.0.0.1', 'n0d7nmac21aplsvav6pd0lho46', 'localhost:81/apf2/ingreso.php?');
INSERT INTO `seg_loginlog` VALUES ('3', '1', 'Login Exitoso.', '2013-03-29 02:51:58', '127.0.0.1', 'n0d7nmac21aplsvav6pd0lho46', 'localhost:81/apf2/ingreso.php?');
INSERT INTO `seg_loginlog` VALUES ('4', '1', 'Login Exitoso.', '2013-03-29 03:09:53', '127.0.0.1', 'n0d7nmac21aplsvav6pd0lho46', 'localhost:81/apf2/ingreso.php?');
INSERT INTO `seg_loginlog` VALUES ('5', '1', 'Login Exitoso.', '2013-03-29 04:48:53', '127.0.0.1', 'n0d7nmac21aplsvav6pd0lho46', 'localhost:81/apf2/login.php?');
INSERT INTO `seg_loginlog` VALUES ('6', '1', 'Login Exitoso.', '2013-03-29 04:52:57', '127.0.0.1', 'n0d7nmac21aplsvav6pd0lho46', 'localhost:81/apf2/login.php?');
INSERT INTO `seg_loginlog` VALUES ('7', '1', 'Login Exitoso.', '2013-03-29 06:09:08', '127.0.0.1', 'k7i30pd962vesnjtmeh7tc62f5', 'localhost:81/apf2/ingreso.php?');
INSERT INTO `seg_loginlog` VALUES ('8', '1', 'Login Exitoso.', '2013-03-29 06:10:51', '127.0.0.1', '1hij654jsdbup9re1jm5vt38p4', 'localhost:81/apf2/ingreso.php?');
INSERT INTO `seg_loginlog` VALUES ('9', '1', 'Login Exitoso.', '2013-03-29 06:13:11', '127.0.0.1', 'vdluuendh0sdkmb8l7otkqmff7', 'localhost:81/apf2/ingreso.php?');
INSERT INTO `seg_loginlog` VALUES ('10', '1', 'Login Exitoso.', '2013-03-29 06:16:31', '127.0.0.1', 'vdluuendh0sdkmb8l7otkqmff7', 'localhost:81/apf2/ingreso.php?');
INSERT INTO `seg_loginlog` VALUES ('11', '1', 'Login Exitoso.', '2013-03-29 06:17:52', '127.0.0.1', '3qol9b7587n02u5edclpc1bdi7', 'localhost:81/apf2/ingreso.php?');
INSERT INTO `seg_loginlog` VALUES ('12', '1', 'Login Exitoso.', '2013-03-29 06:19:24', '127.0.0.1', 'qgssrdklhsu749dgf57ualj767', 'localhost:81/apf2/ingreso.php?');
INSERT INTO `seg_loginlog` VALUES ('13', '1', 'Login Exitoso.', '2013-03-29 06:19:51', '127.0.0.1', 'qgssrdklhsu749dgf57ualj767', 'localhost:81/apf2/ingreso.php?');
INSERT INTO `seg_loginlog` VALUES ('14', '1', 'Login Exitoso.', '2013-03-29 06:20:44', '127.0.0.1', 'm4bucev87rk04sm3h2vbou58h4', 'localhost:81/apf2/ingreso.php?');
INSERT INTO `seg_loginlog` VALUES ('15', '1', 'Login Exitoso.', '2013-03-29 06:20:54', '127.0.0.1', 'm4bucev87rk04sm3h2vbou58h4', 'localhost:81/apf2/ingreso.php?');
INSERT INTO `seg_loginlog` VALUES ('16', '1', 'Login Exitoso.', '2013-03-29 06:24:07', '127.0.0.1', 'h62a5tmgo3mi9ai2vcdoqva4c4', 'localhost:81/apf2/ingreso.php?');
INSERT INTO `seg_loginlog` VALUES ('17', '1', 'Login Exitoso.', '2013-03-29 06:24:30', '127.0.0.1', 'h62a5tmgo3mi9ai2vcdoqva4c4', 'localhost:81/apf2/ingreso.php?');
INSERT INTO `seg_loginlog` VALUES ('18', '1', 'Login Exitoso.', '2013-03-29 06:25:03', '127.0.0.1', 'h62a5tmgo3mi9ai2vcdoqva4c4', 'localhost:81/apf2/ingreso.php?');
INSERT INTO `seg_loginlog` VALUES ('19', '1', 'Login Exitoso.', '2013-03-29 06:33:08', '127.0.0.1', 'h62a5tmgo3mi9ai2vcdoqva4c4', 'localhost:81/apf2/ingreso.php?');
INSERT INTO `seg_loginlog` VALUES ('20', '1', 'Login Exitoso.', '2013-03-29 06:36:06', '127.0.0.1', 'h62a5tmgo3mi9ai2vcdoqva4c4', 'localhost:81/apf2/ingreso.php?');
INSERT INTO `seg_loginlog` VALUES ('21', '1', 'Login Exitoso.', '2013-03-29 06:40:35', '127.0.0.1', 'h62a5tmgo3mi9ai2vcdoqva4c4', 'localhost:81/apf2/ingreso.php?');
INSERT INTO `seg_loginlog` VALUES ('22', '1', 'Login Exitoso.', '2013-03-29 06:44:22', '127.0.0.1', 'h62a5tmgo3mi9ai2vcdoqva4c4', 'localhost:81/apf2/ingreso.php?');
INSERT INTO `seg_loginlog` VALUES ('23', '1', 'Login Exitoso.', '2013-03-29 06:46:50', '127.0.0.1', 'h62a5tmgo3mi9ai2vcdoqva4c4', 'localhost:81/apf2/ingreso.php?');
INSERT INTO `seg_loginlog` VALUES ('24', '1', 'Login Exitoso.', '2013-03-29 07:06:13', '127.0.0.1', 'h62a5tmgo3mi9ai2vcdoqva4c4', 'localhost:81/apf2/ingreso.php?');
INSERT INTO `seg_loginlog` VALUES ('25', '1', 'Login Exitoso.', '2013-03-29 11:08:56', '127.0.0.1', 'h62a5tmgo3mi9ai2vcdoqva4c4', 'localhost:81/apf2/ingreso.php?');
INSERT INTO `seg_loginlog` VALUES ('26', '1', 'Login Exitoso.', '2013-03-29 13:08:18', '127.0.0.1', 'h62a5tmgo3mi9ai2vcdoqva4c4', 'localhost:81/apf2/ingreso.php?');
INSERT INTO `seg_loginlog` VALUES ('27', '1', 'Login Exitoso.', '2013-03-29 13:20:00', '127.0.0.1', 'kqcmco15s2lstgirfpn3t5aua4', 'localhost:81/apf2/ingreso.php?');
INSERT INTO `seg_loginlog` VALUES ('28', '1', 'Login Exitoso.', '2013-03-29 13:21:27', '127.0.0.1', 'elrnrfvsk0q69u6p8h5tac1uv0', 'localhost:81/apf2/ingreso.php?');
INSERT INTO `seg_loginlog` VALUES ('29', '1', 'Login Exitoso.', '2013-03-29 13:25:23', '127.0.0.1', 'erio0ke54c93kv3kk782shjuk5', 'localhost:81/apf2/ingreso.php?');
INSERT INTO `seg_loginlog` VALUES ('30', '1', 'Login Exitoso.', '2013-03-29 13:25:58', '127.0.0.1', 'pul24nc325k3hqg3macm1htrh1', 'localhost:81/apf2/ingreso.php?');
INSERT INTO `seg_loginlog` VALUES ('31', '1', 'Login Exitoso.', '2013-03-29 13:28:31', '127.0.0.1', '2elm3hues50ei6rjdidoe040m7', 'localhost:81/apf2/ingreso.php?');
INSERT INTO `seg_loginlog` VALUES ('32', '1', 'Login Exitoso.', '2013-03-29 13:30:21', '127.0.0.1', 'i6b1nqiap9q5vel8ert3m88m01', 'localhost:81/apf2/ingreso.php?');
INSERT INTO `seg_loginlog` VALUES ('33', '1', 'Login Exitoso.', '2013-03-29 13:30:56', '127.0.0.1', 'gjjd8jipmcas0qvlc3f1k9l7c6', 'localhost:81/apf2/ingreso.php?');
INSERT INTO `seg_loginlog` VALUES ('34', '1', 'Login Exitoso.', '2013-03-29 13:32:32', '127.0.0.1', '0bva1rtl32kp5qk9ntlsvc5d21', 'localhost:81/apf2/ingreso.php?');
INSERT INTO `seg_loginlog` VALUES ('35', '1', 'Login Exitoso.', '2013-03-29 13:33:29', '127.0.0.1', '9m4fjnp99lqctu8lmg7t6e3ju2', 'localhost:81/apf2/ingreso.php?');
INSERT INTO `seg_loginlog` VALUES ('36', '1', 'Login Exitoso.', '2013-03-29 13:36:42', '127.0.0.1', 'j0pq62hai1sop1pon3uj6850s1', 'localhost:81/apf2/ingreso.php?');
INSERT INTO `seg_loginlog` VALUES ('37', '1', 'Login Exitoso.', '2013-03-29 13:44:19', '127.0.0.1', 'hqth1701kb0sphuf5u22ds0rh0', 'localhost:81/apf2/ingreso.php?');
INSERT INTO `seg_loginlog` VALUES ('38', '1', 'Login Exitoso.', '2013-03-29 13:45:13', '127.0.0.1', 'prgdfv722p2du1vi339r4nlfg3', 'localhost:81/apf2/ingreso.php?');
INSERT INTO `seg_loginlog` VALUES ('39', '1', 'Login Exitoso.', '2013-03-29 13:48:59', '127.0.0.1', 'n9o4vs7lm8j8nlj8jg233qhjo7', 'localhost:81/apf2/ingreso.php?');
INSERT INTO `seg_loginlog` VALUES ('40', '1', 'Login Exitoso.', '2013-03-29 13:57:16', '127.0.0.1', '6e62uqdjfsb3cbiuhevg691j35', 'localhost:81/apf2/ingreso.php?');
INSERT INTO `seg_loginlog` VALUES ('41', '1', 'Login Exitoso.', '2013-03-29 22:43:03', '127.0.0.1', 'slh2k6fbuus5a67v7p94fl7333', 'localhost:81/apf2/ingreso.php?');
INSERT INTO `seg_loginlog` VALUES ('42', '1', 'Login Exitoso.', '2013-03-29 22:48:35', '127.0.0.1', '0coq66j28vfgo43m61mat20ld2', 'localhost:81/apf2/ingreso.php?');
INSERT INTO `seg_loginlog` VALUES ('43', '1', 'Login Exitoso.', '2013-03-29 23:00:53', '127.0.0.1', 'jlfrjdvi207llhmnpad2m2pdj2', 'localhost:81/apf2/ingreso.php?');
INSERT INTO `seg_loginlog` VALUES ('44', '1', 'Login Exitoso.', '2013-03-29 23:01:25', '127.0.0.1', '0q9n4b4iteg0t3mu6a3adfdq81', 'localhost:81/apf2/ingreso.php?');
INSERT INTO `seg_loginlog` VALUES ('45', '1', 'Login Exitoso.', '2013-03-29 23:01:53', '127.0.0.1', '3hsflgpdtfvr7rrgpoo7evstc5', 'localhost:81/apf2/ingreso.php?');
INSERT INTO `seg_loginlog` VALUES ('46', '1', 'Login Exitoso.', '2013-03-29 23:04:15', '127.0.0.1', '1b7bk2960m09l2a01ibsca7hj7', 'localhost:81/apf2/ingreso.php?');
INSERT INTO `seg_loginlog` VALUES ('47', '1', 'Login Exitoso.', '2013-03-29 23:09:56', '127.0.0.1', '1pg9or59u2sqdn0vcep4kirf12', 'localhost:81/apf2/ingreso.php?');
INSERT INTO `seg_loginlog` VALUES ('48', '1', 'Login Exitoso.', '2013-03-31 03:08:38', '127.0.0.1', '6fnd7ugj89agfrtuvu3nn7opt7', 'localhost:81/apf2/ingreso.php?');
INSERT INTO `seg_loginlog` VALUES ('49', '1', 'Login Exitoso.', '2013-04-03 00:01:40', '127.0.0.1', 'cop5dirti7e68n0mtt5f21p537', 'localhost:81/apf2/ingreso.php?');
INSERT INTO `seg_loginlog` VALUES ('50', '1', 'Login Exitoso.', '2013-04-03 00:37:19', '127.0.0.1', 'cop5dirti7e68n0mtt5f21p537', 'localhost:81/apf2/ingreso.php?');
INSERT INTO `seg_loginlog` VALUES ('51', '1', 'Login Exitoso.', '2013-04-03 00:48:41', '127.0.0.1', 'cop5dirti7e68n0mtt5f21p537', 'localhost:81/apf2/ingreso.php?');
INSERT INTO `seg_loginlog` VALUES ('52', '1', 'Login Exitoso.', '2013-04-03 03:07:46', '127.0.0.1', 't6b2p63p9rmasi85aulfvsv0i7', 'localhost:81/apf2/ingreso.php?');
INSERT INTO `seg_loginlog` VALUES ('53', '1', 'Login Exitoso.', '2013-04-04 23:20:53', '127.0.0.1', '2o3shp59mm2lsf88qa8k8t8n34', 'localhost:81/apf2/ingreso.php?');
INSERT INTO `seg_loginlog` VALUES ('54', '1', 'Login Exitoso.', '2013-04-04 23:21:33', '127.0.0.1', '2o3shp59mm2lsf88qa8k8t8n34', 'localhost:81/apf2/ingreso.php?');
INSERT INTO `seg_loginlog` VALUES ('55', '1', 'Login Exitoso.', '2013-04-04 23:22:15', '127.0.0.1', '2o3shp59mm2lsf88qa8k8t8n34', 'localhost:81/apf2/ingreso.php?');
INSERT INTO `seg_loginlog` VALUES ('56', '1', 'Login Exitoso.', '2013-04-04 23:25:39', '127.0.0.1', '2o3shp59mm2lsf88qa8k8t8n34', 'localhost:81/apf2/ingreso.php?');
INSERT INTO `seg_loginlog` VALUES ('57', '1', 'Login Exitoso.', '2013-04-05 00:39:21', '127.0.0.1', '2o3shp59mm2lsf88qa8k8t8n34', 'localhost:81/apf2/ingreso.php?');
INSERT INTO `seg_loginlog` VALUES ('58', '1', 'Login Exitoso.', '2013-04-05 01:28:11', '127.0.0.1', '2o3shp59mm2lsf88qa8k8t8n34', 'localhost:81/apf2/ingreso.php?');
INSERT INTO `seg_loginlog` VALUES ('59', '1', 'Login Exitoso.', '2013-04-05 02:03:14', '127.0.0.1', 'jq8r180ksadciv4t0vf0u646e0', 'localhost:81/apf2/ingreso.php?');
INSERT INTO `seg_loginlog` VALUES ('60', '1', 'Login Exitoso.', '2013-04-05 02:57:17', '127.0.0.1', '2o3shp59mm2lsf88qa8k8t8n34', 'localhost:81/apf2/ingreso.php?');
INSERT INTO `seg_loginlog` VALUES ('61', '1', 'Login Exitoso.', '2013-04-05 03:18:31', '127.0.0.1', '2o3shp59mm2lsf88qa8k8t8n34', 'localhost:81/apf2/ingreso.php?');
INSERT INTO `seg_loginlog` VALUES ('62', '1', 'Login Exitoso.', '2013-04-05 21:33:45', '127.0.0.1', 'lb66afu44h39lkpo1j3o9daj15', 'localhost:81/apf2/ingreso.php?');
INSERT INTO `seg_loginlog` VALUES ('63', '1', 'Login Exitoso.', '2013-04-13 00:33:44', '127.0.0.1', '3kervif28bgr4g1dko19t21pd5', 'localhost:81/apf2/ingreso.php?');
INSERT INTO `seg_loginlog` VALUES ('64', '1', 'Login Exitoso.', '2013-04-21 15:45:39', '127.0.0.1', 'j59up30fjn4le9qs23ug1eaju0', 'localhost:81/apf2/ingreso.php?');
INSERT INTO `seg_loginlog` VALUES ('65', '1', 'Login Exitoso.', '2013-04-28 22:19:34', '127.0.0.1', 't5c10l9btasc463p5lg2shmkt4', 'localhost:81/apf2/ingreso.php?');
INSERT INTO `seg_loginlog` VALUES ('66', '1', 'Login Exitoso.', '2013-06-05 01:23:40', '127.0.0.1', '2uea40j6vt87mcdm97m7g4gml3', 'localhost:81/apf2/web/login.php?');
INSERT INTO `seg_loginlog` VALUES ('67', '1', 'Login Exitoso.', '2014-02-06 22:52:55', '127.0.0.1', 'ukvtfi7qvgc58o5k7bpbqgih72', 'localhost:81/apf2/web/login.php?');
INSERT INTO `seg_loginlog` VALUES ('68', '1', 'Login Exitoso.', '2014-02-06 23:34:35', '127.0.0.1', 'ukvtfi7qvgc58o5k7bpbqgih72', 'localhost:81/apf2/ingreso.php?');
INSERT INTO `seg_loginlog` VALUES ('69', '1', 'Login Exitoso.', '2014-02-07 03:51:25', '127.0.0.1', 'ukvtfi7qvgc58o5k7bpbqgih72', 'localhost:81/apf2/ingreso.php?');

-- ----------------------------
-- Table structure for `seg_opcionesmenu`
-- ----------------------------
DROP TABLE IF EXISTS `seg_opcionesmenu`;
CREATE TABLE `seg_opcionesmenu` (
  `id_opm` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Id',
  `nombre_opm` varchar(50) NOT NULL COMMENT 'Nombre',
  `ruta_opm` varchar(50) NOT NULL COMMENT 'Ruta',
  `orden_opm` varchar(20) NOT NULL,
  `opcionpadre_opm` int(11) NOT NULL COMMENT 'OpciÃ³n Padre',
  `fechahora_mod` datetime NOT NULL COMMENT 'Fecha Modificacón',
  `fechahora_ins` datetime NOT NULL COMMENT 'Fecha Inserción',
  `usuario_mod` int(11) NOT NULL COMMENT 'Usuario ModificaciÃ³n',
  `usuario_ins` int(11) NOT NULL COMMENT 'Usuario InserciÃ³n',
  PRIMARY KEY (`id_opm`),
  KEY `opcionpadre_opm` (`opcionpadre_opm`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of seg_opcionesmenu
-- ----------------------------
INSERT INTO `seg_opcionesmenu` VALUES ('2', 'Configuración', '#', 'B', '1', '2013-04-03 00:17:44', '2013-03-29 01:36:26', '1', '1');
INSERT INTO `seg_opcionesmenu` VALUES ('3', 'Correos', '/cnf/correos.php', 'A', '2', '2013-04-03 00:27:11', '2013-03-29 01:36:26', '1', '1');
INSERT INTO `seg_opcionesmenu` VALUES ('4', 'Gestiones', '/cnf/gestiones.php', 'B', '2', '2013-04-03 00:27:23', '2013-03-29 01:36:26', '1', '1');
INSERT INTO `seg_opcionesmenu` VALUES ('5', 'Tipo de circulares', '/cnf/tipocirculares.php', 'C', '2', '2013-04-03 00:26:57', '2013-03-29 01:36:26', '1', '1');
INSERT INTO `seg_opcionesmenu` VALUES ('6', 'Registros', '#', 'C', '1', '2013-04-03 00:19:27', '2013-03-29 01:36:26', '1', '1');
INSERT INTO `seg_opcionesmenu` VALUES ('7', 'Registro de padres', '/reg/registropadres.php', 'A', '6', '2013-04-03 00:27:57', '2013-03-29 01:36:26', '1', '1');
INSERT INTO `seg_opcionesmenu` VALUES ('8', 'Seguridad', '#', 'A', '1', '2013-04-03 00:06:24', '2013-03-29 01:36:26', '1', '1');
INSERT INTO `seg_opcionesmenu` VALUES ('9', 'Opciones de Menú', '/seg/opcionesmenu.php', 'A', '8', '2013-04-03 00:03:03', '2013-03-29 01:36:26', '1', '1');
INSERT INTO `seg_opcionesmenu` VALUES ('10', 'Permisos', '/seg/permisos.php', 'B', '8', '2013-04-03 00:28:25', '2013-03-29 01:36:26', '1', '1');
INSERT INTO `seg_opcionesmenu` VALUES ('11', 'Roles', '/seg/roles.php', 'C', '8', '2013-04-03 00:28:35', '2013-03-29 01:36:26', '1', '1');
INSERT INTO `seg_opcionesmenu` VALUES ('12', 'Usuarios', '/seg/usuarios.php', 'D', '8', '2013-04-03 00:28:57', '2013-03-29 01:36:26', '1', '1');
INSERT INTO `seg_opcionesmenu` VALUES ('13', 'Contenidos', '#', 'D', '1', '2013-04-03 00:25:30', '2013-03-29 01:36:26', '1', '1');
INSERT INTO `seg_opcionesmenu` VALUES ('14', 'Actividades', '/smc/actividades.php', 'A', '13', '2013-04-03 00:29:14', '2013-03-29 01:36:26', '1', '1');
INSERT INTO `seg_opcionesmenu` VALUES ('15', 'Albumes', '/smc/albumes.php', 'B', '13', '2013-04-03 00:29:22', '2013-03-29 01:36:26', '1', '1');
INSERT INTO `seg_opcionesmenu` VALUES ('16', 'Circulares', '/smc/circulares.php', 'C', '13', '2013-04-03 00:29:30', '2013-03-29 01:36:26', '1', '1');
INSERT INTO `seg_opcionesmenu` VALUES ('17', 'Contenido pagina principal', '/smc/paginaprincipal.php', 'D', '13', '2013-04-03 00:32:55', '2013-04-03 00:32:55', '1', '1');

-- ----------------------------
-- Table structure for `seg_permisos`
-- ----------------------------
DROP TABLE IF EXISTS `seg_permisos`;
CREATE TABLE `seg_permisos` (
  `id_per` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Id',
  `opcionmenu_per` int(11) NOT NULL COMMENT 'OpciÃ³n MenÃº',
  `rol_per` int(11) NOT NULL COMMENT 'Rol',
  `fechahora_mod` datetime NOT NULL COMMENT 'Fecha Modificación',
  `fechahora_ins` datetime NOT NULL COMMENT 'Fecha Inserción',
  `usuario_mod` int(11) NOT NULL COMMENT 'Usuario ModificaciÃ³n',
  `usuario_ins` int(11) NOT NULL COMMENT 'Usuario InserciÃ³n',
  PRIMARY KEY (`id_per`),
  KEY `opcionmenu_per` (`opcionmenu_per`),
  KEY `rol_per` (`rol_per`),
  CONSTRAINT `seg_permisos_ibfk_1` FOREIGN KEY (`opcionmenu_per`) REFERENCES `seg_opcionesmenu` (`id_opm`),
  CONSTRAINT `seg_permisos_ibfk_2` FOREIGN KEY (`rol_per`) REFERENCES `seg_roles` (`id_rol`)
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of seg_permisos
-- ----------------------------
INSERT INTO `seg_permisos` VALUES ('16', '2', '1', '2013-04-03 00:44:20', '2013-04-03 00:44:20', '1', '1');
INSERT INTO `seg_permisos` VALUES ('17', '3', '1', '2013-04-03 00:44:20', '2013-04-03 00:44:20', '1', '1');
INSERT INTO `seg_permisos` VALUES ('18', '4', '1', '2013-04-03 00:44:20', '2013-04-03 00:44:20', '1', '1');
INSERT INTO `seg_permisos` VALUES ('19', '5', '1', '2013-04-03 00:44:20', '2013-04-03 00:44:20', '1', '1');
INSERT INTO `seg_permisos` VALUES ('20', '6', '1', '2013-04-03 00:44:20', '2013-04-03 00:44:20', '1', '1');
INSERT INTO `seg_permisos` VALUES ('21', '7', '1', '2013-04-03 00:44:20', '2013-04-03 00:44:20', '1', '1');
INSERT INTO `seg_permisos` VALUES ('22', '8', '1', '2013-04-03 00:44:20', '2013-04-03 00:44:20', '1', '1');
INSERT INTO `seg_permisos` VALUES ('23', '9', '1', '2013-04-03 00:44:20', '2013-04-03 00:44:20', '1', '1');
INSERT INTO `seg_permisos` VALUES ('24', '10', '1', '2013-04-03 00:44:20', '2013-04-03 00:44:20', '1', '1');
INSERT INTO `seg_permisos` VALUES ('25', '11', '1', '2013-04-03 00:44:20', '2013-04-03 00:44:20', '1', '1');
INSERT INTO `seg_permisos` VALUES ('26', '12', '1', '2013-04-03 00:44:20', '2013-04-03 00:44:20', '1', '1');
INSERT INTO `seg_permisos` VALUES ('27', '13', '1', '2013-04-03 00:44:20', '2013-04-03 00:44:20', '1', '1');
INSERT INTO `seg_permisos` VALUES ('28', '14', '1', '2013-04-03 00:44:20', '2013-04-03 00:44:20', '1', '1');
INSERT INTO `seg_permisos` VALUES ('29', '15', '1', '2013-04-03 00:44:20', '2013-04-03 00:44:20', '1', '1');
INSERT INTO `seg_permisos` VALUES ('30', '16', '1', '2013-04-03 00:44:20', '2013-04-03 00:44:20', '1', '1');
INSERT INTO `seg_permisos` VALUES ('31', '17', '1', '2013-04-03 00:44:21', '2013-04-03 00:44:21', '1', '1');

-- ----------------------------
-- Table structure for `seg_roles`
-- ----------------------------
DROP TABLE IF EXISTS `seg_roles`;
CREATE TABLE `seg_roles` (
  `id_rol` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Id',
  `nombre_rol` varchar(50) NOT NULL COMMENT 'Nombre',
  `activo_rol` varchar(1) NOT NULL COMMENT 'Activo',
  `fechahora_mod` datetime NOT NULL COMMENT 'Fecha Modificación',
  `fechahora_ins` datetime NOT NULL COMMENT 'Fecha Inserción',
  `usuario_mod` int(11) NOT NULL COMMENT 'Usuario ModificaciÃƒÂ³n',
  `usuario_ins` int(11) NOT NULL COMMENT 'Usuario InserciÃƒÂ³n',
  PRIMARY KEY (`id_rol`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of seg_roles
-- ----------------------------
INSERT INTO `seg_roles` VALUES ('1', 'Administrador', 'S', '2012-02-15 14:01:04', '0000-00-00 00:00:00', '7', '0');
INSERT INTO `seg_roles` VALUES ('2', 'Directiva', 'S', '2013-03-28 04:14:23', '2013-03-28 04:14:23', '1', '1');
INSERT INTO `seg_roles` VALUES ('3', 'DirectivaAdm', 'S', '2013-03-28 04:14:23', '2013-03-28 04:14:23', '1', '1');

-- ----------------------------
-- Table structure for `seg_usuarios`
-- ----------------------------
DROP TABLE IF EXISTS `seg_usuarios`;
CREATE TABLE `seg_usuarios` (
  `id_usr` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Id',
  `nombres_usr` varchar(30) NOT NULL COMMENT 'Nombres',
  `apellidopaterno_usr` varchar(80) NOT NULL COMMENT 'Apellido Paterno',
  `apellidomaterno_usr` varchar(80) DEFAULT NULL COMMENT 'Apellido Materno',
  `clave_usr` varchar(128) NOT NULL COMMENT 'Clave',
  `usuario_usr` varchar(150) NOT NULL COMMENT 'Usuario',
  `claveanterior_usr` varchar(128) DEFAULT NULL COMMENT 'Clave Anterior',
  `rol_usr` int(11) NOT NULL COMMENT 'Rol',
  `activo_usr` varchar(1) NOT NULL COMMENT 'Activo',
  `fechahora_mod` datetime NOT NULL COMMENT 'Fecha Modificación',
  `fechahora_ins` datetime NOT NULL COMMENT 'Fecha Inserción',
  `usuario_mod` int(11) NOT NULL COMMENT 'Usuario ModificaciÃƒÂ³n',
  `usuario_ins` int(11) NOT NULL COMMENT 'Usuario InserciÃƒÂ³n',
  PRIMARY KEY (`id_usr`),
  UNIQUE KEY `nombreusuario_usr` (`nombres_usr`),
  KEY `rol_usr` (`rol_usr`),
  CONSTRAINT `seg_usuarios_ibfk_1` FOREIGN KEY (`rol_usr`) REFERENCES `seg_roles` (`id_rol`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of seg_usuarios
-- ----------------------------
INSERT INTO `seg_usuarios` VALUES ('1', 'Windsor', 'Suarez', 'Rivero', '0b4e7a0e5fe84ad35fb5f95b9ceeac79', 'sa_admin', null, '1', 'S', '2013-03-28 04:14:23', '2013-03-28 04:14:23', '1', '1');

-- ----------------------------
-- Table structure for `smc_actividades`
-- ----------------------------
DROP TABLE IF EXISTS `smc_actividades`;
CREATE TABLE `smc_actividades` (
  `id_act` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID Actividad',
  `nombre_act` varchar(150) NOT NULL COMMENT 'Nombre',
  `fechainicio_act` datetime NOT NULL COMMENT 'Fecha Inicio',
  `fechafin_act` datetime NOT NULL COMMENT 'Fecha Fin',
  `archivo_act` varchar(200) DEFAULT NULL COMMENT 'Cargar Archivo',
  `tipofecha_act` int(11) DEFAULT NULL COMMENT 'Tipo de fecha',
  `gestion_act` int(11) NOT NULL COMMENT 'Gestion',
  `activo_act` varchar(1) NOT NULL COMMENT 'Activo',
  `descripcion_act` longtext COMMENT 'Descripción',
  `fechahora_mod` datetime NOT NULL,
  `fechahora_ins` datetime NOT NULL,
  `usuario_mod` int(11) NOT NULL,
  `usuario_ins` int(11) NOT NULL,
  PRIMARY KEY (`id_act`),
  KEY `gestion_act` (`gestion_act`),
  CONSTRAINT `smc_actividades_ibfk_1` FOREIGN KEY (`gestion_act`) REFERENCES `cnf_gestiones` (`id_gst`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of smc_actividades
-- ----------------------------
INSERT INTO `smc_actividades` VALUES ('1', 'Actividad 1', '2013-04-01 06:24:00', '2013-04-13 09:31:00', '', '0', '1', 'S', 'Está es la actividad número 1 de ññññññ &nbsp; 31321231&nbsp;ejejejejeje  <div>as</div><div>asdgasgdasgasdgasdgasdgasdgasgasdgasd</div><div>aagasdgasdgasgsdg</div><div>aasdasdgasdgasgdasgdasdg</div><div>dgasdgasgasgasdgasdg</div>  ', '2013-04-13 03:28:46', '2013-04-13 00:35:44', '1', '1');

-- ----------------------------
-- Table structure for `smc_albumes`
-- ----------------------------
DROP TABLE IF EXISTS `smc_albumes`;
CREATE TABLE `smc_albumes` (
  `id_alm` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID Album',
  `nombre_alm` varchar(150) NOT NULL COMMENT 'Nombre',
  `gestion_alm` int(11) NOT NULL COMMENT 'Gestion',
  `portada_alm` varchar(150) DEFAULT NULL COMMENT 'Imagen de portada',
  `descripcion_alm` longtext COMMENT 'Descripcion',
  `activo_alm` varchar(1) NOT NULL COMMENT 'Activo',
  `fechahora_mod` datetime NOT NULL,
  `fechahora_ins` datetime NOT NULL,
  `usuario_mod` int(11) NOT NULL,
  `usuario_ins` int(11) NOT NULL,
  PRIMARY KEY (`id_alm`),
  KEY `gestion_alm` (`gestion_alm`),
  CONSTRAINT `smc_albumes_ibfk_1` FOREIGN KEY (`gestion_alm`) REFERENCES `cnf_gestiones` (`id_gst`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of smc_albumes
-- ----------------------------

-- ----------------------------
-- Table structure for `smc_circulares`
-- ----------------------------
DROP TABLE IF EXISTS `smc_circulares`;
CREATE TABLE `smc_circulares` (
  `id_crc` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID Circular',
  `nombre_crc` varchar(150) NOT NULL COMMENT 'Nombre',
  `archivo_crc` varchar(136) DEFAULT NULL COMMENT 'Cargar archivo',
  `gestion_crc` int(11) NOT NULL COMMENT 'Gestion',
  `tipocircular_crc` int(11) NOT NULL COMMENT 'Tipo Circular',
  `descripcion_crc` longtext COMMENT 'Descripcion',
  `fechahora_mod` datetime NOT NULL,
  `fechahora_ins` datetime NOT NULL,
  `usuario_mod` int(11) NOT NULL,
  `usuario_ins` int(11) NOT NULL,
  PRIMARY KEY (`id_crc`),
  KEY `gestion_crc` (`gestion_crc`,`tipocircular_crc`),
  KEY `tipocircular_crc` (`tipocircular_crc`),
  CONSTRAINT `smc_circulares_ibfk_1` FOREIGN KEY (`gestion_crc`) REFERENCES `cnf_gestiones` (`id_gst`),
  CONSTRAINT `smc_circulares_ibfk_2` FOREIGN KEY (`tipocircular_crc`) REFERENCES `cnf_tipocirculares` (`id_tcc`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of smc_circulares
-- ----------------------------
INSERT INTO `smc_circulares` VALUES ('2', 'Nueva Cir  2', '20140207-menuquery.txt', '2', '1', ' ', '2014-02-07 02:58:41', '0000-00-00 00:00:00', '1', '1');
INSERT INTO `smc_circulares` VALUES ('3', 'Circular', null, '2', '2', ' ', '2014-02-07 02:58:41', '0000-00-00 00:00:00', '1', '1');

-- ----------------------------
-- Table structure for `smc_paginaprincipal`
-- ----------------------------
DROP TABLE IF EXISTS `smc_paginaprincipal`;
CREATE TABLE `smc_paginaprincipal` (
  `id_ppl` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID Contenido Pagina principal',
  `nombre_ppl` varchar(200) NOT NULL COMMENT 'Nombre',
  `descripcion_ppl` longtext NOT NULL COMMENT 'Descripci&oacute;n',
  `activo_ppl` varchar(1) NOT NULL COMMENT 'Activo',
  `fechahora_mod` datetime NOT NULL,
  `fechahora_ins` datetime NOT NULL,
  `usuario_mod` int(11) NOT NULL,
  `usuario_ins` int(11) NOT NULL,
  PRIMARY KEY (`id_ppl`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of smc_paginaprincipal
-- ----------------------------
INSERT INTO `smc_paginaprincipal` VALUES ('1', 'Carta padres', 'Estimados Padres de Familia:&nbsp;<br><br>Con mucho entusiasmo, les invitamos a asumir el compromiso de ser parte activa de la Asociación de Padres, participando de la elección del Directorio 2013, a realizarse el próximo Miércoles 13 del presente a las 19:30 en la sala de exámenes del Colegio.&nbsp;<br><br>En lo personal, ha sido una enorme satisfacción trabajar en equipo, como Directorio 2012, con tan selecto grupo de Padres, involucrados con la educación de sus Hijos. Iniciamos el trabajo orientado a reforzar los valores y principios, recibidos en el seno familiar, y necesarios para el desarrollo sano y armónico de nuestros hijos como individuos y componentes de una sociedad.<br><br>Hemos concluido un ciclo de actividades orientadas a la colaboración y relación con el Colegio Alemán, confirmando que hemos elegido una institución de excelencia para la educación de nuestros amados hijos.<br><br>Actividades como el FESTIVAL CULTURAL, cuyo objetivo es incentivar las aptitudes y talento artístico de los Alumnos, tenemos la satisfacción de haberlo logrado.<br><br>Los TALLERES PARA PADRES, destinados a la práctica de los valores y la buena relación/ comunicación entre Padres e Hijos. Deseamos y valoramos el apoyo del Colegio, para continuar con los mismos.&nbsp;<br><br>La KERMESSE, esperada por una década, gran evento que nos brindó la oportunidad de disfrutar en familia y estrechar lazos con la Dirección, Plantel Docente y Administrativo.<br><br>El “ESTUDIO DE SATISFACCIÓN DE LOS PADRES” llegó a un avance del 30% aproximadamente; daremos continuidad al relevamiento, cumpliendo su objetivo: proporcionar información de utilidad específica y oportuna para la acreditación del Colegio.<br><br>Las encuestas a los Padres seleccionados, se aplicarán en septiembre, conforme a la solicitud del nuevo Director señor Frank Weigand.<br><br>Al finalizar, nos sentimos contentos y satisfechos por lo realizado y creemos que aún queda mucho por hacer. Estamos seguros que habrá nuevas inquietudes, ideas y propuestas de trabajo, que afirmarán nuestro rol como Asociación.&nbsp;<br><br>Mi gratitud para todo el Directorio 2012 y para todos los Padres que nos apoyaron y alentaron; así como también para todo el Colegio a través de sus funcionarios, Dirección, Docentes y Administrativos.<br><br>El mejor de los éxitos en las funciones asumidas y muchísimas bendiciones!!!.<br><br>Lic. Martha Sonia Montaño de Asfura.  ', 'S', '2013-04-05 03:42:35', '2013-04-03 00:54:54', '1', '1');
