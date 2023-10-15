<?php

namespace App\Controllers;

use App\Model\User;

class AuthController extends Controller
{

    public function index()
    {
        return view('features/index');
    }

    public function register($role = 'user')
    {

        $errors = [];

        // check method
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $name = $_POST['name'];
            $email = $_POST['email'];
            $password = $_POST['password'];
            $user = new User();
            // check if email already exists
            if ($user->checkExist($email)) {
                return view('auth/register', [
                    'errors' => ['Email already exists!'],
                ]);
            }

            $user->createUser($name, $email, $password, 0, $role);

        }

        return view('auth/register');
    }

    // login existing user
    public function login()
    {
        $errors = [];
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $email = $_POST['email'];
            $password = $_POST['password'];
            $user = new User();
            $user = $user->authenticate($email, $password)[0];

            if ($user) {
                // set session
                setuser($user);
                if ($user['role'] == 'admin') {
                    return redirect('/admin/customers');
                } else {
                    return redirect('/customer/dashboard');
                }
            } else {
                $errors = ['Email or password is incorrect!'];
            }
        }

        return view('auth/login', [
            'errors' => $errors,
        ]);

    }

    public function logout()
    {
        session_destroy();
        return redirect('/');
    }

    public function run()
    {
        $data = [];

        if (session_var_exists('user')) {
            $data['user'] = get_session_var('user');
        }

        return view('features/index', $data);
    }
}
