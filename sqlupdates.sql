//Add Gateway Column

ALTER TABLE `payment_response` ADD `Gateway` VARCHAR( 50 ) NOT NULL DEFAULT 'NPC' AFTER `PaymentTransactionId` ;
ALTER TABLE `guestform_submissions` ADD `email` VARCHAR( 255 ) NULL AFTER `zip` ;

RENAME TABLE `ezolp`.`robvincentform_submissions` TO `ezolp`.`donationform_submissions` ;

//Additional of Transaction Status Table
CREATE TABLE IF NOT EXISTS `transaction_status` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `status` varchar(50) NOT NULL,
  `active` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

INSERT INTO `ezolp`.`transaction_status` (`id`, `status`, `active`) VALUES ('1', 'Approved', '1'), ('2', 'Void', '1'), ('3', 'Refunded', '1');

ALTER TABLE `payment_response` ADD `TransactionStatusId` INT NOT NULL DEFAULT '1' AFTER `Gateway` ;

ALTER TABLE `payment_response` ADD `VoidResponseHTML` TEXT NULL AFTER `ResponseHTML` ;


