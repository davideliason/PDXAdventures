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

            
        }
?>
