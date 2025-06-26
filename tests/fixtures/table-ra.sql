CREATE TABLE phpbb_ra_incubator (
	from_forum_id int(10) NOT NULL,
	to_forum_id int(10) DEFAULT NULL,
	days int(10) NOT NULL DEFAULT 30,
	PRIMARY KEY (from_forum_id)
);
