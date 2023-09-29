<?php

namespace App\Controller;

use App\Model\User;

class AuthController extends BankController
{

    public function register($role = 'user')
    {
        $name = readline("Name: ");
        $email = readline("Email: ");
        $password = readline("Password: ");

        // check if email already exists
        foreach ($this->users as $user) {
            if ($user->email == $email) {
                colorLog("Email already exists! Try Again.", 'red');
                $this->register();
                return;
            }
        }

        $user = new User($name, $email, $password, 0, $role);
        $this->users[] = $user;

        colorLog(ucfirst($role) . " successfully registered!", 'green');

        if ($role == 'admin') {
            return exit;
        }

        $this->run();
    }

    // login existing user
    public function login()
    {
        $email = readline("Email: ");
        $password = readline("Password: ");

        foreach ($this->users as $user) {
            if ($user->email == $email && $user->comparePassword($password)) {
                $this->current_user = $user;
                if ($this->current_user->role == 'admin') {

                    $this->adminmenu();
                    return;
                }
                $this->menu();
                return;
            }
        }

        colorLog("Invalid email or password! Try Again.", 'red');
        $this->login();
    }
    public function run()
    {
        echo "Welcome to Banking CLI App" . PHP_EOL;
        echo "1. Register" . PHP_EOL;
        echo "2. Login" . PHP_EOL;
        echo "3. Exit" . PHP_EOL;
        $input = readline("Choose menu: ");

        switch ($input) {
            case '1':
                $this->register();
                break;
            case '2':
                $this->login();
                break;
            case '3':
                exit;
            default:
                echo "Invalid menu" . PHP_EOL;
                $this->run();
                break;
        }
    }
}
