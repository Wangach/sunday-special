/*Looser Games DB*/
CREATE TABLE `sundb`.`looserdata` ( `id` INT NOT NULL AUTO_INCREMENT , `Hplayer` VARCHAR(100) NOT NULL , `Aplayer` VARCHAR(100) NOT NULL , `Hteam` VARCHAR(100) NOT NULL , `Ateam` VARCHAR(100) NOT NULL , `Hscore` INT NOT NULL , `Ascore` INT NOT NULL , `winner` VARCHAR(100) NOT NULL , `looser` VARCHAR(100) NOT NULL , `matchty` VARCHAR(100) NOT NULL , `cost` INT NOT NULL , `playdte` VARCHAR(100) NOT NULL , `playtme` VARCHAR(100) NOT NULL , `matchid` VARCHAR(100) NOT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB;


/*Fair Games DB*/
CREATE TABLE `sundb`.`fairdata` ( `id` INT NOT NULL AUTO_INCREMENT , `Hteam` VARCHAR(100) NOT NULL , `Ateam` VARCHAR(100) NOT NULL , `Hscore` INT NOT NULL , `Ascore` INT NOT NULL , `playdte` VARCHAR(100) NOT NULL , `playtme` VARCHAR(100) NOT NULL , `matchid` VARCHAR(100) NOT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB;


/*Gameweek Table*/
CREATE TABLE `sundb`.`gameweek` ( `id` INT NOT NULL AUTO_INCREMENT , `GW` VARCHAR(100) NOT NULL , `start_dte` VARCHAR(100) NOT NULL , `end_dte` VARCHAR(100) NOT NULL , `tlooser` INT NOT NULL , `tfair` INT NOT NULL , `total` INT NOT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB;

/*DEbts Table*/
CREATE TABLE `sundb`.`debts` ( `id` INT NOT NULL AUTO_INCREMENT , `debtor` VARCHAR(100) NOT NULL , `reason` VARCHAR(1000) NOT NULL , `date_of_issue` VARCHAR(100) NOT NULL , `debt_id` VARCHAR(100) NOT NULL , `is_paid` INT NOT NULL DEFAULT '0' , `when_paid` TIMESTAMP on update CURRENT_TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP , PRIMARY KEY (`id`)) ENGINE = InnoDB;
