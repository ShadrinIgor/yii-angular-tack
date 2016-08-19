SET FOREIGN_KEY_CHECKS=0;
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- База данных: `yii_test`
--
CREATE DATABASE IF NOT EXISTS `yii_test` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `yii_test`;

-- --------------------------------------------------------

--
-- Структура таблицы `tbl_bad_answers`
--

DROP TABLE IF EXISTS `tbl_bad_answers`;
CREATE TABLE IF NOT EXISTS `tbl_bad_answers` (
  `id` int(15) NOT NULL,
  `word_id` int(15) NOT NULL,
  `answer` int(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


--
-- Структура таблицы `tbl_users`
--

DROP TABLE IF EXISTS `tbl_users`;
CREATE TABLE IF NOT EXISTS `tbl_users` (
  `id` int(15) NOT NULL,
  `name` varchar(150) NOT NULL,
  `count_ball` int(10) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


--
-- Структура таблицы `tbl_words`
--

DROP TABLE IF EXISTS `tbl_words`;
CREATE TABLE IF NOT EXISTS `tbl_words` (
  `id` int(15) NOT NULL,
  `name` varchar(150) NOT NULL,
  `translate` varchar(150) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `tbl_words`
--

INSERT INTO `tbl_words` (`id`, `name`, `translate`) VALUES
(1, 'яблоко', 'apple'),
(2, 'персик', 'pear'),
(3, 'апельсин', 'orange'),
(4, 'виноград', 'grape'),
(5, 'лимон', 'lemon'),
(6, 'ананас', 'pineapple'),
(7, 'арбуз', 'watermelon'),
(8, 'кокос', 'coconut'),
(9, 'банан', 'banana'),
(10, 'помело', 'pomelo'),
(11, 'клубника', 'strawberry'),
(12, 'малина', 'raspberry'),
(13, 'дыня', 'melon'),
(14, 'абрикос', 'apricot'),
(15, 'манго', 'mango'),
(17, 'гранат', 'pomegranate'),
(18, 'вишня', 'cherry');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `tbl_bad_answers`
--
ALTER TABLE `tbl_bad_answers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `word_id_2` (`word_id`,`answer`),
  ADD KEY `word_id` (`word_id`) USING BTREE;

--
-- Индексы таблицы `tbl_users`
--
ALTER TABLE `tbl_users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Индексы таблицы `tbl_words`
--
ALTER TABLE `tbl_words`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `tbl_words`
--
ALTER TABLE `tbl_words`
  MODIFY `id` int(15) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=19;
--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `tbl_bad_answers`
--
ALTER TABLE `tbl_bad_answers`
  ADD CONSTRAINT `tbl_bad_answers_ibfk_1` FOREIGN KEY (`word_id`) REFERENCES `tbl_words` (`id`) ON DELETE CASCADE;
SET FOREIGN_KEY_CHECKS=1;
