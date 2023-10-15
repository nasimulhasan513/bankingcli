<?php
namespace App\Controllers;

use App\Model\Transaction;
use App\Model\User;

class AdminController extends Controller
{

    public function add_customer()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $name = $_POST['first-name'] . ' ' . $_POST['last-name'];
            $email = $_POST['email'];
            $password = $_POST['password'];
            $user = new User();
            // check if email already exists
            if ($user->checkExist($email)) {
                return view('features/admin/add_customer', [
                    'errors' => ['Email already exists!'],
                ]);
            }

            $user->createUser($name, $email, $password, 0, 'user');
            return redirect('/admin/customers');
        }

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
