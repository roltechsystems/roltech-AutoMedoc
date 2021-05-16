<?php

declare(strict_types=1);

namespace System\Model\Entity;

class ModulesEntity
{
    protected $access_module_id;
    protected $module_name;
    protected $module_descrept;
    protected $module_afficher;
    protected $templateattruibute;
    protected $moduleroute;
 

    

    /**
     * Get the value of access_module_id
     */ 
    public function getAccessmoduleid()
    {
        return $this->access_module_id;
    }

    /**
     * Set the value of access_module_id
     *
     * @return  self
     */ 
    public function setAccessmoduleid($access_module_id)
    {
        $this->access_module_id = $access_module_id;

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

    /**
     * Get the value of templateattruibute
     */ 
    public function getTemplateattruibute()
    {
        return $this->templateattruibute;
    }

    /**
     * Set the value of templateattruibute
     *
     * @return  self
     */ 
    public function setTemplateattruibute($templateattruibute)
    {
        $this->templateattruibute = $templateattruibute;

        return $this;
    }

    /**
     * Get the value of moduleroute
     */ 
    public function getModuleroute()
    {
        return $this->moduleroute;
    }

    /**
     * Set the value of moduleroute
     *
     * @return  self
     */ 
    public function setModuleroute($moduleroute)
    {
        $this->moduleroute = $moduleroute;

        return $this;
    }
}