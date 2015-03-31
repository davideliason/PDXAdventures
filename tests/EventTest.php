<?php

    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */

    require_once "src/Event.php";

    //$DB = new PDO('pgsql:host=localhost;dbname=adventure_test');

    class EventTest extends PHPUnit_Framework_TestCase
    {

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

        



    }//Ends class

?>
