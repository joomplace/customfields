<?php 
/**
* Created by JooGii.
* User: ;
* Date: 27.10.2016;
* Time: 18:25;
*/
namespace Joomplace\Customfields\Admin;

defined('_JEXEC') or die;

class Component extends \Joomplace\Library\JooYii\Component
{
	protected static $_default_controller = 'Customfields';

    protected function setNamespace()
    {
        $this->_namespace = __NAMESPACE__;
    }
}