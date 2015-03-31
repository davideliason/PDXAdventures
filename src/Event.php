<?php

    class Event
    {
        private $id;
        private $date_event;
        private $description;
        private $event_name;
        private $location;
        private $user_id;

        function __construct($id, $date_event, $description, $event_name, $location, $user_id)
        {
            $this->id = $id;
            $this->date_event = $date_event;
            $this->description = $description;
            $this->event_name = $event_name;
            $this->location = $location;
            $this->user_id = $user_id;
        }


    //GETTERS
        function getId()
        {
            return $this->id;
        }

        function getDateEvent()
        {
            return $this->date_event;
        }

        function getDescription()
        {
            return $this->description;
        }

        function getEventName()
        {
            return $this->event_name;
        }

        function getLocation()
        {
            return $this->location;
        }

        function getUserId()
        {
            return $this->user_id;
        }

        //SETTERS
        function setId($new_id)
        {
            $this->id = (int) $new_id;
        }

        function setDate($new_date)
        {
            $this->date_event = $new_date;
        }

        function setDescription($new_description)
        {
            $this->description = (string) $new_description;
        }

        function setEventName($new_event_name)
        {
            $this->event_name = (string) $new_event_name;
        }

        function setLocation($new_location)
        {
            $this->location = (string) $new_location;
        }

        function setUserId($new_user_id)
        {
                $this->user_id = (int) $new_user_id;
        }

        //DB FUNCTIONS
        function save()
        {
            $statement = $GLOBALS['DB']->query("INSERT INTO events (date_event, description, event_name, location, user_id) VALUES ('{$this->getDateEvent()}', '{$this->getDescription()}', '{$this->getEventName()}', '{$this->getLocation()}', {$this->getUserId()}) RETURNING id;");
            $result = $statement->fetch(PDO::FETCH_ASSOC);
            $this->setId($result['id']);

         }



}//Ends class

?>
