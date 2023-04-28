<?php

class Controller_Basket extends Controller
{
    function __construct()
	{
		$this->model = new Model_Basket();
		$this->view = new View();
	}

    function action_index()
    {
        $data = $this->model->get_data();
        $data = Meta::add_meta_data($data, "Органайзер", null, null);
        $this->view->generate('basket_view.php', 'template_view.php', $data);
    }

    function action_remove_ingredients()
	{
        require_once ROOT."/models/model_basket.php";
        $this->model = new Model_Basket();
		$this->model->remove_ingredients();
        header("Location: ".$_SERVER['HTTP_REFERER']);
    }
}