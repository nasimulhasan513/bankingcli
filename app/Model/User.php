<?php

namespace App\Model;

class User
{
    public $name;
    public $email;
    public $password;
    public $balance;

    public $role;

    public function __construct($name, $email, $password, $balance, $role)
    {
        $this->name = $name;
        $this->email = $email;
        $this->password = $password;
        $this->balance = $balance;
        $this->role = $role;
    }

    public function comparePassword($password)
    {
        return $this->password == $password;
    }

    public function showUser()
    {
        colorLog("Name: {$this->name}", 'green');
        colorLog("Email: {$this->email}", 'green');
        colorLog("Balance: {$this->balance}", 'green');
        colorLog("------------------------------", 'yellow');
    }

    public function isAdmin()
    {
        return $this->role == 'admin';
    }

}
