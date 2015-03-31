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
    return $app['twig']->render('index.twig', array('authors' => Author::getAll(), 'books' => Book::getAll()));
    });


    return $app


?>
