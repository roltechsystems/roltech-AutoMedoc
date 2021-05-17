<?php
 

declare(strict_types=1);

namespace Application\Service;

use Laminas\EventManager\EventInterface;
use Laminas\EventManager\EventManagerInterface;
use Laminas\EventManager\ListenerAggregateInterface;
use Laminas\Log\Logger;
use Laminas\Mvc\MvcEvent;

class LogEvents implements ListenerAggregateInterface
{
    private $listeners = [];
    private $log; 
    private $MvcEvent; 
    private $IdentityUser;
    public function __construct(Logger $log,MvcEvent $e,$identity)
    {
        $this->log = $log; 
        $this->MvcEvent=$e;
        $this->IdentityUser=$identity;
    }

    public function attach(EventManagerInterface $events, $priority = 1)
    {
        $this->listeners[] = $events->attach("finish", [$this, 'log']);
        $this->listeners[] = $events->attach("dispatch.error", [$this, 'log']);  
        $this->listeners[] = $events->attach("isLoggedUser", [$this, 'log']);
        $this->listeners[] = $events->attach("isDeLoggedUser", [$this, 'log']);
      //  $this->listeners[] = $events->attach('doSomethingElse', [$this, 'log']);
    }

    public function detach(EventManagerInterface $events)
    {
        foreach ($this->listeners as $index => $listener) {
            $events->detach($listener);
            unset($this->listeners[$index]);
        }
    }

    public function log(EventInterface $e)
    {
        $event  = $e->getName();
 
        $routeMatch = $this->MvcEvent->getRouteMatch();   

         
        $resource =  !empty($routeMatch) ? $routeMatch->getParam('module') . DS .$routeMatch->getParam('controller') . DS . $routeMatch->getParam('action') :"";
        $email =$this->IdentityUser->email;
      //  die( $resource);
   
        $role_id=$this->IdentityUser->role_id;
        $EventToSave=\Laminas\Json\Encoder::encode(["user"=>$email,"event"=>$event,"jobs"=>["role"=> $role_id,"routes"=>$resource]]);
        $this->log->info( $EventToSave); 
    }
}