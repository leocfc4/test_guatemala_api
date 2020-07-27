<?php
	session_start();
	require_once './vendor/autoload.php';
	require_once 'src/config/db.php';

    use \Psr\Http\Message\ServerRequestInterface as Request;
    use \Psr\Http\Message\ResponseInterface as Response;
	
	$app = new \Slim\App();

	$app->options('/{routes:.+}', function ($request, $response, $args) {
	    return $response;
	});

	$app->add(function ($req, $res, $next) {
	    $response = $next($req, $res);
	    return $response
	            ->withHeader('Access-Control-Allow-Origin', '*')
	            ->withHeader('Access-Control-Allow-Headers', 'X-Requested-With, Content-Type, Accept, Origin, Authorization, token')
	            ->withHeader('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, PATCH, OPTIONS');
	});

	// Ruta -> Controller
	require_once ('src/routes/controller.php');
		
	$app->run();