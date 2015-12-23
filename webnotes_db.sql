-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Хост: 127.0.0.1
-- Время создания: Сен 21 2014 г., 19:24
-- Версия сервера: 5.5.25
-- Версия PHP: 5.3.13

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- База данных: `webnotes_db`
--

-- --------------------------------------------------------

--
-- Структура таблицы `kid7_table`
--

CREATE TABLE IF NOT EXISTS `kid7_table` (
  `table_id` int(11) NOT NULL AUTO_INCREMENT,
  `color` char(7) DEFAULT NULL,
  `text` varchar(200) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `note_status` char(1) DEFAULT NULL,
  `note_password` decimal(4,0) DEFAULT NULL,
  `thumbs` decimal(1,0) DEFAULT NULL,
  PRIMARY KEY (`table_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Дамп данных таблицы `kid7_table`
--

INSERT INTO `kid7_table` (`table_id`, `color`, `text`, `date`, `note_status`, `note_password`, `thumbs`) VALUES
(1, '#fbf6a7', 'Kid here', '2014-09-09', '0', NULL, '5');

-- --------------------------------------------------------

--
-- Структура таблицы `lind_table`
--

CREATE TABLE IF NOT EXISTS `lind_table` (
  `table_id` int(11) NOT NULL AUTO_INCREMENT,
  `color` char(7) DEFAULT NULL,
  `text` varchar(200) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `note_status` char(1) DEFAULT NULL,
  `note_password` decimal(4,0) DEFAULT NULL,
  `thumbs` decimal(1,0) DEFAULT NULL,
  PRIMARY KEY (`table_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Дамп данных таблицы `lind_table`
--

INSERT INTO `lind_table` (`table_id`, `color`, `text`, `date`, `note_status`, `note_password`, `thumbs`) VALUES
(1, '#a0c3ff', 'Lind here', '2014-09-07', '2', '1111', '3'),
(2, '#badbab', 'Lind again', '2014-09-07', '0', '0', '2');

-- --------------------------------------------------------

--
-- Структура таблицы `max7_table`
--

CREATE TABLE IF NOT EXISTS `max7_table` (
  `table_id` int(11) NOT NULL AUTO_INCREMENT,
  `color` char(7) DEFAULT NULL,
  `text` varchar(200) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `note_status` char(1) DEFAULT NULL,
  `note_password` decimal(4,0) DEFAULT NULL,
  `thumbs` decimal(1,0) DEFAULT NULL,
  PRIMARY KEY (`table_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Дамп данных таблицы `max7_table`
--

INSERT INTO `max7_table` (`table_id`, `color`, `text`, `date`, `note_status`, `note_password`, `thumbs`) VALUES
(1, '#fbf6a7', 'Max here', '2014-09-07', '0', NULL, '5');

-- --------------------------------------------------------

--
-- Структура таблицы `max9_table`
--

CREATE TABLE IF NOT EXISTS `max9_table` (
  `table_id` int(11) NOT NULL AUTO_INCREMENT,
  `color` char(7) DEFAULT NULL,
  `text` varchar(200) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `note_status` char(1) DEFAULT NULL,
  `note_password` decimal(4,0) DEFAULT NULL,
  `thumbs` decimal(1,0) DEFAULT NULL,
  PRIMARY KEY (`table_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `max10_table`
--

CREATE TABLE IF NOT EXISTS `max10_table` (
  `table_id` int(11) NOT NULL AUTO_INCREMENT,
  `color` char(7) DEFAULT NULL,
  `text` varchar(200) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `note_status` char(1) DEFAULT NULL,
  `note_password` decimal(4,0) DEFAULT NULL,
  `thumbs` decimal(1,0) DEFAULT NULL,
  PRIMARY KEY (`table_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `max12_table`
--

CREATE TABLE IF NOT EXISTS `max12_table` (
  `table_id` int(11) NOT NULL AUTO_INCREMENT,
  `color` char(7) DEFAULT NULL,
  `text` varchar(200) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `note_status` char(1) DEFAULT NULL,
  `note_password` decimal(4,0) DEFAULT NULL,
  `thumbs` decimal(1,0) DEFAULT NULL,
  PRIMARY KEY (`table_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `max888_table`
--

CREATE TABLE IF NOT EXISTS `max888_table` (
  `table_id` int(11) NOT NULL AUTO_INCREMENT,
  `color` char(7) DEFAULT NULL,
  `text` varchar(200) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `note_status` char(1) DEFAULT NULL,
  `note_password` decimal(4,0) DEFAULT NULL,
  `thumbs` decimal(1,0) DEFAULT NULL,
  PRIMARY KEY (`table_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `sara_table`
--

CREATE TABLE IF NOT EXISTS `sara_table` (
  `table_id` int(11) NOT NULL AUTO_INCREMENT,
  `color` char(7) DEFAULT NULL,
  `text` varchar(200) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `note_status` char(1) DEFAULT NULL,
  `note_password` decimal(4,0) DEFAULT NULL,
  `thumbs` decimal(1,0) DEFAULT NULL,
  PRIMARY KEY (`table_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Дамп данных таблицы `sara_table`
--

INSERT INTO `sara_table` (`table_id`, `color`, `text`, `date`, `note_status`, `note_password`, `thumbs`) VALUES
(2, '#badbab', 'Sarah again', '2014-09-10', '0', NULL, '2'),
(5, '#ffb6c1', 'Sarah', '2014-09-11', '0', '0', '6'),
(6, '#c5a5cf', 'Karina', '2014-09-20', '0', NULL, '4');

-- --------------------------------------------------------

--
-- Структура таблицы `webnotes_user`
--

CREATE TABLE IF NOT EXISTS `webnotes_user` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(32) DEFAULT NULL,
  `first_name` varchar(32) DEFAULT NULL,
  `last_name` varchar(32) DEFAULT NULL,
  `password` varchar(40) DEFAULT NULL,
  `email` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=11 ;

--
-- Дамп данных таблицы `webnotes_user`
--

INSERT INTO `webnotes_user` (`user_id`, `username`, `first_name`, `last_name`, `password`, `email`) VALUES
(1, 'Lind', 'Vadim', 'Kovalenko', '011c945f30ce2cbafc452f39840f025693339c42', 'jad@gmail'),
(2, 'Zero', 'Zigmund', 'Freid', '011c945f30ce2cbafc452f39840f025693339c42', 'zigi@gmail'),
(3, 'Max7', 'Maxvell', 'Rose', '011c945f30ce2cbafc452f39840f025693339c42', 'max@gmail'),
(4, 'Kon7', 'Konnor', 'Jester', '011c945f30ce2cbafc452f39840f025693339c42', 'jestax@gmail'),
(5, 'kid7', 'Kirkland', 'Jefferson', '011c945f30ce2cbafc452f39840f025693339c42', 'jeskkktax@gmail'),
(6, 'Sara', 'Sarah', 'Sarhty', '011c945f30ce2cbafc452f39840f025693339c42', 'sarah@gmail'),
(7, 'Max888', '77', '778', 'b1496bc9b5e1731c341abe41a63738444f77106c', 'sara77h@gmail'),
(8, 'Max9', 'Vadim2', 'Kovalenko', '193125fce1d9f7eafb8d3919c30140990125cdf4', 'sar44ah@gmail'),
(9, 'Max10', 'Vadim', 'Kovalenko', '8cb2237d0679ca88db6464eac60da96345513964', 'sar1414ah@gmail'),
(10, 'Max12', 'Vadim', 'Kovalenko', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'sara7894h@gmail');

-- --------------------------------------------------------

--
-- Структура таблицы `zero_table`
--

CREATE TABLE IF NOT EXISTS `zero_table` (
  `table_id` int(11) NOT NULL AUTO_INCREMENT,
  `color` char(7) DEFAULT NULL,
  `text` varchar(200) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `note_status` char(1) DEFAULT NULL,
  `note_password` decimal(4,0) DEFAULT NULL,
  `thumbs` decimal(1,0) DEFAULT NULL,
  PRIMARY KEY (`table_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Дамп данных таблицы `zero_table`
--

INSERT INTO `zero_table` (`table_id`, `color`, `text`, `date`, `note_status`, `note_password`, `thumbs`) VALUES
(1, '#badbab', 'Hello', '2014-09-07', '0', NULL, '2');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
