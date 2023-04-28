<?php

class Controller_Recipes extends Controller
{
    function __construct()
	{
		$this->model = new Model_Recipes();
		$this->view = new View();
	}

    function action_index()
    {
        $data = $this->model->get_data();
        $data = Meta::add_meta_data($data, "Рецепти", "Рецепти", null);
        $this->view->generate('recipes_view.php', 'template_view.php', $data);
    }

}