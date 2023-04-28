<?php

use Workerman\Worker;


require_once __DIR__ .'/../vendor/autoload.php';


$wsWorker = new Worker('websocket://0.0.0.0:8080');
$wsWorker->count = 4;

$active_users = [];

$wsWorker->onConnect = function($connection) use (&$active_users){
    $con_id = $connection->id;
    $active_users[$con_id] = null;
    $message = array();
    $message["type"] = "login";
    $connection->send(json_encode($message));
};



$wsWorker->onMessage = function($connection, $data) use ($wsWorker, &$active_users){

    $decoded_message = json_decode($data);
    if($decoded_message->type == "login_session")
    {
        $ses_id = $decoded_message->session;
        session_id($ses_id);
        session_start();
        $user = "Anonymus";
        if(isset($_SESSION['user']))
            $user = $_SESSION['user'];
        $con_id = $connection->id;
        $active_users[$con_id] = $user;
        session_write_close();
    }

    else if($decoded_message->type == "message")
    {
        $decoded_message->user = $active_users[$connection->id];
        $json_message = json_encode($decoded_message);
    
        foreach($wsWorker->connections as $clientConnection) {
                $clientConnection->send($json_message);
        }
    }

    else if($decoded_message->type == "private_message")
    {
        $decoded_message->user = $active_users[$connection->id];
        $receiver = $decoded_message->receiver;
        $correct_connections = [$connection->id];
        foreach(array_keys($active_users) as $key)
        {
            if($active_users[$key] == $receiver)
            {
                $correct_connections[] = $key;
            }
        }
        if(count($correct_connections) > 1)
        {
            $decoded_message->status = "Success";
            $json_message = json_encode($decoded_message);
            foreach($wsWorker->connections as $clientConnection) 
            {
                foreach($correct_connections as $correctConnection)
                {
                    if($clientConnection->id == $correctConnection)
                    {
                        $clientConnection->send($json_message);
                        break;
                    } 
                }
            }  
        }
        else
        {
            $decoded_message->status = "Failed";
            $json_message = json_encode($decoded_message);
            $connection->send($json_message);
        }
    }

};

$wsWorker->onClose = function($connection) use (&$active_users) {
    unset($active_users[$connection->id]);
};

Worker::runAll();