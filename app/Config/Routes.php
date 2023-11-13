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

$routes->get('/privacy-policy', 'Frontend\HomeController::privacyPolicy');

$routes->match(['get', 'post'],'/register', 'Frontend\HomeController::register');
$routes->match(['get', 'post'],'/resetPassword', 'Frontend\HomeController::resetPassword');
$routes->match(['get', 'post'],'/setNewPassword', 'Frontend\HomeController::setNewPassword');

$routes->post('/loginClient', 'Frontend\ClientAuthenticate::authPassword');
$routes->post('/loginClientOTP', 'Frontend\ClientAuthenticate::authOTP');
$routes->match(['get', 'post'],'/login/client', 'Frontend\ClientAuthenticate::defaultClientLogin');


$routes->get('/dashboard', 'Frontend\HomeController::dashboard', ['filter' => 'authclient']);
$routes->match(['get', 'post'],'/dashboard/setNewPassword', 'Frontend\HomeController::setPasswordbyClient', ['filter' => 'authclient']);

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

    //Manage Clients
    $routes->get('allClients', 'ClientController::viewAllClients');
    $routes->post('clients/ajaxCallAllClients', 'ClientController::ajaxCallAllClients');
    
    //Packages
    $routes->get('managePackages', 'PackageController::viewAllPackages');
    $routes->post('packages/ajaxCallAllPackages', 'PackageController::ajaxCallAllPackages');




});