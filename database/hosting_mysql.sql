-- Import ONCE into a new, empty MySQL database through phpMyAdmin.
-- Equivalent to the migrations and initial seeder, for hosts without Artisan.
-- Task dates are computed in Philippine time (+08:00) when imported.
CREATE TABLE `users` (
 `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
 `username` VARCHAR(50) NOT NULL,
 `full_name` VARCHAR(100) NOT NULL,
 `email` VARCHAR(150) NOT NULL,
 `created_at` TIMESTAMP NULL DEFAULT NULL,
 `updated_at` TIMESTAMP NULL DEFAULT NULL,
 PRIMARY KEY (`id`),
 UNIQUE KEY `users_username_unique` (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `tasks` (
 `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
 `title` VARCHAR(255) NOT NULL,
 `status` VARCHAR(255) NOT NULL DEFAULT 'pending',
 `task_date` DATE NOT NULL,
 `created_at` TIMESTAMP NULL DEFAULT NULL,
 `updated_at` TIMESTAMP NULL DEFAULT NULL,
 PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `users` (`username`,`full_name`,`email`,`created_at`,`updated_at`) VALUES
 ('johnx','John Xavier Tumbokon','student@example.com',NOW(),NOW());

SET @philippine_today = DATE(DATE_ADD(UTC_TIMESTAMP(), INTERVAL 8 HOUR));
INSERT INTO `tasks` (`title`,`status`,`task_date`,`created_at`,`updated_at`) VALUES
 ('Outline the weekly study plan','completed',DATE_ADD(@philippine_today, INTERVAL -2 DAY),NOW(),NOW()),
 ('Review the systems analysis notes','completed',DATE_ADD(@philippine_today, INTERVAL -1 DAY),NOW(),NOW()),
 ('Prepare IT0049 Laravel activity','pending',@philippine_today,NOW(),NOW()),
 ('Check the task database records','in progress',@philippine_today,NOW(),NOW()),
 ('Read the cybersecurity module','pending',@philippine_today,NOW(),NOW()),
 ('Organize group project notes','completed',@philippine_today,NOW(),NOW()),
 ('Submit the weekly reflection','pending',DATE_ADD(@philippine_today, INTERVAL 1 DAY),NOW(),NOW()),
 ('Review upcoming quiz topics','pending',DATE_ADD(@philippine_today, INTERVAL 3 DAY),NOW(),NOW()),
 ('Prepare next week task list','pending',DATE_ADD(@philippine_today, INTERVAL 5 DAY),NOW(),NOW());
