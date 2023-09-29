<?php

namespace App\Service;

use App\Model\Transaction;
use App\Model\User;

enum StorageTypes: string {
    case USER = 'user';
    case TRANSACTION = 'transaction';
}

class Storage
{
    private const USER_FILE = __DIR__ . '/../../data/users.json';
    private const TRANSACTION_FILE = __DIR__ . '/../../data/transactions.json';

    public static function read(StorageTypes $type)
    {
        switch ($type) {
            case StorageTypes::USER:

                if (!file_exists(self::USER_FILE)) {
                    return [];
                }

                $file_contents = json_decode(file_get_contents(self::USER_FILE), true);
                $users = [];
                foreach ($file_contents as $user) {
                    $users[] = new User($user['name'], $user['email'], $user['password'], $user['balance'], $user['role']);
                }
                return $users;
            case StorageTypes::TRANSACTION:

                if (!file_exists(self::TRANSACTION_FILE)) {
                    return [];
                }

                $file_contents = json_decode(file_get_contents(self::TRANSACTION_FILE), true);
                $transactions = [];
                foreach ($file_contents as $transaction) {
                    $transactions[] = new Transaction($transaction['name'], $transaction['email'], $transaction['amount'], $transaction['transactionType'], $transaction['date']);
                }
                return $transactions;
        }
    }

    public static function write(StorageTypes $type, $data)
    {
        switch ($type) {
            case StorageTypes::USER:
                file_put_contents(self::USER_FILE, json_encode($data));
                break;
            case StorageTypes::TRANSACTION:
                file_put_contents(self::TRANSACTION_FILE, json_encode($data));
                break;
        }

    }
}
