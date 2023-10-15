<?php

use App\Controllers\AdminController;
use App\Controllers\AuthController;
use App\Controllers\CustomerController;

return [
    "/" => [AuthController::class, 'login'],
    '/login' => [AuthController::class, 'login'],
    '/register' => [AuthController::class, 'register'],
    '/logout' => [AuthController::class, 'logout'],

    // customer routes
    '/customer/dashboard' => [CustomerController::class, 'dashboard'],
    '/customer/deposit' => [CustomerController::class, 'deposit'],
    '/customer/withdraw' => [CustomerController::class, 'withdraw'],
    '/customer/transfer' => [CustomerController::class, 'transfer'],

    // admin routes
    '/admin/add_customer' => [AdminController::class, 'add_customer'],
    '/admin/customers' => [AdminController::class, 'customers'],
    '/admin/customer_transactions' => [AdminController::class, 'customer_transactions'],
    '/admin/transactions' => [AdminController::class, 'transactions'],
];
