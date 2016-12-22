<?php 
/**
* Created by JooGii.
* User: Me;
* Date: 19.10.2016;
* Time: 21:44;
*/
defined('_JEXEC') or die;

JToolbarHelper::title(JText::_('EXAMPLES_LIST_VIEW_TITLE'), 'stack article');
if($items){
	JToolbarHelper::deleteList(JText::_('EXAMPLES_LIST_VIEW_SURE_WANT_TO_DELETE'),'proxy.model.remove');
}
if($state){
	$this->listOrder = $state->get('list.ordering');
	$this->listDirn  = $state->get('list.direction');
}else{
	$this->listOrder = 'id';
	$this->listDirn = 'asc';
}
$saveOrder = $this->listOrder == 'ordering';
$this->saveOrder = $saveOrder;
if ($saveOrder)
{
	$saveOrderingUrl = 'index.php?option=com_customfields&controller='.$this->_view_name.'&task=saveOrderAjax&tmpl=component';
	JHtml::_('sortablelist.sortable', $this->_view_name.'List', 'adminForm', strtolower($this->listDirn), $saveOrderingUrl);
}
?>


<form id="adminForm" name="adminForm" class="adminForm" method="POST">
	<?php if($sidebar){
	?>
	<div id="j-sidebar-container" class="span2">
		<?php echo $sidebar ?>
	</div>
	<div id="j-main-container" class="span10">
		<?php
		}else{
		?>
		<div id="j-main-container">
			<?php
			} ?>
	<?php
	/** @var \Joomplace\Library\JooYii\View  $this */
	if($items){
		$this->display('_table',array('items'=>$items));
	}
	?>
	<input type="hidden" name="filter_order" value="<?php echo $this->listOrder; ?>">
	<input type="hidden" name="filter_order_Dir" value="<?php echo $this->listDirn; ?>">
	<input type="hidden" name="option" value="com_customfields">
	<input type="hidden" name="controller" value="<?php echo $this->_view_name; ?>">
	<input type="hidden" name="context" value="<?php echo $context; ?>">
	<input type="hidden" name="extension" value="<?php echo $extension; ?>">
	<input type="hidden" name="task" value="">
	<input type="hidden" name="boxchecked" value="">
	</div>
</form>
