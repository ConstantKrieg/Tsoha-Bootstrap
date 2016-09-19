-- Lisää INSERT INTO lauseet tähän tiedostoon



--Team-taulun testidata

INSERT INTO Team (id, name, wins, championships) VALUES (1,'Mercedes AMG', 48, 4);
INSERT INTO Team (id, name, wins, championships) VALUES (2, 'Ferrari', 197, 17);

--Driver-taulun testidata

INSERT INTO Driver (num, name, wins, championships, team_id) VALUES (1,'Michael Schumacher', 91, 7, 1);
INSERT INTO Driver (num, name, wins, championships, team_id) VALUES (2, 'Rubens Barrichello', 16, 0, 2);

--Track-taulun testidataa

INSERT INTO Track(name) VALUES ('Monza');
INSERT INTO Track(name) VALUES ('Spa-Francochamps');
INSERT INTO Track(name) VALUES ('Monaco');


