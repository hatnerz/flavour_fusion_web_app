<?php

class Model_Login extends Model{
    
    function get_login_data()
    {
        $user_login = $_POST["username"];
        $password = $_POST["password"];
        return array(
            "user_login" => $user_login,
            "password" => $password
        );
    }
    function verify_password($user_login, $password)
    {
        $result = DB::do_sql_select("SELECT `password` FROM `user` WHERE `login` = ?", array($user_login));
        $hashedPassword = DB::convert_result_to_array($result)[0]["password"];
        if($hashedPassword == null) {
            return INCORRECT_LOGIN;
        }
        if (password_verify($password, $hashedPassword)) {
            return CORRECT_AUTHENTICATION;
        } else {
            return INCORRECT_PASSWORD;
        }
    }

    function set_current_user($user_login)
    {
        $_SESSION["user"] = $user_login;
    }

}