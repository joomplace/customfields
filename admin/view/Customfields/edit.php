<?php 
/**
* Created by JooGii.
* User: Me;
* Date: 19.10.2016;
* Time: 21:44;
*/
defined('_JEXEC') or die;

/** @var \Joomplace\Library\JooYii\Model $item */
$form = $item->getForm();
?>
<form id="adminForm" name="adminForm" class="adminForm" method="POST">
	<?php
	foreach ($form->getFieldset() as $field){
		/** @var JFormField $field */
		echo $field->renderField();
	}
	?>
	<input type="hidden" name="option" value="com_customfields">
	<input type="hidden" name="controller" value="<?php echo $this->_view_name; ?>">
	<input type="hidden" name="context" value="<?php echo $context; ?>">
	<input type="hidden" name="extention" value="<?php echo $extention; ?>">
	<input type="hidden" name="return_url" value="<?php echo JRoute::_('index.php?option=com_customfields&controller=' . $this->_view_name . '&task=index&context='.$context.'&extension='.$extention) ?>">
	<input type="hidden" name="task" value="">
</form>
