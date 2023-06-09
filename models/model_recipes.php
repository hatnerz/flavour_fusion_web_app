<?php 

class Model_Recipes extends Model
{
    public $page = 1;
    public $filter_id = 1;

    public function __construct()
    {
        if(!empty($_GET['page']))
            $this->page = (int)$_GET['page'];
        if(!empty($_GET['filter']))
            $this->filter_id = (int)$_GET['filter'];
    }

	public function get_data()
	{	
        $recipes_count = 9;
        $categories = DB::do_sql_select("SELECT * FROM `category`");
        $categories_array = DB::convert_result_to_array($categories);
        if($this->filter_id == 1)
        {
            $recipes = DB::do_sql_select("SELECT * FROM `recipe` LIMIT ?, $recipes_count", array($recipes_count*($this->page - 1)));
            $recipes_all = DB::do_sql_select("SELECT COUNT(*) FROM `recipe`");
        }
        else
        {
            $recipes = DB::do_sql_select("SELECT * FROM `recipe` WHERE `category_id` = ? LIMIT ?, $recipes_count", array($this->filter_id, $recipes_count*($this->page - 1)));
            $recipes_all = DB::do_sql_select("SELECT COUNT(*) FROM `recipe` WHERE `category_id` = ?", array($this->filter_id));
        }
        $recipes_found = mysqli_fetch_row($recipes_all)[0];
        $pages_count = intdiv($recipes_found-1,$recipes_count)+1;
        
        $recipes_array = DB::convert_result_to_array($recipes);
        return array_combine(
            array("categories_array", "recipes_array", "page", "filter_id", "recipes_found", "pages_count"),
            array($categories_array, $recipes_array, $this->page, $this->filter_id, $recipes_found, $pages_count));
	}
}