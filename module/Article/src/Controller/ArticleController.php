<?php 

declare(strict_types=1);

namespace Article\Controller;

 
use Laminas\Mvc\Controller\AbstractActionController;
use Laminas\View\Model\ViewModel; 
use Laminas\View\Model\JsonModel;   
use Interop\Container\ContainerInterface;
 
use RuntimeException; 
 
use Laminas\Db\Adapter\Adapter;
use Laminas\View\Renderer\PhpRenderer;

class ArticleController   extends AbstractActionController
{
    private $Container;
    private $adapter;
 
	public function __construct(ContainerInterface $Container)
    { 
        $this->Container = $Container;
        $this->adapter=$this->Container->get(\Laminas\Db\Adapter\AdapterInterface::class);
      //  $this->layout()->setTemplate('Candidat/index-layout');
    }

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

    public function saveAction(){
        
    }

    public function infoArticleAction(){
        
    }

}