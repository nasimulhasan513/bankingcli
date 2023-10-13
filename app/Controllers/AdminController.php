<?php
namespace App\Controllers;

use App\Model\Transaction;
use App\Model\User;

class AdminController extends Controller
{

    public function add_customer()
    {

        return view('features/admin/add_customer');
    }

    public function customer_transactions()
    {

        $email = $_GET['email'];

        $transactions = (new Transaction())->getTransactions($email);

        return view('features/admin/customer_transactions', [
            'transactions' => $transactions,
            'name' => $transactions[0]['name'],
        ]);

    }

    public function customers()
    {
        $users = (new User())->getUsers();

        return view('features/admin/customers', [
            'users' => $users,
        ]);

    }

    public function transactions()
    {
        $transactions = (new Transaction())->getAllTransactions();
        return view('features/admin/transactions', [
            'transactions' => $transactions,
        ]);

    }

}
