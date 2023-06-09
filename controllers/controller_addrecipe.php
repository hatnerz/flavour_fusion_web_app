<?php

class Controller_Addrecipe extends Controller
{
    function __construct()
	{
		$this->model = new Model_Addrecipe();
		$this->view = new View();
	}

    function action_index()
    {
        $data = array();
        $data = Meta::add_meta_data($data, "Додавання рецепту", null, null);
        $this->view->generate('addrecipe_view.php', 'template_view.php', $data);
    }

    function action_add()
    {
        $data = $this->model->get_data();
        $data = Meta::add_meta_data($data, "Додавання рецепту", null, null);

        $post_img = $_FILES["img-input_file"];
        $pictures = $_FILES["section-input_file"];
        $text = $_POST["section-input_text"];
        $duration = $_POST["duration"];
        $complexity = $_POST["complexity"];
        $category = $_POST["category"];
        $title = $_POST["title"];
        $user_id = $data['user']->id;
        $description = $_POST["description"];
        $this->model->add_recipe($post_img, $pictures, $text, $duration, 
                             $complexity, $category, $title, $description, $user_id);
    
        $data = array();
        $data = Meta::add_meta_data($data, "Рецепти", null, "Рецепт додано");
        $this->view->generate('profile_view.php', 'template_view.php', $data);

    }

}