## Banking CLI App - PHP

This is a simple CLI app that simulates a banking system. It allows users to create accounts, deposit and withdraw funds, and transfer funds between accounts.

### Installation

1. Clone the repository
2. Run `php migration.php` for create database  
3. Run `php -S localhost:8000 -t public` to start the server

### Basic Usage
1. To create user account use simply webview of registration form
2. To create an admin account please change role in database to `admin` for any user
3. If role is `admin` then you will be redirected to admin dashboard
4. If role is `user` then you will be redirected to user dashboard

### Common Features
1. User can create account
2. User can deposit money
3. User can withdraw money
4. User can transfer money to another account
5. User can view account balance
6. User can view transaction history

### Admin Features
1. Admin can view all users
2. Admin can view all accounts
3. Admin can view all transactions


### Technologies Used
1. PHP
2. JSON file for data storage
3. Composer for autoloading classes