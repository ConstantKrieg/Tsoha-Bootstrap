-- Lisää CREATE TABLE lauseet tähän tiedostoon


CREATE TABLE Member(
	id SERIAL PRIMARY KEY,
	name varchar (25) NOT NULL,
	password varchar(25) NOT NULL
);


CREATE TABLE Team(
	id SERIAL PRIMARY KEY,
	name varchar(25) NOT NULL,
	wins integer,
	championships integer
);



CREATE TABLE Driver(
	id SERIAL PRIMARY KEY,
        user_id
	num integer ,
	name varchar(30) NOT NULL,
	wins integer,
	championships integer
);



CREATE TABLE Track(
	id SERIAL PRIMARY KEY,
	name varchar(40) NOT NULL
);

CREATE TABLE Driverteam(
	id SERIAL PRIMARY KEY,
	team_id integer REFERENCES Team(id),
	driver_id integer REFERENCES Driver(id)
);



