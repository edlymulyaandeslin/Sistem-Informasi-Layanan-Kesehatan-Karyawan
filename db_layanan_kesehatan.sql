/*
 Navicat Premium Data Transfer

 Source Server         : MySQL Server
 Source Server Type    : MySQL
 Source Server Version : 50744
 Source Host           : localhost:3306
 Source Schema         : db_layanan_kesehatan

 Target Server Type    : MySQL
 Target Server Version : 50744
 File Encoding         : 65001

 Date: 25/11/2025 02:09:38
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for layanan_kesehatan
-- ----------------------------
DROP TABLE IF EXISTS `layanan_kesehatan`;
CREATE TABLE `layanan_kesehatan`  (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `jenis_layanan` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `deskripsi` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `status` enum('diajukan','disetujui','ditolak') CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `layanan_kesehatan_user_id_foreign`(`user_id`) USING BTREE,
  CONSTRAINT `layanan_kesehatan_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 14 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_bin ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of layanan_kesehatan
-- ----------------------------
INSERT INTO `layanan_kesehatan` VALUES (12, 2, 'Kacamata', '123123', 'disetujui', '2025-11-25 01:16:28');
INSERT INTO `layanan_kesehatan` VALUES (13, 2, 'Klaim Obat', 'lololo\r\n', 'disetujui', '2025-11-25 01:40:42');

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users`  (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `role` enum('admin','karyawan') CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `users_email_unique`(`email`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 11 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_bin ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES (1, 'admin', 'admin@silkk.com', '$2y$10$Rs5wtdHE.l2XA2FDMlDFoOrT.EcHTF2L6DB/cPVrhpgL2cWC6EM8e', 'admin');
INSERT INTO `users` VALUES (2, 'Karyawan 1', 'karyawan1@silkk.com', '$2y$10$R9I8n8TbGnloB8zJsUnosO5WIAvqM.cOwAT7Zn0NMJPTh6Ld6.ioe', 'karyawan');
INSERT INTO `users` VALUES (3, 'Karyawan 2', 'karyawan2@silkk.com', '$2y$10$eQF16Kbehtv/kiPCW07rWuEpf867xvXH4u0sArgE1.eoxyjV9lbMm', 'karyawan');
INSERT INTO `users` VALUES (4, 'Karyawan 3', 'karyawan3@silkk.com', '$2y$10$xOGql0COOjCUOQOQDGXeGuD9b7xJ4MvTFOS5f/mkvDXukUkjs/omC', 'karyawan');

SET FOREIGN_KEY_CHECKS = 1;
