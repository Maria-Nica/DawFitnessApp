-- ============================================================================
-- FITNESS APP DATABASE STRUCTURE
-- ============================================================================
-- Database: fitnessapp
-- Date: 2026-01-11
-- Description: Complete database structure for Fitness Studio application
--              Normalized to Third Normal Form (3NF)
-- ============================================================================

-- Drop database if exists and create new one
DROP DATABASE IF EXISTS `fitnessapp`;
CREATE DATABASE `fitnessapp` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE `fitnessapp`;

-- ============================================================================
-- TABLE: roles
-- Description: User roles for authorization (admin, user, etc.)
-- ============================================================================
CREATE TABLE `roles` (
  `role_id` INT(11) NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(50) NOT NULL UNIQUE,
  `description` VARCHAR(255) DEFAULT NULL,
  PRIMARY KEY (`role_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Insert default roles
INSERT INTO `roles` (`role_id`, `name`, `description`) VALUES
(1, 'user', 'Regular user with basic access'),
(2, 'admin', 'Administrator with full access');

-- ============================================================================
-- TABLE: users
-- Description: User accounts with authentication information
-- 3NF Compliance: role_name is not stored here, referenced via role_id
-- ============================================================================
CREATE TABLE `users` (
  `user_id` INT(11) NOT NULL AUTO_INCREMENT,
  `role_id` INT(11) NOT NULL DEFAULT 1,
  `name` VARCHAR(100) NOT NULL,
  `email` VARCHAR(150) NOT NULL UNIQUE,
  `password_hash` VARCHAR(255) NOT NULL,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`user_id`),
  KEY `idx_email` (`email`),
  KEY `idx_role_id` (`role_id`),
  CONSTRAINT `fk_users_role` FOREIGN KEY (`role_id`) REFERENCES `roles` (`role_id`) ON DELETE RESTRICT ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Insert sample admin user (password: admin123)
INSERT INTO `users` (`user_id`, `role_id`, `name`, `email`, `password_hash`) VALUES
(1, 2, 'Admin User', 'admin@fitnessapp.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi');

-- ============================================================================
-- TABLE: recipes
-- Description: Healthy recipes for fitness nutrition
-- 3NF Compliance: author_name is not stored, referenced via created_by_user_id
-- ============================================================================
CREATE TABLE `recipes` (
  `recipe_id` INT(11) NOT NULL AUTO_INCREMENT,
  `title` VARCHAR(150) NOT NULL,
  `description` TEXT NOT NULL,
  `steps` TEXT NOT NULL,
  `created_by_user_id` INT(11) NOT NULL,
  `total_calories` INT(11) DEFAULT 0,
  `is_public` TINYINT(1) DEFAULT 1,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`recipe_id`),
  KEY `idx_created_by` (`created_by_user_id`),
  KEY `idx_is_public` (`is_public`),
  CONSTRAINT `fk_recipes_user` FOREIGN KEY (`created_by_user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Insert sample recipes
INSERT INTO `recipes` (`title`, `description`, `steps`, `created_by_user_id`, `total_calories`, `is_public`) VALUES
('Protein Smoothie Bowl', 'Smoothie bowl bogat în proteine, perfect pentru micul dejun post-antrenament.', 
 '1. Amestecă bananele înghețate cu proteina în pudră\n2. Adaugă lapte de migdale\n3. Blendează până devine cremos\n4. Topping: fructe proaspete, granola, semințe chia', 
 1, 350, 1),
('Salată de Pui Grătar', 'Salată proteică cu pui la grătar, perfectă pentru masa de prânz.', 
 '1. Gătește pieptul de pui la grătar\n2. Pregătește salata verde, roșii, castraveți\n3. Adaugă quinoa fiartă\n4. Dresing: ulei de măsline, lămâie, usturoi', 
 1, 420, 1);

-- ============================================================================
-- TABLE: workout_types
-- Description: Types of workouts (cardio, strength, yoga, etc.)
-- 3NF Compliance: Separate table to avoid repeating workout type names
-- ============================================================================
CREATE TABLE `workout_types` (
  `workout_type_id` INT(11) NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(100) NOT NULL UNIQUE,
  `description` VARCHAR(255) DEFAULT NULL,
  PRIMARY KEY (`workout_type_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Insert sample workout types
INSERT INTO `workout_types` (`name`, `description`) VALUES
('Cardio', 'Antrenamente cardiovasculare pentru rezistență'),
('Strength', 'Antrenamente de forță și tonifiere musculară'),
('Yoga', 'Antrenamente de flexibilitate și relaxare'),
('HIIT', 'High Intensity Interval Training'),
('CrossFit', 'Antrenamente funcționale de înaltă intensitate'),
('Pilates', 'Antrenamente pentru core și postura'),
('Boxing', 'Antrenamente de box și kickboxing'),
('Swimming', 'Înot pentru cardio și rezistență');

-- ============================================================================
-- TABLE: workouts
-- Description: Individual workout sessions logged by users
-- 3NF Compliance: user_name and workout_type_name are not stored,
--                 referenced via foreign keys
-- ============================================================================
CREATE TABLE `workouts` (
  `workout_id` INT(11) NOT NULL AUTO_INCREMENT,
  `user_id` INT(11) NOT NULL,
  `workout_type_id` INT(11) NOT NULL,
  `description` VARCHAR(255) DEFAULT NULL,
  `date` DATE NOT NULL,
  `duration_min` INT(11) NOT NULL,
  `intensity` INT(11) DEFAULT NULL CHECK (`intensity` >= 1 AND `intensity` <= 10),
  `calories_burned` INT(11) DEFAULT 0,
  `notes` TEXT DEFAULT NULL,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`workout_id`),
  KEY `idx_user_id` (`user_id`),
  KEY `idx_workout_type_id` (`workout_type_id`),
  KEY `idx_date` (`date`),
  CONSTRAINT `fk_workouts_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_workouts_type` FOREIGN KEY (`workout_type_id`) REFERENCES `workout_types` (`workout_type_id`) ON DELETE RESTRICT ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Insert sample workouts
INSERT INTO `workouts` (`user_id`, `workout_type_id`, `description`, `date`, `duration_min`, `intensity`, `calories_burned`, `notes`) VALUES
(1, 1, 'Alergare în parc, ritm moderat', '2026-01-10', 45, 7, 450, 'Timp excelent, mă simt energic!'),
(1, 2, 'Antrenament piept și triceps', '2026-01-09', 60, 8, 380, 'Progres vizibil la bench press'),
(1, 3, 'Sesiune de yoga pentru recuperare', '2026-01-08', 30, 4, 120, 'Relaxant după săptămâna intensă');

-- ============================================================================
-- END OF DATABASE STRUCTURE
-- ============================================================================
