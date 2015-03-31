<?php

    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */

    require_once "src/Activity.php";

    //$DB = new PDO('pgsql:host=localhost;dbname=adventure_test');

    class ActivityTest extends PHPUnit_Framework_TestCase
    {
        function test_getActivityName()
        {
            //Arrange
            $id = 1;
            $activity_name = "Running";
            $test_activity = new Activity ($id, $activity_name);

            //Act
            $result = $test_activity->getActivityName();

            //Assert
            $this->assertEquals($activity_name, $result);
        }

        function test_getActivityId()
        {
            //Arrange
            $id = 1;
            $activity_name = "Running";
            $test_activity = new Activity ($id, $activity_name);

            //Act
            $result = $test_activity->getId();

            //Assert
            $this->assertEquals(1, is_numeric($result));
        }

        function test_setActivityName()
        {
            //Arrange
            $id = 1;
            $activity_name = "Running";
            $test_activity = new Activity ($id, $activity_name);

            //Act
            $new_name = "Swiming";
            $test_activity->setActivityName($new_name);
            $result = $test_activity->getActivityName();

            //Assert
            $this->assertEquals($new_name, $result);
        }

        function test_setActivityId()
        {
            //Arrange
            $id = 1;
            $activity_name = "Running";
            $test_activity = new Activity ($id, $activity_name);

            //Act
            $new_id = 2;
            $test_activity->setId($new_id);

            $result = $test_activity->getId();

            //Assert
            $this->assertEquals(2, is_numeric($result));
        }

    }//Ends class

?>
