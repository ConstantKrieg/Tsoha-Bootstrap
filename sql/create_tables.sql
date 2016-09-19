-- Lisää CREATE TABLE lauseet tähän tiedostoon


CREATE TABLE Member(
	id SERIAL PRIMARY KEY,
	name varchar (25) NOT NULL,
	password varchar(25) NOT NULL
);


CREATE TABLE Team(
	id integer PRIMARY KEY,
	name varchar(25) NOT NULL,
	wins integer,
	championships integer
);



CREATE TABLE Driver(
	num integer PRIMARY KEY,
	team_id integer REFERENCES Team(id),
	name varchar(30) NOT NULL,
	wins integer,
	championships integer
);



CREATE TABLE Track(
	id SERIAL PRIMARY KEY,
	name varchar(40) NOT NULL
);


CREATE TABLE Race(
	id SERIAL PRIMARY KEY,
	track_id integer REFERENCES Track(id),
	datum date
);

CREATE TABLE Placement(
	rank integer PRIMARY KEY,
	driver_id integer REFERENCES Driver(num),
	race_id integer REFERENCES Track(id)
);

