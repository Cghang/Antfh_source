ALTER TABLE `ant_website` ADD `gg` TEXT NOT NULL COMMENT '广告' AFTER `is_txprotect`;
UPDATE `ant_website` SET `gg` = '<a href=\"http://www.5uyun.com/\" target=\"_blank\"><img src=\"\" style=\"width:85%;\"></a>' WHERE `ant_website`.`id` = 1;
ALTER TABLE `ant_website` ADD `expired_time` INT(11) NOT NULL DEFAULT '30' COMMENT '单位为天数' AFTER `status`;