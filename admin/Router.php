<?php 
/**
* Created by JooGii.
* User: ;
* Date: 27.10.2016;
* Time: 18:25;
*/
namespace Joomplace\Customfields\Admin;

use Joomplace\Library\JooYii\Router as BaseRouter;

defined('_JEXEC') or die;

jimport('JooYii.autoloader',JPATH_LIBRARIES);

class Router extends BaseRouter
{

    protected function setNamespace()
    {
        $this->_namespace = __NAMESPACE__;
    }

}