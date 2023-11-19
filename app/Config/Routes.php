<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

$routes->match(['get', 'post'],'clientAthentication/email', 'Home::login');


$routes->get('send-fcm', 'FCMController::sendNotification');


//FrontEnd Routes
$routes->get('/', 'Frontend\HomeController::index', ['filter' => 'noauthclient']);
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

//Profile Update by Client
$routes->match(['get', 'post'],'/profile', 'Frontend\HomeController::profile', ['filter' => 'authclient']);

//Subscription
$routes->get('/subscription', 'Frontend\SubscriptionController::index', ['filter' => 'authclient']);
$routes->get('/subscription/packages', 'Frontend\SubscriptionController::packages', ['filter' => 'authclient']);

//Purchase
$routes->get('subscription/purchase/(:alphanum)', 'Frontend\SubscriptionController::purchasePackage/$1', ['filter'=>'authclient']);

$routes->match(['get', 'post'],'subscription/pay', 'Frontend\SubscriptionController::checkout', ['filter' => 'authclient']);

$routes->post('subscription/paymentStatus', 'Frontend\SubscriptionController::checkPaymentStatus', ['filter' => 'authclient']);




/**
 * Admin Routes
 * 
 */
$routes->group('admin', ['namespace' => 'App\Controllers\Backend'] ,static function ($routes) {

    $routes->get("/", 'Dashboard::index', ['filter' => 'authadmin']);

    //Authentication
    $routes->get('logout', 'UserController::logout');
    $routes->match(['get', 'post'], 'login', 'UserController::login');

    //Dashboard
    $routes->get('dashboard', 'Dashboard::index', ['filter' => 'authadmin']);

    //Add New Client
    $routes->match(['get', 'post'], 'clients/add', 'ClientController::addClient', ['filter'=>'authadmin']);

    //All Clients
    $routes->get('allClients', 'ClientController::viewAllClients');
    $routes->post('clients/ajaxCallAllClients', 'ClientController::ajaxCallAllClients');
    
    //Clients Active Subscriptions
    $routes->get('clients/active', 'ClientController::viewAllClientsActive');
    $routes->match(['post'],'clients/ajaxCallAllClientsActive', 'ClientController::ajaxCallAllClientsActive');

    //Clients Expired Subscriptions
    $routes->get('clients/expired', 'ClientController::viewAllClientsExpired');
    $routes->post('clients/ajaxCallAllClientsExpired', 'ClientController::ajaxCallAllClientsExpired');

    //Clients Pending Subscriptions
    $routes->get('clients/pending', 'ClientController::viewAllClientsPending');
    $routes->post('clients/ajaxCallAllClientsPending', 'ClientController::ajaxCallAllClientsPending');

    //View Client Page
    $routes->get('clients/view/(:alphanum)', 'ClientController::viewClient/$1', ['filter'=>'authadmin']);

    //Update CLient Profile
    $routes->post('clients/updateProfile', 'ClientController::updateClientProfile', ['filter'=>'authadmin']);    
    
    //Update CLient Subscription
    $routes->post('clients/updateSubscription', 'ClientController::updateClientSubscription', ['filter'=>'authadmin']);
    
    //Update Password
    $routes->post('clients/updatePassword', 'ClientController::updateClientPassword', ['filter'=>'authadmin']);

    //All Transactions
    $routes->get('transactions', 'TxnController::index', ['filter'=>'authadmin']);
    $routes->post('transactions/ajaxCallAllTxn', 'TxnController::ajaxCallAllTxn');


    
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


//Test Routes
$routes->match(['get', 'post'], 'test', 'Backend\Dashboard::test');