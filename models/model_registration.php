<?php

define("LOGIN_ALREADY_IN_USE", 0);
define("SUCCESS", 1);
define("FAILED", -1);

class Model_Registration extends Model{
    function register_user()
    {
        $login = $_POST["username"];
        $password = $_POST["password"];
        $password_hash = password_hash($password, PASSWORD_DEFAULT);
        $first_name = $_POST["first-name"];
        $last_name = $_POST["last-name"];
        $login_select = DB::do_sql_select("SELECT * FROM `user` WHERE `login` = ?", array($login));
        if(mysqli_num_rows($login_select) != 0)
            return LOGIN_ALREADY_IN_USE;
        $result = DB::do_sql("INSERT INTO `user`(`login`, `password`, `first_name`, `last_name`, `role_id`) VALUES (?,?,?,?,?)",
        array($login, $password_hash, $first_name, $last_name, 2));
        if($result == true)
        {
            $_SESSION["user"] = $login;
            return SUCCESS;
        }
        else
            return FAILED;
    }
}