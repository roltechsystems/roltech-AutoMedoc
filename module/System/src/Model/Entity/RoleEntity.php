<?php

declare(strict_types=1);

namespace System\Model\Entity;

class RoleEntity
{

    protected $role_id;
    protected $role_name;
    protected $role_descrept;

    /**
     * Get the value of role_id
     */ 
    public function getRoleid()
    {
        return $this->role_id;
    }

    /**
     * Set the value of role_id
     *
     * @return  self
     */ 
    public function setRoleid($role_id)
    {
        $this->role_id = $role_id;

        return $this;
    }

    /**
     * Get the value of role_name
     */ 
    public function getRolename()
    {
        return $this->role_name;
    }

    /**
     * Set the value of role_name
     *
     * @return  self
     */ 
    public function setRolename($role_name)
    {
        $this->role_name = $role_name;

        return $this;
    }

    /**
     * Get the value of role_descrept
     */ 
    public function getRoledescrept()
    {
        return $this->role_descrept;
    }

    /**
     * Set the value of role_descrept
     *
     * @return  self
     */ 
    public function setRoledescrept($role_descrept)
    {
        $this->role_descrept = $role_descrept;

        return $this;
    }
}