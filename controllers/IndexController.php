<?php
namespace App\Controllers;

use App\Libs\ControllerBase;

class IndexController extends ControllerBase
{
    //Go to index
    public function index()
    {
        error_log("Index controller and action called!");
	    $vars['dummy'] = 0;
		
        $this->view->show("home.php", $vars);
    }
	
    //Go to error index
    public function indexErrorLogin()
    {
	$vars['error'] = 1;
		
        $this->view->show("home.php", $vars);
    }
}