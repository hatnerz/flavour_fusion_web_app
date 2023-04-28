<?php

class User extends Model
{
    public $login;
    public $first_name;
    public $last_name;
    public function __construct($login, $first_name, $last_name)
    {
        $this -> login = $login;
        $this -> first_name = $first_name;
        $this -> last_name = $last_name;
    }

    public static function get_user_from_db($login)
    {
        $result_select = DB::do_sql_select("SELECT * FROM `user` WHERE `login` = ?", array($login));
        $result = DB::convert_result_to_array($result_select)[0];
        if($result != null)
        {
            $user = new User($result['login'], $result['first_name'], $result['last_name']);
            return $user;
        }
        else
            return null;
    }
}