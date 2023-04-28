<?php

class Controller {
	
	public $model;
	public $view;
	public $additional_info;

	function __construct($additional_info = '')
	{
		$this->view = new View();
		$this->additional_info = $additional_info;
	}
	
	function action_index()
    {
        $host = 'http://'.$_SERVER['HTTP_HOST'].'/';
        header('HTTP/1.1 404 Not Found');
		header("Status: 404 Not Found");
		header('Location:'.$host.'404');
    }
}