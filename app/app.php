<?php

    require_once __DIR__.'/../vendor/autoload.php';
    require_once __DIR__.'/../src/Activity.php';
    require_once __DIR__.'/../src/Event.php';
    require_once __DIR__.'/../src/User.php';

    $DB = new PDO('pgsql:host=localhost;dbname=pdxadventure');

    $app = new Silex\Application();
    $app['debug'] = true;

    use Symfony\Component\HttpFoundation\Request;
    Request::enableHttpMethodParameterOverride();

    $app->register(new Silex\Provider\TwigServiceProvider(), array(
    'twig.path'=> __DIR__.'/../views'
    ));

    //creates route to homepage
    $app->get('/', function() use ($app) {

    return $app['twig']->render('index.twig', array('events' => Event::getAll(), 'activities' => Activity::getAll()));
    });

    $app->get('/filter', function() use ($app) {
        $checked = [];
        $activities = $_POST['activity'];
        foreach($activities as $activity_id){
            $new_activity = Activity::find($activity_id);
            array_push($checked, $new_activity);
        }

        $all_events = [];
        foreach($checked as $activity) {
            //grab the events for each activity
            $events = $activity->getEvents();
                foreach($events as $event) {
                    array_push($all_events, $event);
                }
            //push them into a new array of events checked
        }
        return $app['twig']->render('filter.twig', array('events' => $all_events, 'activities' => Activity::getAll()));
    });


    $app->post('/filter', function() use ($app) {
        $checked = [];
        $activities = $_POST['activity'];
        foreach($activities as $activity_id){
            $new_activity = Activity::find($activity_id);
            array_push($checked, $new_activity);
        }
            // $n = count($activities);
            // for($i = 0; $i < $n; $i++)
            // if($activities[$i] == 1){
            //     $new_activity = new Activity('epi-coding', 1);
            //     array_push($checked, $new_activity);
            //     $i++;
            // } elseif($activities[$i]== 2) {
            //     $new_activity = new Activity('frolocking', 2);
            //     array_push($checked, $new_activity);
            //     $i++;
            // } elseif ($activities[$i] == 3) {
            //     $new_activity = new Activity('swimming', 3);
            //     array_push($checked, $new_activity);
            //     $i++;
            // } else {
            //     $new_activity = new Activity('outdoors', 4);
            //     array_push($checked, $new_activity);
            //     $i++;
            // }


        //use the checked array to loop through activity objects
        $all_events = [];
        foreach($checked as $activity) {
            //grab the events for each activity
            $events = $activity->getEvents();
                foreach($events as $event) {
                    array_push($all_events, $event);
                }
            //push them into a new array of events checked
        }

        return $app['twig']->render('filter.twig', array('events' => $all_events, 'activities' => Activity::getAll()));
    });

    $app->get('/add_event', function() use ($app) {
        return $app['twig']->render('add_event.twig');
    });

    $app->post('/add_event', function() use ($app) {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $new_user = new User($name, $email, $phone);
        $new_user->save();

        $event_name = $_POST['event_name'];
        $date_event = $_POST['date_event'];
        $location = $_POST['location'];
        $description = $_POST['description'];
        $user_id = $new_user->getId();
        $id = null;
        $new_event = new Event($date_event, $description, $event_name, $location, $user_id);
        $new_event->save();

        $checked = [];
        $activities = $_POST['activity'];
        foreach($activities as $activity_id){
            $new_activity = Activity::find($activity_id);
            array_push($checked, $new_activity);
        }

        foreach($checked as $activity) {
            $new_event->addActivity($activity);
        }
        return $app['twig']->render('add_success.twig', array('event'=> $new_event, 'user' => $new_user, 'activities_associated' => $checked));
    });

    //SEE ALL ACTIVITIES


    $app->get('/event/{id}', function($id) use ($app) {
        $selected_event = Event::find($id);
        $user = $selected_event->getUsers();
        $selected_user = User::find($user[0]->getId());
        $associated_activites = $selected_event->getActivities();
        return $app['twig']->render('event.twig', array('event'=> $selected_event, 'user' => $selected_user, 'associated_activities' => $associated_activities));
    });

    $app->get('/event/{id}/edit', function($id) use ($app) {
        $selected_event = Event::find($id);
        $user = $selected_event->getUsers();
        $selected_user = User::find($user[0]->getId());
        $associated_activites = $selected_event->getActivities();
        return $app['twig']->render('event_edit.twig', array('event' => $selected_event, 'user' => $selected_user, 'associated_activities' => $associated_activities));
    });


    //NEED A POST ROUTE FOR THE EDIT

    $app->patch('/event/{id}', function($id) use ($app) {
        $selected_event = Event::find($id);

        $user = $selected_event->getUsers();
        $selected_user = User::find($user->getId());
        $new_user_name = $_POST['name'];
        $new_user_email = $_POST['email'];
        $new_user_phone = $_POST['phone'];
        $selected_user->update($new_user_name, $new_user_email, $new_user_phone);

        $new_event_name = $_POST['event_name'];
        $new_date_event = $_POST['date_event'];
        $new_location = $_POST['location'];
        $new_description = $_POST['description'];
        $new_user_id = $selected_user->getId();
        $selected_event->update($new_date_event, $new_description, $new_event_name, $new_location, $user_id);
        return $app['twig']->render('event.twig', array('event'=> $selected_event, 'user' => $selected_user));
    });

    $app->delete('/delete_event/{id}', function($id) use ($app) {
        $selected_event = Event::find($id);
        $selected_event->deleteEvent();
        return $app['twig']->render('index.twig', array('events' => Event::getAll(), 'activities' => Activity::getAll()));
    });

    $app->post('/delete_events', function() use ($app) {
        Event::deleteAll();
        return $app['twig']->render('index.twig', array('events' => Event::getAll(), 'activities' => Activity::getAll()));
    });

    return $app;


?>
