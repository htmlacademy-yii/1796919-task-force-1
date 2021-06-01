-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Хост: mysql
-- Время создания: Июн 01 2021 г., 18:22
-- Версия сервера: 5.7.34
-- Версия PHP: 7.4.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `test`
--

-- --------------------------------------------------------

--
-- Структура таблицы `category`
--

CREATE TABLE `category` (
                            `id` int(11) NOT NULL,
                            `title` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `city`
--

CREATE TABLE `city` (
                        `id` int(11) NOT NULL,
                        `title` text NOT NULL,
                        `latitude` decimal(10,7) DEFAULT NULL,
                        `longitude` decimal(10,7) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `comment`
--

CREATE TABLE `comment` (
                           `id` int(11) NOT NULL,
                           `task_id` int(11) NOT NULL,
                           `customer_id` int(11) NOT NULL,
                           `worker_id` int(11) NOT NULL,
                           `body` text NOT NULL,
                           `rate` int(1) DEFAULT NULL,
                           `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `favorits`
--

CREATE TABLE `favorits` (
                            `id` int(11) NOT NULL,
                            `master_user_id` int(11) NOT NULL,
                            `slave_user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `file_storage`
--

CREATE TABLE `file_storage` (
                                `id` int(11) NOT NULL,
                                `user_id` int(11) DEFAULT NULL,
                                `task_id` int(11) DEFAULT NULL,
                                `path` varchar(1024) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `message`
--

CREATE TABLE `message` (
                           `id` int(11) NOT NULL,
                           `task_id` int(11) NOT NULL,
                           `user_id` int(11) NOT NULL,
                           `body` text NOT NULL,
                           `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `response`
--

CREATE TABLE `response` (
                            `id` int(11) NOT NULL,
                            `task_id` int(11) NOT NULL,
                            `worker_id` int(11) NOT NULL,
                            `comment` text NOT NULL,
                            `price` int(11) NOT NULL,
                            `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `task`
--

CREATE TABLE `task` (
                        `id` int(11) NOT NULL,
                        `title` text NOT NULL,
                        `description` text NOT NULL,
                        `price` int(11) DEFAULT '0',
                        `category_id` int(11) NOT NULL,
                        `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
                        `finish_at` datetime DEFAULT NULL,
                        `status` enum('new','canceled','working','fail','complete') NOT NULL DEFAULT 'new',
                        `latitude` decimal(10,7) DEFAULT NULL,
                        `longitude` decimal(10,7) DEFAULT NULL,
                        `city_id` int(10) UNSIGNED DEFAULT NULL,
                        `customer_id` int(10) UNSIGNED NOT NULL,
                        `worker_id` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `user`
--

CREATE TABLE `user` (
                        `id` int(10) UNSIGNED NOT NULL,
                        `name` varchar(512) NOT NULL,
                        `email` varchar(256) NOT NULL,
                        `password` varchar(32) NOT NULL,
                        `birthday` datetime DEFAULT NULL,
                        `register_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
                        `city_id` int(10) UNSIGNED DEFAULT NULL,
                        `avatar` varchar(1024) DEFAULT NULL,
                        `about` text,
                        `phone` varchar(128) DEFAULT NULL,
                        `show_profile` tinyint(1) NOT NULL DEFAULT '0',
                        `show_contacts` tinyint(1) NOT NULL DEFAULT '0',
                        `notify` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `user_category`
--

CREATE TABLE `user_category` (
                                 `category_id` int(10) UNSIGNED NOT NULL,
                                 `user_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `category`
--
ALTER TABLE `category`
    ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `city`
--
ALTER TABLE `city`
    ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `comment`
--
ALTER TABLE `comment`
    ADD PRIMARY KEY (`id`),
  ADD KEY `task_id` (`task_id`),
  ADD KEY `customer_id` (`customer_id`),
  ADD KEY `worker_id` (`worker_id`);

--
-- Индексы таблицы `favorits`
--
ALTER TABLE `favorits`
    ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `master_user_id` (`master_user_id`,`slave_user_id`);

--
-- Индексы таблицы `file_storage`
--
ALTER TABLE `file_storage`
    ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_id` (`user_id`),
  ADD UNIQUE KEY `task_id` (`task_id`);

--
-- Индексы таблицы `message`
--
ALTER TABLE `message`
    ADD PRIMARY KEY (`id`),
  ADD KEY `task_id` (`task_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Индексы таблицы `response`
--
ALTER TABLE `response`
    ADD PRIMARY KEY (`id`),
  ADD KEY `task_id` (`task_id`),
  ADD KEY `worker_id` (`worker_id`);

--
-- Индексы таблицы `task`
--
ALTER TABLE `task`
    ADD PRIMARY KEY (`id`),
  ADD KEY `category_id` (`category_id`),
  ADD KEY `city_id` (`city_id`),
  ADD KEY `customer_id` (`customer_id`),
  ADD KEY `worker_id` (`worker_id`);

--
-- Индексы таблицы `user`
--
ALTER TABLE `user`
    ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `show_profile` (`show_profile`),
  ADD KEY `city_id` (`city_id`);

--
-- Индексы таблицы `user_category`
--
ALTER TABLE `user_category`
    ADD PRIMARY KEY (`user_id`,`category_id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `category`
--
ALTER TABLE `category`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `city`
--
ALTER TABLE `city`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `comment`
--
ALTER TABLE `comment`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `favorits`
--
ALTER TABLE `favorits`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `file_storage`
--
ALTER TABLE `file_storage`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `message`
--
ALTER TABLE `message`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `response`
--
ALTER TABLE `response`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `task`
--
ALTER TABLE `task`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `user`
--
ALTER TABLE `user`
    MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
