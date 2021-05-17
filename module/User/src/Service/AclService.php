<?php

declare(strict_types=1);

namespace User\Service;

use Laminas\Permissions\Acl\Acl; # add this
use Laminas\Permissions\Acl\Resource\GenericResource;
use Laminas\Permissions\Acl\Role\GenericRole; # add this
use User\Model\Table\PrivilegesTable;

class AclService extends Acl
{
    protected $privilegesTable;

    public function __construct(PrivilegesTable $privilegesTable)
    {
        $this->privilegesTable = $privilegesTable;
    }

    # create a method that will grant roles access to resources
    public function grantAccess()
    {
        foreach($this->privilegesTable->fetchAllResources() as $table) { 
            # we check if a role is already set or not
            # if not set, add it
            if(!$this->hasRole($table->getRolename())) {
                $role = new GenericRole($table->getRolename());
                $this->addRole($role);
            } else {
                $role = $this->getRole($table->getRolename());
            }

            # check resources
            if(!$this->hasResource($table->getResource())) {
                $resource = new GenericResource($table->getResource());
                $this->addResource($resource);
            } else {
                $resource = $this->getResource($table->getResource());
            }

            # most important part
            $this->allow($role, $resource);  
        }

       
    }
    
    # next create a method that checks whether a role is allowed access to a resource
    public function isAuthorized($role = null, $resource = null)
    {
        //echo $role;echo $resource;
        if(null === $role || (!$this->hasRole($role))) {
            return false;
        }
        //echo "role:".$role." Ressource: ".$resource;
        if(null === $resource || (!$this->hasResource($resource))) {
            return false;
        }
        
        return $this->isAllowed($role, $resource);
    }
}
