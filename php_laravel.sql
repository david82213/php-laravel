-- phpMyAdmin SQL Dump
-- version 4.2.7.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: 2014-12-02 04:57:56
-- 服务器版本： 5.6.20
-- PHP Version: 5.5.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `php_laravel`
--

-- --------------------------------------------------------

--
-- 表的结构 `forum_categories`
--

CREATE TABLE IF NOT EXISTS `forum_categories` (
`id` int(10) unsigned NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `group_id` int(11) NOT NULL,
  `author_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

--
-- 转存表中的数据 `forum_categories`
--

INSERT INTO `forum_categories` (`id`, `title`, `group_id`, `author_id`, `created_at`, `updated_at`) VALUES
(1, 'Test Category 1', 1, 1, '2014-11-24 20:07:15', '2014-11-24 20:07:15'),
(2, 'Test Category 2', 1, 1, '2014-11-24 20:07:15', '2014-11-24 20:07:15');

-- --------------------------------------------------------

--
-- 表的结构 `forum_comments`
--

CREATE TABLE IF NOT EXISTS `forum_comments` (
`id` int(10) unsigned NOT NULL,
  `body` text COLLATE utf8_unicode_ci NOT NULL,
  `group_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `thread_id` int(11) NOT NULL,
  `author_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- 转存表中的数据 `forum_comments`
--

INSERT INTO `forum_comments` (`id`, `body`, `group_id`, `category_id`, `thread_id`, `author_id`, `created_at`, `updated_at`) VALUES
(1, 'eeeee', 1, 1, 1, 2, '2014-12-02 03:24:00', '2014-12-02 03:24:00');

-- --------------------------------------------------------

--
-- 表的结构 `forum_groups`
--

CREATE TABLE IF NOT EXISTS `forum_groups` (
`id` int(10) unsigned NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `author_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=4 ;

--
-- 转存表中的数据 `forum_groups`
--

INSERT INTO `forum_groups` (`id`, `title`, `author_id`, `created_at`, `updated_at`) VALUES
(1, 'General Discussion', 1, '2014-11-24 20:06:31', '2014-11-24 20:06:31'),
(3, 'test group', 1, '2014-11-24 22:07:47', '2014-11-24 22:07:47');

-- --------------------------------------------------------

--
-- 表的结构 `forum_threads`
--

CREATE TABLE IF NOT EXISTS `forum_threads` (
`id` int(10) unsigned NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `body` text COLLATE utf8_unicode_ci NOT NULL,
  `group_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `author_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- 转存表中的数据 `forum_threads`
--

INSERT INTO `forum_threads` (`id`, `title`, `body`, `group_id`, `category_id`, `author_id`, `created_at`, `updated_at`) VALUES
(1, 'Hello', '1212r1212', 1, 1, 2, '2014-12-02 03:23:55', '2014-12-02 03:23:55');

-- --------------------------------------------------------

--
-- 表的结构 `migrations`
--

CREATE TABLE IF NOT EXISTS `migrations` (
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 转存表中的数据 `migrations`
--

INSERT INTO `migrations` (`migration`, `batch`) VALUES
('2014_11_24_034508_create_users_table', 1),
('2014_11_24_034537_create_forum_groups_table', 1),
('2014_11_24_034555_create_forum_categories_table', 1),
('2014_11_24_034612_create_forum_threads_table', 1),
('2014_11_24_034633_create_forum_comments_table', 1);

-- --------------------------------------------------------

--
-- 表的结构 `users`
--

CREATE TABLE IF NOT EXISTS `users` (
`id` int(10) unsigned NOT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `isAdmin` enum('0','1') COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `remember_token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=7 ;

--
-- 转存表中的数据 `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `isAdmin`, `remember_token`, `created_at`, `updated_at`, `email`) VALUES
(1, 'testuser1', '$2y$10$5nd/Pp2J3utNa/83Yhnu3.xf8GRxG0UUNp9veKzk/iF9bvxc2qXjy', '1', 'GTibYptOpGkkK5RvYdilScTTF0UiggxrHocF2fO8slOfS32ywuYrwSrszlbT', '2014-11-24 19:49:12', '2014-11-24 19:49:21', ''),
(2, 'testtesttest', '$2y$10$NTcN4fxZAwHjULfBdL3vC.HqM3.dY0rMaWUyB5nhv3z5KQfqgWys6', '0', 'MidNFXWcEXCQ48ePTbKDdvIZ4qrAzNUP9MqWgCDZhNfrgYFvn4QS9m65oqYZ', '2014-12-01 12:20:48', '2014-12-02 03:42:52', ''),
(3, 'test123', '$2y$10$RclwH2exCTozn/8jkh9uku.4GeLXbIMzMEtRGGvbU0BH77R2bxpK.', '0', '', '2014-12-02 03:43:15', '2014-12-02 03:43:15', ''),
(4, 'test1234', '$2y$10$2EjH27K62NRy/s2W81OsE.b7KEkjWeuifew9d.B0214tKz.95Xtkq', '0', '', '2014-12-02 03:43:58', '2014-12-02 03:43:58', ''),
(5, 'ffffff', '$2y$10$/1MmxhRYWvsFHvBI/tlWA.gCSwlCRn5p.7FsdC7WbTzzN4FbdrnrK', '0', '', '2014-12-02 03:46:21', '2014-12-02 03:46:21', ''),
(6, 'maxmaxmax', '$2y$10$yi5CfUuTBdWRfYK/zyElUeBog7D2rdjYKGXxiaIHJFYmWXG.2iCOq', '0', '', '2014-12-02 03:56:31', '2014-12-02 03:56:31', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `forum_categories`
--
ALTER TABLE `forum_categories`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `forum_comments`
--
ALTER TABLE `forum_comments`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `forum_groups`
--
ALTER TABLE `forum_groups`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `forum_threads`
--
ALTER TABLE `forum_threads`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
 ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `forum_categories`
--
ALTER TABLE `forum_categories`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `forum_comments`
--
ALTER TABLE `forum_comments`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `forum_groups`
--
ALTER TABLE `forum_groups`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `forum_threads`
--
ALTER TABLE `forum_threads`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
