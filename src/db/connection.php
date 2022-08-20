<?php

namespace App\db\connection;

use PDO;

function createConnection()
{
    $dbPath = __DIR__ . '/../../db.sqlite';
    touch($dbPath);

    //$db = null;

    //TODO: Create connection to Sqlite DB
    $db = new PDO('sqlite:' . $dbPath );

    return $db;
}
