<?php

class Controller_Contact extends Controller
{
    function action_index()
    {
        $data = array();
        $data = Meta::add_meta_data($data, "Контакти", "Контакти", null);
        $this->view->generate('contact_view.php', 'template_view.php', $data);
    }
}
