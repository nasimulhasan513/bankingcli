<?php

use App\Controller\AuthController;

require_once __DIR__ . '/vendor/autoload.php';

/**
 * This script is to register admin users only
 */

$auth = new AuthController();
$auth->register('admin');
