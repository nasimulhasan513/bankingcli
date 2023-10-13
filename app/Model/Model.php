<?php

namespace App\Model;

use PDO;
use PDOException;

class Model
{
    protected PDO $db;

    public function __construct()
    {

        try {
            $config = require_once __DIR__ . '/../../config/database.php';

            $this->db = new PDO(
                'mysql:host=' . $config['host'] . ';dbname=' . $config['database'],
                $config['username'],
                $config['password']
            );
            $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function createTable(string $sql)
    {
        try {
            $this->db->exec($sql);
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function select(string $sql)
    {

        try {
            $stmt = $this->db->query($sql);
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function insert(string $sql)
    {
        try {
            $stmt = $this->db->exec($sql);
            return $stmt;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function update(string $sql)
    {
        try {
            $stmt = $this->db->exec($sql);
            return $stmt;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

}
