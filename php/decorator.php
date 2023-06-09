<?php

function logUser(User $user)
{
    $logFile = USER_LOG_PATH;

    $logMessage = "User ID: {$user->id}\n";
    $logMessage .= "Login: {$user->login}\n";
    $logMessage .= "First Name: {$user->first_name}\n";
    $logMessage .= "Last Name: {$user->last_name}\n";
    $logMessage .= "Timestamp: " . date('Y-m-d H:i:s') . "\n";

    file_put_contents($logFile, $logMessage, FILE_APPEND);
}