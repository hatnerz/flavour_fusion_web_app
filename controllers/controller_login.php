<?php

class Controller_Login extends Controller
{
    function __construct()
	{
		$this->model = new Model_Login();
		$this->view = new View();
	}

    function action_index()
    {
        $data = Meta::add_meta_data($data, "Авторизація", null, null);
        $this->view->generate('login_view.php', 'template_view.php', $data);
    }

    function action_check()
    {
        $login_data = $this->model->get_login_data();
        $data = $this->model->verify_password($login_data["user_login"], $login_data["password"]);
        if($data == CORRECT_AUTHENTICATION)
        {
            $this->model->set_current_user($login_data["user_login"]);
            $data = array();
            $data = Meta::add_meta_data($data, "Головна", "Головна", "Авторизація успішна");
            $this->view->generate('main_view.php', 'template_view.php', $data);
        }       
        else if($data == INCORRECT_LOGIN)
        {
            $data = array();
            $data = Meta::add_meta_data($data, "Авторизація", null, "Невірний логін");
            $this->view->generate('login_view.php', 'template_view.php', $data);
        }
        else // INCORRECT_PASSWORD
        {
            $data = array();
            $data = Meta::add_meta_data($data, "Авторизація", null, "Невірний пароль");
            $this->view->generate('login_view.php', 'template_view.php', $data);
        }
    }
}