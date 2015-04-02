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

            function addEvent($event)
            {
                $GLOBALS['DB']->exec("INSERT INTO activities_events (activity_id, event_id) VALUES ({$this->getId()}, {$event->getId()});");

            }


            function getEvents()
            {
                $query = $GLOBALS['DB']->query("SELECT events.* FROM
                activities JOIN activities_events ON (activities.id = activities_events.activity_id) JOIN events ON (activities_events.event_id = events.id)
                WHERE activities.id = {$this->getId()};");
            $event_ids = $query->fetchAll(PDO::FETCH_ASSOC);

            $events = array();
            foreach($event_ids as $event) {
                    $date_event = $event['date_event'];
                    $description = $event['description'];
                    $event_name = $event['event_name'];
                    $location = $event['location'];
                    $user_id = $event['user_id'];
                    $id = $event['id'];
                    $new_event = new Event($date_event, $description, $event_name, $location, $user_id, $id);
                    array_push($events, $new_event);
                }
                return $events;
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

            function update($new_name)
            {
                $GLOBALS['DB']->exec("UPDATE activities SET (activity_name) = ('{$new_name}') WHERE id = {$this->getId()};");
                $this->setActivityName($new_name);
            }

            function delete()
            {
                $GLOBALS['DB']->exec("DELETE FROM activities WHERE id = {$this->getId()};");
            }

        }
?>
