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
            $result = Activity::getAll();

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
            $result = Activity::getAll();

            //Assert
            $this->assertEquals([$test_activity,$test_activity2], $result);

        }

        function test_update()
        {
            //assemble
            $test_activity = new Activity (1,"running");
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
            $test_activity = new Activity(1, "running");
            $test_activity->save();
            $test_activity->delete();
            //act
            $result = Activity::getAll();
            //assert
            $this->assertEquals([], $result);
        }

        function test_find()
        {
            //assemble
            $test_activity = new Activity(1, "running");
            $test_activity->save();

            $test_activity2 = new Activity(2, "running2");
            $test_activity2->save();
            //act
            $result = Activity::find($test_activity2->getId());
            //assert
            $this->assertEquals($test_activity2, $result);
        }
        function test_addEvent()
        {
            //assemble
            $test_activity = new Activity(1, "swimming");
            $test_activity->save();

            $id = 1;
            $date = '2015-10-01 12:24:55';
            $description = "26.5 miles of fun";
            $event_name = "Portland Marathon";
            $location = "Downtown Portland";
            $user_id = 2;
            $test_event = new Event($id, $date, $description, $event_name, $location, $user_id);
            $test_event->save();
            //act
            $test_activity->addEvent($test_event);
            //assert
            $this->assertEquals($test_activity->getEvent(), ['$test_event']);

        }

        function test_getEvents()
        {
            //arrange
            $id = 1;
            $date = '2015-10-01 12:24:55';
            $description = "26.5 miles of fun";
            $event_name = "Portland Marathon";
            $location = "Downtown Portland";
            $user_id = 2;
            $test_event = new Event ($id, $date, $description, $event_name, $location, $user_id);
            $test_event->save();

            $id2 = 2;
            $date2 = '2015-10-01 12:24:55';
            $description2 = "26.5 miles of fun";
            $event_name2 = "Portland Marathon";
            $location2 = "Downtown Portland";
            $user_id2 = 2;
            $test_event2 = new Event ($id2, $date2, $description2, $event_name2, $location2, $user_id2);
            $test_event2->save();

            $id3 = 3;
            $activity_name2 = "Windsurfing";
            $test_activity2 = new Activity($id3, $activity_name2);
            $test_activity2->save();

            //act
            $test_activity2->addEvents($test_event);
            $test_activity2->addEvents($test_event2);
            //assert
            $this->assertEquals($test_activity2->getEvents(), [$test_event, $test_event2]);

        }


        //
        //
        //     function test_GetUsers()
        // {
        //         //Arrange
        //         $id = 3;
        //         $date = '2015-10-01 12:24:55';
        //         $description = "26.5 miles of fun";
        //         $event_name = "Portland Marathon";
        //         $location = "Downtown Portland";
        //         $user_id = 4;
        //         $test_event = new Event ($id, $date, $description, $event_name, $location, $user_id);
        //         $test_event->save();
        //
        //         $name = 'Tom';
        //         $email = 'tom@aol.com';
        //         $phone = '123';
        //         $id = 1;
        //         $test_user = new User($name, $email, $phone, $id);
        //         $test_user->save();
        //
        //         $name2 = 'Bob';
        //         $email2 = 'bob@aol.com';
        //         $phone2 = '124';
        //         $id2 = 2;
        //         $test_user2 = new User($name2, $email2, $phone2, $id2);
        //         $test_user2->save();
        //
        //         //Act
        //         $test_event->addUser($test_user);
        //         $test_event2->addUser($test_user2);
        //
        //         //Assert
        //         $result = $test_event->getUsers();
        //         $this->assertEquals([$test_user, $test_user2], $result);
        // }



    }//Ends class

?>
