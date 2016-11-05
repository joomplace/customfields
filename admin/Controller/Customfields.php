<?php 
/**
* Created by JooGii.
* User: ;
* Date: 27.10.2016;
* Time: 18:25;
*/
namespace Joomplace\Customfields\Admin\Controller;

use Joomplace\Library\JooYii\Controller;

defined('_JEXEC') or die;

class Customfields extends Controller
{
	public function getModel($modelname = 'Customfield', $force_new = false)
	{
		if(is_null($modelname)){
			$modelname = 'Customfield';
		}
		return parent::getModel($modelname, $force_new);
	}

	public function index($limit = false, $limitstart = 0, $view = false, $context, $extention)
	{
		parent::index($limit, $limitstart, $view);
	}

	protected function preRender($viewname, $layout, &$vars)
	{
		$vars['context'] = \JFactory::getApplication()->input->get('context');
		$vars['extension'] = \JFactory::getApplication()->input->get('extension');
	}

}