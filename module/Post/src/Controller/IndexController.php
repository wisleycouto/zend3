<?php


namespace Post\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class IndexController extends AbstractActionController
{

    protected $table;


	    public function __construct($table){
	    	$this->table =  $table;
	    }


    public function indexAction()
    {
    	$posts = $this->table->fetchAll();

    	foreach ($posts as $post) {
    		echo $post->getTitle();
    		# code...
    	}
    	exit();
        return new ViewModel();
    }
}
