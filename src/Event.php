<?php

    class Event
    {
        private $id;
        private $date;
        private $description;
        private $event_name;
        private $location;
        private $user_id;

        function __construct($id, $date, $description, $event_name, $location, $user_id)
        {
            $this->id = $id;
            $this->date = $date;
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

        function getDate()
        {
            return $this->date;
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
            $this->date = $new_date;
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



}//Ends class

?>
