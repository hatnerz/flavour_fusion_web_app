<?php

class Meta extends Model
{
    static function add_meta_data($data, $page_title = "Flavour Fusion", $choosen_page = null, $notification_text = null)
    {
        $user = null;
        if(isset($_SESSION["user"]))
        {
            $login = $_SESSION["user"];
            $user = User::get_user_from_db($login);
        }
        $data["page_title"] = $page_title;
        $data["choosen_page"] = $choosen_page;
        $data["notification_text"] = $notification_text;
        $data["user"] = $user;
        return $data;
    }
}