

-- Define schema up front for most user-cases where there are no vendors
-- to allow for vendor_id null values

CREATE TABLE setting(
id                      INT(11)                 AUTO_INCREMENT PRIMARY KEY,
name                    VARCHAR(255)            NOT NULL,
value                   VARCHAR(255)            NOT NULL,
vendor_id               INT(11)                 NULL DEFAULT NULL) ENGINE=InnoDB;

