<?php 
/**
* Created by JooGii.
* User: ;
* Date: 27.10.2016;
* Time: 18:26;
*/
namespace Joomplace\Customfields\Admin\Model;

use Joomplace\Library\JooYii\Helper;
use Joomplace\Library\JooYii\Model;

defined('_JEXEC') or die;

class CustomfieldValue extends Model
{
	protected $_fields = array(
		'field' => array(
			'mysql_type' => 'int(11) unsigned',
			'type' => 'hidden',
		),
		'item' => array(
			'mysql_type' => 'int(11) unsigned',
			'type' => 'hidden',
		),
		'value' => array(
			'mysql_type' => 'text',
			'type' => 'hidden',
		)
	);

	protected function determine()
	{
		$this->_table = '#__joomplace_customfields_values';
		$this->_jsonEncode = array('value');
	}

	private function parseKey($key){
		$field = null;
		if($key){
			$field = array_pop(explode('.',$key));
		}
		return $field;
	}

	public function save($src, $orderingFilter = '', $ignore = '')
	{
		$src['field'] = $this->parseKey($src['key']);
		if(isset($src['field']) && isset($src['item'])){
			$this->load(array('field'=>$src['field'],'item'=>$src['item']));
		}
		return parent::save($src, $orderingFilter, $ignore);
	}

	public function load($keys = null, $reset = true)
	{
		if(is_array($keys) && isset($keys['key'])){
			$keys['field'] = $this->parseKey($keys['key']);
			unset($keys['key']);
//			$db = \JFactory::getDbo();
//			$db->setQuery('SELECT * FROM '.$this->_table);
//			echo "<pre>";
//			print_r($db->loadObjectList());
//			echo "</pre>";
		}
		$return = parent::load($keys, $reset);
		foreach ($this->_jsonEncode as $key){
			if(Helper::isJson($this->$key)){
				$this->$key = json_decode($this->$key);
			}
		}
		return $return;
	}
}