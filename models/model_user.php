<?php

class User extends Model
{
    public $id;
    public $login;
    public $first_name;
    public $last_name;
    public $role_id;
    public $profile_img;
    public function __construct($id, $login, $first_name, $last_name, $role_id, $profile_img)
    {
        $this -> login = $login;
        $this -> first_name = $first_name;
        $this -> last_name = $last_name;
        $this -> id = $id;
        $this -> role_id = $role_id;
        $this -> profile_img = $profile_img;
    }

    public static function get_user_from_db($login)
    {
        $result_select = DB::do_sql_select("SELECT * FROM `user` WHERE `login` = ?", array($login));
        $result = DB::convert_result_to_array($result_select)[0];
        if($result != null)
        {
            $user = new User($result['user_id'], $result['login'], $result['first_name'], $result['last_name'], $result['role_id'], $result["profile_img"]);
            return $user;
        }
        else
            return null;
    }
}