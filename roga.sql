-- phpMyAdmin SQL Dump
-- version 4.0.10
-- http://www.phpmyadmin.net
--
-- Хост: 127.0.0.1:3306
-- Время создания: Апр 10 2015 г., 00:46
-- Версия сервера: 5.5.38-log
-- Версия PHP: 5.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- База данных: `roga`
--

-- --------------------------------------------------------

--
-- Структура таблицы `books`
--

CREATE TABLE IF NOT EXISTS `books` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(150) NOT NULL,
  `author` varchar(150) NOT NULL,
  `year` int(4) NOT NULL,
  `genre` varchar(30) NOT NULL,
  `price` int(11) NOT NULL,
  `user` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=20 ;

--
-- Дамп данных таблицы `books`
--

INSERT INTO `books` (`id`, `title`, `author`, `year`, `genre`, `price`, `user`) VALUES
(1, 'Виконт де Бражелон или десять лет спустя', 'Александр Дюма', 2014, 'Фантастика', 29, 1),
(18, 'Фотографы. Заглянувшие в будущее', 'Мэриен Уорнер Мэри', 2015, 'Образование', 199, 1),
(19, 'Мальчик и злая медведица', 'Якобсон Александра Николаевна', 2015, 'Детям', 99, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `genres`
--

CREATE TABLE IF NOT EXISTS `genres` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `url` varchar(15) NOT NULL,
  `title` varchar(20) NOT NULL,
  `approved` tinyint(4) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=12 ;

--
-- Дамп данных таблицы `genres`
--

INSERT INTO `genres` (`id`, `url`, `title`, `approved`) VALUES
(1, 'fantasys', 'Фантастика', 1),
(2, 'detective', 'Детективы', 1),
(3, 'adventures', 'Приключения', 1),
(4, 'education', 'Образование', 1),
(5, 'humor', 'Юмор', 1),
(6, 'kids', 'Детям', 1);

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `login` varchar(30) NOT NULL,
  `pass` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `books` int(11) NOT NULL DEFAULT '0',
  `type` varchar(20) NOT NULL DEFAULT 'user',
  `registered` date NOT NULL,
  `enter` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `login`, `pass`, `email`, `books`, `type`, `registered`, `enter`) VALUES
(4, 'Admin', 'c33367701511b4f6020ec61ded352059', 'admin@roga.ru', 0, 'admin', '0000-00-00', '2015-04-10');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
