-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- ホスト: localhost:3306
-- 生成日時: 2021 年 1 月 17 日 00:22
-- サーバのバージョン： 5.7.30
-- PHP のバージョン: 7.4.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- データベース: `gs_chat_db`
--

-- --------------------------------------------------------

--
-- テーブルの構造 `gs_admin_user_table`
--

CREATE TABLE `gs_admin_user_table` (
  `id` int(12) NOT NULL,
  `name` varchar(64) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `kanri_flag` int(1) NOT NULL DEFAULT '0',
  `life_flag` int(1) NOT NULL DEFAULT '1',
  `indate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- テーブルのデータのダンプ `gs_admin_user_table`
--

INSERT INTO `gs_admin_user_table` (`id`, `name`, `email`, `password`, `kanri_flag`, `life_flag`, `indate`) VALUES
(1, 'koji_izumi', 'abcd@test.com', '$2y$10$BU6k3pXQ0pLQa.xKhB1sbuINMLjQXR36hVKM08WUQtLZN7Z17/662', 1, 1, '2021-01-16 17:18:55'),
(2, 'あいうえお', 'test@test.com', '$2y$10$BUDNEp0SJJOJG1Gb2YLMEeNsj4/i89alDnA9ykwyZO8siq0.9aphW', 0, 0, '2021-01-17 00:17:48');

--
-- ダンプしたテーブルのインデックス
--

--
-- テーブルのインデックス `gs_admin_user_table`
--
ALTER TABLE `gs_admin_user_table`
  ADD PRIMARY KEY (`id`);

--
-- ダンプしたテーブルのAUTO_INCREMENT
--

--
-- テーブルのAUTO_INCREMENT `gs_admin_user_table`
--
ALTER TABLE `gs_admin_user_table`
  MODIFY `id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
