/*
 Navicat Premium Data Transfer

 Source Server         : localh
 Source Server Type    : MySQL
 Source Server Version : 100408
 Source Host           : localhost:3306
 Source Schema         : poliwangi_press

 Target Server Type    : MySQL
 Target Server Version : 100408
 File Encoding         : 65001

 Date: 26/05/2021 22:22:05
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for catatan
-- ----------------------------
DROP TABLE IF EXISTS `catatan`;
CREATE TABLE `catatan`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `isi_catatan` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `id_status_catatan` int(11) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for failed_jobs
-- ----------------------------
DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE `failed_jobs`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `connection` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp(0) NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for files
-- ----------------------------
DROP TABLE IF EXISTS `files`;
CREATE TABLE `files`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `file` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `id_usulan` int(11) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for kategori
-- ----------------------------
DROP TABLE IF EXISTS `kategori`;
CREATE TABLE `kategori`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kategori` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of kategori
-- ----------------------------
INSERT INTO `kategori` VALUES (1, 'Rekayasa Perangkat Lunak');
INSERT INTO `kategori` VALUES (2, 'Agrobisnis');

-- ----------------------------
-- Table structure for migrations
-- ----------------------------
DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 39 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of migrations
-- ----------------------------
INSERT INTO `migrations` VALUES (28, '2014_10_12_000000_create_users_table', 1);
INSERT INTO `migrations` VALUES (29, '2014_10_12_100000_create_password_resets_table', 1);
INSERT INTO `migrations` VALUES (30, '2016_06_01_000001_create_oauth_auth_codes_table', 1);
INSERT INTO `migrations` VALUES (31, '2016_06_01_000002_create_oauth_access_tokens_table', 1);
INSERT INTO `migrations` VALUES (32, '2016_06_01_000003_create_oauth_refresh_tokens_table', 1);
INSERT INTO `migrations` VALUES (33, '2016_06_01_000004_create_oauth_clients_table', 1);
INSERT INTO `migrations` VALUES (34, '2016_06_01_000005_create_oauth_personal_access_clients_table', 1);
INSERT INTO `migrations` VALUES (35, '2019_08_19_000000_create_failed_jobs_table', 1);
INSERT INTO `migrations` VALUES (36, '2020_08_25_035741_create_usulan_table', 1);
INSERT INTO `migrations` VALUES (37, '2020_09_09_091857_create_usulan_dosen_table', 2);
INSERT INTO `migrations` VALUES (38, '2020_09_15_031535_create_panduan_table', 3);

-- ----------------------------
-- Table structure for oauth_access_tokens
-- ----------------------------
DROP TABLE IF EXISTS `oauth_access_tokens`;
CREATE TABLE `oauth_access_tokens`  (
  `id` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED NULL DEFAULT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `scopes` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  `expires_at` datetime(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `oauth_access_tokens_user_id_index`(`user_id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for oauth_auth_codes
-- ----------------------------
DROP TABLE IF EXISTS `oauth_auth_codes`;
CREATE TABLE `oauth_auth_codes`  (
  `id` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `scopes` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `oauth_auth_codes_user_id_index`(`user_id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for oauth_clients
-- ----------------------------
DROP TABLE IF EXISTS `oauth_clients`;
CREATE TABLE `oauth_clients`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) UNSIGNED NULL DEFAULT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `secret` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `provider` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `redirect` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `personal_access_client` tinyint(1) NOT NULL,
  `password_client` tinyint(1) NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `oauth_clients_user_id_index`(`user_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of oauth_clients
-- ----------------------------
INSERT INTO `oauth_clients` VALUES (1, NULL, 'Laravel Personal Access Client', 'kG1QVV5f7Pq1yCgXp1ui1drqojhYyiCXDg1nInbX', NULL, 'http://localhost', 1, 0, 0, '2021-04-23 14:01:55', '2021-04-23 14:01:55');
INSERT INTO `oauth_clients` VALUES (2, NULL, 'Laravel Password Grant Client', 'IKYf8ILOi121EWwoYaXILXxh30AasPXwHbcggCVo', 'users', 'http://localhost', 0, 1, 0, '2021-04-23 14:01:55', '2021-04-23 14:01:55');

-- ----------------------------
-- Table structure for oauth_personal_access_clients
-- ----------------------------
DROP TABLE IF EXISTS `oauth_personal_access_clients`;
CREATE TABLE `oauth_personal_access_clients`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of oauth_personal_access_clients
-- ----------------------------
INSERT INTO `oauth_personal_access_clients` VALUES (1, 1, '2021-04-23 14:01:55', '2021-04-23 14:01:55');

-- ----------------------------
-- Table structure for oauth_refresh_tokens
-- ----------------------------
DROP TABLE IF EXISTS `oauth_refresh_tokens`;
CREATE TABLE `oauth_refresh_tokens`  (
  `id` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `access_token_id` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `oauth_refresh_tokens_access_token_id_index`(`access_token_id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for panduan
-- ----------------------------
DROP TABLE IF EXISTS `panduan`;
CREATE TABLE `panduan`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `file` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for password_resets
-- ----------------------------
DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE `password_resets`  (
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  INDEX `password_resets_email_index`(`email`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for profiles
-- ----------------------------
DROP TABLE IF EXISTS `profiles`;
CREATE TABLE `profiles`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `jurusan` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `nip_nik` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `foto_profil` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `id_user` int(11) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for revisi
-- ----------------------------
DROP TABLE IF EXISTS `revisi`;
CREATE TABLE `revisi`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kriteria` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `id_catatan` int(11) NOT NULL,
  `created_at` timestamp(0) NOT NULL DEFAULT current_timestamp() ON UPDATE CURRENT_TIMESTAMP(0),
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for roles
-- ----------------------------
DROP TABLE IF EXISTS `roles`;
CREATE TABLE `roles`  (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `role` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of roles
-- ----------------------------
INSERT INTO `roles` VALUES (1, 'admin');
INSERT INTO `roles` VALUES (2, 'dosen');
INSERT INTO `roles` VALUES (3, 'reviewer');

-- ----------------------------
-- Table structure for status
-- ----------------------------
DROP TABLE IF EXISTS `status`;
CREATE TABLE `status`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama_status` varchar(25) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of status
-- ----------------------------
INSERT INTO `status` VALUES (1, 'Pengajuan');
INSERT INTO `status` VALUES (2, 'Direview');
INSERT INTO `status` VALUES (3, 'Diterima');
INSERT INTO `status` VALUES (4, 'Ditolak');

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp(0) NULL DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'user',
  `bio` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `photo` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT 'profile.png',
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `users_email_unique`(`email`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 17 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES (1, 'admin', 'admin@me.com', NULL, '$2y$10$LnuK.RB2hZwh56m045po6eT.SDAlUITBiQ6bMmQ2.hoqryMoW3KWC', '1', NULL, '1599542104.jpeg', 'yAwlcG2uqCO4rrOeNpCArU8mX3kD5TCEAP3KnJr9T75UrYGrreRk2DuK7eEo', '2020-08-25 04:24:59', '2020-09-08 05:15:05');
INSERT INTO `users` VALUES (2, 'jipau', 'jipau@me.com', NULL, '123456', '2', NULL, '1599325588.jpeg', NULL, '2020-08-25 04:31:58', '2020-10-05 13:55:29');
INSERT INTO `users` VALUES (3, 'dosenku', 'dosen@me.com', NULL, '$2y$10$eIqfsnXm.z.tUeQYCBogV.OSaBNwraDjehoNKT8.eKWRF/HSO.8tC', '2', NULL, '1600445477.jpeg', NULL, '2020-08-25 04:32:58', '2020-09-18 16:11:18');
INSERT INTO `users` VALUES (12, 'ji', 'ji@me.com', NULL, '$2y$10$McdMXo55oZ2haoPKoeuboelcXDwvPA7cPmbMn9RpoScTJbbX82jVe', '2', NULL, NULL, NULL, '2020-09-03 14:28:39', '2020-09-03 14:28:39');
INSERT INTO `users` VALUES (13, 'uhuy', 'uhuy@me.com', NULL, '$2y$10$MlGouPyukrJTOyn6iCTBkuRVoEXELHj9Uga3ngtISjtb3mfkr78XS', '3', NULL, NULL, NULL, '2020-09-03 16:41:23', '2021-05-26 11:18:28');
INSERT INTO `users` VALUES (14, 'admin2', 'admin2@me.com', NULL, '$2y$10$MlGouPyukrJTOyn6iCTBkuRVoEXELHj9Uga3ngtISjtb3mfkr78XS', '3', NULL, '1599325486.jpeg', NULL, '2020-09-03 16:41:54', '2020-09-15 15:09:19');
INSERT INTO `users` VALUES (15, 'coba', 'coba@me.com', NULL, '$2y$10$MlGouPyukrJTOyn6iCTBkuRVoEXELHj9Uga3ngtISjtb3mfkr78XS', '2', NULL, NULL, NULL, '2020-09-11 18:36:56', '2020-09-11 18:36:56');
INSERT INTO `users` VALUES (16, 'joss', 'gandos@gmail.com', NULL, '$2y$10$MlGouPyukrJTOyn6iCTBkuRVoEXELHj9Uga3ngtISjtb3mfkr78XS', '1', 'gandos', NULL, NULL, '2020-09-29 11:38:44', '2020-09-29 11:38:44');

-- ----------------------------
-- Table structure for usersx
-- ----------------------------
DROP TABLE IF EXISTS `usersx`;
CREATE TABLE `usersx`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp(0) NULL DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'user',
  `bio` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `photo` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT 'profile.png',
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `users_email_unique`(`email`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 17 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of usersx
-- ----------------------------
INSERT INTO `usersx` VALUES (1, 'admin', 'admin@me.com', NULL, '$2y$10$LnuK.RB2hZwh56m045po6eT.SDAlUITBiQ6bMmQ2.hoqryMoW3KWC', 'admin', NULL, '1599542104.jpeg', 'yAwlcG2uqCO4rrOeNpCArU8mX3kD5TCEAP3KnJr9T75UrYGrreRk2DuK7eEo', '2020-08-25 04:24:59', '2020-09-08 05:15:05');
INSERT INTO `usersx` VALUES (2, 'jipau', 'jipau@me.com', NULL, '123456', 'user', NULL, '1599325588.jpeg', NULL, '2020-08-25 04:31:58', '2020-10-05 13:55:29');
INSERT INTO `usersx` VALUES (3, 'dosenku', 'dosen@me.com', NULL, '$2y$10$eIqfsnXm.z.tUeQYCBogV.OSaBNwraDjehoNKT8.eKWRF/HSO.8tC', 'user', NULL, '1600445477.jpeg', NULL, '2020-08-25 04:32:58', '2020-09-18 16:11:18');
INSERT INTO `usersx` VALUES (12, 'ji', 'ji@me.com', NULL, '$2y$10$McdMXo55oZ2haoPKoeuboelcXDwvPA7cPmbMn9RpoScTJbbX82jVe', 'user', NULL, NULL, NULL, '2020-09-03 14:28:39', '2020-09-03 14:28:39');
INSERT INTO `usersx` VALUES (13, 'uhuy', 'uhuy@me.com', NULL, '$2y$10$9pUykxntCK0Fu6aXMPExn.fJ402Pd.4CTlNGv/RKnre31aaMolsee', 'user', NULL, NULL, NULL, '2020-09-03 16:41:23', '2020-09-03 16:41:23');
INSERT INTO `usersx` VALUES (14, 'admin2', 'admin2@me.com', NULL, '$2y$10$ZaVWq/b5OhUOQkJkFUORBeFZlaa/lWpj5Swc.ChGl9yeTYGsKzjcC', 'admin', NULL, '1599325486.jpeg', NULL, '2020-09-03 16:41:54', '2020-09-15 15:09:19');
INSERT INTO `usersx` VALUES (15, 'coba', 'coba@me.com', NULL, '$2y$10$0onaVOludeQ2cIpUkvAUpObiv8fgOl5Ng5QYgSANpLdew.zQiAxTO', 'user', NULL, NULL, NULL, '2020-09-11 18:36:56', '2020-09-11 18:36:56');
INSERT INTO `usersx` VALUES (16, 'joss', 'gandos@gmail.com', NULL, '$2y$10$MlGouPyukrJTOyn6iCTBkuRVoEXELHj9Uga3ngtISjtb3mfkr78XS', 'admin', 'gandos', NULL, NULL, '2020-09-29 11:38:44', '2020-09-29 11:38:44');

-- ----------------------------
-- Table structure for usulan
-- ----------------------------
DROP TABLE IF EXISTS `usulan`;
CREATE TABLE `usulan`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `judul` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `deskripsi` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `file` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `id_user` int(11) NOT NULL,
  `id_reviewer` int(11) NULL DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  `id_kategori` int(11) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 11 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of usulan
-- ----------------------------
INSERT INTO `usulan` VALUES (1, 'RPL IS ME', 'ME IS RPL', '1622040858.pdf', 3, 13, 1, '2021-05-26 14:54:18', '2021-05-26 15:01:01', 1);
INSERT INTO `usulan` VALUES (2, 'tes tes', 'tes tes', '1622041419.pptx', 3, 0, 1, '2021-05-26 15:03:39', '2021-05-26 15:03:39', 1);
INSERT INTO `usulan` VALUES (3, 'agb is me', 'joss', '1622041558.pdf', 3, 0, 1, '2021-05-26 15:05:58', '2021-05-26 15:05:58', 2);
INSERT INTO `usulan` VALUES (4, 'tes lagi', 'lagi rwa', '1622041626.cdr', 3, 0, 1, '2021-05-26 15:07:06', '2021-05-26 15:07:06', 2);
INSERT INTO `usulan` VALUES (5, 'boro boro', 'ts bor', '1622041688.txt', 3, 0, 1, '2021-05-26 15:08:08', '2021-05-26 15:08:08', 2);
INSERT INTO `usulan` VALUES (6, 'bc', 'bc cha', '1622041762.jpeg', 3, 0, 1, '2021-05-26 15:09:22', '2021-05-26 15:09:22', 1);
INSERT INTO `usulan` VALUES (7, 'alternatif', 'natif alte', '1622041844.gif', 3, 0, 1, '2021-05-26 15:10:44', '2021-05-26 15:10:44', 1);
INSERT INTO `usulan` VALUES (8, 'iyo', 'opo iyo', '1622041903.png', 3, 14, 1, '2021-05-26 15:11:43', '2021-05-26 15:12:41', 1);
INSERT INTO `usulan` VALUES (9, 'ada dosen', 'dosen ada', '1622041935.twb', 3, 0, 1, '2021-05-26 15:12:15', '2021-05-26 15:12:15', 1);
INSERT INTO `usulan` VALUES (10, 'LAST', 'LAST', '1622042389.png', 3, 13, 1, '2021-05-26 15:19:49', '2021-05-26 15:20:11', 1);

-- ----------------------------
-- Table structure for usulan_catatan
-- ----------------------------
DROP TABLE IF EXISTS `usulan_catatan`;
CREATE TABLE `usulan_catatan`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `status_catatan` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `id_usulan` int(11) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 6 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of usulan_catatan
-- ----------------------------
INSERT INTO `usulan_catatan` VALUES (1, NULL, NULL);
INSERT INTO `usulan_catatan` VALUES (2, NULL, NULL);
INSERT INTO `usulan_catatan` VALUES (3, 'ya dicatat dulu', 1);
INSERT INTO `usulan_catatan` VALUES (4, 'hayo apaa', 8);
INSERT INTO `usulan_catatan` VALUES (5, 'ya betulkan dulu', 10);

-- ----------------------------
-- Table structure for usulan_dosen
-- ----------------------------
DROP TABLE IF EXISTS `usulan_dosen`;
CREATE TABLE `usulan_dosen`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `judul` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `deskripsi` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `dosen` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `file` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for usulans
-- ----------------------------
DROP TABLE IF EXISTS `usulans`;
CREATE TABLE `usulans`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `judul` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `deskripsi` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `id_file` int(11) NOT NULL,
  `id_kategori` int(11) NOT NULL,
  `id_status` int(11) NOT NULL,
  `id_revisi` int(11) NOT NULL,
  `created_at` timestamp(0) NOT NULL DEFAULT current_timestamp() ON UPDATE CURRENT_TIMESTAMP(0),
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

SET FOREIGN_KEY_CHECKS = 1;
