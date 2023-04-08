/*Looser Games DB*/
CREATE TABLE `sundb`.`looserdata` ( `id` INT NOT NULL AUTO_INCREMENT , `Hplayer` VARCHAR(100) NOT NULL , `Aplayer` VARCHAR(100) NOT NULL , `Hteam` VARCHAR(100) NOT NULL , `Ateam` VARCHAR(100) NOT NULL , `Hscore` INT NOT NULL , `Ascore` INT NOT NULL , `winner` VARCHAR(100) NOT NULL , `looser` VARCHAR(100) NOT NULL , `matchty` VARCHAR(100) NOT NULL , `cost` INT NOT NULL , `playdte` VARCHAR(100) NOT NULL , `playtme` VARCHAR(100) NOT NULL , `matchid` VARCHAR(100) NOT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB;

/*Alter The looser table*/
ALTER TABLE `looserdata` ADD `coup` VARCHAR(100) NOT NULL AFTER `matchty`;

/*Fair Games DB*/
CREATE TABLE `sundb`.`fairdata` ( `id` INT NOT NULL AUTO_INCREMENT , `Hteam` VARCHAR(100) NOT NULL , `Ateam` VARCHAR(100) NOT NULL , `Hscore` INT NOT NULL , `Ascore` INT NOT NULL , `playdte` VARCHAR(100) NOT NULL , `playtme` VARCHAR(100) NOT NULL , `matchid` VARCHAR(100) NOT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB;


/*Gameweek Table*/
CREATE TABLE `sundb`.`gameweek` ( `id` INT NOT NULL AUTO_INCREMENT , `GW` VARCHAR(100) NOT NULL , `start_dte` VARCHAR(100) NOT NULL , `end_dte` VARCHAR(100) NOT NULL , `tlooser` INT NOT NULL , `tfair` INT NOT NULL , `total` INT NOT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB;

/*Indebt Table*/
CREATE TABLE `sundb`.`debts` ( `id` INT NOT NULL AUTO_INCREMENT , `debtor` VARCHAR(100) NOT NULL , `reason` VARCHAR(1000) NOT NULL , `date_of_issue` VARCHAR(100) NOT NULL , `debt_id` VARCHAR(100) NOT NULL , `is_paid` INT NOT NULL DEFAULT '0' , `when_paid` TIMESTAMP on update CURRENT_TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP , PRIMARY KEY (`id`)) ENGINE = InnoDB;


/*Transactions table*/
CREATE TABLE `transactions` ( `id` INT NOT NULL AUTO_INCREMENT , `trName` VARCHAR(100) NOT NULL , `trId` VARCHAR(100) NOT NULL , `credit` INT NOT NULL , `debit` INT NOT NULL , `amount` INT NOT NULL , `pmeth` VARCHAR(100) NOT NULL , `trDesc` VARCHAR(100) NOT NULL , `trDte` TIMESTAMP on update CURRENT_TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP , PRIMARY KEY (`id`)) ENGINE = InnoDB;

/*Users Table*/
CREATE TABLE `users` ( `id` INT NOT NULL AUTO_INCREMENT , `username` VARCHAR(100) NOT NULL , `password` VARCHAR(100) NOT NULL , `phone` INT NOT NULL , `alias` VARCHAR(100) NOT NULL , `favteam` VARCHAR(100) NOT NULL , `uno` INT NOT NULL , `dte_registered` VARCHAR(100) NOT NULL , `last_login` TIMESTAMP on update CURRENT_TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP , `is_logged` INT NOT NULL DEFAULT '0' , `is_deleted` INT NOT NULL DEFAULT '0' , `reg_no` INT NOT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB;

/*Roles Table*/
CREATE TABLE `sundb`.`roles` ( `id` INT NOT NULL AUTO_INCREMENT , `rolename` VARCHAR(100) NOT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB;

/*Admin Table*/
CREATE TABLE `sundb`.`admin` ( `id` INT NOT NULL AUTO_INCREMENT , `userName` VARCHAR(1000) NOT NULL , `userPass` VARCHAR(1000) NOT NULL , `role` INT NOT NULL , `islogged` INT NOT NULL DEFAULT '0' , `lastlogin` TIMESTAMP NOT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB;

/*Foreign Key*/
ALTER TABLE `admin` ADD CONSTRAINT `fk_user_category` FOREIGN KEY (`role`) REFERENCES `roles`(`id`) ON DELETE RESTRICT ON UPDATE CASCADE;

/*coup and timestamp on looser pay table*/
ALTER TABLE `looserdata` ADD `coup` VARCHAR(100) NOT NULL AFTER `matchty`;
ALTER TABLE `looserdata` ADD `tme` TIMESTAMP on update CURRENT_TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP AFTER `matchid`;

/*is_paid  on fair pay table*/
ALTER TABLE `fairdata` ADD `is_paid` INT NOT NULL DEFAULT '0' AFTER `matchid`;
