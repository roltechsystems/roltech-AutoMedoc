<?php

declare(strict_types=1);

namespace System\Model\Entity;

class AccessResourcesEntity
{
    protected $resource_id; 
    protected $module; 
    protected $controller;  
    protected $action;  
    protected $idaccessmodules; 
    protected $resources_descrept;  
    protected $idaccessmode;
    
    protected $labelaccessmode;//#access_mode Label
    protected $descaccessmode;//#access_mode Descreption

    protected $module_name;//#access_modules Name de module service
    protected $module_descrept;//#access_modules Descreption
    protected $module_afficher;//#access_modules si il va étre afficher ou pas dans le view


    /**
     * Get the value of resource_id
     */ 
    public function getResourceid()
    {
        return $this->resource_id;
    }

    /**
     * Set the value of resource_id
     *
     * @return  self
     */ 
    public function setResourceid($resource_id)
    {
        $this->resource_id = $resource_id;

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
     * Get the value of resources_descrept
     */ 
    public function getResourcesdescrept()
    {
        return $this->resources_descrept;
    }

    /**
     * Set the value of resources_descrept
     *
     * @return  self
     */ 
    public function setResourcesdescrept($resources_descrept)
    {
        $this->resources_descrept = $resources_descrept;

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