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
    $routes->get('managePackages', 'PackageController::viewAllPackages', ['filter' => 'authadmin']);
    $routes->post('packages/createPackage', 'PackageController::createPackage', ['filter' => 'authadmin']);
    $routes->post('packages/updatePackage', 'PackageController::updatePackage', ['filter' => 'authadmin']);
    $routes->post('packages/deletePackage', 'PackageController::deletePackage', ['filter' => 'authadmin']);
    $routes->post('packages/ajaxCallAllPackages', 'PackageController::ajaxCallAllPackages');
    
    
    //Activation Codes    
    $routes->get('activationCodes', 'ActivationCodeController::index', ['filter' => 'authadmin']);
    $routes->post('activationCodes/createCode', 'ActivationCodeController::createCode', ['filter' => 'authadmin']);
    $routes->post('activationCodes/deleteCode', 'ActivationCodeController::deleteCode', ['filter' => 'authadmin']);
    $routes->post('activationCodes/ajaxCallAllCodes', 'ActivationCodeController::ajaxCallAllCodes');



    //Coupon Codes
    $routes->get('couponCodes', 'CouponController::index', ['filter' => 'authadmin']);
    $routes->post('coupons/createCoupon', 'CouponController::createCoupon', ['filter' => 'authadmin']);
    $routes->post('coupons/updateCoupon', 'CouponController::updateCoupon', ['filter' => 'authadmin']);
    $routes->post('coupons/deleteCoupon', 'CouponController::deleteCoupon', ['filter' => 'authadmin']);
    $routes->post('coupons/ajaxCallAllCoupons', 'CouponController::ajaxCallAllCoupons');



    //Settings
    $routes->match(['get', 'post'], 'settings', 'SettingsController::index', ['filter' => 'authadmin']);




});