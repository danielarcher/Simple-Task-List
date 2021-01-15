CREATE TABLE `task` (
 `id` int(11) NOT NULL AUTO_INCREMENT,
 `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
 `is_completed` tinyint(1) COLLATE utf8mb4_unicode_ci DEFAULT 0,
 PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;