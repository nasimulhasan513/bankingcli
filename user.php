<?php
use App\Controller\AuthController;
require_once __DIR__ . '/vendor/autoload.php';

/**
 * Entry point of the application
 * New User can be registered from here
 * Existing user can login from here
 *
 * If logged in user is admin, he can see all the admin related menus
 * If logged in user is not admin, he can see all the customer related menus
 *
 */

$auth = new AuthController();
$auth->run();
