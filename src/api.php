<?php

namespace App;

use App\Models\User;
use App\Models\Post;
use App\db\db;

class api
{
    public function connection(): void
    {
        //TODO: Implement api: get user by id, create user
        header('Content-Type: application/json');
        $method = $_SERVER['REQUEST_METHOD'];
        switch($method) {
            case 'GET':
                $url = $_SERVER['REQUEST_URI'];
                $parsedUrl = explode("/", $url);
                $userId = end($parsedUrl);
                $user = User::findOne($userId);
                $userJson = json_encode($user);
                echo $userJson;
                break;

            case 'PUT':
                $inputJsonData = file_get_contents('php://input');
                $userData = json_decode($inputJsonData, true);

                $user = new User();
                $user->email = $userData['email'];
                $user->first_name = $userData['first_name'];
                $user->last_name = $userData['last_name'];
                $user->password = $userData['password'];
                $user->save();

                $userById = User::findOne($user->id);
                $userJson = json_encode($userById);
                echo $userJson;
                break;

            default:
                header('HTTP/1.1 405 Method Not Allowed');
                break;
        }
    }
}
