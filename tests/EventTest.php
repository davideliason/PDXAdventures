<?php

    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */

    require_once "src/Event.php";

    $DB = new PDO('pgsql:host=localhost;dbname=pdxadventure_test');

    class EventTest extends PHPUnit_Framework_TestCase
    {
        protected function tearDown()
        {
            Event::deleteAll();
        }

        //SETTERS
        function test_getId()
        {
            //Arrange
            $id = 1;
            $date = '2015-10-01 12:24:55';
            $description = "26.5 miles of fun";
            $event_name = "Portland Marathon";
            $location = "Downtown Portland";
            $user_id = 2;
            $test_event= new Event ($id, $date, $description, $event_name, $location, $user_id);

            //Act
            $result = $test_event->getId();

            //Assert
            $this->assertEquals(1, $result);

        }

        function test_getDate()
        {
            //Arrange
            $id = 1;
            $date = '2015-10-01 12:24:55';
            $description = "26.5 miles of fun";
            $event_name = "Portland Marathon";
            $location = "Downtown Portland";
            $user_id = 2;
            $test_event = new Event ($id, $date, $description, $event_name, $location, $user_id);

            //Act
            $result = $test_event->getDateEvent();

            //Assert
            $this->assertEquals('2015-10-01 12:24:55', $result);

        }

        function test_getEventName()
        {
            //Arrange
            $id = 1;
            $date = '2015-10-01 12:24:55';
            $description = "26.5 miles of fun";
            $event_name = "Portland Marathon";
            $location = "Downtown Portland";
            $user_id = 2;
            $test_event = new Event ($id, $date, $description, $event_name, $location, $user_id);

            //Act
            $result = $test_event->getEventName();

            //Assert
            $this->assertEquals("Portland Marathon", $result);
        }

        function test_getLocation()
        {
            //Arrange
            $id = 1;
            $date = '2015-10-01 12:24:55';
            $description = "26.5 miles of fun";
            $event_name = "Portland Marathon";
            $location = "Downtown Portland";
            $user_id = 2;
            $test_event = new Event ($id, $date, $description, $event_name, $location, $user_id);

            //Act
            $result = $test_event->getLocation();

            //Assert
            $this->assertEquals("Downtown Portland", $result);

        }

        function test_getUserId()
        {
            //Arrange
            $id = 1;
            $date = '2015-10-01 12:24:55';
            $description = "26.5 miles of fun";
            $event_name = "Portland Marathon";
            $location = "Downtown Portland";
            $user_id = 2;
            $test_event = new Event ($id, $date, $description, $event_name, $location, $user_id);

            //Act
            $result = $test_event->getUserId();

            //Assert
            $this->assertEquals(2, $result);

        }
        //SETTERS
        function test_setId()
        {
            //Arrange
            $id = 1;
            $date = '2015-10-01 12:24:55';
            $description = "26.5 miles of fun";
            $event_name = "Portland Marathon";
            $location = "Downtown Portland";
            $user_id = 2;
            $test_event= new Event ($id, $date, $description, $event_name, $location, $user_id);

            //Act
            $test_event->setId(2);

            //Assert
            $result = $test_event->getId();
            $this->assertEquals(2, $result);

        }

        function test_setDate()
        {
            //Arrange
            $id = 1;
            $date = '2015-10-01 12:24:55';
            $description = "26.5 miles of fun";
            $event_name = "Portland Marathon";
            $location = "Downtown Portland";
            $user_id = 2;
            $test_event = new Event ($id, $date, $description, $event_name, $location, $user_id);

            //Act
            $test_event->setDate('2016-11-01 12:24:55');

            //Assert
            $result = $test_event->getDateEvent();
            $this->assertEquals('2016-11-01 12:24:55', $result);

        }

        function test_setEventName()
        {
            //Arrange
            $id = 1;
            $date = '2015-10-01 12:24:55';
            $description = "26.5 miles of fun";
            $event_name = "Portland Marathon";
            $location = "Downtown Portland";
            $user_id = 2;
            $test_event = new Event ($id, $date, $description, $event_name, $location, $user_id);

            //Act
            $test_event->setEventName("Mt Tabor Soap Box Derby");

            //Assert
            $result = $test_event->getEventName();
            $this->assertEquals("Mt Tabor Soap Box Derby", $result);
        }

        function test_setLocation()
        {
            //Arrange
            $id = 1;
            $date = '2015-10-01 12:24:55';
            $description = "26.5 miles of fun";
            $event_name = "Portland Marathon";
            $location = "Downtown Portland";
            $user_id = 2;
            $test_event = new Event ($id, $date, $description, $event_name, $location, $user_id);

            //Act
            $test_event->setLocation("Hillsboro");

            //Assert
            $result = $test_event->getLocation();
            $this->assertEquals("Hillsboro", $result);

        }

        function test_setUserId()
        {
            //Arrange
            $id = 1;
            $date = '2015-10-01 12:24:55';
            $description = "26.5 miles of fun";
            $event_name = "Portland Marathon";
            $location = "Downtown Portland";
            $user_id = 2;
            $test_event = new Event ($id, $date, $description, $event_name, $location, $user_id);

            //Act
            $test_event->setUserId(3);

            //Assert
            $result = $test_event->getUserId();
            $this->assertEquals(3, $result);

        }

        //DB FUNCTIONS
        function test_save()
        {
            //Arrange
            $id = 1;
            $date = '2015-10-01 12:24:55';
            $description = "26.5 miles of fun";
            $event_name = "Portland Marathon";
            $location = "Downtown Portland";
            $user_id = 2;
            $test_event = new Event ($id, $date, $description, $event_name, $location, $user_id);
            $test_event->save();

            //Act
            $result = Event::getAll();

            //Assert
            $this->assertEquals($test_event, $result[0]);
        }

        function test_getAll()
        {
            //Arrange
            $id = 1;
            $date = '2015-10-01 12:24:55';
            $description = "26.5 miles of fun";
            $event_name = "Portland Marathon";
            $location = "Downtown Portland";
            $user_id = 2;
            $test_event = new Event ($id, $date, $description, $event_name, $location, $user_id);
            $test_event->save();

            $id2 = 2;
            $date2 = '2015-11-01 12:24:55';
            $description2 = "soap box craziness";
            $event_name2 = "Mount Tabor Soap Box Derby";
            $location2 = "Mount Tabor";
            $user_id2 = 2;
            $test_event2 = new Event ($id2, $date2, $description2, $event_name2, $location2, $user_id2);
            $test_event2->save();

            //Act
            $result = Event::getAll();

            //Assert
            $this->assertEquals([$test_event, $test_event2], $result);
        }

        function testdeleteAll()
        {
            //Arrange
            $id = 1;
            $date = '2015-10-01 12:24:55';
            $description = "26.5 miles of fun";
            $event_name = "Portland Marathon";
            $location = "Downtown Portland";
            $user_id = 2;
            $test_event = new Event ($id, $date, $description, $event_name, $location, $user_id);
            $test_event->save();

            $id2 = 2;
            $date2 = '2015-11-01 12:24:55';
            $description2 = "soap box craziness";
            $event_name2 = "Mount Tabor Soap Box Derby";
            $location2 = "Mount Tabor";
            $user_id2 = 2;
            $test_event2 = new Event ($id2, $date2, $description2, $event_name2, $location2, $user_id2);
            $test_event2->save();

            //Act
            Event::deleteAll();

            //Assert
            $result = Event::getAll();
            $this->assertEquals([], $result);
        }

        function testAddActivity()
        {
            //Arrange
            $id = 1;
            $date = '2015-10-01 12:24:55';
            $description = "26.5 miles of fun";
            $event_name = "Portland Marathon";
            $location = "Downtown Portland";
            $user_id = 2;
            $test_event = new Event ($id, $date, $description, $event_name, $location, $user_id);
            $test_event->save();

            $test_activity = new Activity($id, $activity_name);

            //Act

        }


    }//Ends class

?>
