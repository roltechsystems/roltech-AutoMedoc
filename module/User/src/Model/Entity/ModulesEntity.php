<?php

declare(strict_types=1);

namespace User\Model\Entity;

class ModulesEntity
{

    private $role_id;
    private $role_name; 
    
    private $module;
    private $controller;
    private $action;
    private $idaccessmodules;
    private $idaccessmode;
    
    
    private $labelaccessmode;
    private $descaccessmode;
    
    
    private $module_name;
    private $module_descrept;
    private $module_afficher;
    

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
     * Get the value of module
     */ 
    public function getModule()
    {
        return $this->module;
    }

    /**
     * Set the value of module
     *
     * @return  self
     */ 
    public function setModule($module)
    {
        $this->module = $module;

        return $this;
    }

    /**
     * Get the value of controller
     */ 
    public function getController()
    {
        return $this->controller;
    }

    /**
     * Set the value of controller
     *
     * @return  self
     */ 
    public function setController($controller)
    {
        $this->controller = $controller;

        return $this;
    }

    /**
     * Get the value of action
     */ 
    public function getAction()
    {
        return $this->action;
    }

    /**
     * Set the value of action
     *
     * @return  self
     */ 
    public function setAction($action)
    {
        $this->action = $action;

        return $this;
    }

    /**
     * Get the value of idaccessmodules
     */ 
    public function getIdaccessmodules()
    {
        return $this->idaccessmodules;
    }

    /**
     * Set the value of idaccessmodules
     *
     * @return  self
     */ 
    public function setIdaccessmodules($idaccessmodules)
    {
        $this->idaccessmodules = $idaccessmodules;

        return $this;
    }

    /**
     * Get the value of idaccessmode
     */ 
    public function getIdaccessmode()
    {
        return $this->idaccessmode;
    }

    /**
     * Set the value of idaccessmode
     *
     * @return  self
     */ 
    public function setIdaccessmode($idaccessmode)
    {
        $this->idaccessmode = $idaccessmode;

        return $this;
    }

    /**
     * Get the value of labelaccessmode
     */ 
    public function getLabelaccessmode()
    {
        return $this->labelaccessmode;
    }

    /**
     * Set the value of labelaccessmode
     *
     * @return  self
     */ 
    public function setLabelaccessmode($labelaccessmode)
    {
        $this->labelaccessmode = $labelaccessmode;

        return $this;
    }

    /**
     * Get the value of descaccessmode
     */ 
    public function getDescaccessmode()
    {
        return $this->descaccessmode;
    }

    /**
     * Set the value of descaccessmode
     *
     * @return  self
     */ 
    public function setDescaccessmode($descaccessmode)
    {
        $this->descaccessmode = $descaccessmode;

        return $this;
    }

    /**
     * Get the value of module_name
     */ 
    public function getModulename()
    {
        return $this->module_name;
    }

    /**
     * Set the value of module_name
     *
     * @return  self
     */ 
    public function setModulename($module_name)
    {
        $this->module_name = $module_name;

        return $this;
    }

    /**
     * Get the value of module_descrept
     */ 
    public function getModuledescrept()
    {
        return $this->module_descrept;
    }

    /**
     * Set the value of module_descrept
     *
     * @return  self
     */ 
    public function setModuledescrept($module_descrept)
    {
        $this->module_descrept = $module_descrept;

        return $this;
    }

    /**
     * Get the value of module_afficher
     */ 
    public function getModuleafficher()
    {
        return $this->module_afficher;
    }

    /**
     * Set the value of module_afficher
     *
     * @return  self
     */ 
    public function setModuleafficher($module_afficher)
    {
        $this->module_afficher = $module_afficher;

        return $this;
    }
}