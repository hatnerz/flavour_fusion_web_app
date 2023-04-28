<?php

class Controller_Chat extends Controller
{

    function action_index()
    {
        $data = array();
        $data = Meta::add_meta_data($data, "Чат", "Чат", null);
        $this->view->generate('chat_view.php', 'template_view.php', $data);
    }

}