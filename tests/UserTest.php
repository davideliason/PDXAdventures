<?php

    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */

    require_once __DIR__.'/../src/User.php';
    require_once __DIR__.'/../src/Event.php';

    $DB = new PDO('pgsql:host=localhost;dbname=pdxadventure_test');

    class UserTest extends PHPUnit_Framework_TestCase
    {
        protected function tearDown()
        {
            User::deleteAll();
            Event::deleteAll();
        }

        function test_getId()
        {
            //arrange
            $name = 'Tom';
            $email = 'tom@aol.com';
            $phone = '123';
            $id = 1;
            $test_user = new User($name, $email, $phone, $id);
            //act
            $result = $test_user->getId();
            //assert
            $this->assertEquals($id, $result);
        }

        function test_setId()
        {
            //arrange
            $name = 'Tom';
            $email = 'tom@aol.com';
            $phone = '123';
            $id = 1;
            $test_user = new User($name, $email, $phone, $id);

            //act
            $test_user->setId(2);
            $result = $test_user->getId();
            //assert
            $this->assertEquals(2,$result);
        }

        function test_setName()
        {
            //arrange
            $name = 'Tom';
            $email = 'tom@aol.com';
            $phone = '123';
            $id = 1;
            $test_user = new User($name, $email, $phone, $id);

            //act
            $test_user->setName('daniel');
            $result = $test_user->getName();

            //assert
            $this->assertEquals('daniel', $result);
        }

        function test_getName()
        {
            //arrange
            $name = 'Tom';
            $email = 'tom@aol.com';
            $phone = '123';
            $id = 1;
            $test_user = new User($name, $email, $phone, $id);

            //act
            $result = $test_user->getName();

            //assert
            $this->assertEquals('Tom', $name);
        }

         function test_find()
        {
            //arrange
            $name = 'Tom';
            $email = 'tom@aol.com';
            $phone = '123';
            $id = 1;
            $test_user = new User($name, $email, $phone, $id);
            $test_user->save();

            $name2 = 'Maggie';
            $email2 = 'maggie@gmail.com';
            $phone2 = 'maggie124';
            $id2 = 2;
            $test_user2 = new User($name2, $email2, $phone2, $id2);
            $test_user2->save();
            //act
            $result = User::find($test_user->getId());
            //assert
            $this->assertEquals($test_user,$result);
        }

        function test_delete()
        {
            //arrange
            $name = 'Tom';
            $email = 'tom@aol.com';
            $phone = '123';
            $id = 1;
            $test_user = new User($name, $email, $phone, $id);
            $test_user->save();

            $name2 = 'Maggie';
            $email2 = 'maggie@gmail.com';
            $phone2 = 'maggie124';
            $id2 = 2;
            $test_user2 = new User($name2, $email2, $phone2, $id2);
            $test_user2->save();

            //act
            $test_user->delete();
            $result = User::getAll();

            //assert
            $this->assertEquals($test_user2, $result[0]);
        }

        function test_update()
        {
            //Arrange
            $name = 'Tom';
            $email = 'tom@aol.com';
            $phone = '123';
            $id = 1;
            $test_user = new User($name, $email, $phone, $id);
            $test_user->save();

            $new_name = 'Kyle';
            $new_email = 'kgiardch@gmail.com';
            $new_phone = 'phone';

            //Act
            $test_user->update($new_name, $new_email, $new_phone);

            //Assert
            $this->assertEquals(['Kyle', 'kgiardch@gmail.com','phone'], [$test_user->getName(), $test_user->getEmail(), $test_user->getPhone()]);

        }

        function test_getEmail()
        {
            $name = 'Tom';
            $email = 'tom@aol.com';
            $phone = '123';
            $id = 1;
            $test_user = new User($name, $email, $phone, $id);

            //act
            $result = $test_user->getEmail();

            //assert
            $this->assertEquals('tom@aol.com', $result);
        }

        function test_setEmail()
        {
            //arrange
            $name = 'Tom';
            $email = 'tom@aol.com';
            $phone = '123';
            $id = 1;
            $test_user = new User($name, $email, $phone, $id);
            //act
            $test_user->setEmail('new_tom@aol.com');
            $result=$test_user->getEmail();
            //assert
            $this->assertEquals('new_tom@aol.com', $result);
        }

        function test_setPhone()
        {
            //arrange
            $name = 'Tom';
            $email = 'tom@aol.com';
            $phone = '123';
            $id = 1;
            $test_user = new User($name, $email, $phone, $id);

            //act
            $test_user->setPhone('234');
            $result = $test_user->getPhone();
            //assert
            $this->assertEquals('234', $result);
        }

        function test_getPhone()
        {
            //Arrange
            $name = 'Tom';
            $email = 'tom@aol.com';
            $phone = '123';
            $id = 1;
            $test_user = new User($name, $email, $phone, $id);

            //Act
            $result = $test_user->getPhone();

            //Assert
            $this->assertEquals('123', $result);
        }


        function test_getEvents()
        {
            //Arrange
            $name = 'Bob';
            $email = 'bobo@aol.com';
            $phone = '123';
            $id = 2;
            $test_user = new User($name, $email, $phone, $id);
            $test_user->save();

            $event_date = "2015-10-01 12:24:55";
            $event_description = "running";
            $event_name = "PDX Marathon";
            $event_location = "pdx";
            $id2 = 3;
            $event_user_id = $test_user->getId();
            $test_event = new Event($id2, $event_date, $event_description, $event_name, $event_location, $event_user_id);
            $test_event->save();

            // $id, $date, $description, $event_name, $location, $user_id
            //Act
            $result = $test_user->getEvents();
            //Assert
            $this->assertEquals([$test_event], $result);
        }


        function test_save()
        {
            //Arrange
            $name = 'Tom';
            $email = 'tom@aol.com';
            $phone = '123';
            $id = 1;
            $test_user = new User($name, $email, $phone, $id);
            //Act
            $test_user->save();
            $result = User::getAll();
            //Assert
            $this->assertEquals($test_user,$result[0]);
        }

        function test_getAll()
        {
            //Arrange
            $name = 'Tom';
            $email = 'tom@aol.com';
            $phone = '123';
            $id = 1;
            $test_user = new User($name, $email, $phone, $id);
            $test_user->save();

            $name2 = 'Maggie';
            $email2 = 'maggie@gmail.com';
            $phone2 = 'maggie124';
            $id2 = 2;
            $test_user2 = new User($name2, $email2, $phone2, $id2);
            $test_user2->save();

            //Act
            $result = User::getAll();
            $this->assertEquals([$test_user, $test_user2], $result);

        }

        function test_deleteAll()
        {
            //arrange
            $name = 'Tom';
            $email = 'tom@aol.com';
            $phone = '123';
            $id = 1;
            $test_user = new User($name, $email, $phone, $id);
            $test_user->save();

            $name2 = 'Maggie';
            $email2 = 'maggie@gmail.com';
            $phone2 = 'maggie124';
            $id2 = 2;
            $test_user2 = new User($name2, $email2, $phone2, $id2);
            $test_user2->save();
            //act
            User::deleteAll();
            //assert
            $result = User::getAll();
            //act
            $this->assertEquals([],$result);
        }
    }

?>
