/*Looser pay table*/
CREATE TABLE `outset`.`looserpay_data` ( `id` INT NOT NULL AUTO_INCREMENT , `Hplayer` VARCHAR(100) NOT NULL , `Aplayer` VARCHAR(100) NOT NULL , `Hteam` VARCHAR(100) NOT NULL , `Ateam` VARCHAR(100) NOT NULL , `Hscore` INT NOT NULL , `Ascore` INT NOT NULL , `winner` VARCHAR(100) NOT NULL , `looser` VARCHAR(100) NOT NULL , `matchty` VARCHAR(100) NOT NULL , `coup` VARCHAR(100) NOT NULL , `cost` INT NOT NULL , `matchid` VARCHAR(100) NOT NULL , `tme` TIMESTAMP on update CURRENT_TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP , `match_statud` INT NOT NULL DEFAULT '1' , PRIMARY KEY (`id`)) ENGINE = InnoDB; 

/*Fair pay table*/
CREATE TABLE `outset`.`fairpay_data` ( `id` INT NOT NULL AUTO_INCREMENT , `Hteam` VARCHAR(100) NOT NULL , `Ateam` VARCHAR(100) NOT NULL , `Hscore` INT NOT NULL , `Ascore` INT NOT NULL , `matchid` VARCHAR(100) NOT NULL , `tme` TIMESTAMP on update CURRENT_TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP , `is_paid` INT NOT NULL DEFAULT '0' , `is_active` INT NOT NULL DEFAULT '1' , PRIMARY KEY (`id`)) ENGINE = InnoDB; 

/*Transactions table*/
CREATE TABLE `outset`.`transactions` ( `id` INT NOT NULL AUTO_INCREMENT , `trName` VARCHAR(100) NOT NULL , `trId` VARCHAR(100) NOT NULL , `credit` INT NOT NULL , `debit` INT NOT NULL , `amount` INT NOT NULL , `pmeth` VARCHAR(100) NOT NULL , `trDesc` VARCHAR(100) NOT NULL , `trDte` TIMESTAMP on update CURRENT_TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP , PRIMARY KEY (`id`)) ENGINE = InnoDB;
/*Transactions table edit*/
ALTER TABLE `outset`.`transactions` ADD `tr_status` INT NOT NULL DEFAULT '1' AFTER `trDte`;

/*Debts Table*/
CREATE TABLE `outset`.`debts` (`id` INT NOT NULL AUTO_INCREMENT , `debtor` VARCHAR(100) NOT NULL , `reason` VARCHAR(1000) NOT NULL , `amount` INT NOT NULL , `date_of_issue` VARCHAR(100) NOT NULL , `debt_id` VARCHAR(100) NOT NULL , `is_paid` INT NOT NULL DEFAULT '0' , `when_paid` TIMESTAMP on update CURRENT_TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP , PRIMARY KEY (`id`)) ENGINE = InnoDB;


/*Roles table*/
CREATE TABLE `outset`.`roles` ( `id` INT NOT NULL AUTO_INCREMENT , `rolename` VARCHAR(100) NOT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB;

/*Users Table*/
CREATE TABLE `outset`.`users` ( `id` INT NOT NULL AUTO_INCREMENT , `username` VARCHAR(100) NOT NULL , `password` VARCHAR(100) NOT NULL , `phone` INT NOT NULL , `alias` VARCHAR(100) NOT NULL , `fanfav` VARCHAR(100) NOT NULL , `uno` INT NOT NULL , `dte_registered` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP , `last_login` TIMESTAMP on update CURRENT_TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP , `is_logged` INT NOT NULL DEFAULT '0' , `is_deleted` INT NOT NULL DEFAULT '0' , `role` INT NOT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB;
/*Users table mods*/
ALTER TABLE `users` ADD `reg_no` VARCHAR(100) NOT NULL AFTER `uno`; 