<?php

    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */

    require_once "src/Activity.php";


    $DB = new PDO('pgsql:host=localhost;dbname=pdxadventure_test');

    class ActivityTest extends PHPUnit_Framework_TestCase
    {
        protected function tearDown()
        {
            Activity::deleteAll();
        }

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

        function test_save()
        {
            //Arrange
            $id = 1;
            $activity_name = "Running";
            $test_activity = new Activity ($id, $activity_name);

            //Act
            $test_activity->save();
            $result =Activity::getAll();

            //Assert
            $this->assertEquals([$test_activity], $result);
        }

        function test_getAll()
        {
            //Arrange
            $id = 1;
            $activity_name = "Running";
            $test_activity = new Activity ($id, $activity_name);
            $test_activity->save();

            $id2 = 2;
            $activity_name2 = "Swimming";
            $test_activity2 = new Activity ($id2, $activity_name2);
            $test_activity2->save();

            //Act
            $result =Activity::getAll();

            //Assert
            $this->assertEquals([$test_activity,$test_activity], $result);

        }

        function test_AddEvent()
        {

        }

        function test_GetEvents()
        {
            
        }



    }//Ends class

?>
