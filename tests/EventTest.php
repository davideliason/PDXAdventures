<?php

    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */

    require_once "src/Event.php";

    //$DB = new PDO('pgsql:host=localhost;dbname=adventure_test');

    class EventTest extends PHPUnit_Framework_TestCase
    {

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
            $result = $test_event->getDate();

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
            $result = $test_event->getDate();
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




    }//Ends class

?>
