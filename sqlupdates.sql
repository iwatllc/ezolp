//Add Gateway Column

ALTER TABLE `payment_response` ADD `Gateway` VARCHAR( 50 ) NOT NULL DEFAULT 'NPC' AFTER `PaymentTransactionId` ;
ALTER TABLE `guestform_submissions` ADD `email` VARCHAR( 255 ) NULL AFTER `zip` ;

RENAME TABLE `ezolp`.`robvincentform_submissions` TO `ezolp`.`donationform_submissions` ;

