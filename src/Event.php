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

         function addActivity($activity)
         {
             $GLOBALS['DB']->exec("INSERT INTO activities_events (activity_id, event_id) VALUES ({$this->getId()}, {$activity->getId()});");
         }

         function getActivities()
         {
             $query = $GLOBALS['DB']->query("SELECT activities.* FROM
                 events JOIN events_activities ON (events.id = events_activities.event_id)
                        JOIN activities ON (events_activities.event_id = activities.id)
                        WHERE events.id = {$this->getId()};");
            $activity_ids = $query->fetchAll(PDO::FETCH_ASSOC);

            $activities = array();
            foreach ($activity_ids as $activity) {
                $activity_name = $activity['activity_name'];
                $id = $activity['id'];
                $new_activity = new Activity($activity_name, $id);
                array_push($activities, $new_activity);
            }
            return $activities;
         }

         function GetUsers()
         {
             $GLOBALS['DB']->exec("SELECT user_id FROM ")
         }

         static function getAll()
         {
             $returned_events = $GLOBALS['DB']->query("SELECT * FROM events;");
             $events = array();
             foreach($returned_events as $event) {
                 $id = $event['id'];
                 $date_event = $event['date_event'];
                 $description = $event['description'];
                 $event_name = $event['event_name'];
                 $location = $event['location'];
                 $user_id = $event['user_id'];
                 $new_event = new Event($id, $date_event, $description, $event_name, $location, $user_id);
                 array_push($events, $new_event);
             }
             return $events;
         }

         static function deleteAll()
         {
             $GLOBALS['DB']->exec("DELETE FROM events *;");
         }





}//Ends class

?>
