###Developers
Kelly de Vries, David Eliason, Kyle Giard-Chase, Brian Kropff, Bojana Skarich
###Date
March 27, 2015

###Description
PDX Adventures aggregates outdoor activities in the Portland area into a searchable, user-friendly format.  

It uses Composer to install:
<a href="https://phpunit.de/" target="_blank">PHPUnit</a>, <a href="http://silex.sensiolabs.org/" target="_blank">Silex</a>, and <a href="http://twig.sensiolabs.org/" target="_blank">Twig</a>.  It also links to a <a href="http://www.bootstrapcdn.com/" target="_blank">Bootstrap</a> CDN for CSS Styling.

To view the app, start your php server in the web folder and then navigate to your root path.


###Copyright (c) 2015 Kyle Giard-Chase

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in
all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
THE SOFTWARE.

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
    b.  CREATE DATABASE pdxadventure;
    c.  \c pdxadventure;
    d.  \i pdxadventure.sql;

3.  In a web browser window, type localhost:8000

4.  Now you should be able to see the PDX Adventures web app.


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
CREATE TABLE events (id serial PRIMARY KEY, date_event timestamp, description varchar, event_name varchar, location varchar, user_id int);
CREATE TABLE users (id serial PRIMARY KEY, name varchar, email varchar, password varchar);
CREATE TABLE activities (id serial PRIMARY KEY, activity_name varchar);
CREATE TABLE activities_events (id serial PRIMARY KEY, activity_id int, event_id int);
INSERT INTO activities (activity_name) VALUES ('epi-coding');
INSERT INTO activities (activity_name) VALUES ('frolocking');
INSERT INTO activities (activity_name) VALUES ('swimming');
INSERT INTO activities (activity_name) VALUES ('outdoors');

CREATE DATABASE pdxadventure_test WITH template pdxadventure;
