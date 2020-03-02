-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Mar 02, 2020 at 03:00 PM
-- Server version: 5.7.26
-- PHP Version: 7.0.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `91she`
--

-- --------------------------------------------------------

--
-- Table structure for table `ant_action_log`
--

CREATE TABLE `ant_action_log` (
  `id` bigint(10) UNSIGNED NOT NULL COMMENT '主键',
  `uid` mediumint(8) UNSIGNED NOT NULL DEFAULT '0' COMMENT '执行会员id',
  `module` varchar(30) NOT NULL DEFAULT 'admin' COMMENT '模块',
  `action` varchar(50) NOT NULL DEFAULT '' COMMENT '行为',
  `describe` varchar(255) NOT NULL DEFAULT '' COMMENT '描述',
  `url` varchar(255) NOT NULL DEFAULT '' COMMENT '执行的URL',
  `ip` char(30) NOT NULL DEFAULT '' COMMENT '执行行为者ip',
  `status` tinyint(2) NOT NULL DEFAULT '1' COMMENT '状态',
  `update_time` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `create_time` int(10) UNSIGNED NOT NULL DEFAULT '0' COMMENT '执行行为的时间'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='行为日志表' ROW_FORMAT=COMPACT;

-- --------------------------------------------------------

--
-- Table structure for table `ant_admin`
--

CREATE TABLE `ant_admin` (
  `id` bigint(10) UNSIGNED NOT NULL,
  `username` varchar(20) DEFAULT '0',
  `nickname` varchar(40) DEFAULT NULL,
  `password` varchar(32) DEFAULT NULL,
  `create_time` int(10) UNSIGNED NOT NULL COMMENT '创建时间',
  `update_time` int(10) UNSIGNED NOT NULL COMMENT '更新时间'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='管理员信息';

--
-- Dumping data for table `ant_admin`
--

INSERT INTO `ant_admin` (`id`, `username`, `nickname`, `password`, `create_time`, `update_time`) VALUES
(1, 'admin', '超级管理员', 'd10675b1b33de9e383ce03a1c38f310a', 0, 1582871786);


--
-- Table structure for table `ant_fhdomain`
--

CREATE TABLE `ant_fhdomain` (
  `id` bigint(10) NOT NULL COMMENT 'id',
  `tid` mediumint(10) UNSIGNED NOT NULL COMMENT '所属跳转域名',
  `longurl` varchar(255) NOT NULL COMMENT '网址url',
  `title` varchar(32) NOT NULL DEFAULT '',
  `host` varchar(255) DEFAULT NULL COMMENT '主网址[一二多级]',
  `shorturl` varchar(255) NOT NULL COMMENT '短网址',
  `jump_short` varchar(32) NOT NULL COMMENT '跳转后缀',
  `type` tinyint(1) NOT NULL DEFAULT '1' COMMENT '短网址类型:1-新浪-2-百度，3-搜狗，4-微信',
  `visit` int(10) NOT NULL DEFAULT '0' COMMENT '访问次数 暂不记录ua',
  `api` int(1) NOT NULL DEFAULT '0' COMMENT '0 用户中心添加 1为代理',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '域名状态:0-微信已红-1-正常，2-QQ已红，3-全红，4-其他类型拦截',
  `out_time` int(10) UNSIGNED DEFAULT NULL COMMENT '过期时间',
  `create_time` int(10) UNSIGNED NOT NULL COMMENT '创建时间',
  `update_time` int(10) UNSIGNED NOT NULL COMMENT '更新时间'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='防红域名';

--
-- Dumping data for table `ant_fhdomain`
--

-- --------------------------------------------------------

--
-- Table structure for table `ant_lddomain`
--

CREATE TABLE `ant_lddomain` (
  `id` bigint(10) NOT NULL COMMENT 'id',
  `url` varchar(255) NOT NULL COMMENT '落地域名',
  `imp` int(6) NOT NULL DEFAULT '1' COMMENT '权重 越大几率越大',
  `visit` int(10) NOT NULL DEFAULT '0' COMMENT '访问次数 暂不记录ua',
  `fjx` int(2) NOT NULL DEFAULT '0' COMMENT '泛解析',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '域名状态:0-已红-1-正常，2-其他类型拦截',
  `create_time` int(10) UNSIGNED NOT NULL COMMENT '创建时间',
  `update_time` int(10) UNSIGNED NOT NULL COMMENT '更新时间'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='落地域名';

--
-- Dumping data for table `ant_lddomain`
--

-- --------------------------------------------------------

--
-- Table structure for table `ant_msg_notify`
--

CREATE TABLE `ant_msg_notify` (
  `id` int(10) UNSIGNED NOT NULL,
  `pushlog_id` int(10) UNSIGNED NOT NULL,
  `is_status` int(3) UNSIGNED NOT NULL DEFAULT '404',
  `result` varchar(300) NOT NULL DEFAULT '' COMMENT '请求相响应',
  `times` smallint(5) UNSIGNED NOT NULL DEFAULT '0' COMMENT '请求次数',
  `create_time` int(10) UNSIGNED NOT NULL COMMENT '创建时间',
  `update_time` int(10) UNSIGNED NOT NULL COMMENT '更新时间'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='通知服务队列表';

-- --------------------------------------------------------

--
-- Table structure for table `ant_pushlog`
--

CREATE TABLE `ant_pushlog` (
  `id` bigint(10) NOT NULL COMMENT '通知id',
  `uid` mediumint(8) NOT NULL COMMENT '用户id',
  `cid` mediumint(8) NOT NULL COMMENT '通道id',
  `subject` varchar(64) NOT NULL COMMENT '通知标题',
  `body` varchar(256) NOT NULL COMMENT '通知描述信息',
  `openid` varchar(30) NOT NULL COMMENT '通知openid',
  `client_ip` varchar(32) NOT NULL COMMENT '客户端IP',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '通知状态:0-通知失败-1-通知中，2-已通知',
  `create_time` int(10) UNSIGNED NOT NULL COMMENT '创建时间',
  `update_time` int(10) UNSIGNED NOT NULL COMMENT '更新时间'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='通知记录表';

-- --------------------------------------------------------

--
-- Table structure for table `ant_tzdomain`
--

CREATE TABLE `ant_tzdomain` (
  `id` bigint(10) NOT NULL COMMENT 'id',
  `url` varchar(255) NOT NULL COMMENT '跳转域名',
  `imp` int(6) NOT NULL DEFAULT '1' COMMENT '权重 越大几率越大',
  `visit` int(10) NOT NULL DEFAULT '0' COMMENT '访问次数 暂不记录ua',
  `fjx` int(2) NOT NULL DEFAULT '0' COMMENT '泛解析',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '域名状态:0-微信已红-1-正常，2-QQ已红，3-全红，4-其他类型拦截',
  `create_time` int(10) UNSIGNED NOT NULL COMMENT '创建时间',
  `update_time` int(10) UNSIGNED NOT NULL COMMENT '更新时间'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='跳转域名';

--
-- Dumping data for table `ant_tzdomain`
--

-- --------------------------------------------------------

--
-- Table structure for table `ant_user`
--

CREATE TABLE `ant_user` (
  `uid` mediumint(8) NOT NULL COMMENT '用户uid',
  `username` varchar(30) NOT NULL COMMENT '用户微信名称',
  `password` varchar(32) NOT NULL COMMENT '加密密码',
  `phone` varchar(250) DEFAULT NULL COMMENT '手机号',
  `email` varchar(50) DEFAULT NULL COMMENT '商户邮件',
  `money` decimal(16,2) NOT NULL DEFAULT '0.00' COMMENT '账户余额',
  `is_jump` int(2) DEFAULT '1' COMMENT '0 直连 1跳转 2跟随系统',
  `is_email` int(8) NOT NULL DEFAULT '1' COMMENT '邮件通知',
  `is_sms` int(11) NOT NULL DEFAULT '0' COMMENT '短信通知',
  `is_ant` int(11) NOT NULL DEFAULT '0' COMMENT '蚂蚁推送',
  `qq` varchar(250) DEFAULT NULL COMMENT 'QQ',
  `type` int(2) NOT NULL DEFAULT '1' COMMENT '1 免费用户 2高级用户',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '用户状态,0-未激活,1-使用中,2-禁用',
  `out_time` int(10) DEFAULT NULL,
  `create_time` int(10) UNSIGNED NOT NULL COMMENT '创建时间',
  `update_time` int(10) UNSIGNED NOT NULL COMMENT '更新时间'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='用户信息表';

--
-- Dumping data for table `ant_user`
--

-- --------------------------------------------------------

--
-- Table structure for table `ant_user_bill`
--

CREATE TABLE `ant_user_bill` (
  `id` bigint(10) UNSIGNED NOT NULL COMMENT '主键',
  `uid` mediumint(8) UNSIGNED NOT NULL DEFAULT '0' COMMENT '会员id',
  `money` decimal(16,2) NOT NULL DEFAULT '0.00' COMMENT '余额',
  `price` decimal(16,2) NOT NULL DEFAULT '0.00',
  `describe` varchar(255) NOT NULL DEFAULT '' COMMENT '描述',
  `ip` char(30) NOT NULL DEFAULT '' COMMENT '执行行为者ip',
  `type` int(8) NOT NULL DEFAULT '1' COMMENT '1 消费 2充值',
  `status` tinyint(2) NOT NULL DEFAULT '1' COMMENT '状态',
  `update_time` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `create_time` int(10) UNSIGNED NOT NULL DEFAULT '0' COMMENT '执行的时间'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='账目表' ROW_FORMAT=COMPACT;

--
-- Dumping data for table `ant_user_bill`
--

-- --------------------------------------------------------

--
-- Table structure for table `ant_website`
--

CREATE TABLE `ant_website` (
  `id` bigint(10) NOT NULL COMMENT 'id',
  `appid` int(11) DEFAULT NULL,
  `appkey` varchar(32) DEFAULT NULL,
  `secret` varchar(32) DEFAULT NULL,
  `token` varchar(32) NOT NULL DEFAULT '',
  `title` varchar(64) NOT NULL COMMENT '标题',
  `title_second` varchar(32) NOT NULL COMMENT '副标题',
  `keywords` varchar(255) NOT NULL COMMENT 'keywords',
  `description` varchar(255) NOT NULL COMMENT 'description',
  `is_jump` int(2) NOT NULL DEFAULT '0' COMMENT '0 关闭 1开启',
  `is_wxjump` int(2) NOT NULL DEFAULT '0' COMMENT '安卓微信直接跳 0 关闭 1开启',
  `is_qqreport` int(2) NOT NULL DEFAULT '0' COMMENT '0关闭 1开启',
  `is_webjump` int(1) NOT NULL DEFAULT '0' COMMENT '防止腾讯手工举报',
  `is_txprotect` varchar(1) NOT NULL DEFAULT '1' COMMENT '防腾讯检测',
  `jumpurl` varchar(64) NOT NULL DEFAULT '',
  `qq` int(11) DEFAULT NULL,
  `email` varchar(32) DEFAULT NULL,
  `weburl` varchar(255) NOT NULL COMMENT '网址url',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '网站状态:0-关闭-1-正常，2-维护中',
  `create_time` int(10) UNSIGNED NOT NULL COMMENT '创建时间',
  `update_time` int(10) UNSIGNED NOT NULL COMMENT '更新时间'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='网站详情';

--
-- Dumping data for table `ant_website`
--

INSERT INTO `ant_website` (`id`, `appid`, `appkey`, `secret`, `token`, `title`, `title_second`, `keywords`, `description`, `is_jump`, `is_wxjump`, `is_qqreport`, `is_webjump`, `is_txprotect`, `jumpurl`, `qq`, `email`, `weburl`, `status`, `create_time`, `update_time`) VALUES
(1, 100001, 'd93a5def7511da3d0f2d132d9c344e91', 'e10adc3949ba59abbe56e057f20f8831', 'd558a6bfab93f3e31e0ab626c3579589', '蚂蚁防红', '域名防红工具|域名微信状态检测|防红短链接', '蚂蚁防红网,微信防红链接检测,腾讯防红短链接,防红短链接生成,QQ域名防红检测,防红在线生成,域名防红工具,免费防红,腾讯防红', '蚂蚁防红网,微信防红链接检测,腾讯防红短链接,防红短链接生成,QQ域名防红检测,防红在线生成,域名防红工具,免费防红,腾讯防红', 0, 0, 0, 1, '1', 'http://baidu.com', 7019732, '7019732@qq.com', 'https://www.52fh.cn/', 1, 1565684756, 1582869614);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ant_action_log`
--
ALTER TABLE `ant_action_log`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ant_admin`
--
ALTER TABLE `ant_admin`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `ant_api`
--
ALTER TABLE `ant_api`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `api_domain_unique` (`id`,`domain`,`uid`) USING BTREE;

--
-- Indexes for table `ant_channel`
--
ALTER TABLE `ant_channel`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ant_channel_openid`
--
ALTER TABLE `ant_channel_openid`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ant_fhdomain`
--
ALTER TABLE `ant_fhdomain`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ant_lddomain`
--
ALTER TABLE `ant_lddomain`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ant_msg_notify`
--
ALTER TABLE `ant_msg_notify`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pushlog_id` (`pushlog_id`);

--
-- Indexes for table `ant_pushlog`
--
ALTER TABLE `ant_pushlog`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `pushlog_index` (`uid`,`cid`) USING BTREE;

--
-- Indexes for table `ant_tzdomain`
--
ALTER TABLE `ant_tzdomain`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ant_user`
--
ALTER TABLE `ant_user`
  ADD PRIMARY KEY (`uid`),
  ADD UNIQUE KEY `user_name_unique` (`uid`,`username`) USING BTREE;

--
-- Indexes for table `ant_user_bill`
--
ALTER TABLE `ant_user_bill`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ant_website`
--
ALTER TABLE `ant_website`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `ant_action_log`
--
ALTER TABLE `ant_action_log`
  MODIFY `id` bigint(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键', AUTO_INCREMENT=1;

--
-- AUTO_INCREMENT for table `ant_admin`
--
ALTER TABLE `ant_admin`
  MODIFY `id` bigint(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `ant_api`
--
ALTER TABLE `ant_api`
  MODIFY `id` bigint(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

--
-- AUTO_INCREMENT for table `ant_channel`
--
ALTER TABLE `ant_channel`
  MODIFY `id` bigint(10) NOT NULL AUTO_INCREMENT COMMENT '通道ID';

--
-- AUTO_INCREMENT for table `ant_channel_openid`
--
ALTER TABLE `ant_channel_openid`
  MODIFY `id` bigint(10) NOT NULL AUTO_INCREMENT COMMENT '通道ID';

--
-- AUTO_INCREMENT for table `ant_fhdomain`
--
ALTER TABLE `ant_fhdomain`
  MODIFY `id` bigint(10) NOT NULL AUTO_INCREMENT COMMENT 'id', AUTO_INCREMENT=1;

--
-- AUTO_INCREMENT for table `ant_lddomain`
--
ALTER TABLE `ant_lddomain`
  MODIFY `id` bigint(10) NOT NULL AUTO_INCREMENT COMMENT 'id', AUTO_INCREMENT=1;

--
-- AUTO_INCREMENT for table `ant_msg_notify`
--
ALTER TABLE `ant_msg_notify`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ant_pushlog`
--
ALTER TABLE `ant_pushlog`
  MODIFY `id` bigint(10) NOT NULL AUTO_INCREMENT COMMENT '通知id';

--
-- AUTO_INCREMENT for table `ant_tzdomain`
--
ALTER TABLE `ant_tzdomain`
  MODIFY `id` bigint(10) NOT NULL AUTO_INCREMENT COMMENT 'id', AUTO_INCREMENT=1;

--
-- AUTO_INCREMENT for table `ant_user`
--
ALTER TABLE `ant_user`
  MODIFY `uid` mediumint(8) NOT NULL AUTO_INCREMENT COMMENT '用户uid', AUTO_INCREMENT=100001;

--
-- AUTO_INCREMENT for table `ant_user_bill`
--
ALTER TABLE `ant_user_bill`
  MODIFY `id` bigint(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键', AUTO_INCREMENT=1;

--
-- AUTO_INCREMENT for table `ant_website`
--
ALTER TABLE `ant_website`
  MODIFY `id` bigint(10) NOT NULL AUTO_INCREMENT COMMENT 'id', AUTO_INCREMENT=2;
