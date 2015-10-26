<?php

//Composer AutoLoad
require "vendor/autoload.php";
 
date_default_timezone_set('America/New_York');

// use Monolog\Logger;
// use Monolog\Handler\StreamHandler;

// $log = new Logger('name');
// $log->pushHandler(new StreamHandler('app.log', Logger::WARNING));
// //$log->addWarning('Foo');

$app = new \Slim\Slim(
 array('view' => new \Slim\Views\Twig())
 );

$view = $app->view();
$view->parserOptions = array(
    'debug' => true
);

$view->parserExtensions = array(
    new \Slim\Views\TwigExtension(),
);


$app->get('/', function() use($app){
	require_once("database.php"); 
		try{
		    $results = $db->prepare('
							SELECT items.name, items.price, items.desci, locations.name AS location, distributor.name AS distributor 
							FROM items 
							INNER JOIN locations ON items.location = locations.id
							INNER JOIN distributor ON items.distributor = distributor.id
				    	');
		    $results->execute();

	 	} catch (Exception $e) {
		    echo $e->getMessage();
		    die();

	  	}
  	$item = $results->fetchALL(PDO::FETCH_ASSOC);

	$app->render('item.twig', array('item' => $item));
})->name('home');


// $app->get('/contact', function() use($app){
// 	$app->render('contact.twig');
// })->name('contact');



$app->run();
	

?>
