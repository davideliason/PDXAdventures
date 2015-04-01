<?php

    class User
    {
        private $name;
        private $email;
        private $phone;
        private $id;

        function __construct($name, $email, $phone, $id = null)
        {
            $this->name = $name;
            $this->email = $email;
            $this->phone = $phone;
            $this->id = $id;
        }

        // function getEventId()
        // {
        //     return $this->event_id;
        // }
        //
        // function setEventId($event_id)
        // {
        //     $this->event_id = (string) $event_id;
        // }

        function getName()
        {
            return $this->name;
        }

        function setName($new_name)
        {
            $this->name = (string) $new_name;
        }

        function setEmail($new_email)
        {
            $this->email = (string) $new_email;
        }

        function getEmail()
        {
            return $this->email;
        }

        function setPhone($new_phone)
        {
            $this->phone = (string) $new_phone;
        }

        function getPhone()
        {
            return $this->phone;
        }

        function getId()
        {
            return $this->id;
        }

        function setId($new_id)
        {
            $this->id = $new_id;
        }

        function delete()
        {
            $GLOBALS['DB']->exec("DELETE FROM users WHERE id ={$this->getId()};");
        }


        //$id, $date, $description, $event_name, $location, $user_id

        static function find($search_id)
        {
            $found_user = null;
            $search = User::getAll();
            foreach ($search as $user)
            {
                $user_id = $user->getId();
                if($user_id == $search_id)
                {
                    $found_user = $user;
                }
            }
          return $found_user;
        }

        function save()
        {
            $statement = $GLOBALS['DB']->query("INSERT INTO users (name,email,phone) VALUES ('{$this->getName()}', '{$this->getEmail()}', '{$this->getPhone()}') RETURNING id;");
            $result = $statement->fetch(PDO::FETCH_ASSOC);
            $this->setId($result['id']);
        }

        function update($new_name, $new_email, $new_phone)
        {
            $GLOBALS['DB']->exec("UPDATE users SET (name, email, phone) = ('{$new_name}', '{$new_email}', '{$new_phone}') WHERE id = {$this->getId()};");
            $this->setName($new_name);
            $this->setEmail($new_email);
            $this->setPhone($new_phone);
        }

        static function getAll()
        {
            $query = $GLOBALS['DB']->query("SELECT * FROM users;");

            $returned_users = $query->fetchAll(PDO::FETCH_ASSOC);
            $users = array();
            foreach($returned_users as $user){
                $name = $user['name'];
                $email = $user['email'];
                $phone = $user['phone'];
                $id = $user['id'];
                $new_user = new User($name, $email, $phone, $id);
                array_push($users, $new_user);
            }
            return $users;
        }

        static function deleteAll()
        {
            $GLOBALS['DB']->exec('DELETE FROM users *;');
        }


        function addEvent($event)
        {
            $GLOBALS['DB']->exec("INSERT INTO users (id) VALUES ({$this->getId()});");
        }

        //One to many relationship
        //Grab all events associated with a particular user. Call GetEvents method on User object.
        function getEvents()
        {
            $query = $GLOBALS['DB']->query("SELECT * FROM events WHERE user_id = {$this->getId()};");
            $events = $query->fetchAll(PDO::FETCH_ASSOC);
            $events_array = array();

            foreach($events as $event) {
                $id = $event['id'];
                $date_event = $event['date_event'];
                $description = $event['description'];
                $event_name = $event['event_name'];
                $location = $event['location'];
                $user_id = $event['user_id'];
                $new_event = new Event($date_event, $description, $event_name, $location, $user_id, $id);
                array_push($events_array, $new_event);
            }
            return $events_array;
        }
    }

?>
