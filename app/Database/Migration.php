<?php

namespace App\Database;

use App\Model\Model;

class Migration
{

    public function __construct(private Model $db)
    {

    }

    public function run()
    {
        $files = glob(__DIR__ . "/migrations/*");
        foreach ($files as $file) {
            if (is_file($file)) {
                $sql = file_get_contents($file);
                $this->db->createTable($sql);
                echo "Table " . basename($file) . " Created Successfully" . PHP_EOL;
            }
        }
    }
}
