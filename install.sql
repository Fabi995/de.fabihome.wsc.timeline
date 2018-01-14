DROP TABLE IF EXISTS wcf1_timeline;
CREATE TABLE wcf1_timeline (
	timelineID         INT(10)      NOT NULL AUTO_INCREMENT PRIMARY KEY,
	title              VARCHAR(255) NOT NULL,
	content            MEDIUMTEXT,
	icon VARCHAR(255),
	iconColor VARCHAR(255),
	badgeColor VARCHAR(255),
	date               INT(10)      NOT NULL,
	isHighlight        TINYINT(1)   NOT NULL DEFAULT 0,
	hasEmbeddedObjects TINYINT(1)   NOT NULL DEFAULT 0,
	KEY (date)
);
