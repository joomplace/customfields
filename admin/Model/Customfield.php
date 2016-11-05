<?php 
/**
* Created by JooGii.
* User: ;
* Date: 27.10.2016;
* Time: 18:26;
*/
namespace Joomplace\Customfields\Admin\Model;

use Joomplace\Library\JooYii\Model;

defined('_JEXEC') or die;

class Customfield extends Model
{
	protected $_fields = array(
		'context' => array(
			'mysql_type' => 'varchar(128)',
			'type' => 'hidden',
		),
		'name' => array(
			'mysql_type' => 'varchar(128)',
			'type' => 'hidden',
		),
		'definition' => array(
			'mysql_type' => 'text',
			'type' => '\\Joomplace\\Customfields\\Admin\\Fields\\FieldDefinition',
			'default' => '{}',
		)
	);

	protected function determine()
	{
		$this->_table = '#__joomplace_customfields';
	}


	public function store($updateNulls = false)
	{
		$return = parent::store($updateNulls);
		if(!$this->name){
			$this->name = 'cust.'.$this->context.'.'.$this->id;
			$return = parent::store($updateNulls);
		}
		return $return;
		// TODO: create or recreate language file according to field defenitions
	}

}