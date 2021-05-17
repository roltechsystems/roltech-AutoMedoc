<?php
/**
 * Created by oussama limam.
 * User: o.limam
 * Date: 11/04/2018
 * Time: 15:42
 */

namespace Limostr\Tools;

use Laminas\Session\Container;
abstract class GenericParams
{
    const __NAME_CONTAINER__='Roltechsystem';
    const __NAME_YEAR__='Acruel';
    const __NAME_ACTIVE_FORM__='Activ_Form';

    static $__DB_ADAPTER__=NULL;

    public static function __getParamUniv(){
        $session = new Container(self::__NAME_CONTAINER__);
        return $session->getArrayCopy();
    }

    public static function __setYear($year){
        $session = new Container(self::__NAME_CONTAINER__);
        $session->offsetSet(self::__NAME_YEAR__,$year);
    }

    public static function __getYear($adapter=NULL){
        $session = new Container(self::__NAME_CONTAINER__);
        $year=$session->offsetGet(self::__NAME_YEAR__);
         
        return $year;
    }


    public static function __setActivForm($ActivForm){
        $session = new Container(self::__NAME_CONTAINER__);
        $session->offsetSet(self::__NAME_ACTIVE_FORM__,$ActivForm);
    }

    public static function __getActivForm(){
        $session = new Container(self::__NAME_CONTAINER__);
        $session->offsetGet(self::__NAME_ACTIVE_FORM__);
    }

    public static function __setOtherParam($pramName,$paramValue){
        $session = new Container(self::__NAME_CONTAINER__);
        $session->offsetSet($pramName,$paramValue);
    }

    public static function __GetOtherParam($paramName){
        $session = new Container(self::__NAME_CONTAINER__);
        $session->offsetGet($paramName);
    }

    public static function __getInfoUserLogged(){
        $session=new Container("user");
        $user=$session->offsetGet("infologged");
        return $user;
    }

}