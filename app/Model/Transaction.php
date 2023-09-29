<?php

namespace App\Model;

class Transaction
{
    public $name;
    public $email;
    public $amount;
    public $transactionType;
    public $date;

    public function __construct($name, $email, $amount, $transactionType, $date)
    {
        $this->name = $name;
        $this->email = $email;
        $this->amount = $amount;
        $this->transactionType = $transactionType;
        $this->date = $date;
    }

    public function showTransaction($isAdmin = false)
    {

        if ($isAdmin) {
            colorLog("User: " . $this->name, 'white');
        }
        colorLog("Amount: " . $this->amount . " BDT", 'white');
        colorLog("Transaction Type: " . $this->transactionType, 'white');
        colorLog("Date: " . $this->date, 'white');
        colorLog('--------------------------', 'yellow');

    }

}
