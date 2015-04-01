<?php

    require_once __DIR__.'/../vendor/autoload.php';
    require_once __DIR__.'/../src/    .php';

    $DB = new PDO('pgsql:host=localhost;dbname=     ');

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

    $app->get('/create_event', function() use ($app) {
        return $app['twig']->render('add_event.twig');
    });

    $app->post('/create_event', function() use ($app) {
        return $app['twig']->render('add_success.twig', array('event' => Event))
    });


    return $app


?>
