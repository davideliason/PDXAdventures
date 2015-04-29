###Developers
Kelly de Vries, David Eliason, Kyle Giard-Chase, Brian Kropff, Bojana Skarich

###Date
March 27, 2015

###Description
PDX Adventures aggregates outdoor activities in the Portland area into a searchable, user-friendly format.  

It uses <a href='https://getcomposer.org/'>Composer</a> to install:
<a href="https://phpunit.de/" target="_blank">PHPUnit</a>, <a href="http://silex.sensiolabs.org/" target="_blank">Silex</a>, and <a href="http://twig.sensiolabs.org/" target="_blank">Twig</a>.  It also links to a <a href="http://www.bootstrapcdn.com/" target="_blank">Bootstrap</a> CDN for CSS Styling.


#Setup instructions:#

To view online: point your browser to <a href="http://pdx-adventures.herokuapp.com"> http://pdx-adventures.herokuapp.com</a>

OR

View on your local machine:

1.  PHP must be installed on your machine (consult other sources for tutorials)

2.  In your terminal:
  1.  Make a directory `mkdir <folder name>`<br>
  2.  Change into that directory `cd <folder name>` <br>
  3.  Clone the repository `git clone https://github.com/BabaYaga64/PDXAdventures.git .`<br>
  4. In the top level of the project folder, run `composer install`<br>
  5. Import the database into PostgreSQL. See the Database section to do so.<br>
  6. Change directories into the web folder`cd web`<br>
  7. Start a php server `php -S localhost:8000`
  8. In a web browser window, navigate to `localhost:8000`

##Database
1. Create a new database `CREATE DATABASE pdx_adventure;`<br>
2. Connect to the database `\c pdx_adventure;`<br>
3. Import the database `\i pdx_adventure.sql`<br>
4. If you would like to edit the app and make use of the test database, `CREATE DATABASE pdx_adventure_test WITH TEMPLATE pdx_adventure`<br>
5. NOTE: If the database fails to import (see above), you may manually create it using the following commands:<br>
```sql
CREATE DATABASE pdx_adventure;
 \c pdx_adventure
CREATE TABLE activities (id serial PRIMARY KEY, activity_name int);
CREATE TABLE events (id serial PRIMARY KEY, date_event timestamp, description varchar, event_name varchar, location varchar, user_id int);
CREATE TABLE users (id serial PRIMARY KEY, name varchar, email varchar, phone varchar);
CREATE TABLE activities_events (id serial PRIMARY KEY, activity_id int, event_id int);
CREATE DATABASE pdx_adventure_test WITH TEMPLATE pdx_adventure;
```
##Known bugs
To date, the following need to be updated:<br>
1. The filter will return multiple of the same events if that event has more than one activity lined up with the user's search.
2. The icons on the home page are not all displaying.
3. The top right menu is inconsistently functioning when rendering a mobile layout.

###Copyright (c) 2015 Kyle Giard-Chase Kelly de Vries, David Eliason, Brian Kropff, Bojana Skarich

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
