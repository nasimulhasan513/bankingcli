<?php

namespace App\Model;

class Transaction extends Model
{

    public function getAllTransactions()
    {
        $sql = "SELECT * FROM transactions order by date desc";
        $result = $this->select($sql);
        $transactions = [];
        if (count($result) > 0) {
            $transactions = $result;
        }
        return $transactions;
    }

    public function getTransactions($email)
    {
        $sql = "SELECT * FROM transactions WHERE email = '$email' order by date desc";
        $result = $this->select($sql);
        $transactions = [];
        if (count($result) > 0) {
            $transactions = $result;
        }
        return $transactions;
    }

    public function updateBalance($amount, $type)
    {
        $user = user();

        $balance = $user['balance'];
        $email = $user['email'];

        if ($type == 'deposit') {
            $balance += $amount;
        } else {
            $balance -= $amount;
        }
        $sql = "UPDATE users SET balance = '$balance' WHERE email = '$email'";
        $result = $this->update($sql);

        set_session_var('balance', $balance);
        return $result;
    }

    public function createTransaction($name, $email, $amount, $transactionType, $date)
    {

        $sql = "INSERT INTO transactions (name, email, amount, transaction_type, date) VALUES ('$name', '$email', '$amount', '$transactionType', '$date')";
        $this->updateBalance($amount, $transactionType);
        $this->insert($sql);
    }

    public function transferMoney($receiverEmail, $amount)
    {
        $user = user();
        $senderEmail = $user['email'];
        $senderName = $user['name'];
        $date = date('Y-m-d H:i:s');

        $receiver = $this->getUser($receiverEmail)[0];

        $this->createTransaction($senderName, $senderEmail, $amount, 'withdraw', $date);
        $this->createTransaction($receiver['name'], $receiverEmail, $amount, 'deposit', $date);
        $sql = "UPDATE `users` SET `balance` = `balance` + $amount WHERE `email` = '$receiverEmail'";
        $this->update($sql);

        $this->updateBalance($amount, 'withdraw');
    }

    public function getUser($email)
    {
        $sql = "SELECT * FROM users WHERE email = '$email'";
        $result = $this->select($sql);
        return $result;
    }

    public function getBalance($email)
    {
        $sql = "SELECT balance FROM users WHERE email = '$email'";
        $result = $this->select($sql);
        $balance = 0;
        if (count($result) > 0) {
            $balance = $result[0]['balance'];
        }

        return $balance;
    }

}
