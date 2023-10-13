<?php

require 'vendor/autoload.php';

use App\Database\Migration;
use App\Model\Model;

(new Migration(new Model()))->run();
