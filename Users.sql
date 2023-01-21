-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Хост: sql303.byetcluster.com
-- Время создания: Дек 21 2022 г., 12:30
-- Версия сервера: 10.3.27-MariaDB
-- Версия PHP: 7.2.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `b11_32810043_users`
--

-- --------------------------------------------------------

--
-- Структура таблицы `Users`
--

CREATE TABLE `Users` (
  `ID` int(11) NOT NULL COMMENT 'ID, Autogenerate',
  `Name` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `Surname` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `Patronymic` text DEFAULT NULL,
  `Email` text NOT NULL,
  `Phone` text NOT NULL,
  `Password` text NOT NULL,
  `Role` int(11) NOT NULL DEFAULT 1 COMMENT '1-pa, 2-препод, 3-админ',
  `Courses` text DEFAULT NULL,
  `PassOne` text DEFAULT NULL,
  `PassTwo` text DEFAULT NULL,
  `PassThree` text DEFAULT NULL,
  `Verification` tinyint(1) NOT NULL DEFAULT 0,
  `Hashphrase` text DEFAULT NULL COMMENT 'Admin only'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Индексы таблицы `Users`
--
ALTER TABLE `Users`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT для таблицы `Users`
--
ALTER TABLE `Users`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID, Autogenerate', AUTO_INCREMENT=106;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
