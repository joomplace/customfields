<?php
/**
 * @package     Joomplace\Library\JooYii
 * @subpackage  Joomplace\Library\JooYii\Fields
 *
 * @copyright   Alexandr Kosarev
 * @license     GPL2
 */

namespace Joomplace\Customfields\Admin\Fields;
use Joomplace\Library\JooYii\Loader;

defined('_JEXEC') or die;

/**
 * Dynamic list field type
 *
 * @package     Joomplace\Library\JooYii\Fields
 *
 * @since       1.0
 */
class FieldDefinition extends \JFormField
{
	/**
	 * Fully qualified class name
	 *
	 * @var string
	 * @since 1.0
	 */
	protected $type = '\\Joomplace\\Customfields\\Admin\\Fields\\FieldDefinition';
	/** @var array $_options Options store */
	protected $_options = array();

	protected function getInput()
	{
		list($def_path) = Loader::getPathByPsr4('Joomplace\\Customfields\\Admin\\Layouts\\', '/');
		$params = $this->readParams();
		$html = \JLayoutHelper::render('form.definition', $params, $def_path);
		return $html;
	}

	protected function readParams(){
		$params = array();
		foreach ($this as $k => $item){
			if(!is_array($item)){
				$params[$k] = $item;
			}
		}
		return $params;
	}

	public static function renderHtml($row,$field){
		$row[$field] = json_decode($row[$field]);
		echo $row[$field]->label.' ['.$row[$field]->type.']';
	}

}