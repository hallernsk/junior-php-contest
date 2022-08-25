<?php

namespace App\Models;

class Post
{
    public int $id;
    public string $title;
    public string $body;
    public int $creator_id;
    public $created_at;

    public function save(): void
    {

        $db = \App\db\db::getInstance()->getConnection();
        $this->created_at = date("m.d.y");

        $sqlQuery = "INSERT INTO 
                post(title, body, creator_id, created_at) 
            VALUES(:title, :body, :creator_id, :created_at)";
        $result = $db->prepare($sqlQuery);
        $result->execute([
            ":title" => $this->title,
            ":body" => $this->body,
            ":creator_id" => $this->creator_id,
            ":created_at" => $this->created_at,
        ]);
        $this->id = $db->lastInsertId();

    }

    public static function findOne(int | null $id = null): Post
    {

        $db = \App\db\db::getInstance()->getConnection();
        if ($id !== null) {
            $sqlQuery = 'SELECT * FROM post WHERE id = :id';
            $result = $db->prepare($sqlQuery);
            $result->execute([':id' => $id]);
        } else {
            $sqlQuery = 'SELECT * FROM post ORDER BY id DESC LIMIT 1';
            $result = $db->query($sqlQuery);
        }
        $post = new Post();

        while ($row = $result->fetch(\PDO::FETCH_ASSOC)) {
            $post->id = $row['id'];
            $post->title = $row['title'];
            $post->body = $row['body'];
            $post->creator_id = $row['creator_id'];
            $post->created_at = $row['created_at'];
        }
        return $post;

    }
}
