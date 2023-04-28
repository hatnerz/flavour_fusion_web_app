<?php

class Controller_Main extends Controller
{
    function action_index()
    {
        $data = array();
        $data = Meta::add_meta_data($data, "Головна", "Головна", null);
        $this->view->generate('main_view.php', 'template_view.php', $data);
    }
}