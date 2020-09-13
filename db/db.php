<?php

// SQL запросы для создания таблиц:

/* CREATE TABLE `users` (
	`id` INT(255) UNSIGNED NOT NULL AUTO_INCREMENT,
	`first_name` VARCHAR(50) NOT NULL COLLATE 'utf8_general_ci',
	`last_name` VARCHAR(50) NOT NULL COLLATE 'utf8_general_ci',
	`email` VARCHAR(50) NOT NULL COLLATE 'utf8_general_ci',
	`user_type` VARCHAR(50) NOT NULL COLLATE 'utf8_general_ci',
	`password` VARCHAR(50) NOT NULL COLLATE 'utf8_general_ci',
	`created_at` VARCHAR(50) NOT NULL COLLATE 'utf8_general_ci',
	PRIMARY KEY (`id`) USING BTREE
)
COLLATE='utf8_general_ci'
ENGINE=InnoDB
AUTO_INCREMENT=15
; */

/* CREATE TABLE `address` (
	`address_id` INT(255) UNSIGNED NOT NULL AUTO_INCREMENT,
	`user_id` VARCHAR(50) NOT NULL COLLATE 'utf8_general_ci',
	`city` VARCHAR(50) NOT NULL COLLATE 'utf8_general_ci',
	`postcode` VARCHAR(50) NOT NULL COLLATE 'utf8_general_ci',
	`region` VARCHAR(50) NOT NULL COLLATE 'utf8_general_ci',
	`street` VARCHAR(50) NOT NULL COLLATE 'utf8_general_ci',
	PRIMARY KEY (`address_id`) USING BTREE
)
COLLATE='utf8_general_ci'
ENGINE=InnoDB
AUTO_INCREMENT=11
; */

$mysql = new \PDO('mysql:host=localhost;dbname=modern_retail;', 'root', 'root'); // localhost, название БД, логин, пароль
$mysql->exec('SET NAMES UTF8'); // Установка кодировки