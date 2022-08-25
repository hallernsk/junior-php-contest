<?php

use App\api;
use App\db\connection;
use App\db\db;

require 'vendor/autoload.php';

$db = connection\createConnection();

db::getInstance()->setupConnection($db);

$api = new api();

$api->connection();
