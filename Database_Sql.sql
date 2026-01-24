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



USE `sekkgcsq_joblink_db`;

-- Listage de la structure de table sekkgcsq_joblink_db. announcements
CREATE TABLE IF NOT EXISTS `announcements` (
  `id` int NOT NULL AUTO_INCREMENT,
  `title` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `contract_type` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `location` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `skills` text COLLATE utf8mb4_unicode_ci,
  `company_id` int NOT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_announcements_company` (`company_id`),
  CONSTRAINT `fk_announcements_company` FOREIGN KEY (`company_id`) REFERENCES `companies` (`id`) ON DELETE RESTRICT
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table sekkgcsq_joblink_db.announcements : ~19 rows (environ)
DELETE FROM `announcements`;
INSERT INTO `announcements` (`id`, `title`, `description`, `contract_type`, `location`, `image`, `skills`, `company_id`, `deleted`, `created_at`, `updated_at`) VALUES
	(2, 'Duis inventore et qu', 'Esse quia itaque ni', 'Freelance', 'Odio officia delectu', '/assets/images/ann_696e8e148a95e.png', 'Et reiciendis offici', 1, 1, '2026-01-19 20:03:32', NULL),
	(3, 'Natus sunt tenetur o', 'Debitis pariatur Hi', 'CDI', 'Voluptas et exercita', '/assets/images/ann_696e8eb5e80cd.png', 'Quibusdam natus et l', 2, 0, '2026-01-19 20:06:13', NULL),
	(4, 'Elit mollit volupta', 'Porro et tempora sed', 'CDI', 'Dolores aut id autem', '/assets/images/ann_696e8f4eb9d6f.png', 'Est doloribus maiore', 4, 0, '2026-01-19 20:08:46', NULL),
	(5, 'Illum rerum ipsum c', 'Mollitia ullam et te', 'CDI', 'Vitae consectetur do', NULL, 'Necessitatibus cum a', 2, 0, '2026-01-19 20:21:00', NULL),
	(6, 'Illum rerum ipsum c', 'Mollitia ullam et te', 'CDI', 'Vitae consectetur do', NULL, 'Necessitatibus cum a', 2, 0, '2026-01-19 20:21:00', NULL),
	(7, 'Do iure anim autem e', 'Dolores non nihil no', 'CDI', 'Occaecat dolores dol', NULL, 'Eiusmod nostrud laud', 5, 0, '2026-01-19 20:21:26', NULL),
	(8, 'Do iure anim autem e', 'Dolores non nihil no', 'CDI', 'Occaecat dolores dol', NULL, 'Eiusmod nostrud laud', 5, 0, '2026-01-19 20:21:26', NULL),
	(9, 'Cumque alias explica', 'Saepe culpa eos nos', 'CDD', 'Nisi nostrum exercit', NULL, 'In qui perferendis v', 2, 0, '2026-01-19 20:22:07', NULL),
	(10, 'Cumque alias explica', 'Saepe culpa eos nos', 'CDD', 'Nisi nostrum exercit', NULL, 'In qui perferendis v', 2, 0, '2026-01-19 20:22:07', NULL),
	(11, 'Quis', 'Repellendus Est pro', 'CDD', 'Autem dolore et quo', '/assets/images/ann_696f5c093ee70.jpg', 'Est quis et delenit', 4, 0, '2026-01-20 10:42:17', NULL),
	(12, 'Quis', 'Repellendus Est pro', 'CDD', 'Autem dolore et quo', '/assets/images/ann_696f5c093ee70.jpg', 'Est quis et delenit', 4, 0, '2026-01-20 10:42:17', NULL),
	(13, 'Alias inventore mini', 'Dolor sed libero inc', 'CDD', 'Et accusantium labor', NULL, 'Explicabo Magni tem', 3, 0, '2026-01-20 10:42:33', NULL),
	(14, 'Alias inventore mini', 'Dolor sed libero inc', 'CDD', 'Et accusantium labor', NULL, 'Explicabo Magni tem', 3, 0, '2026-01-20 10:42:33', NULL),
	(15, 'no dep', 'Vitae maxime at ad a', 'Freelance', 'Qui enim et sed dolo', '/assets/images/ann_696f94c830108.png', 'Velit minima facilis', 4, 0, '2026-01-20 10:56:21', NULL),
	(16, 'Sunnnnnnn', 'Vitae maxime at ad a', 'Freelance', 'Qui enim et sed dolo', '/assets/images/ann_696f5f55c84d2.png', 'Velit minima facilis', 2, 0, '2026-01-20 10:56:21', '2026-01-20 14:51:52'),
	(17, 'Aliquid voluptas dol', 'Assumenda minus assu', 'CDI', 'Porro sequi voluptat', NULL, 'Assumenda amet a ev', 5, 0, '2026-01-20 10:58:27', NULL),
	(18, 'Qui voluptatem ut r', 'Corrupti dolorum iu', 'Stage', 'Labore excepteur qui', '/assets/images/ann_696f5fe06db1c.png', 'In aliquip veniam a', 1, 0, '2026-01-20 10:58:40', NULL),
	(19, 'test', 'Commodo numquam est', 'CDD', 'Laboris soluta magni', '/assets/images/ann_696f94d656330.png', 'Saepe aperiam qui et', 5, 1, '2026-01-20 11:06:45', '2026-01-20 22:05:21'),
	(20, 'Harum quas ratione e', 'Et repellendus Itaq', 'CDD', 'Consectetur rerum a', '/assets/images/ann_69708aa5554e1.png', 'Laboris quia numquam', 3, 1, '2026-01-21 08:13:25', '2026-01-21 08:13:45');

-- Listage de la structure de table sekkgcsq_joblink_db. companies
CREATE TABLE IF NOT EXISTS `companies` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sector` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `location` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `avatar` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table sekkgcsq_joblink_db.companies : ~5 rows (environ)
DELETE FROM `companies`;
INSERT INTO `companies` (`id`, `name`, `sector`, `location`, `email`, `phone`, `avatar`, `created_at`) VALUES
	(1, 'OCP Group', 'Industrie', 'Casablanca', 'contact@ocpgroup.ma', '+212600000001', NULL, '2026-01-19 19:01:57'),
	(2, 'Inwi', 'Télécom', 'Rabat', 'jobs@inwi.ma', '+212600000002', NULL, '2026-01-19 19:01:57'),
	(3, 'Capgemini', 'IT Services', 'Casablanca', 'recruit@capgemini.com', '+212600000003', NULL, '2026-01-19 19:01:57'),
	(4, 'YouCode', 'Éducation', 'Youssoufia', 'admin@youcode.ma', '+212600000004', NULL, '2026-01-19 19:01:57'),
	(5, 'WebHelp', 'Call Center', 'Casablanca', 'hr@webhelp.com', '+212600000005', NULL, '2026-01-19 19:01:57');

-- Listage de la structure de table sekkgcsq_joblink_db. students
CREATE TABLE IF NOT EXISTS `students` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `promotion` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `specialization` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_students_user` (`user_id`),
  CONSTRAINT `fk_students_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table sekkgcsq_joblink_db.students : ~0 rows (environ)
DELETE FROM `students`;

-- Listage de la structure de table sekkgcsq_joblink_db. users
CREATE TABLE IF NOT EXISTS `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` enum('admin','apprenant') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table sekkgcsq_joblink_db.users : ~4 rows (environ)
DELETE FROM `users`;
INSERT INTO `users` (`id`, `name`, `email`, `password`, `role`, `created_at`) VALUES
	(1, 'Admin YouCode', 'admin@youcode.ma', '$2y$10$F15HBGdtJGnsS02Dt8Jt2..GBhbHHrZcQ0bDbc6ATV/EOW8jtT8TW', 'admin', '2026-01-19 11:37:45'),
	(2, 'Student Test', 'student@youcode.ma', '$2y$10$EABxtPUJxqHwhU5KU9of4um7vowhRoGFut5LeuguW9YM/wnYKbBDq', 'apprenant', '2026-01-19 11:40:25'),
	(3, 'Student Test', 'student@test.com', '$2y$10$6o6wLUeH046fLgWI.wMVMufe.uiiukfOefRPytvQitglWML8lsp/e', 'apprenant', '2026-01-19 16:59:13'),
	(4, 'Ciaran Avery', 'bukyde@mailinator.com', '$2y$10$fWtbOLQ7UjCkiMBdw.TmcOTMTb6T6UW7xcXYBmJNe5T/Z7ba4J1pK', 'apprenant', '2026-01-19 17:27:49'),
	(5, 'Mari Weaver', 'jibe@mailinator.com', '$2y$10$p08nUq2ti0mFVcv701njZeZjC4HrNg.LZ/SOM3KDSOoJ4OLrBftX.', 'apprenant', '2026-01-19 17:49:53');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
