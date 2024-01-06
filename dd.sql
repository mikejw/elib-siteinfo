



CREATE TABLE setting(
id                      INT(11)                 AUTO_INCREMENT PRIMARY KEY,
name                    VARCHAR(255)            NOT NULL,
value                   VARCHAR(255)            NOT NULL,
vendor_id               INT(11)                 NULL DEFAULT NULL) ENGINE=InnoDB;

