<?php

/**
 * @see       https://github.com/laminas/laminas-mvc-skeleton for the canonical source repository
 * @copyright https://github.com/laminas/laminas-mvc-skeleton/blob/master/COPYRIGHT.md
 * @license   https://github.com/laminas/laminas-mvc-skeleton/blob/master/LICENSE.md New BSD License
 */

declare(strict_types=1);

namespace Application;

use Application\Service\LogEvents;
use Laminas\Db\Adapter\Adapter;
use Laminas\Http\Response; # <- add this
use Laminas\Mvc\MvcEvent; # add this
use System\Model\Table\AccessMenuTable;
use Laminas\Authentication\AuthenticationService;
class Module
{
    public function getConfig() : array
    {
        return include __DIR__ . '/../config/module.config.php';
    }


    public function onBootstrap(MvcEvent $event) 
    {
        $app = $event->getApplication();
        $eventManager = $app->getEventManager();

       
      $eventManager->attach($event::EVENT_DISPATCH, [$this, 'getMenuEvent']);
    
        //create log database
        # make sure whoever accesses this page is logged in
		$auth = new AuthenticationService();
		if($auth->hasIdentity()) {
            $container = $app->getServiceManager();
            $dbAdapter = $container->get(Adapter::class);
    
            $logger = new \Laminas\Log\Logger;
    
          /*  $mapping = [
                'dateevent' => 'date',
                'levelevent'  => 'type',
                'eventmessage'   => 'event', 
            ];*/
            $mapping = [
                'timestamp' => 'dateevent',
                'priority'  => 'levelevent',
                'message'   => 'eventmessage',
                 $auth->getIdentity()->email=>'email',
            ];
    
           
            $writer = new \Laminas\Log\Writer\Db($dbAdapter,'access_log', $mapping);
           
            $logger->addWriter($writer);
            $logListener = new LogEvents($logger,$event,$auth->getIdentity());
            $logListener->attach($eventManager);

           
		} 
    }

    public function getServiceConfig(): array 
    {
    	return [
    		'factories' => [
                "adapter" => function($sm) {
                    $dbAdapter = $sm->get(Adapter::class);
                    return new AccessMenuTable($dbAdapter);
                },
            ]
        ];
    }
    public function getMenuEvent(MvcEvent $mvcEvent)
    {
        $auth = new AuthenticationService();
        $user = $auth->getIdentity();
        $services = $mvcEvent->getApplication()->getServiceManager();
        $adapter  = $services->get("adapter");

        $event = $mvcEvent->getName();
        $params = $mvcEvent->getParams();
        $routeMatch = $mvcEvent->getRouteMatch();
       // print_r($user);die();

    }

    public function logEvents(MvcEvent $mvcEvent)
    {

    }
}
