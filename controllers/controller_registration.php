<?php

class Controller_Registration extends Controller
{
    function __construct()
	{
		$this->model = new Model_Registration();
		$this->view = new View();
	}

    function action_index()
    {
        $this->view->generate('registration_view.php', 'template_view.php');
    }

    function action_register()
    {
        $result = $this->model->register_user();
        $notification = null;
        $view = null;
        if($result == SUCCESS)
        {
            $view = 'main_view.php';
            $page_title = "Головна";
            $choosen_page = $page_title;
            $notification = "Реєстрація успішна";
        }
        else if ($result == LOGIN_ALREADY_IN_USE)
        {
            $view = 'registration_view.php';
            $page_title = "Реєстрація";
            $notification = "Логін вже використовується";
        }
        else // FAILED
        {
            $view = 'registration_view.php';
            $page_title = "Реєстрація";
            $notification = "Виникла помилка при реєстрації. Спробуйте пізніше";
        }

        $data = array();
        $data = Meta::add_meta_data($data, $page_title, $choosen_page, $notification);
        $this->view->generate($view, 'template_view.php', $data);
    }

    function check_data()
    {
        $login_data = $this->mode->get_login_data();
        $data = $this->model->verify_password($login_data["user_login"], $login_data["password"]);
        if($data == CORRECT_AUTHORIZATION)
        {
            $this->model->set_current_user($login_data["user_login"]);
        }       
        else if($data == INCORRECT_LOGIN)
        {
            $this->view->generate_view('login_view.php', 'template_view.php');
        }
        else // INCORRECT_PASSWORD
        {
            $this->view->generate_view('login_view.php', 'template_view.php');
        }
    }

}