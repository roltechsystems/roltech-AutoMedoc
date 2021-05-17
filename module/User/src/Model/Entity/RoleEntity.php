<?php

declare(strict_types=1);

namespace User\Model\Entity;

class RoleEntity
{
    protected $role_id;
    protected $role_name;
    protected $role_descrept;


    public function getRoledescrept()
    {
        return $this->role_descrept;
    }

    public function setRoledescrept($role_descrept)
    {
        $this->role_descrept = $role_descrept;
        return $this;
    }


    public function getRoleId()
    {
        return $this->role_id;
    }

    public function setRoleId($role_id)
    {
        $this->role_id = $role_id;
        return $this;
    }

    public function getRolename()
    {
        return $this->role_name;
    }

    public function setRolename($role_name)
    {
        $this->role_name = $role_name;
        return $this;
    }
}