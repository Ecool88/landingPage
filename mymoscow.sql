-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1
-- Время создания: Авг 17 2020 г., 14:19
-- Версия сервера: 10.1.35-MariaDB
-- Версия PHP: 7.2.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `mymoscow`
--

-- --------------------------------------------------------

--
-- Структура таблицы `comment`
--

CREATE TABLE `comment` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `article_id` int(11) NOT NULL,
  `message` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `comment`
--

INSERT INTO `comment` (`id`, `name`, `article_id`, `message`) VALUES
(1, 'Евгений', 7, 'good'),
(2, 'Max', 8, 'dood luck'),
(3, 'Евгений11', 5, 'gg'),
(4, 'df', 7, 'fd'),
(5, 'fdfd', 5, 'sdfsdfv'),
(6, 'fdsfsdf', 5, 'sdfcsdcsds'),
(7, 'fdcdsdf', 5, 'cvxvdf'),
(8, 'fsdccvdf', 5, 'vcvdfvd'),
(9, 'bvfbfdvc xvd', 5, 'fvvbbeergvf'),
(10, 'Nicola', 5, 'very bad dislike and unsubscribe\r\n'),
(11, 'Евгений', 5, 'e3r'),
(12, 'df', 5, 'gg'),
(13, 'Эмин', 2, 'Я черт');

-- --------------------------------------------------------

--
-- Структура таблицы `feedback`
--

CREATE TABLE `feedback` (
  `ID` int(11) NOT NULL,
  `FIO` varchar(256) DEFAULT NULL,
  `EMAIL` varchar(256) DEFAULT NULL,
  `PHONE` varchar(16) DEFAULT NULL,
  `MESSAGE` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `feedback`
--

INSERT INTO `feedback` (`ID`, `FIO`, `EMAIL`, `PHONE`, `MESSAGE`) VALUES
(11, 'Евгений Куликов', 'gorbunow_9@mail.ru', '89208781488', 'Хочу на экскурсию'),
(13, 'Максим Кержаков', 'jonik2281488@gmail.com', '+79806554008', 'Хочу триповать!!!'),
(15, 'Роман Кенигсберг', 'jonik2281488@gmail.com', '89208781488', 'Че-то меня потряхивает'),
(17, 'Георгий', 'jonik2281488@gmail.com', '89208781488', 'дууууууууудос атака'),
(18, 'Василий Шелкунов', 'jonik2281488@gmail.com', '89208781488', 'Все гуд ');

-- --------------------------------------------------------

--
-- Структура таблицы `news`
--

CREATE TABLE `news` (
  `id` int(11) NOT NULL,
  `title` varchar(256) DEFAULT NULL,
  `intro` text,
  `autor` varchar(50) DEFAULT NULL,
  `text` text,
  `date` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `news`
--

INSERT INTO `news` (`id`, `title`, `intro`, `autor`, `text`, `date`) VALUES
(1, '111', NULL, 'fw', 'fewrfr', NULL),
(2, 'Это одна из самых первых новостей MyMoscow', NULL, 'Максим Кержаков', 'Мы благодарим всех пользователей нашей тур фирмы за проявленное ку нам доверие с вашей стороны\r\n', NULL),
(3, 'Это вторая новость MyMoscow', NULL, 'Максим Кержаков', 'Вторая статья', NULL),
(4, 'Это третья новость MyMoscow', NULL, 'Максим Кержаков', 'ку ку ку 3 новость за день, даешь 5 статей?', '2020-08-14 14:36:44'),
(5, 'Это 4 новость MyMoscow', NULL, 'admin', 'fgfdg erg trh rth rerew tgyergterg erhg eh eth rhrthe rere hreh', '2020-08-14 14:38:20'),
(6, 'Это 5 новость MyMoscow', NULL, 'admin', 'стальные данные в БД заносятся. ... Чем они различаются?Я пробовал оставить только первую строчку - данные заносятся нормально, со второй - заносятся нормально, но если сначала заносить с первой строчкой, а потом испрвить на вторую, данные которые были занесены с помощью первой строки.', '2020-08-14 14:38:43'),
(7, 'Проверка интро', 'Добавлено интро к статьям', 'Алекс Кил', 'Добавлено интро к статьям\r\nпока что все', '2020-08-15 14:18:50'),
(8, 'Ghjdthr', 'gerfregfverg erguhgu eut wh hergf egj erhhgt ehh fusihf ijfjcj whf nj bfrewwg jn jgrnjg jer erjre jnnjkn ejngrj jerj erj jeng jnejgb ejwbhwnfcvm fmfn wqljquhrwe jjfnfjc hjabrfhwb efn jsnsjdfcb hwhbf jwnj fnvjsncb fwjn fnsjbrwej jwn kjjfjwtgb wjibcjabdf nwejfnw hi', 'gfreger', 'gg', '2020-08-15 14:40:24');

-- --------------------------------------------------------

--
-- Структура таблицы `reviews`
--

CREATE TABLE `reviews` (
  `id` int(11) NOT NULL,
  `name` varchar(50) DEFAULT NULL,
  `message` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `reviews`
--

INSERT INTO `reviews` (`id`, `name`, `message`) VALUES
(1, 'Максим Кержаков', 'Всё топ!'),
(2, 'Евгений', 'qqqq'),
(3, 'Евгений', 'qqqq'),
(4, 'Евгений', 'rfe'),
(5, 'few', '&lt;script&gt;alert(123)&lt;/script&gt;'),
(6, 'Евгений', '<script>alert(123)</script>'),
(7, 'Евгений', '&lt;script&gt;alert(123)&lt;/script&gt;'),
(8, 'fdsfs', 'ff'),
(9, 'fdsfs', 'ff'),
(10, 'fdsfs', 'ff'),
(11, 'fdsfs', 'ff'),
(12, 'serg', 'good'),
(13, 'Валерий', 'ну такое себе');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int(6) NOT NULL,
  `admin` varchar(50) DEFAULT NULL,
  `password` varchar(50) DEFAULT NULL,
  `login` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `admin`, `password`, `login`) VALUES
(1, '1', 'd9b1d7db4cd6e70935368a1efb10e377', 'admin');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`ID`);

--
-- Индексы таблицы `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `comment`
--
ALTER TABLE `comment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT для таблицы `feedback`
--
ALTER TABLE `feedback`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT для таблицы `news`
--
ALTER TABLE `news`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT для таблицы `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
