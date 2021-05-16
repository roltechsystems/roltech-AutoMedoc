<?php
declare(strict_types = 1);
/**
 * Created by PhpStorm.
 * User: username
 * Date: 30/01/2017
 * Time: 16:44
 */

namespace User\Navigator\Service;
use Laminas\Navigation\Service\DefaultNavigationFactory;


class UserNavigationFactory extends DefaultNavigationFactory
{
    protected function getName()
    {
        return 'System_Navigator';
    }
}