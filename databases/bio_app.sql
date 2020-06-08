CREATE TABLE IF NOT EXISTS `device` (
  `device_name` varchar(50) NOT NULL,
  `sn` varchar(50) NOT NULL,
  `vc` varchar(50) NOT NULL,
  `ac` varchar(50) NOT NULL,
  `vkey` varchar(50) NOT NULL
);


CREATE TABLE IF NOT EXISTS `finger` (
  `user_id` int(11) unsigned NOT NULL,
  `finger_id` int(11) unsigned NOT NULL,
  `finger_data` text NOT NULL
);

CREATE TABLE IF NOT EXISTS `log` (
  `log_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `user_name` varchar(50) NOT NULL,
  `data` text NOT NULL COMMENT 'sn+pc time'
);


CREATE TABLE IF NOT EXISTS `user` (
  `user_id` int(11) unsigned NOT NULL,
  `user_name` varchar(50) NOT NULL,
  `department` varchar(100) NOT NULL,
  `level` int(3) unsigned NOT NULL
);


ALTER TABLE `device`
 ADD PRIMARY KEY (`sn`);


ALTER TABLE `finger`
 ADD PRIMARY KEY (`user_id`);


ALTER TABLE `log`
 ADD PRIMARY KEY (`log_time`);


ALTER TABLE `user`
 ADD PRIMARY KEY (`user_id`);

ALTER TABLE `user`
MODIFY `user_id` int(11) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=1;

CREATE TABLE IF NOT EXISTS `users` (
 `id` int(11) NOT NULL AUTO_INCREMENT,
 `username` varchar(100) NOT NULL,
 `department` varchar(100) NOT NULL,
 `fullname` varchar(100) NOT NULL,
 `email` varchar(50) NOT NULL,
 `password` varchar(50) NOT NULL,
 `trn_date` datetime NOT NULL,
 PRIMARY KEY (`id`)
 );