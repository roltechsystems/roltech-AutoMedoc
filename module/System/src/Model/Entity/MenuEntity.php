<?php
declare(strict_types=1);
namespace System\Model\Entity;
//access_menu_id, submenuid, menu_label, menuroute, menu_help, resource_id, ordreaffichage, templatemenuattribute
class MenuEntity
{
    protected $access_menu_id; 
    protected $submenuid;
    protected $menu_label; 
    protected $menuroute;
    protected $menu_help;
    protected $resource_id; 
    protected $ordreaffichage; 
    protected $templatemenuattribute;
    protected $idaccessmodule;
    protected $module_name;


    protected $module; #ressource
    protected $controller;   #ressource
    protected $action;   #ressource 
    protected $resources_descrept;   #ressource

    protected $labelaccessmode;//#access_mode Label
    protected $descaccessmode;//#access_mode Descreption

    protected $module_descrept;//#access_modules Descreption
    protected $module_afficher;//#access_modules si il va étre afficher ou pas dans le view





    /**
     * Get the value of access_menu_id
     */ 
    public function getAccessmenuid()
    {
        return $this->access_menu_id;
    }

    /**
     * Set the value of access_menu_id
     *
     * @return  self
     */ 
    public function setAccessmenuid($access_menu_id)
    {
        $this->access_menu_id = $access_menu_id;

        return $this;
    }

    /**
     * Get the value of submenuid
     */ 
    public function getSubmenuid()
    {
        return $this->submenuid;
    }

    /**
     * Set the value of submenuid
     *
     * @return  self
     */ 
    public function setSubmenuid($submenuid)
    {
        $this->submenuid = $submenuid;

        return $this;
    }

    /**
     * Get the value of menu_label
     */ 
    public function getMenulabel()
    {
        return $this->menu_label;
    }

    /**
     * Set the value of menu_label
     *
     * @return  self
     */ 
    public function setMenulabel($menu_label)
    {
        $this->menu_label = $menu_label;

        return $this;
    }

    /**
     * Get the value of menuroute
     */ 
    public function getMenuroute()
    {
        return $this->menuroute;
    }

    /**
     * Set the value of menuroute
     *
     * @return  self
     */ 
    public function setMenuroute($menuroute)
    {
        $this->menuroute = $menuroute;

        return $this;
    }

    /**
     * Get the value of menu_help
     */ 
    public function getMenuhelp()
    {
        return $this->menu_help;
    }

    /**
     * Set the value of menu_help
     *
     * @return  self
     */ 
    public function setMenuhelp($menu_help)
    {
        $this->menu_help = $menu_help;

        return $this;
    }

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
     * Get the value of ordreaffichage
     */ 
    public function getOrdreaffichage()
    {
        return $this->ordreaffichage;
    }

    /**
     * Set the value of ordreaffichage
     *
     * @return  self
     */ 
    public function setOrdreaffichage($ordreaffichage)
    {
        $this->ordreaffichage = $ordreaffichage;

        return $this;
    }

    /**
     * Get the value of templatemenuattribute
     */ 
    public function getTemplatemenuattribute()
    {
        return $this->templatemenuattribute;
    }

    /**
     * Set the value of templatemenuattribute
     *
     * @return  self
     */ 
    public function setTemplatemenuattribute($templatemenuattribute)
    {
        $this->templatemenuattribute = $templatemenuattribute;

        return $this;
    }

    /**
     * Get the value of idaccessmodule
     */ 
    public function getIdaccessmodule()
    {
        return $this->idaccessmodule;
    }

    /**
     * Set the value of idaccessmodule
     *
     * @return  self
     */ 
    public function setIdaccessmodule($idaccessmodule)
    {
        $this->idaccessmodule = $idaccessmodule;

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
}