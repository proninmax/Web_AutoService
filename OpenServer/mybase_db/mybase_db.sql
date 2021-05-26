-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Май 26 2021 г., 15:47
-- Версия сервера: 10.3.22-MariaDB
-- Версия PHP: 7.1.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `mybase_db`
--

-- --------------------------------------------------------

--
-- Структура таблицы `cars`
--

CREATE TABLE `cars` (
  `ID` int(11) NOT NULL,
  `marka` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `year` int(4) NOT NULL,
  `price` double(10,2) NOT NULL,
  `new` varchar(3) COLLATE utf8mb4_unicode_ci NOT NULL,
  `href_car_imj` varchar(100) CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `cars`
--

INSERT INTO `cars` (`ID`, `marka`, `model`, `year`, `price`, `new`, `href_car_imj`) VALUES
(1, 'Mercedes-Benz', 'G63 AMG', 2018, 14850000.00, '2', '6.jpg'),
(19, 'Ford', 'F150 Shelby DEVOLRO', 2019, 21750000.00, '1', '7.jpg'),
(21, 'Maybach', '62', 2003, 2900000.00, '2', '8.jpg');

-- --------------------------------------------------------

--
-- Структура таблицы `orderscar`
--

CREATE TABLE `orderscar` (
  `ID` int(11) NOT NULL,
  `Car_ID` int(11) NOT NULL,
  `User_ID` int(11) NOT NULL,
  `price` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `orderszap`
--

CREATE TABLE `orderszap` (
  `ID` int(11) NOT NULL,
  `Zap_ID` int(11) NOT NULL,
  `User_ID` int(11) NOT NULL,
  `price` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `surname` varchar(100) NOT NULL,
  `pass` varchar(255) NOT NULL,
  `isAdmin` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `email`, `name`, `surname`, `pass`, `isAdmin`) VALUES
(7, 'maxpronin70@gmail.com', 'Максим', 'Пронин', '92d6aae6aae19abddf7287933f8f75f1', 1),
(9, 'antsiferov.ilya@mail.ru', 'Илья', 'Анциферов', '92d6aae6aae19abddf7287933f8f75f1', 1),
(10, 'neadmin@gmail.com', 'Саня', 'Булавин', '92d6aae6aae19abddf7287933f8f75f1', 0);

-- --------------------------------------------------------

--
-- Структура таблицы `zapchasti`
--

CREATE TABLE `zapchasti` (
  `ID` int(4) NOT NULL,
  `Name` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Proizv` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `For_marca` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `For_model` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `For_in` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pricez` double(10,2) NOT NULL,
  `imjz` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `zapchasti`
--

INSERT INTO `zapchasti` (`ID`, `Name`, `Proizv`, `For_marca`, `For_model`, `For_in`, `pricez`, `imjz`) VALUES
(3, 'Передняя фара', 'POLCAR', 'BMW', 'Z4 E89', '2', 110000.00, '1.jpg'),
(4, 'Задняя фара', 'MAGNETI MARELLI', 'BMW', 'Z4 E89', '2', 90520.00, '2.jpg');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `cars`
--
ALTER TABLE `cars`
  ADD PRIMARY KEY (`ID`);

--
-- Индексы таблицы `orderscar`
--
ALTER TABLE `orderscar`
  ADD PRIMARY KEY (`ID`);

--
-- Индексы таблицы `orderszap`
--
ALTER TABLE `orderszap`
  ADD PRIMARY KEY (`ID`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `zapchasti`
--
ALTER TABLE `zapchasti`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `cars`
--
ALTER TABLE `cars`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT для таблицы `orderscar`
--
ALTER TABLE `orderscar`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT для таблицы `orderszap`
--
ALTER TABLE `orderszap`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT для таблицы `zapchasti`
--
ALTER TABLE `zapchasti`
  MODIFY `ID` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
