<?php
require_once CORE_PATH."/validator.php";



class Model_Profile extends Model{

    public function change_data($user_id, $login, $first_name, $last_name) {
        $result = DB::do_sql("UPDATE `user` SET `login` = ?, `first_name` = ?, `last_name` = ? WHERE `user_id` = ?", 
        array($login, $first_name, $last_name, $user_id));
        return $result;
    }

    public function change_password($user_id, $old_password, $new_password, $confirm_password) {
        $result = DB::do_sql_select("SELECT `password` FROM `user` WHERE `user_id` = ?", array($user_id));
        $user_password_hash = DB::convert_result_to_array($result)[0]["password"];
        if(!password_verify($old_password, $user_password_hash))
            return INCORRECT_PASSWORD;
        
        if($new_password != $confirm_password) 
            return INCORRECT_PASSWORD_CONFIRM;

        if($old_password == $new_password) 
            return PASSWORDS_MATCH;

        if(!isGoodPassword($new_password)) 
            return EASY_PASSWORD;
            
        
        $password_hash = password_hash($new_password, PASSWORD_DEFAULT);
        $result = DB::do_sql("UPDATE `user` SET `password` = ? WHERE `user_id` = ?", 
        array($password_hash, $user_id));
        if($result == true)
            return PASSWORD_CHANGED;
        else
            return ERROR;
    }

    
}