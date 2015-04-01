<?php
    class Activity
        {
            private $id;
            private $activity_name;

            function __construct($id_new, $activity_new)
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
                    $activity_item = new Activity($id, $activity_name);
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
