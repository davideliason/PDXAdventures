<?php
    class Activity
        {
            private $id;
            private $activity_name;

            function __construct($activity_new, $id_new=null)
            {
                $this->id = $id_new;
                $this->activity_name = $activity_new;

            }

            function getId()
            {
                return $this->id;
            }

            function getActivityName()
            {
                return $this->activity_name;
            }

            function setId($new_id)
            {
                $this->id = $new_id;
            }

            function setActivityName($new_name)
            {
                $this->activity_name = $new_name;
            }

            function save()
            {
                $statement = $GLOBALS['DB']->query("INSERT INTO activities (activity_name) VALUES ('{$this->getActivityName()}')RETURNING id;");
                $result = $statement->fetch(PDO::FETCH_ASSOC);
                $this->setId($result['id']);
            }

            function update($new_name)
            {
                $GLOBALS['DB']->exec("UPDATE activities SET (activity_name) = ('{$new_name}') WHERE id = {$this->getId()};");
                $this->setActivityName($new_name);
            }

            function delete()
            {
                $GLOBALS['DB']->exec("DELETE FROM activities WHERE id = {$this->getId()};");
            }

            /*
            function getEvents()
            {
                $GLOBALS['DB']->query("SELECT * FROM events WHERE user_id = {$this->getId()};");
                $events_array = array();

                foreach($events as $event) {
                    $id = $event['id'];
                    $date_event = $event['date_event'];
                    $description = $event['description'];
                    $event_name = $event['event_name'];
                    $location = $event['location'];
                    $user_id = $event['user_id'];
                    $new_event = new Event($id, $date_event, $description, $location, $user_id);
                    array_push($events_array, $new_event);
                }
                return $events_array;
            }
            */

            // static functions

            static function find($search)
            {
                $found = null;
                $all_activities = Activity::getAll();
                foreach ($all_activities as $activity)
                {
                    $activity_id = $activity->getId();
                    if($activity_id == $search)
                    {
                        $found = $activity;
                    }
                }
              return $found;
            }

            static function getAll()
            {
                $statement = $GLOBALS['DB']->query("SELECT * FROM activities;");
                $all_activities = [];

                foreach($statement as $activity){
                    $activity_name = $activity['activity_name'];
                    $id = $activity['id'];
                    $activity_item = new Activity($activity_name, $id);
                    array_push($all_activities, $activity_item);
                }
                return $all_activities;
            }

            static function deleteAll()
            {
                $GLOBALS['DB']->exec("DELETE FROM activities *;");
            }
        }
?>
