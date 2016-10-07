-- Lisää CREATE TABLE lauseet tähän tiedostoon


--CREATE TABLE Member(
	--id SERIAL PRIMARY KEY,
	--name varchar (25) NOT NULL,
	--password varchar(25) NOT NULL
--);


CREATE TABLE Team(
	id SERIAL PRIMARY KEY,
	name varchar(25) NOT NULL UNIQUE,
	wins integer,
	championships integer,
	user_id integer REFERENCES Member(id)
);



CREATE TABLE Driver(
	id SERIAL PRIMARY KEY,
	num integer ,
	name varchar(30) NOT NULL,
	wins integer,
	championships integer,
	team_name varchar REFERENCES Team(name),
	user_id integer REFERENCES Member(id)
);



CREATE TABLE Track(
	id SERIAL PRIMARY KEY,
	name varchar(40) NOT NULL,
	user_id integer REFERENCES Member(id)
);





