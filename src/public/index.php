<?php
use \config\Config;
use \database\Connection;
use \auth\Acl;

use JeremyKendall\Password\PasswordValidator;
use JeremyKendall\Slim\Auth\Adapter\Db\PdoAdapter;
use JeremyKendall\Slim\Auth\Bootstrap;
use JeremyKendall\Slim\Auth\Exception\HttpForbiddenException as HttpForbiddenException;
use JeremyKendall\Slim\Auth\Exception\HttpUnauthorizedException as HttpUnauthorizedException;
use Zend\Authentication\Storage\Session as SessionStorage;
use Zend\Session\Config\SessionConfig;
use Zend\Session\SessionManager;


require '../vendor/autoload.php';
require '../config.php';
// Create the app instance
$app = new \Slim\Slim(array(
	'mode' => Config::get('app.mode'),
	'debug' => Config::get('app.debug'),
	'templates.path' => Config::get('app.templates.path')
	));

// Authentication bootstrap
$validator = new PasswordValidator();
$db = Connection::getInstance();
$adapter = new PdoAdapter($db->db, 'user', 'username', 'password', $validator);
$acl = new Acl();

$sessionConfig = new SessionConfig();
$sessionConfig->setOptions(array(
	'remember_me_seconds' => 60 * 60 * 24 * 7,
	'name' => 'bedreiv'));

$sessionManager = new SessionManager($sessionConfig);
$sessionManager->rememberMe();
$storage = new SessionStorage(null, null, $sessionManager);
$authBootstrap = new Bootstrap($app, $adapter, $acl);
$authBootstrap->bootstrap();

// Handle errors die inloggen kan throwen
$app->error(function (\Exception $e) use ($app) {
	if ($e instanceof HttpForbiddenException) {
		return $app->render('403.php', array('e' => $e), 403);
	}
	if ($e instanceof HttpUnauthorizedException) {
		return $app->redirectTo('login');
	}
		// You should handle other exceptions here, not throw them
	throw $e;
});

// Grabbing a few things I want in each view
$app->hook('slim.before.dispatch', function () use ($app) {
	$hasIdentity = $app->auth->hasIdentity();
	$identity = $app->auth->getIdentity();
	$role = ($hasIdentity) ? $identity['role'] : 'guest';
	$data = array(
		'hasIdentity' => $hasIdentity,
		'role' =>  $role,
		'identity' => $identity
		);
	$app->view->appendData($data);
});


// include the routes you want to use
// we could do this with some loop, this way we have more control
require '../routes/home.php';
require '../routes/auth.php';

// Run the app
$app->run();

