<?php

class Model_Addrecipe extends Model
{
    function add_recipe($post_img, $pictures, $text, $duration, $complexity, 
                        $category, $title, $description, $user_id) {
        $content = "";

        $section_count = count($text);
        for($i = 0; $i < $section_count; $i++) {
            $content .= "[";
            $content .= $pictures['name'][$i];
            $content .= "]";
            $content .= $text[$i];
            $content .= "<**>";
        }

        $content = substr($content, 0, -4);
        $pic_path = $post_img['name'];
        $views = 0;
        $date = date('Y-m-d H:i:s');
        $recipe_id = DB::do_sql_with_id("INSERT INTO `recipe`(`title`, `description`, `content`, `complexity`, `views`, 
        `date`, `cooking_time`, `picture_path`, `category_id`, `user_ID`) 
        VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?)", 
        array($title, $description, $content, $complexity, $views, $date, $duration, $pic_path, $category, $user_id));
        
        $post_img_dir = MEDIA_PATH."recipe_img/".$recipe_id;

        mkdir($post_img_dir);

        for ($i = 0; $i < $section_count; $i++) {
            $fileName = $pictures['name'][$i];
            $fileTmpPath = $pictures['tmp_name'][$i];
            $dest = $post_img_dir."/".$fileName;
            move_uploaded_file($fileTmpPath, $dest);
        }

        $post_img_dir = MEDIA_PATH."recipes_img/";
        $fileName = $post_img['name'];
        $fileTmpPath = $post_img['tmp_name'];
        move_uploaded_file($fileTmpPath, $post_img_dir.$fileName);
    }

    function get_categories() {
        $result = DB::do_sql_select("SELECT * FROM `category` WHERE `name` <> 'Усі'");
        $categories = DB::convert_result_to_array($result);
        return array_combine(
            array("categories"),
            array($categories));
    }
}