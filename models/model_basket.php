<?php

class Model_Basket extends Model
{
    public function add_ingredients()
    {
        $ingredients = $_POST['ingredients'];
        $placeholders = rtrim(str_repeat('?,', count($ingredients)), ',');
        $result = DB::do_sql_select("SELECT `recipe_ingredient`.`recipe_ingredient_id`, `recipe`.`title`, `ingredient`.`ingredient_id`, `ingredient`.`name`, 
            `recipe_ingredient`.`quantity`, `ingredient`.`measure` 
            FROM `ingredient` INNER JOIN `recipe_ingredient` ON `ingredient`.`ingredient_id` = `recipe_ingredient`.`ingredient_id` 
            INNER JOIN `recipe` ON `recipe`.`recipe_id` = `recipe_ingredient`.`recipe_id` 
            WHERE `recipe_ingredient`.`recipe_ingredient_id` IN ($placeholders)", $ingredients);
        $new_ingredients = DB::convert_result_to_array($result);
        
        if(!isset($_SESSION['ingredients']))
        {
            $_SESSION['ingredients'] = $new_ingredients;
        }
        else
        {
            $_SESSION['ingredients'] = array_merge($_SESSION['ingredients'], $new_ingredients);
        }
    }

    public function remove_ingredients()
    {
        $ingredients_remove = $_POST['ingredients'];
        if($ingredients_remove == null)
            return;
        if(count($ingredients_remove) == 0)
            return;
        if(!isset($_SESSION['ingredients']))
            return;
        else
        {
            foreach ($ingredients_remove as $ingredient_remove)
            {
                foreach (array_keys($_SESSION['ingredients']) as $ingredient)
                {
                    if($_SESSION['ingredients'][$ingredient]['recipe_ingredient_id'] == $ingredient_remove)
                    {
                        unset($_SESSION['ingredients'][$ingredient]);
                        break;
                    }
                }
            }
        }
    }



    public function get_data()
    {
        if(!isset($_SESSION['ingredients']))
        {
            return array_combine(
                array("recipes"),
                array(null));
        }
        else
        {
            $temp_ingredients = $_SESSION['ingredients'];
            $ingredients = array();
            foreach ($temp_ingredients as $ingredient) 
            {
                $recipe = $ingredient['title'];
                if (isset($ingredients[$recipe])) 
                {
                    $ingredients[$recipe][] = $ingredient;
                } 
                else 
                {
                    $ingredients[$recipe] = array($ingredient);
                }
            }
            return array_combine(
                array("recipes"),
                array($ingredients));
        }
        
        
    }
}