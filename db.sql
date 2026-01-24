-- --------------------------------------------------------
-- Hôte:                         127.0.0.1
-- Version du serveur:           8.0.30 - MySQL Community Server - GPL
-- SE du serveur:                Win64
-- HeidiSQL Version:             12.1.0.6537
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

-- Listage de la structure de table sekkgcsq_joblink_db. users
CREATE TABLE IF NOT EXISTS `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` enum('admin','apprenant') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `promotion` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `specialization` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

-- Listage des données de la table sekkgcsq_joblink_db.users : ~9 rows (environ)
DELETE FROM `users`;
INSERT INTO `users` (`id`, `name`, `email`, `password`, `role`, `created_at`, `promotion`, `specialization`) VALUES
	(1, 'Admin YouCode', 'admin@youcode.ma', '$2y$10$F15HBGdtJGnsS02Dt8Jt2..GBhbHHrZcQ0bDbc6ATV/EOW8jtT8TW', 'admin', '2026-01-19 11:37:45', NULL, NULL),
	(2, 'Student Test', 'student@youcode.ma', '$2y$10$EABxtPUJxqHwhU5KU9of4um7vowhRoGFut5LeuguW9YM/wnYKbBDq', 'apprenant', '2026-01-19 11:40:25', NULL, NULL),
	(3, 'Student Test', 'student@test.com', '$2y$10$6o6wLUeH046fLgWI.wMVMufe.uiiukfOefRPytvQitglWML8lsp/e', 'apprenant', '2026-01-19 16:59:13', NULL, NULL),
	(4, 'Ciaran Avery', 'bukyde@mailinator.com', '$2y$10$fWtbOLQ7UjCkiMBdw.TmcOTMTb6T6UW7xcXYBmJNe5T/Z7ba4J1pK', 'apprenant', '2026-01-19 17:27:49', NULL, NULL),
	(5, 'Mari Weaver', 'jibe@mailinator.com', '$2y$10$p08nUq2ti0mFVcv701njZeZjC4HrNg.LZ/SOM3KDSOoJ4OLrBftX.', 'apprenant', '2026-01-19 17:49:53', NULL, NULL),
	(6, 'Robin Kidd', 'huhutubyro@mailinator.com', '$2y$10$eTju/TJP149SrXfa7.pXEePEIQotsfMyiCxHjJVK7t5.ikrBDHId.', 'apprenant', '2026-01-21 22:23:19', NULL, NULL),
	(7, 'Cooper Stewart', 'jaxoligu@mailinator.com', '$2y$10$A5MtyiUHDNc3kkHufvefo.mO1mvLxukcXkU3wdejFx/fLut16XS4C', 'apprenant', '2026-01-22 09:07:00', NULL, NULL),
	(8, 'John Hodge', 'mumojy@mailinator.com', '$2y$10$TCMCBd5JsNxiUHBd50JjueEETMjQXrbSgxSncrQqkJBqtAA9QaRZO', 'apprenant', '2026-01-23 09:39:29', NULL, NULL),
	(9, 'Hilda Winters', 'fatutabek@mailinator.com', '$2y$10$bPd7MP7Hkr225/vRePZIsOx68FuOPcowbpCw6So5Ou4FWxIGwW5za', 'apprenant', '2026-01-23 20:32:17', NULL, NULL);


