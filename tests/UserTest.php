<?php

    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */

    require_once __DIR__.'/../src/User.php';

    // $DB = new PDO('pgsql:host=localhost;dbname=pdxadventure_test');

    class UserTest extends PHPUnit_Framework_TestCase
    {

        function test_getId()
        {
            //arrange
            $name = 'Tom';
            $email = 'tom@aol.com';
            $password = '123';
            $id = 1;
            $test_user = new User($name, $email, $password, $id);
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
            $password = '123';
            $id = 1;
            $test_user = new User($name, $email, $password, $id);

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
            $password = '123';
            $id = 1;
            $test_user = new User($name, $email, $password, $id);

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
            $password = '123';
            $id = 1;
            $test_user = new User($name, $email, $password, $id);

            //act
            $result = $test_user->getName();

            //assert
            $this->assertEquals('Tom', $name);
        }

        function test_getEmail()
        {
            $name = 'Tom';
            $email = 'tom@aol.com';
            $password = '123';
            $id = 1;
            $test_user = new User($name, $email, $password, $id);

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
            $password = '123';
            $id = 1;
            $test_user = new User($name, $email, $password, $id);
            //act
            $test_user->setEmail('new_tom@aol.com');
            $result=$test_user->getEmail();
            //assert
            $this->assertEquals('new_tom@aol.com', $result);
        }

        function test_setPassword()
        {
            //arrange
            $name = 'Tom';
            $email = 'tom@aol.com';
            $password = '123';
            $id = 1;
            $test_user = new User($name, $email, $password, $id);

            //act
            $test_user->setPassword('234');
            $result = $test_user->getPassword();
            //assert
            $this->assertEquals('234', $result);
        }

        function test_getPassword()
        {
            //Arrange
            $name = 'Tom';
            $email = 'tom@aol.com';
            $password = '123';
            $id = 1;
            $test_user = new User($name, $email, $password, $id);

            //Act
            $result = $test_user->getPassword();

            //Assert
            $this->assertEquals('123', $result);
        }

        function test_save()
        {
            //Arrange
            $name = 'Tom';
            $email = 'tom@aol.com';
            $password = '123';
            $id = 1;
            $test_user = new User($name, $email, $password, $id);
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
            $password = '123';
            $id = 1;
            $test_user = new User($name, $email, $password, $id);
            $test_user->save();

            $name2 = 'Maggie';
            $email2 = 'maggie@gmail.com';
            $password2 = 'maggie124';
            $id2 = 2;
            $test_user2 = new User($name2, $email2, $password2, $id2);
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
            $password = '123';
            $id = 1;
            $test_user = new User($name, $email, $password, $id);
            $test_user->save();

            $name2 = 'Maggie';
            $email2 = 'maggie@gmail.com';
            $password2 = 'maggie124';
            $id2 = 2;
            $test_user2 = new User($name2, $email2, $password2, $id2);
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
