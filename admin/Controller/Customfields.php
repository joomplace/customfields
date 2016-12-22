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
	protected $context;
	protected $extension;

	public function preInitialize($context, $extension){
		$this->context = $context;
		$this->extension = $extension;
	}

	public function getModel($modelname = 'Customfield', $force_new = false)
	{
		if(is_null($modelname)){
			$modelname = 'Customfield';
		}
		return parent::getModel($modelname, $force_new);
	}

	public function index($limit = false, $limitstart = 0, $view = false)
	{
		$sidebar_class = '\\Joomplace\\'.ucfirst(str_replace('com_','',$this->extension)).'\\Admin\\Helper\\Sidebar';
		$sidebar_function = 'setControllersEntries';
		if(class_exists($sidebar_class)){
			$sidebar_class::$sidebar_function('Customfields',$this->context);
		}
		parent::index($limit, $limitstart, $view);
	}

	protected function preRender($viewname, $layout, &$vars)
	{
		$vars['context'] = $this->context;
		$vars['extension'] = $this->extension;
	}

	public function generateNewBtn($appendix = '')
	{
		$appendix .= '&context='.$this->context;
		$appendix .= '&extension='.$this->extension;
		parent::generateNewBtn($appendix);
	}

	public function generateCancelBtn($appendix = '')
	{
		$appendix .= '&context='.$this->context;
		$appendix .= '&extension='.$this->extension;
		parent::generateCancelBtn($appendix);
	}


}