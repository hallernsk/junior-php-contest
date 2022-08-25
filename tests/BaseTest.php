<?php

namespace App\Tests;

use App\db\connection;
use App\db\db;
use PHPUnit\Framework\TestCase;

abstract class BaseTest extends TestCase
{
    public function setUp(): void
    {
        $db = connection\createConnection();

        db::getInstance()->setupConnection($db);
    }
}
