#Setup instructions:#
1.  PHP must be installed on your machine (consult other sources for tutorials)

2.  In your terminal, type:
    a.  mkdir <folder name>
    b.  cd <folder name>
    c.  git clone https://github.com/BabaYaga64/PDXAdventures.git .
    d.  cd web
    e.  php -S localhost:8000

3.  Open a new tab in terminal and type:
    a.  psql
    b.  CREATE DATABASE shoes;
    c.  \c shoes;
    d.  \i shoes.sql;

3.  In a web browser window, type localhost:8000

4.  Now you should be able to see the Shoe Store.


If the import doesn't work or you want to also view the test database and you need to recreate the database in psql, you can also type in the following commands:

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
