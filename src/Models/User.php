<?php

namespace App\Models;

class User
{
    public int $id;
    public string $email;
    public string $first_name;
    public string $last_name;
    public string $password;
    public $created_at;

    public function save(): void
    {

        $db = \App\db\db::getInstance()->getConnection();
        $this->created_at = date('m.d.y');

        $sqlQuery = "INSERT INTO 
                users(email, first_name, last_name, password, created_at) 
            VALUES(:email, :first_name, :last_name, :password, :created_at)";
        $result = $db->prepare($sqlQuery);
        $result->execute([
            ":email" => $this->email,
            ":first_name" => $this->first_name,
            ":last_name" => $this->last_name,
            ":password" => $this->password,
            ":created_at" => $this->created_at,
            ]);
        $this->id = $db->lastInsertId();

    }

    public static function findOne(int | null $id = null): User
    {

        $db = \App\db\db::getInstance()->getConnection();
        if ($id !== null) {
            $sqlQuery = 'SELECT * FROM users WHERE id = :id';
            $result = $db->prepare($sqlQuery);
            $result->execute([':id' => $id]);
        } else {
            $sqlQuery = 'SELECT * FROM users ORDER BY id DESC LIMIT 1';
            $result = $db->query($sqlQuery);
        }

        $user = new User;

        while ($row = $result->fetch(\PDO::FETCH_ASSOC)) {
            $user->id = $row['id'];
            $user->email = $row['email'];
            $user->first_name = $row['first_name'];
            $user->last_name = $row['last_name'];
            $user->password = $row['password'];
            $user->created_at = $row['created_at'];
        }
        return $user;

    }
}
