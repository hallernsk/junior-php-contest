<?php

namespace App\db\initial;

function initializeDb($db)
{
    //TODO: Create initial tables

    $commands = ['CREATE TABLE IF NOT EXISTS users (
        id INTEGER PRIMARY KEY,
        email TEXT,
        first_name TEXT,
        last_name TEXT,
        password TEXT,
        created_at INTEGER 
        )',
        'CREATE TABLE IF NOT EXISTS post (
            id INTEGER PRIMARY KEY,
            title  TEXT,
            body  TEXT,
            creator_id INTEGER,
            created_at INTEGER,
            FOREIGN KEY (creator_id) REFERENCES users (id)
        )'
    ];

    foreach ($commands as $command) {
        $db->exec($command);
    }
}
