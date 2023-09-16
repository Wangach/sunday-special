/*Looser pay table*/
CREATE TABLE `outset`.`looserpay_data` ( `id` INT NOT NULL AUTO_INCREMENT , `Hplayer` VARCHAR(100) NOT NULL , `Aplayer` VARCHAR(100) NOT NULL , `Hteam` VARCHAR(100) NOT NULL , `Ateam` VARCHAR(100) NOT NULL , `Hscore` INT NOT NULL , `Ascore` INT NOT NULL , `winner` VARCHAR(100) NOT NULL , `looser` VARCHAR(100) NOT NULL , `matchty` VARCHAR(100) NOT NULL , `coup` VARCHAR(100) NOT NULL , `cost` INT NOT NULL , `matchid` VARCHAR(100) NOT NULL , `tme` TIMESTAMP on update CURRENT_TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP , `match_statud` INT NOT NULL DEFAULT '1' , PRIMARY KEY (`id`)) ENGINE = InnoDB; 

/*Fair pay table*/
CREATE TABLE `outset`.`fairpay_data` ( `id` INT NOT NULL AUTO_INCREMENT , `Hteam` VARCHAR(100) NOT NULL , `Ateam` VARCHAR(100) NOT NULL , `Hscore` INT NOT NULL , `Ascore` INT NOT NULL , `matchid` VARCHAR(100) NOT NULL , `tme` TIMESTAMP on update CURRENT_TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP , `is_paid` INT NOT NULL DEFAULT '0' , `is_active` INT NOT NULL DEFAULT '1' , PRIMARY KEY (`id`)) ENGINE = InnoDB; 

/*Transactions table*/
CREATE TABLE `outset`.`transactions` ( `id` INT NOT NULL AUTO_INCREMENT , `trName` VARCHAR(100) NOT NULL , `trId` VARCHAR(100) NOT NULL , `credit` INT NOT NULL , `debit` INT NOT NULL , `amount` INT NOT NULL , `pmeth` VARCHAR(100) NOT NULL , `trDesc` VARCHAR(100) NOT NULL , `trDte` TIMESTAMP on update CURRENT_TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP , PRIMARY KEY (`id`)) ENGINE = InnoDB;
/*Transactions table edit*/
ALTER TABLE `transactions` ADD `tr_status` INT NOT NULL DEFAULT '1' AFTER `trDte`;

/*Debts Table*/
CREATE TABLE `outset`.`debts` ( `id` INT NOT NULL , `debtor` VARCHAR(100) NOT NULL , `reason` VARCHAR(100) NOT NULL , `date_of_issue` VARCHAR(100) NOT NULL , `debt_id` VARCHAR(100) NOT NULL , `is_paid` INT NOT NULL , `when_paid` TIMESTAMP on update CURRENT_TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ) ENGINE = InnoDB;
/*Debts Table edit*/
ALTER TABLE `debts` ADD `amount` INT NOT NULL AFTER `reason`;
