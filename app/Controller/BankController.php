<?php

namespace App\Controller;

use App\Model\Transaction;
use App\Model\User;
use App\Service\Storage;
use App\Service\StorageTypes;

class BankController
{
    public $transactions = [];
    public $users = [];

    public $current_user = null;

    public function __construct()
    {

        $this->transactions = Storage::read(StorageTypes::TRANSACTION);
        $this->users = Storage::read(StorageTypes::USER);

    }
    public function menu()
    {

        echo "Welcome {$this->current_user->name}" . PHP_EOL;
        echo "1. See all transactions" . PHP_EOL;
        echo "2. Deposit" . PHP_EOL;
        echo "3. Withdraw" . PHP_EOL;
        echo "4. Transfer" . PHP_EOL;
        echo "5. Balance" . PHP_EOL;
        echo "6. Logout" . PHP_EOL;
        $input = readline("Choose menu: ");

        switch ($input) {
            case '1':
                $this->transaction_history();
                break;
            case '2':
                $this->deposit();
                break;
            case '3':
                $this->withdraw();
                break;
            case '4':
                $this->transfer();
                break;
            case '5':
                $this->balance();
                break;
            case '6':
                exit;
            default:
                echo "Invalid menu" . PHP_EOL;
                $this->menu();
                break;
        }

    }
    public function adminmenu()
    {

        echo "Welcome {$this->current_user->name}" . PHP_EOL;
        echo "1. See all transactions" . PHP_EOL;
        echo "2. See all users" . PHP_EOL;
        echo "3. Search an user transactions" . PHP_EOL;
        echo "4. Logout" . PHP_EOL;
        $input = readline("Choose menu: ");

        switch ($input) {
            case '1':
                $this->showAllTransactions();
                break;
            case '2':
                $this->showAllusers();
                break;
            case '3':
                $email = readline("User email: ");
                $this->showTransactionsByEmail($email);
                break;
            case '4':
                exit;
            default:
                echo "Invalid menu" . PHP_EOL;
                $this->adminmenu();
                break;
        }
    }

    public function deposit()
    {
        $amount = readline("Deposit Amount: ");
        $this->current_user->balance += $amount;
        $this->transactions[] = new Transaction($this->current_user->name, $this->current_user->email, $amount, 'deposit', date('Y-m-d H:i:s'));
        colorLog("Deposit success!", 'green');
        $this->menu();
    }
    public function withdraw()
    {
        $amount = readline("Withdrawal Amount: ");

        if ($amount > $this->current_user->balance) {
            colorLog("Insufficient balance!", 'red');
            return $this->withdraw();
        }
        $this->current_user->balance -= $amount;
        $this->transactions[] = new Transaction($this->current_user->name, $this->current_user->email, $amount, 'withdraw', date('Y-m-d H:i:s'));
        colorLog("Withdraw success!", 'green');
        $this->menu();

    }
    public function transfer()
    {
        $receiver_email = readline("Receiver email: ");
        $amount = readline("Amount: ");
        if ($amount > $this->current_user->balance) {
            colorLog("Insufficient balance!", 'red');
            return $this->transfer();
        }

        // check id user exist
        $receiver = null;
        foreach ($this->users as $user) {
            if ($user->email == $receiver_email) {
                $receiver = $user;
            }
        }

        if (!$receiver) {
            colorLog("User not found!", 'red');
            return $this->transfer();
        }

        $this->current_user->balance -= $amount;
        $receiver->balance += $amount;

        $this->transactions[] = new Transaction($this->current_user->name, $this->current_user->email, $amount, 'debit', date('Y-m-d H:i:s'));
        $this->transactions[] = new Transaction($receiver->name, $receiver->email, $amount, 'credit', date('Y-m-d H:i:s'));

        colorLog("Transfer success!", 'green');

        $this->menu();
    }

    public function balance()
    {
        // colorLog('--------------------------', 'yellow');
        // colorLog("| Your balance is {$this->current_user->balance} BDT |", 'green');
        // colorLog('--------------------------', 'yellow');

        boxLog("Your balance is {$this->current_user->balance} BDT", 'green');

        $this->menu();
    }

    public function transaction_history()
    {
        $transactions = array_filter($this->transactions, function ($transaction) {
            return $transaction->email == $this->current_user->email;
        });

        if (count($transactions) == 0) {
            colorLog("No transaction found!", 'red');
            $this->menu();
            return;
        }

        foreach ($transactions as $transaction) {

            colorLog('--------------------------', 'yellow');

            $transaction->showTransaction();
        }

        $this->menu();
    }

    // Admin methods

    public function showAllTransactions()
    {
        foreach ($this->transactions as $transaction) {
            $transaction->showTransaction(true);
        }
        $this->adminmenu();
    }

    public function showTransactionsByEmail($email)
    {

        foreach ($this->transactions as $transaction) {
            if ($transaction->email == $email) {
                colorLog('--------------------------', 'yellow');
                $transaction->showTransaction();
            }
        }
        $this->adminmenu();

    }

    public function showAllusers()
    {
        foreach ($this->users as $user) {

            colorLog("------------------------------", 'yellow');
            $user->showUser();

        }

        $this->adminmenu();

    }

    public function __destruct()
    {
        if ($this->current_user != null) {
            foreach ($this->users as $key => $user) {
                if ($user->email == $this->current_user->email) {
                    $this->users[$key] = $this->current_user;
                }
            }
        }

        Storage::write(StorageTypes::USER, $this->users);
        Storage::write(StorageTypes::TRANSACTION, $this->transactions);
    }

}
