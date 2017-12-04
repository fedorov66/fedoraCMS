-- phpMyAdmin SQL Dump
-- version 4.4.15.5
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Dec 04, 2017 at 05:44 PM
-- Server version: 5.5.58-0+deb7u1
-- PHP Version: 5.4.45-0+deb7u11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `_c_m_s_`
--

-- --------------------------------------------------------

--
-- Table structure for table `models`
--

CREATE TABLE IF NOT EXISTS `models` (
  `id` int(11) NOT NULL,
  `name` varchar(255) CHARACTER SET latin1 NOT NULL,
  `data` text CHARACTER SET latin1 NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `models`
--

INSERT INTO `models` (`id`, `name`, `data`) VALUES
(1, 'text_page', '{\n"data": [\n   {\n   "name":"title",\n   "type":"INPUT"\n   },\n   {\n   "name":"content",\n   "type":"TEXT"\n   }\n]\n}');

-- --------------------------------------------------------

--
-- Table structure for table `pages`
--

CREATE TABLE IF NOT EXISTS `pages` (
  `id` mediumint(8) unsigned NOT NULL,
  `tpl_id` mediumint(8) DEFAULT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `model_id` int(11) NOT NULL,
  `data` text COLLATE utf8_unicode_ci
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `pages`
--

INSERT INTO `pages` (`id`, `tpl_id`, `title`, `model_id`, `data`) VALUES
(1, 1, 'Главная страница', 1, '{\r\n"title" : "Главная страница",\r\n"content" : "Проверка проверка"\r\n}'),
(2, 1, 'Вакансии', 1, '{\r\n"title" : "Вакансии",\r\n"content" : "Проверка вакансии проверка"\r\n}'),
(3, 1, 'Программист', 1, '{\n"title" : "Программист",\n"content" : "Вакансия программист"\n}'),
(4, 1, 'Проверка', 1, '{ "title" : "Программист", "content" : "Вакансия программист" }'),
(5, 1, 'Проверка2', 1, '{ "title" : "Программист", "content" : "Вакансия программист" }'),
(6, 1, 'Проверка3', 1, '{ "title" : "Программист", "content" : "Вакансия программист" }'),
(7, 1, 'Проверка4', 1, '{ "title" : "Программист", "content" : "Вакансия программист" }');

-- --------------------------------------------------------

--
-- Table structure for table `sitemap_tree`
--

CREATE TABLE IF NOT EXISTS `sitemap_tree` (
  `page_id` bigint(20) DEFAULT NULL,
  `section_id` bigint(20) NOT NULL,
  `section_left` bigint(20) NOT NULL DEFAULT '0',
  `section_right` bigint(20) NOT NULL DEFAULT '0',
  `section_level` int(11) DEFAULT NULL,
  `section_name` varchar(255) NOT NULL DEFAULT '',
  `section_path_name` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `sitemap_tree`
--

INSERT INTO `sitemap_tree` (`page_id`, `section_id`, `section_left`, `section_right`, `section_level`, `section_name`, `section_path_name`) VALUES
(1, 1, 1, 42, 0, 'ROOT', ''),
(2, 2, 30, 37, 1, 'Товары', 'items'),
(3, 3, 38, 39, 1, 'Вакансии', 'vacancy'),
(4, 4, 31, 34, 2, 'Тарелки', 'plates'),
(5, 5, 40, 41, 1, 'Контакты', 'contacts'),
(6, 6, 35, 36, 2, 'Бухгалтер', 'buhgalter'),
(7, 7, 32, 33, 3, 'азаза', 'azazaza'),
(1, 8, 28, 29, 1, 'Главная', '');

-- --------------------------------------------------------

--
-- Table structure for table `sitemap_tree_seq`
--

CREATE TABLE IF NOT EXISTS `sitemap_tree_seq` (
  `id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `sitemap_tree_seq`
--

INSERT INTO `sitemap_tree_seq` (`id`) VALUES
(12);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `models`
--
ALTER TABLE `models`
  ADD UNIQUE KEY `model_id` (`id`);

--
-- Indexes for table `pages`
--
ALTER TABLE `pages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sitemap_tree`
--
ALTER TABLE `sitemap_tree`
  ADD PRIMARY KEY (`section_id`),
  ADD UNIQUE KEY `section_id` (`section_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `models`
--
ALTER TABLE `models`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `pages`
--
ALTER TABLE `pages`
  MODIFY `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `sitemap_tree`
--
ALTER TABLE `sitemap_tree`
  MODIFY `section_id` bigint(20) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
