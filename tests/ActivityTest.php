<?php

    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */

    require_once "src/Activity.php";
    require_once "src/Event.php";


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

            $activity_name = "Running";
            $test_activity = new Activity ($activity_name);

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
            $test_activity = new Activity ($activity_name, $id);

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
            $test_activity = new Activity ($activity_name, $id);

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
            $test_activity = new Activity ($activity_name, $id);

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
            $test_activity = new Activity ($activity_name, $id);

            //Act
            $test_activity->save();
            $result = Activity::getAll();

            //Assert
            $this->assertEquals([$test_activity], $result);
        }

        function test_getAll()
        {
            //Arrange
            $id = 1;
            $activity_name = "Running";
            $test_activity = new Activity ($activity_name, $id);
            $test_activity->save();

            $id2 = 2;
            $activity_name2 = "Swimming";
            $test_activity2 = new Activity ($activity_name2, $id2);
            $test_activity2->save();

            //Act
            $result = Activity::getAll();

            //Assert
            $this->assertEquals([$test_activity,$test_activity2], $result);

        }

        function test_update()
        {
            //assemble
            $test_activity = new Activity ("running", 1);
            $test_activity->save();
            //act
            $test_activity->update("eating");
            $result = $test_activity->getActivityName();
            //assert
            $this->assertEquals("eating", $result);
        }

        function test_delete()
        {
            //assemble
            $test_activity = new Activity("running", 1);
            $test_activity->save();
            $test_activity->delete();
            //act
            $result = Activity::getAll();
            //assert
            $this->assertEquals([], $result);
        }

        function deleteAll()
        {
            //Arrange
            $id = 1;
            $activity_name = "sleeping";
            $test_activity = new Activity($activity_id, $id);
            $test_activity->save();

            $id2 = 1;
            $activity_name2 = "sleeping";
            $test_activity2 = new Activity($activity_id, $id);
            $test_activity2->save();

            //Act
            Activity::deleteAll();

            //Assert
            $result = Activity::getAll();
            $this->assertEquals([], $result);
        }

        function test_find()
        {
            //assemble
            $test_activity = new Activity("running", 1);
            $test_activity->save();

            $test_activity2 = new Activity("running2", 2);
            $test_activity2->save();
            //act
            $result = Activity::find($test_activity2->getId());
            //assert
            $this->assertEquals($test_activity2, $result);
        }

        function addEvent()
        {
            //Arrange
            $id3 = 3;
            $activity_name2 = "Windsurfing";
            $test_activity2 = new Activity($activity_name2, $id3);
            $test_activity2->save();

            $id = 1;
            $date = '2015-10-01 12:24:55';
            $description = "26.5 miles of fun";
            $event_name = "Portland Marathon";
            $location = "Downtown Portland";
            $user_id = 2;
            $test_event = new Event ($date, $description, $event_name, $location, $user_id, $id);
            $test_event->save();

            //Act
            $test_activity2->addEvent($test_event);
            $result = $test_activity2->getEvents();

            //Act
            $this->assertEquals([$test_event], $result);
        }


        function test_getEvents()
        {
            //arrange
            $id = 3;
            $activity_name = "Windsurfing";
            $test_activity = new Activity($activity_name, $id);
            $test_activity->save();

            $id2 = 1;
            $date = '2015-10-01 12:24:55';
            $description = "26.5 miles of fun";
            $event_name = "Portland Marathon";
            $location = "Downtown Portland";
            $user_id = 2;
            $test_event = new Event ($date, $description, $event_name, $location, $user_id, $id2);
            $test_event->save();

            $id3 = 2;
            $date2 = '2015-10-01 12:24:55';
            $description2 = "26.5 miles of fun";
            $event_name2 = "Portland Marathon";
            $location2 = "Downtown Portland";
            $user_id2 = 2;
            $test_event2 = new Event ($date2, $description2, $event_name2, $location2, $user_id2, $id3);
            $test_event2->save();


            //act
            $test_activity->addEvent($test_event);
            $test_activity->addEvent($test_event2);
            $result = $test_activity->getEvents();
            //assert
            $this->assertEquals([$test_event, $test_event2], $result);

        }
?>