-- Listage de la structure de table sekkgcsq_joblink_db. companies
CREATE TABLE IF NOT EXISTS `companies` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `sector` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `location` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `avatar` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE KEY `email` (`email`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

-- Listage des données de la table sekkgcsq_joblink_db.companies : ~11 rows (environ)
DELETE FROM `companies`;
INSERT INTO `companies` (`id`, `name`, `sector`, `location`, `email`, `phone`, `avatar`, `created_at`, `updated_at`) VALUES
	(1, 'OCP Group 2', 'Industrie', '12', 'contact@ocpgroup.ma', '+212600000001', NULL, '2026-01-19 19:01:57', '2026-01-22 13:34:30'),
	(2, 'Inwi', 'Télécom', 'Rabat', 'jobs@inwi.ma', '+212600000002', NULL, '2026-01-19 19:01:57', '2026-01-22 12:38:21'),
	(3, 'Capgemini', 'IT Services', 'Casablanca', 'recruit@capgemini.com', '+212600000003', NULL, '2026-01-19 19:01:57', '2026-01-22 12:38:21'),
	(4, 'YouCode', 'Éducation', 'Youssoufia', 'admin@youcode.ma', '+212600000004', NULL, '2026-01-19 19:01:57', '2026-01-22 12:38:21'),
	(5, 'WebHelp', 'Call Center', 'Casablanca', 'hr@webhelp.com', '+212600000005', NULL, '2026-01-19 19:01:57', '2026-01-22 12:38:21'),
	(6, 'Scarlett Black', 'Non duis ducimus in', 'Qui quidem dicta nob', 'rivaxaw@mailinator.com', '+1 (211) 669-8007', 'https://ui-avatars.com/api/?name=Scarlett+Black&background=random&color=fff', '2026-01-21 20:37:37', '2026-01-22 12:38:21'),
	(7, 'Margaret Kinney', 'Rerum eum debitis si', 'Ipsum temporibus al', 'keqekeqi@mailinator.com', '+1 (381) 574-1204', 'https://ui-avatars.com/api/?name=Margaret+Kinney&background=random&color=fff', '2026-01-21 20:38:48', '2026-01-22 12:38:21'),
	(8, 'Matthew Douglas', 'Quaerat lorem laboru', 'In omnis vitae susci', 'guganena@mailinator.com', '+1 (864) 323-3188', 'https://ui-avatars.com/api/?name=Matthew+Douglas&background=random&color=fff', '2026-01-21 20:44:05', '2026-01-22 12:38:21'),
	(9, 'test', 'Quia laboris irure m', 'Facere iste distinct', 'wysoresyk@mailinator.com', '+1 (253) 669-5669', 'https://ui-avatars.com/api/?name=test&background=random&color=fff', '2026-01-21 20:44:27', '2026-01-22 12:38:21'),
	(14, 'Jennifer Gilmore', 'wefw', 'Esse dolorum non eum', 'zygavyn@mailinator.com', '+1 (923) 512-1318', 'https://ui-avatars.com/api/?name=Jennifer+Gilmore&background=random&color=fff', '2026-01-22 15:34:52', '2026-01-22 15:34:52'),
	(15, 'Mollie Vincent', 'Deleniti non ducimus', 'Eum ut doloribus qui', 'zirijozyd@mailinator.com', '+1 (691) 534-4833', 'https://ui-avatars.com/api/?name=Mollie+Vincent&background=random&color=fff', '2026-01-22 16:21:03', '2026-01-22 16:21:03');




-- Listage de la structure de table sekkgcsq_joblink_db. announcements
CREATE TABLE IF NOT EXISTS `announcements` (
  `id` int NOT NULL AUTO_INCREMENT,
  `title` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `contract_type` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `location` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `skills` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `company_id` int NOT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  KEY `fk_announcements_company` (`company_id`) USING BTREE,
  CONSTRAINT `announcements_ibfk_1` FOREIGN KEY (`company_id`) REFERENCES `companies` (`id`) ON DELETE RESTRICT
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

-- Listage des données de la table sekkgcsq_joblink_db.announcements : ~25 rows (environ)
DELETE FROM `announcements`;
INSERT INTO `announcements` (`id`, `title`, `description`, `contract_type`, `location`, `image`, `skills`, `company_id`, `deleted`, `created_at`, `updated_at`) VALUES
	(2, 'Duis inventore et qu', 'Esse quia itaque ni', 'Freelance', 'Odio officia delectu', '/assets/images/ann_696e8e148a95e.png', 'Et reiciendis offici', 1, 0, '2026-01-19 20:03:32', '2026-01-21 12:46:52'),
	(3, 'Natus sunt tenetur o', 'Debitis pariatur Hi', 'CDI', 'Voluptas et exercita', '/assets/images/ann_696e8eb5e80cd.png', 'Quibusdam natus et l', 2, 0, '2026-01-19 20:06:13', NULL),
	(4, 'Elit mollit volupta', 'Porro et tempora sed', 'CDI', 'Dolores aut id autem', '/assets/images/ann_696e8f4eb9d6f.png', 'Est doloribus maiore', 4, 0, '2026-01-19 20:08:46', NULL),
	(5, 'Illum rerum ipsum c', 'Mollitia ullam et te', 'CDI', 'Vitae consectetur do', NULL, 'Necessitatibus cum a', 2, 0, '2026-01-19 20:21:00', NULL),
	(6, 'Illum rerum ipsum c', 'Mollitia ullam et te', 'CDI', 'Vitae consectetur do', NULL, 'Necessitatibus cum a', 2, 0, '2026-01-19 20:21:00', NULL),
	(7, 'Do iure anim autem e', 'Dolores non nihil no', 'CDI', 'Occaecat dolores dol', NULL, 'Eiusmod nostrud laud', 5, 0, '2026-01-19 20:21:26', NULL),
	(8, 'Do iure anim autem e', 'Dolores non nihil no', 'CDI', 'Occaecat dolores dol', NULL, 'Eiusmod nostrud laud', 5, 0, '2026-01-19 20:21:26', NULL),
	(9, 'Exercitationem sequi', 'Labore impedit comm', 'Freelance', 'Necessitatibus deser', NULL, 'Ducimus numquam et', 4, 0, '2026-01-19 20:22:07', '2026-01-21 15:03:10'),
	(10, 'Cumque alias explica', 'Saepe culpa eos nos', 'CDD', 'Nisi nostrum exercit', NULL, 'In qui perferendis v', 2, 0, '2026-01-19 20:22:07', NULL),
	(11, 'Quis', 'Repellendus Est pro', 'CDD', 'Autem dolore et quo', '/assets/images/ann_696f5c093ee70.jpg', 'Est quis et delenit', 4, 1, '2026-01-20 10:42:17', '2026-01-21 21:18:01'),
	(12, 'Quis', 'Repellendus Est pro', 'CDD', 'Autem dolore et quo', '/assets/images/ann_696f5c093ee70.jpg', 'Est quis et delenit', 4, 0, '2026-01-20 10:42:17', '2026-01-21 15:06:21'),
	(13, 'Alias inventore mini', 'Dolor sed libero inc', 'CDD', 'Et accusantium labor', NULL, 'Explicabo Magni tem', 3, 1, '2026-01-20 10:42:33', '2026-01-21 14:30:46'),
	(14, 'Alias inventore mini', 'Dolor sed libero inc', 'CDD', 'Et accusantium labor', NULL, 'Explicabo Magni tem', 3, 0, '2026-01-20 10:42:33', NULL),
	(15, 'no dep', 'Vitae maxime at ad a', 'Freelance', 'Qui enim et sed dolo', '/assets/images/ann_696f94c830108.png', 'Velit minima facilis', 4, 1, '2026-01-20 10:56:21', '2026-01-21 14:25:50'),
	(16, 'Sunnnnnnn', 'Vitae maxime at ad a', 'Freelance', 'Qui enim et sed dolo', '/assets/images/ann_696f5f55c84d2.png', 'Velit minima facilis', 2, 1, '2026-01-20 10:56:21', '2026-01-21 14:22:55'),
	(17, 'Aliquid voluptas dol', 'Assumenda minus assu', 'CDI', 'Porro sequi voluptat', NULL, 'Assumenda amet a ev', 5, 1, '2026-01-20 10:58:27', '2026-01-21 14:20:29'),
	(18, 'Qui voluptatem ut r', 'Corrupti dolorum iu', 'Stage', 'Labore excepteur qui', '/assets/images/ann_696f5fe06db1c.png', 'In aliquip veniam a', 1, 0, '2026-01-20 10:58:40', '2026-01-22 08:11:44'),
	(19, 'test', 'Commodo numquam est', 'CDD', 'Laboris soluta magni', '/assets/images/ann_696f94d656330.png', 'Saepe aperiam qui et', 5, 1, '2026-01-20 11:06:45', '2026-01-21 21:17:56'),
	(20, 'Harum quas ratione e', 'Et repellendus Itaq', 'CDD', 'Consectetur rerum a', '/assets/images/ann_69708aa5554e1.png', 'Laboris quia numquam', 3, 1, '2026-01-21 08:13:25', '2026-01-22 16:11:04'),
	(21, 'Hic sint aut sunt n', 'Harum provident do', 'CDI', 'Tempor impedit aliq', NULL, 'Facere quos nostrum', 3, 1, '2026-01-21 09:00:16', '2026-01-21 14:30:32'),
	(22, 'Sunt expedita ipsa', 'Aut eaque autem veli', 'Stage', 'Deserunt libero omni', NULL, 'Voluptas rerum aute', 1, 1, '2026-01-21 14:05:52', '2026-01-21 16:25:56'),
	(23, 'Officiis vel excepte', 'Laborum aut sapiente', 'Stage', 'Nisi velit molestiae', NULL, 'Consectetur cupidita', 3, 0, '2026-01-21 14:30:53', '2026-01-22 10:44:57'),
	(24, 'Veniam in minima qu', 'Laudantium veniam', 'CDI', 'Vel tempor officia a', NULL, 'Eum maxime maiores m', 3, 1, '2026-01-21 15:03:28', '2026-01-21 15:06:00'),
	(25, 'test', 'Omnis voluptatum bla', 'CDD', 'Sunt quo perferendi', NULL, 'Quia illum itaque l', 5, 1, '2026-01-21 21:18:21', '2026-01-22 10:44:51'),
	(26, 'Consequatur et venia', 'Et consequatur Susc', 'Freelance', 'Quas ullamco dolores', NULL, 'Velit sit itaque o', 7, 0, '2026-01-22 16:20:51', NULL);

-- Listage de la structure de table sekkgcsq_joblink_db. applications
CREATE TABLE IF NOT EXISTS `applications` (
  `id` int NOT NULL AUTO_INCREMENT,
  `student_id` int NOT NULL,
  `announcement_id` int NOT NULL,
  `motivation` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `cv_path` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('pending','accepted','rejected') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT 'pending',
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE KEY `student_id` (`student_id`,`announcement_id`) USING BTREE,
  KEY `announcement_id` (`announcement_id`) USING BTREE,
  CONSTRAINT `applications_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  CONSTRAINT `applications_ibfk_2` FOREIGN KEY (`announcement_id`) REFERENCES `announcements` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

-- Listage des données de la table sekkgcsq_joblink_db.applications : ~0 rows (environ)
DELETE FROM `applications`;


/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
