<?php

class Controller_Recipe extends Controller
{
    function __construct($additional_info = '')
	{
        $this->additional_info = $additional_info;
        if($additional_info == '') {}
        else {
		    $this->model = new Model_Recipe($this->additional_info);
		    $this->view = new View();
        }
	}

    function action_index()
    {
        header("Location: /recipes");
        exit();
    }
    function action_list()
    {
        $this->model->add_view();
        $data = $this->model->get_data();
        $data = Meta::add_meta_data($data, $data["article"]["title"], null, null);
        $this->view->generate('recipe_view.php', 'template_view.php', $data);
    }
    
	function action_add_ingredients()
	{
        include ROOT."/models/model_basket.php";
        $this->model = new Model_Basket();
		$this->model->add_ingredients();
        header("Location: ".$_SERVER['HTTP_REFERER']);
        exit();
    }

    function action_add_comment()
    {
        $result = $this->model->add_comment();
        header("Location: ".$_SERVER['HTTP_REFERER']);
        exit();
    }

    function action_change_like()
    {
        $data = $this->model->get_data();
        $data = Meta::add_meta_data($data, "", null, null);
        if($data['user'] == null) {
            $data = Meta::add_meta_data($data, $data["article"]["title"], null, "Для того, щоб вставити лайки, потрібно авторизуватися");
            $this->view->generate('recipe_view.php', 'template_view.php', $data);
        }
        else {
            $this->model->change_like($data['user']->id, $data['has_user_like']);
            header("Location: ".$_SERVER['HTTP_REFERER']);
            exit();
        }
    }
}