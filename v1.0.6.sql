ALTER TABLE `ant_fhdomain` ADD `is_jump` INT(1) NULL DEFAULT '2' COMMENT '0 直连 1跳转 2跟随系统' AFTER `jump_short`;
ALTER TABLE `ant_fhdomain` ADD `ip` VARCHAR(128) NOT NULL DEFAULT '127.0.0.1' AFTER `api`;
ALTER TABLE `ant_website` ADD `is_encode` INT(1) NOT NULL DEFAULT '1' COMMENT '加密方式' AFTER `is_txprotect`;