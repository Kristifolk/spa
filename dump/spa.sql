-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Хост: db-spa:3306
-- Время создания: Фев 15 2024 г., 12:29
-- Версия сервера: 8.3.0
-- Версия PHP: 8.2.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `spa`
--

-- --------------------------------------------------------

--
-- Структура таблицы `operations`
--

CREATE TABLE `operations` (
  `id` INT(11) PRIMARY KEY AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `type` varchar(255) NOT NULL,
  `amount` float(10,2) DEFAULT NULL,
`description` text,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `operations`
--

INSERT INTO `operations` (`user_id`, `type`, `amount`, `description`, `created_at`) VALUES
(1, 'Приход', 400.00, 'Test income', '2024-02-05 09:15:42'),
(1, 'Расход', 100.00, 'Test expense', '2024-02-05 09:16:42'),
(1, 'Приход', 200.00, 'Test income', '2024-02-05 09:17:42'),
(1, 'Расход', 300.00, 'Test expense', '2024-02-05 09:18:42');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` INT(11) PRIMARY KEY AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `tel` varchar(20) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`name`, `tel`, `email`, `password`) VALUES
('Кристина', '89289999999', 'test@test.com', '$2y$10$QA4C5qS3OmDDtGKOqcZqTuKoLPeT9xVi5rLK1n31rxEMAc6secRpq');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
