<?php 

class Model_Recipe extends Model
{
    public $recipe_id = 0;

    public function __construct($additional_info)
    {
        $this->recipe_id = (int)$additional_info;
    }

	public function get_data()
	{	
        $article_select = DB::do_sql_select("SELECT * FROM `recipe` WHERE `recipe_id` = ?;", array($this->recipe_id));
        $article = DB::convert_result_to_array($article_select)[0];
        $article_content = explode("<**>", $article["content"]);
        $reg_ex = '/(\[.*?\])/';
        $article_steps = array();
        for($i = 0; $i < count($article_content); $i++)
        {
            $article_step = preg_split($reg_ex, $article_content[$i], -1, PREG_SPLIT_DELIM_CAPTURE);
            $article_step[1] = substr($article_step[1], 1);
            $article_step[1] = substr($article_step[1], 0, strlen($article_step[1])-1);
            $article_steps[] = array_slice($article_step, 1);
        }
        $article["content"] = $article_steps;

        $ingredients_select = DB::do_sql_select("
            SELECT `recipe_ingredient`.`recipe_ingredient_id`, `ingredient`.`ingredient_id`, `ingredient`.`name`, `recipe_ingredient`.`quantity`, `ingredient`.`measure` 
            FROM `ingredient` INNER JOIN `recipe_ingredient` ON `ingredient`.`ingredient_id` = `recipe_ingredient`.`ingredient_id` 
            WHERE `recipe_ingredient`.`recipe_id` = ?;
        ", array($this->recipe_id));

        $ingredients = DB::convert_result_to_array($ingredients_select);

        $comments_select = DB::do_sql_select("SELECT `comment`.`comment_id`, `comment`.`username`,`comment`.`date`, `comment`.`text` 
        FROM `recipe` INNER JOIN `comment` ON `recipe`.`recipe_id` = `comment`.`recipe_id` 
        WHERE `comment`.`recipe_id` = ?
        ORDER BY `comment`.`date` DESC ", array($this->recipe_id));
        $comments = DB::convert_result_to_array($comments_select);

        return array_combine(
            array("article", "ingredients", "comments"),
            array($article, $ingredients, $comments));
	}

    public function add_view()
    {
        DB::do_sql("UPDATE `recipe` SET `views` = `views` + 1 WHERE `recipe_id` = ?", array($this->recipe_id));
    }

    public function add_comment()
    {
        $username = $_POST["username"];
        $comment = $_POST["comment"];
        if($username == null || $comment == null || $this->recipe_id == null)
            return false;
        $result = DB::do_sql("INSERT INTO `comment`(`recipe_id`, `username`, `text`) VALUES(?,?,?)", array($this->recipe_id, $username, $comment));
        return $result;
    }

}