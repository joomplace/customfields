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

	public function getListQuery($conditioner = array())
	{
		if(is_array($conditioner) && isset($conditioner['key'])){
			$conditioner['field'] = $this->parseKey($conditioner['key']);
			unset($conditioner['key']);
		}
		if(is_array($conditioner) && isset($conditioner['context'])){
			$context = $conditioner['context'];
			unset($conditioner['context']);
		}
		$query = parent::getListQuery($conditioner);
		if(isset($context)){
			$cfields_model = new Customfield();
			$db = $this->getDbo();
			$query->leftJoin($db->qn($cfields_model->_table,'cf').' ON '.$db->qn('cf.id').'='.$db->qn('field'));
			$query->where($db->qn('cf.context').'='.$db->q($context));
		}
		return $query;
	}

	public function getList($limitstart = false, $limit = false, $conditioner = array(), $by = 'field')
	{
		$list = parent::getList($limitstart, $limit, $conditioner, $by);
		array_walk($list, function(&$item){
			foreach ($item->_jsonEncode as $key){
				if(Helper::isJson($item->$key)){
					$item->$key = json_decode($item->$key);
				}
			}
		});
		return $list;
	}


}