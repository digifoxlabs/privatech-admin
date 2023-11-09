<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

$routes->match(['get', 'post'],'clientAthentication/email', 'Home::login');


$routes->get('send-fcm', 'FCMController::sendNotification');


//FrontEnd Routes
$routes->get('/', 'Frontend\HomeController::index');
$routes->get('/login', 'Frontend\HomeController::optionforLogin');
$routes->get('/login/password', 'Frontend\ClientAuthenticate::passwordLogin');
$routes->get('/login/otp', 'Frontend\ClientAuthenticate::otpLogin');

$routes->match(['get', 'post'],'/register', 'Frontend\HomeController::register');

$routes->post('/loginClient', 'Frontend\ClientAuthenticate::authPassword');
$routes->match(['get', 'post'],'/login/client', 'Frontend\ClientAuthenticate::defaultClientLogin');


$routes->get('/dashboard', 'Frontend\HomeController::dashboard');
$routes->get('/client/logout', 'Frontend\ClientAuthenticate::logout');

//AJAX POSTS
$routes->match(['get', 'post'],'check/user', 'Frontend\ClientAuthenticate::check_user');



//Admin Routes

$routes->group('admin', ['namespace' => 'App\Controllers\Backend'] ,static function ($routes) {

    $routes->get("/", 'Dashboard::index', ['filter' => 'authadmin']);

    //Authentication
    $routes->get('logout', 'UserController::logout');
    $routes->match(['get', 'post'], 'login', 'UserController::login');

    //Dashboard
    $routes->get('dashboard', 'Dashboard::index', ['filter' => 'authadmin']);



});