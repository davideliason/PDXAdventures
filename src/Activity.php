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

            static function getAll()
            {
                $statement = $GLOBALS['DB']->query("SELECT FROM activities *;");
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
