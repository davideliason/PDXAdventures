<?php

    class Event
    {
        private $id;
        private $event_name;
        private $description;
        private $date;
        private $user_id;

        function __construct($id, $event_name, $description, $date, $user_id)
        {
            $this->id = $id;
            $this->event_name = $event_name;
            $this->description = $description;
            $this->date = $date;
            $this->user_id = $user_id;
        }


    //GETTERS
        function getId()
        {
            return $this->id;
        }

        function getEventName()
        {
            return $this->event_name;
        }

        function getDescription()
        {
            return $this->description;
        }

        function getDate()
        {
            return $this->date;
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

        function setEventName($new_event_name)
        {
            $this->event_name = (string) $new_event_name;
        }

        function setDescription($new_description)
        {
            $this->description = (string) $new_description;
        }

        function setDate($new_date)
        {
            $this->date = (string) $new_date;
        }

        function setUserId($new_user_id)
        {
                $this->user_id = (int) $new_user_id;
        }



}//Ends class

?>
