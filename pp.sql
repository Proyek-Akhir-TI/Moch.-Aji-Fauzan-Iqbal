/*
 Navicat Premium Data Transfer

 Source Server         : localh
 Source Server Type    : MySQL
 Source Server Version : 100408
 Source Host           : localhost:3306
 Source Schema         : pp_aji2

 Target Server Type    : MySQL
 Target Server Version : 100408
 File Encoding         : 65001

 Date: 16/09/2021 06:19:00
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
  `updated_at` datetime(0) NULL DEFAULT NULL,
  `created_at` datetime(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 47 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of files
-- ----------------------------
INSERT INTO `files` VALUES (1, '-REV.pdf', 1, '2021-06-27 09:44:28', '2021-06-27 09:44:28');
INSERT INTO `files` VALUES (2, '2021-09-27-REV.pdf', 2, '2021-06-27 09:45:02', '2021-06-27 09:45:02');
INSERT INTO `files` VALUES (3, '1624787325.pdf', 1, '2021-06-27 09:48:45', '2021-06-27 09:48:45');
INSERT INTO `files` VALUES (4, '2021-06-16-REV.editorconfig', 5, '2021-07-16 18:55:55', '2021-07-16 18:55:55');
INSERT INTO `files` VALUES (5, '2021-01-18-REV.docx', 8, '2021-07-18 01:12:47', '2021-07-18 01:12:47');
INSERT INTO `files` VALUES (6, '2021-01-18-REV.docx', 9, '2021-07-18 01:13:57', '2021-07-18 01:13:57');
INSERT INTO `files` VALUES (7, '2021-05-18-REV.docx', 10, '2021-07-18 05:30:49', '2021-07-18 05:30:49');
INSERT INTO `files` VALUES (8, '2021-06-18-REV.docx', 11, '2021-07-18 06:24:26', '2021-07-18 06:24:26');
INSERT INTO `files` VALUES (9, '2021-06-18-REV.docx', 12, '2021-07-18 06:24:43', '2021-07-18 06:24:43');
INSERT INTO `files` VALUES (10, '2021-06-18-REV.docx', 13, '2021-07-18 06:25:22', '2021-07-18 06:25:22');
INSERT INTO `files` VALUES (11, '2021-06-18-REV.docx', 14, '2021-07-18 06:26:52', '2021-07-18 06:26:52');
INSERT INTO `files` VALUES (12, '2021-06-18-REV.docx', 15, '2021-07-18 06:27:33', '2021-07-18 06:27:33');
INSERT INTO `files` VALUES (13, '2021-06-18-REV.docx', 16, '2021-07-18 06:28:15', '2021-07-18 06:28:15');
INSERT INTO `files` VALUES (14, '2021-06-18-REV.docx', 17, '2021-07-18 06:30:00', '2021-07-18 06:30:00');
INSERT INTO `files` VALUES (15, '1627647217.docx', 15, '2021-07-30 12:13:37', '2021-07-30 12:13:37');
INSERT INTO `files` VALUES (16, '1627647683.docx', 15, '2021-07-30 12:21:23', '2021-07-30 12:21:23');
INSERT INTO `files` VALUES (17, '1627647692.docx', 15, '2021-07-30 12:21:32', '2021-07-30 12:21:32');
INSERT INTO `files` VALUES (18, '1627647701.docx', 15, '2021-07-30 12:21:41', '2021-07-30 12:21:41');
INSERT INTO `files` VALUES (19, '1627648111.docx', 15, '2021-07-30 12:28:31', '2021-07-30 12:28:31');
INSERT INTO `files` VALUES (20, '1627648744.docx', 15, '2021-07-30 12:39:04', '2021-07-30 12:39:04');
INSERT INTO `files` VALUES (21, '1627648913.docx', 15, '2021-07-30 12:41:53', '2021-07-30 12:41:53');
INSERT INTO `files` VALUES (22, '1627705030.docx', 15, '2021-07-31 04:17:10', '2021-07-31 04:17:10');
INSERT INTO `files` VALUES (23, '1627706990.docx', 15, '2021-07-31 04:49:50', '2021-07-31 04:49:50');
INSERT INTO `files` VALUES (24, '2021-06-31-REV.pdf', 18, '2021-07-31 06:06:33', '2021-07-31 06:06:33');
INSERT INTO `files` VALUES (25, '1627713407.pdf', 18, '2021-07-31 06:36:47', '2021-07-31 06:36:47');
INSERT INTO `files` VALUES (26, '2021-07-08-REV.docx', 19, '2021-08-08 07:43:31', '2021-08-08 07:43:31');
INSERT INTO `files` VALUES (27, '2021-07-08aji.docx', 20, '2021-08-08 07:47:33', '2021-08-08 07:47:33');
INSERT INTO `files` VALUES (28, '2021-01-18-Tren Covid.pptx', 21, '2021-08-18 13:52:26', '2021-08-18 13:52:26');
INSERT INTO `files` VALUES (29, '2021-10-20-DASHBOARD DATA VAKSINASI COVID 19 (16 AGUSTUS 2021).pdf', 22, '2021-08-20 10:39:20', '2021-08-20 10:39:20');
INSERT INTO `files` VALUES (30, '2021-03-22-Poliwangi - PRESS.pptx', 23, '2021-08-22 15:05:35', '2021-08-22 15:05:35');
INSERT INTO `files` VALUES (31, '2021-04-22-Surat Pemberitahuan Zakat Fitrah.doc', 24, '2021-08-22 16:28:40', '2021-08-22 16:28:40');
INSERT INTO `files` VALUES (32, '2021-04-22-Surat Pemberitahuan Zakat Fitrah.doc', 25, '2021-08-22 16:32:35', '2021-08-22 16:32:35');
INSERT INTO `files` VALUES (33, '2021-05-22-Surat Pemberitahuan Zakat Fitrah.doc', 26, '2021-08-22 17:01:44', '2021-08-22 17:01:44');
INSERT INTO `files` VALUES (34, '1629683000.pdf', 26, '2021-08-23 01:43:20', '2021-08-23 01:43:20');
INSERT INTO `files` VALUES (35, '2021-12-13-panduan Surat Pemberitahuan Zakat Fitrah (6).pdf', 27, '2021-09-13 00:21:57', '2021-09-13 00:21:57');
INSERT INTO `files` VALUES (36, '2021-12-14-0115202_RIBABP080921.pdf', 28, '2021-09-14 12:10:59', '2021-09-14 12:10:59');
INSERT INTO `files` VALUES (37, '2021-12-14-logo2.png', 29, '2021-09-14 12:33:56', '2021-09-14 12:33:56');
INSERT INTO `files` VALUES (38, '2021-02-14-Bisnis Indonesia 5 September 2021.pdf', 30, '2021-09-14 14:00:09', '2021-09-14 14:00:09');
INSERT INTO `files` VALUES (39, '2021-02-14-784548E1-5C0A-47DE-B65C-A5FB3E1FCD42.JPEG', 31, '2021-09-14 14:04:19', '2021-09-14 14:04:19');
INSERT INTO `files` VALUES (40, '2021-02-14-BABY CAKE Full Smart Contract Security Audit.pdf', 32, '2021-09-14 14:06:00', '2021-09-14 14:06:00');
INSERT INTO `files` VALUES (41, '2021-11-15-788.pdf', 33, '2021-09-15 11:27:07', '2021-09-15 11:27:07');
INSERT INTO `files` VALUES (42, '2021-12-15-0115202_RIBABP080921.pdf', 34, '2021-09-15 12:36:11', '2021-09-15 12:36:11');
INSERT INTO `files` VALUES (43, '2021-02-15-788.pdf', 35, '2021-09-15 14:04:38', '2021-09-15 14:04:38');
INSERT INTO `files` VALUES (44, '2021-02-15-Panduan Sistem Online Pelaporan Harian COVID-19_Rev 2021.pdf', 36, '2021-09-15 14:14:59', '2021-09-15 14:14:59');
INSERT INTO `files` VALUES (45, '2021-02-15-MANUAL DATA VAKSINASI COVID 19 (22 AGUSTUS 2022).pdf', 37, '2021-09-15 14:17:29', '2021-09-15 14:17:29');
INSERT INTO `files` VALUES (46, '2021-07-15-2017-11-14buku-panduan-mantra.pdf', 38, '2021-09-15 19:42:28', '2021-09-15 19:42:28');

-- ----------------------------
-- Table structure for kategori
-- ----------------------------
DROP TABLE IF EXISTS `kategori`;
CREATE TABLE `kategori`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kategori` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` timestamp(0) NULL DEFAULT current_timestamp(),
  `updated_at` timestamp(0) NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 13 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of kategori
-- ----------------------------
INSERT INTO `kategori` VALUES (1, 'Rekayasa Perangkat Lunak', '2021-08-02 08:55:41', '2021-08-05 08:55:47');
INSERT INTO `kategori` VALUES (2, 'Agrobisnis', '2021-08-04 08:55:27', '2021-08-04 08:56:02');
INSERT INTO `kategori` VALUES (3, 'Draft Buku Ajar', '2021-08-14 02:14:01', '2021-08-14 02:14:01');
INSERT INTO `kategori` VALUES (4, 'Modul', '2021-08-14 02:41:04', '2021-08-14 02:41:04');
INSERT INTO `kategori` VALUES (5, 'Objek', '2021-08-14 03:11:58', '2021-08-14 10:27:58');
INSERT INTO `kategori` VALUES (6, 'Gambar Bangunan', '2021-08-14 03:16:10', '2021-08-14 03:16:10');
INSERT INTO `kategori` VALUES (7, 'Percobaan', '2021-08-14 03:23:19', '2021-08-14 03:23:19');
INSERT INTO `kategori` VALUES (8, 'Penelitian', '2021-08-14 03:26:16', '2021-08-14 03:26:16');
INSERT INTO `kategori` VALUES (9, 'Praktikum', '2021-08-14 06:02:09', '2021-08-14 06:02:09');
INSERT INTO `kategori` VALUES (10, 'Subjek', '2021-08-14 10:28:59', '2021-08-14 10:28:59');
INSERT INTO `kategori` VALUES (11, 'Latihan', '2021-08-15 01:55:11', '2021-08-15 01:55:11');
INSERT INTO `kategori` VALUES (12, 'Observasi', '2021-08-15 01:56:45', '2021-08-15 01:56:45');

-- ----------------------------
-- Table structure for kriteria
-- ----------------------------
DROP TABLE IF EXISTS `kriteria`;
CREATE TABLE `kriteria`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `abstrak` int(11) NULL DEFAULT NULL,
  `created_at` timestamp(0) NOT NULL DEFAULT current_timestamp() ON UPDATE CURRENT_TIMESTAMP(0),
  `updated_at` timestamp(0) NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 9 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

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
-- Table structure for nilai_kriteria
-- ----------------------------
DROP TABLE IF EXISTS `nilai_kriteria`;
CREATE TABLE `nilai_kriteria`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_kriteria` int(11) NOT NULL,
  `id_usulan` bigint(20) UNSIGNED NOT NULL,
  `nilai` int(11) NOT NULL,
  `created_at` timestamp(0) NULL DEFAULT current_timestamp(),
  `updated_at` timestamp(0) NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `id_usulan`(`id_usulan`) USING BTREE,
  CONSTRAINT `nilai_kriteria_ibfk_1` FOREIGN KEY (`id_usulan`) REFERENCES `usulan` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

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
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of oauth_clients
-- ----------------------------
INSERT INTO `oauth_clients` VALUES (1, NULL, 'Laravel Personal Access Client', 'kG1QVV5f7Pq1yCgXp1ui1drqojhYyiCXDg1nInbX', NULL, 'http://localhost', 1, 0, 0, '2021-04-23 14:01:55', '2021-04-23 14:01:55');
INSERT INTO `oauth_clients` VALUES (2, NULL, 'Laravel Password Grant Client', 'IKYf8ILOi121EWwoYaXILXxh30AasPXwHbcggCVo', 'users', 'http://localhost', 0, 1, 0, '2021-04-23 14:01:55', '2021-04-23 14:01:55');
INSERT INTO `oauth_clients` VALUES (3, NULL, 'Laravel Personal Access Client', 'hlNBG9Tk5l4Iy747sMCMLRdnba5bam41kZQsEld1', NULL, 'http://localhost', 1, 0, 0, '2021-07-16 15:58:47', '2021-07-16 15:58:47');
INSERT INTO `oauth_clients` VALUES (4, NULL, 'Laravel Password Grant Client', 'Wp0sOrPat9ff2viEpCU76ik3CKcQqG15PYrrjy3b', 'users', 'http://localhost', 0, 1, 0, '2021-07-16 15:58:47', '2021-07-16 15:58:47');

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
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of oauth_personal_access_clients
-- ----------------------------
INSERT INTO `oauth_personal_access_clients` VALUES (1, 1, '2021-04-23 14:01:55', '2021-04-23 14:01:55');
INSERT INTO `oauth_personal_access_clients` VALUES (2, 3, '2021-07-16 15:58:47', '2021-07-16 15:58:47');

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
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of panduan
-- ----------------------------
INSERT INTO `panduan` VALUES (2, 'panduan Surat Pemberitahuan Zakat Fitrah.pdf', '2021-07-17 06:43:17', '2021-08-22 16:34:59');

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
-- Table structure for prodi
-- ----------------------------
DROP TABLE IF EXISTS `prodi`;
CREATE TABLE `prodi`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `prodi` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` timestamp(0) NOT NULL DEFAULT current_timestamp() ON UPDATE CURRENT_TIMESTAMP(0),
  `updated_at` timestamp(0) NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 8 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of prodi
-- ----------------------------
INSERT INTO `prodi` VALUES (1, 'Teknik Informatika', '2021-07-17 12:27:26', '2021-07-17 08:02:40');
INSERT INTO `prodi` VALUES (2, 'Teknik Sipil', '2021-07-17 08:02:40', '2021-07-17 08:02:40');
INSERT INTO `prodi` VALUES (3, 'Agribisnis', '2021-07-17 08:02:59', '2021-07-17 08:02:59');
INSERT INTO `prodi` VALUES (4, 'Teknik Mesin', '2021-07-17 08:02:59', '2021-07-17 08:02:59');
INSERT INTO `prodi` VALUES (5, 'Teknologi Pengolahan Hasil Ternak', '2021-07-18 07:59:51', '2021-07-18 07:59:51');
INSERT INTO `prodi` VALUES (6, 'Manajemen Bisnis Pariwisata', '2021-07-18 07:59:51', '2021-07-18 07:59:51');
INSERT INTO `prodi` VALUES (7, 'Teknik Manufaktur Kapal', '2021-07-18 08:00:40', '2021-07-18 08:00:40');

-- ----------------------------
-- Table structure for profiles
-- ----------------------------
DROP TABLE IF EXISTS `profiles`;
CREATE TABLE `profiles`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_prodi` int(11) NULL DEFAULT NULL,
  `nip_nik` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `foto_profil` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT 'profile.png',
  `id_user` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp(0) NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp(0) NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `id_user`(`id_user`) USING BTREE,
  CONSTRAINT `profiles_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 10 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of profiles
-- ----------------------------
INSERT INTO `profiles` VALUES (1, 1, '31212144177', 'profile.png', 18, '2021-07-18 11:29:59', '2021-07-18 04:30:53');
INSERT INTO `profiles` VALUES (2, NULL, NULL, '1627650722.png', 17, '2021-07-18 11:29:59', '2021-07-30 13:12:02');
INSERT INTO `profiles` VALUES (3, 6, '314314141', 'profile.png', 26, '2021-07-18 04:41:56', '2021-07-18 04:41:56');
INSERT INTO `profiles` VALUES (4, 2, '12355678990', '1627706742.jpeg', 27, '2021-07-18 06:21:00', '2021-07-31 04:46:34');
INSERT INTO `profiles` VALUES (5, 3, '1231', 'profile.png', 28, '2021-07-18 06:21:30', '2021-07-18 06:21:30');
INSERT INTO `profiles` VALUES (6, 5, 'qeqe', '1627712774.jpeg', 29, '2021-07-18 06:22:38', '2021-07-31 06:26:15');
INSERT INTO `profiles` VALUES (7, 4, 'td131', 'profile.png', 30, '2021-07-18 06:23:16', '2021-07-18 06:23:16');
INSERT INTO `profiles` VALUES (8, 7, '131', 'profile.png', 31, '2021-07-18 06:23:44', '2021-07-18 06:23:44');

-- ----------------------------
-- Table structure for record_status
-- ----------------------------
DROP TABLE IF EXISTS `record_status`;
CREATE TABLE `record_status`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `status` decimal(1, 0) NULL DEFAULT 1,
  `tanggal` datetime(0) NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP(0),
  `is_active` decimal(1, 0) NULL DEFAULT NULL,
  `id_usulan` decimal(10, 0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 13 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of record_status
-- ----------------------------
INSERT INTO `record_status` VALUES (1, 1, '2021-09-16 01:15:07', 1, 34);
INSERT INTO `record_status` VALUES (2, 1, '2021-09-16 01:15:28', 1, 35);
INSERT INTO `record_status` VALUES (3, 1, '2021-09-16 01:15:29', 1, 36);
INSERT INTO `record_status` VALUES (4, 1, '2021-09-16 02:40:01', 0, 37);
INSERT INTO `record_status` VALUES (8, 5, '2021-09-16 02:40:13', 1, 37);
INSERT INTO `record_status` VALUES (9, 1, '2021-09-16 02:47:03', 0, 38);
INSERT INTO `record_status` VALUES (11, 2, '2021-09-16 02:47:43', 0, 38);
INSERT INTO `record_status` VALUES (12, 5, '2021-09-16 03:35:15', 1, 38);

-- ----------------------------
-- Table structure for reviewer_files
-- ----------------------------
DROP TABLE IF EXISTS `reviewer_files`;
CREATE TABLE `reviewer_files`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `file` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `id_usulan` decimal(10, 0) NULL DEFAULT NULL,
  `id_user` decimal(10, 0) NULL DEFAULT NULL,
  `created_at` datetime(0) NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP(0),
  `updated_at` datetime(0) NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP(0),
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of reviewer_files
-- ----------------------------
INSERT INTO `reviewer_files` VALUES (1, '1631715809.pdf', 37, 18, '2021-09-15 14:23:29', '2021-09-15 14:23:29');
INSERT INTO `reviewer_files` VALUES (2, '1631723815.pdf', 37, 18, '2021-09-15 16:36:55', '2021-09-15 16:36:55');
INSERT INTO `reviewer_files` VALUES (3, '2021-04-15.pdf', 37, 18, '2021-09-15 16:41:18', '2021-09-15 16:41:18');

-- ----------------------------
-- Table structure for reviewer_nilai
-- ----------------------------
DROP TABLE IF EXISTS `reviewer_nilai`;
CREATE TABLE `reviewer_nilai`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `abstrak` int(11) NULL DEFAULT NULL,
  `isi` int(11) NULL DEFAULT NULL,
  `kesimpulan` int(11) NULL DEFAULT NULL,
  `id_reviewer` int(11) NULL DEFAULT NULL,
  `id_usulan` int(11) NULL DEFAULT NULL,
  `rekomendasi` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT 'belum',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 20 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of reviewer_nilai
-- ----------------------------
INSERT INTO `reviewer_nilai` VALUES (16, 90, 90, 90, 18, 34, 'diterima');
INSERT INTO `reviewer_nilai` VALUES (17, 50, 50, 50, 18, 35, 'ditolak');
INSERT INTO `reviewer_nilai` VALUES (18, 50, 50, 50, 18, 37, 'ditolak');
INSERT INTO `reviewer_nilai` VALUES (19, 90, 90, 90, 18, 38, 'diterima');

-- ----------------------------
-- Table structure for reviewer_usulan
-- ----------------------------
DROP TABLE IF EXISTS `reviewer_usulan`;
CREATE TABLE `reviewer_usulan`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_usulan` int(11) NULL DEFAULT NULL,
  `id_reviewer` int(255) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 33 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of reviewer_usulan
-- ----------------------------
INSERT INTO `reviewer_usulan` VALUES (29, 34, 18);
INSERT INTO `reviewer_usulan` VALUES (30, 35, 18);
INSERT INTO `reviewer_usulan` VALUES (31, 37, 18);
INSERT INTO `reviewer_usulan` VALUES (32, 38, 18);

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

-- ----------------------------
-- Table structure for status
-- ----------------------------
DROP TABLE IF EXISTS `status`;
CREATE TABLE `status`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama_status` varchar(25) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 7 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of status
-- ----------------------------
INSERT INTO `status` VALUES (1, 'Pengajuan');
INSERT INTO `status` VALUES (2, 'Direview');
INSERT INTO `status` VALUES (3, 'Diterima');
INSERT INTO `status` VALUES (4, 'Ditolak');
INSERT INTO `status` VALUES (5, 'Sudah direview');
INSERT INTO `status` VALUES (6, 'Copy Editing');

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
) ENGINE = InnoDB AUTO_INCREMENT = 33 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES (17, 'admin', 'mahardikawsp@gmail.com', NULL, '$2y$10$ioVvj6nxwMu4tYnsd1MjMuxNfyBRo8zuMNbJvskoBQFTEBLA98vfO', '1', 'sadsa', '1627144674.png', NULL, '2021-07-16 15:54:06', '2021-07-31 04:41:30');
INSERT INTO `users` VALUES (18, 'Dosen Gaul', 'mahardikawirasaputra@gmail.com', NULL, '$2y$10$ioVvj6nxwMu4tYnsd1MjMuxNfyBRo8zuMNbJvskoBQFTEBLA98vfO', '2', 'oke oke jos', '1626571597.jpeg', NULL, '2021-07-16 18:54:33', '2021-07-18 05:28:50');
INSERT INTO `users` VALUES (26, 'jajals', 'jajal@gmail.com', NULL, '$2y$10$ioVvj6nxwMu4tYnsd1MjMuxNfyBRo8zuMNbJvskoBQFTEBLA98vfO', '2', 'dafa', '1626589864.png', NULL, '2021-07-18 04:41:56', '2021-07-18 06:31:04');
INSERT INTO `users` VALUES (27, 'Dosen Sipils', 'promahardika@gmail.com', NULL, '$2y$10$ioVvj6nxwMu4tYnsd1MjMuxNfyBRo8zuMNbJvskoBQFTEBLA98vfO', '2', 'aasasfsafas', '1626592180.jpeg', NULL, '2021-07-18 06:21:00', '2021-07-31 04:46:34');
INSERT INTO `users` VALUES (28, 'Dosen Agri', 'agri@gmail.com', NULL, '$2y$10$ioVvj6nxwMu4tYnsd1MjMuxNfyBRo8zuMNbJvskoBQFTEBLA98vfO', '2', 'swdqwq', 'profile.png', NULL, '2021-07-18 06:21:30', '2021-07-18 06:21:30');
INSERT INTO `users` VALUES (29, 'dosen tpht', 'tpht@gmail.com', NULL, '$2y$10$ioVvj6nxwMu4tYnsd1MjMuxNfyBRo8zuMNbJvskoBQFTEBLA98vfO', '2', 'dad', 'profile.png', NULL, '2021-07-18 06:22:38', '2021-07-31 06:26:14');
INSERT INTO `users` VALUES (30, 'dosen mesin', 'mesin@gmail.com', NULL, '$2y$10$ioVvj6nxwMu4tYnsd1MjMuxNfyBRo8zuMNbJvskoBQFTEBLA98vfO', '2', 'qeq', 'profile.png', NULL, '2021-07-18 06:23:16', '2021-07-18 06:23:16');
INSERT INTO `users` VALUES (31, 'dosen tmk', 'tmk@gmail.com', NULL, '$2y$10$ioVvj6nxwMu4tYnsd1MjMuxNfyBRo8zuMNbJvskoBQFTEBLA98vfO', '2', 'qq', 'profile.png', NULL, '2021-07-18 06:23:44', '2021-07-18 06:23:44');

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
  `abstrak` int(11) NULL DEFAULT 0,
  `isi` int(11) NULL DEFAULT 0,
  `kesimpulan` int(11) NULL DEFAULT NULL,
  `rekomendasi` varchar(12) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  `id_kategori` int(11) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 39 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of usulan
-- ----------------------------
INSERT INTO `usulan` VALUES (34, 'Judul Obser', 'Obser dulu ya', '2021-12-15-0115202_RIBABP080921.pdf', 27, 0, 1, 90, 90, 90, '0', '2021-09-15 12:36:11', '2021-09-15 12:43:01', 12);
INSERT INTO `usulan` VALUES (35, 'PHP version', 'na', '2021-02-15-788.pdf', 27, 0, 1, 50, 50, 50, '0', '2021-09-15 14:04:38', '2021-09-15 14:07:01', 9);
INSERT INTO `usulan` VALUES (36, 'Kentel Kembes', 'kemes', '2021-02-15-Panduan Sistem Online Pelaporan Harian COVID-19_Rev 2021.pdf', 27, 0, 1, 0, 0, NULL, '0', '2021-09-15 14:14:59', '2021-09-15 14:14:59', 6);
INSERT INTO `usulan` VALUES (37, 'nanuk', 'nuknan', '2021-02-15-MANUAL DATA VAKSINASI COVID 19 (22 AGUSTUS 2022).pdf', 27, 0, 1, 50, 50, 50, '0', '2021-09-15 14:17:29', '2021-09-15 14:19:19', 4);
INSERT INTO `usulan` VALUES (38, 'tes gan', 'gan tes', '2021-07-15-2017-11-14buku-panduan-mantra.pdf', 27, 0, 1, 90, 90, 90, '0', '2021-09-15 19:42:28', '2021-09-15 19:47:43', 7);

-- ----------------------------
-- Table structure for usulan_catatan
-- ----------------------------
DROP TABLE IF EXISTS `usulan_catatan`;
CREATE TABLE `usulan_catatan`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `status_catatan` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `id_usulan` int(11) NULL DEFAULT NULL,
  `id_reviewer` int(11) NULL DEFAULT 0,
  `status` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT '1',
  `start_date` datetime(0) NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP(0),
  `end_date` datetime(0) NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP(0),
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 35 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of usulan_catatan
-- ----------------------------
INSERT INTO `usulan_catatan` VALUES (26, NULL, 34, 0, '1', '2021-09-15 19:54:49', '2021-09-15 19:54:54');
INSERT INTO `usulan_catatan` VALUES (27, 'bagus sudah lanjutkan saja saya males ngoreksi sudah gede kok minta dikoreksi', 34, 18, '5', '2021-09-15 19:54:58', '2021-09-15 19:55:00');
INSERT INTO `usulan_catatan` VALUES (28, NULL, 35, 0, '1', NULL, NULL);
INSERT INTO `usulan_catatan` VALUES (29, 'tes', 35, 18, '5', '2021-09-15 21:07:01', '2021-09-15 21:07:01');
INSERT INTO `usulan_catatan` VALUES (30, NULL, 36, 0, '1', NULL, NULL);
INSERT INTO `usulan_catatan` VALUES (31, NULL, 37, 0, '1', NULL, NULL);
INSERT INTO `usulan_catatan` VALUES (32, 'ya ini lahhhh', 37, 18, '5', '2021-09-15 23:41:57', '2021-09-15 23:41:57');
INSERT INTO `usulan_catatan` VALUES (33, NULL, 38, 0, '1', NULL, NULL);
INSERT INTO `usulan_catatan` VALUES (34, 'ya bagus', 38, 18, '5', '2021-09-16 02:47:43', '2021-09-16 02:47:43');

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
