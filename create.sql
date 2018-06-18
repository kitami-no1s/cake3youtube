DROP DATABASE IF EXISTS cake3youtube;
CREATE DATABASE cake3youtube DEFAULT CHARACTER SET utf8;

USE cake3youtube;

DROP TABLE IF EXISTS users;
CREATE TABLE users(
	id int(11) NOT NULL AUTO_INCREMENT,
	email varchar(255) NOT NULL,
	password varchar(255) NOT NULL,
	modified datetime DEFAULT NULL,
	created datetime DEFAULT NULL,
	PRIMARY KEY(id)
);

DROP TABLE IF EXISTS playlists;
CREATE TABLE playlists(
	id int(11) NOT NULL AUTO_INCREMENT,
	title varchar(255) NOT NULL,
	public int(11) NOT NULL, 
	modified datetime DEFAULT NULL,
	created datetime DEFAULT NULL,
	PRIMARY KEY (id)
);

DROP TABLE IF EXISTS playlist_videos;
CREATE TABLE playlist_videos(
	id int(11) NOT NULL AUTO_INCREMENT,
	playlist_id int(11) NOT NULL,
	v_code varchar(255) NOT NULL,
	modified datetime DEFAULT NULL,
	created datetime DEFAULT NULL,
	PRIMARY KEY (id)
);

DROP TABLE IF EXISTS viedos;
CREATE TABLE videos(
	id int(11) NOT NULL AUTO_INCREMENT,
	v_code varchar(255) NOT NULL,
	modified datetime DEFAULT NULL,
	created datetime DEFAULT NULL,
	PRIMARY KEY(id)
);

DROP TABLE IF EXISTS comments;
CREATE TABLE comments(
	id int(11) NOT NULL AUTO_INCREMENT,
	video_id int(11) NOT NULL,
	user_id int(11) NOT NULL,
	body varchar(255) NOT NULL,
	modified datetime DEFAULT NULL,
	created datetime DEFAULT NULL,
	PRIMARY KEY (id)
);