psql database dump (In BASH)
pg_dump (dbname) -f (dbname.sql);
(same for test)

Make sure to create a database in psql on your local computer, and then import the database from remote repo.

CREATE DATABASE pdxadventure;

Import remote database:

psql import:
\i pdxadventure.sql;


psql commands:
CREATE DATABASE pdxadventure;
CREATE TABLE event (id serial PRIMARY KEY, date_event timestamp, description varchar, event_name varchar, location varchar, user_id int);
CREATE TABLE user (id serial PRIMARY KEY, name varchar, email varchar, password varchar);
CREATE TABLE activities (id serial PRIMARY KEY, activity_name varchar);
CREATE TABLE activities_events (id serial PRIMARY KEY, activity_id int, event_id int);



CREATE DATABASE pdxadventure_test WITH template pdxadventure;
