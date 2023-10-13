<?php

namespace App\Controllers;

use App\Model\Transaction;

class CustomerController extends Controller
{
    public function dashboard()
    {

        $data = [];
        $user = user();
        $data['user_id'] = $user['id'];
        $data['user_name'] = $user['name'];
        $data['user_email'] = $user['email'];
        $data['balance'] = $user['balance'];

        $data['transactions'] = (new Transaction())->getTransactions($user['email']);

        return view('features/customer/dashboard', $data);
    }
    public function deposit()
    {

        $data = [];
        $user = user();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $amount = $_POST['amount'];
            $name = $user['name'];
            $email = $user['email'];

            $transaction = new Transaction();
            $transaction->createTransaction($name, $email, $amount, 'deposit', date('Y-m-d H:i:s'));

            $user = user();

        }

        $data['balance'] = $user['balance'];
        return view('features/customer/deposit', $data);
    }

    public function withdraw()
    {
        $user = user();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $amount = $_POST['amount'];
            $name = $user['name'];
            $email = $user['email'];

            $transaction = new Transaction();
            $transaction->createTransaction($name, $email, $amount, 'withdraw', date('Y-m-d H:i:s'));
            $user = user();

        }
        $data['balance'] = $user['balance'];

        return view('features/customer/withdraw', $data);
    }

    public function transfer()
    {

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $amount = $_POST['amount'];
            $email = $_POST['email'];

            $transaction = new Transaction();
            $transaction->transferMoney($email, $amount);
        }

        $user = user();
        $data['balance'] = $user['balance'];

        return view('features/customer/transfer', $data);
    }
}
