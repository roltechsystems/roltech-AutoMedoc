<?php 

declare(strict_types=1);

namespace Article\Controller;

 
use Laminas\Mvc\Controller\AbstractActionController;
use Laminas\View\Model\ViewModel; 
use Laminas\View\Model\JsonModel;  

class ArticleController   extends AbstractActionController
{

    public function indexAction()
    {
        $v1=5;
        $v2=6;
        $v3=$v1+$v2;
        $view = new ViewModel(["v1"=>$v1,"v2"=>$v2,'res'=>$v3]); 
		return $view->setTemplate('Index/index');
    }
    public function addAction()
    {
        $v1=5;
        $v2=6;
        $v3=$v1+$v2;
        $view = new ViewModel(["v1"=>$v1,"v2"=>$v2,'res'=>$v3]); 
		return $view->setTemplate('Index/add');
    }

}