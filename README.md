psql database dump:
pg_dump (dbname) -f (dbname.sql);
(same for test)

psql import:
/i pdxadventure


psql commands:
CREATE DATABASE test;
CREATE TABLE event (id serial PRIMARY KEY, date timestamp, description varchar, event_name varchar, location varchar, user_id int);
CREATE TABLE user (id serial PRIMARY KEY, name varchar, email varchar, password varchar);
CREATE TABLE activities (id serial PRIMARY KEY, activity_name varchar);
CREATE TABLE activities_events (id serial PRIMARY KEY, activity_id int, event_id int);
