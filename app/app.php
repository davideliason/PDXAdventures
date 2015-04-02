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

        $all_events = [];
        foreach($checked as $activity) {
            $events = $activity->getEvents();
                foreach($events as $event) {
                    array_push($all_events, $event);
                }
        }

        return $app['twig']->render('filter.twig', array('events' => $all_events, 'activities' => Activity::getAll()));
    });

    //ICON LINKS
    $app->get('/activities/{id}', function($id) use ($app) {
        $selected_activities = Activity::find($id);
        $matching_events= $selected_activities->getEvents();
        return $app['twig']->render('activities.twig', array('events'=> $matching_events, 'activities'=> $selected_activities));
    });

    $app->get('/activities', function() use ($app) {
        return $app['twig']->render('all_activities.twig', array('activities' => Activity::getAll()));
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
        $associated_activities = $selected_event->getActivities();


        return $app['twig']->render('event.twig', array('event'=> $selected_event, 'user' => $selected_user, 'associated_activities' => $associated_activities));
    });

    $app->get('/event/{id}/edit', function($id) use ($app) {
        $selected_event = Event::find($id);
        $user = $selected_event->getUsers();
        $selected_user = User::find($user[0]->getId());
        //add associated activities to twig
        $associated_activities = $selected_event->getActivities();
        return $app['twig']->render('event_edit.twig', array('event' => $selected_event, 'user' => $selected_user, 'associated_activities' => $associated_activities));
    });


    //NEED A POST ROUTE FOR THE EDIT


    $app->patch('/event/{id}', function($id) use ($app) {
        $selected_event = Event::find($id);

        $user = $selected_event->getUsers();
        $selected_user = User::find($user[0]->getId());
        $new_user_name = $_POST['name'];
        $new_user_email = $_POST['email'];
        $new_user_phone = $_POST['phone'];
        $selected_user->update($new_user_name, $new_user_email, $new_user_phone);

        $new_event_name = $_POST['event_name'];
        $new_date_event = $_POST['date_event'];
        $new_location = $_POST['location'];
        $new_description = $_POST['description'];
        $new_user_id = $selected_user->getId();
        $selected_event->update($new_date_event, $new_description, $new_event_name, $new_location, $new_user_id);
        $associated_activities = $selected_event->getActivities();

        return $app['twig']->render('event.twig', array('event'=> $selected_event, 'user' => $selected_user, 'associated_activities' => $associated_activities));
    });

    $app->delete('/delete_event/{id}', function($id) use ($app) {
        $selected_event = Event::find($id);
        $selected_event->delete();
        return $app['twig']->render('index.twig', array('events' => Event::getAll(), 'activities' => Activity::getAll()));
    });

    $app->post('/delete_events', function() use ($app) {
        Event::deleteAll();
        return $app['twig']->render('index.twig', array('events' => Event::getAll(), 'activities' => Activity::getAll()));
    });

    return $app;


?>
