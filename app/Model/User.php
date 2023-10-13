<?php

namespace App\Model;

class User extends Model
{

    public function getUsers()
    {
        $sql = "SELECT * FROM users";
        $result = $this->select($sql);
        $users = [];
        if (count($result) > 0) {
            $users = $result;
        }
        return $users;
    }

    public function createUser($name, $email, $password, $balance, $role)
    {
        $sql = "INSERT INTO users (name, email, password, balance, role) VALUES ('$name', '$email', '$password', '$balance', '$role')";
        $result = $this->insert($sql);
        return $result;
    }

    public function checkExist($email)
    {
        $sql = "SELECT * FROM users WHERE email = '$email'";
        $result = $this->select($sql);
        return $result;
    }

    public function authenticate($email, $password)
    {
        $sql = "SELECT * FROM users WHERE email = '$email' AND password = '$password'";
        $result = $this->select($sql);
        return $result;
    }

}
