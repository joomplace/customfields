<?php
/**
 * @package     ${NAMESPACE}
 * @subpackage
 *
 * @copyright   A copyright
 * @license     A "Slug" license name e.g. GPL2
 */

defined('_JEXEC') or die;

/** @var \Joomplace\Library\JooYii\View  $this */
$rows = $items;
$columns = $rows[0]->getColumns();
/** @var \JPagination $pagination */
$pagination = $this->pagination;
?>
<table id="<?php echo $this->_view_name; ?>List" class="table table-bordered table-striped">
	<thead>
	<tr>
		<th width="1%" class="nowrap center hidden-phone">
			<?php echo JHTML::_('grid.sort', '<span class="icon-menu-2"></span>', 'ordering', $this->listDirn, false); ?>
		</th>
		<th width="1%" class="center">
			<?php echo JHtml::_('grid.checkall'); ?>
		</th>
		<th width="1%" class="center">

		</th>
		<?php
		foreach ($columns as $column){
			?>
			<th>
				<?php echo JHTML::_('grid.sort', 'TABLE_LIST_HEAD_'.strtoupper($column), $column, $this->listDirn, $this->listOrder); ?>
			</th>
			<?php
		}
		?>
	</tr>
	</thead>
	<tbody>
	<?php
	foreach ($rows as $i => $row){
		?>
		<tr class="row<?php echo $i % 2; ?>" <?php /* use if grouped ?>sortable-group-id="<?php echo $item->catid; ?>" <?php */ ?>>
			<td class="order nowrap center hidden-phone">
				<?php
				$iconClass = '';
				if (!$this->saveOrder)
				{
					$iconClass = ' inactive tip-top hasTooltip" title="' . JHtml::tooltipText('JORDERINGDISABLED');
				}
				?>
				<span class="sortable-handler<?php echo $iconClass ?>">
								<span class="icon-menu"></span>
							</span>
				<?php if ($this->saveOrder) : ?>
					<input type="text" style="display:none" name="order[]" size="5" value="<?php echo $row->ordering; ?>" class="width-20 text-area-order " />
				<?php endif; ?>
			</td>
			<td class="center">
				<?php echo JHtml::_('grid.id', $row->id, $row->id); ?>
			</td>
			<td>
				<?php
				echo $row->renderListControlActionLink('edit','edit','primary');
				?>
			</td>
			<?php
			foreach ($columns as $column){
				?>
				<td>
					<?php
					echo $row->renderListControl($column);
					?>
				</td>
				<?php
			}
			?>
		</tr>
		<?php
	}
	?>
	</tbody>
	<tfoot>
	<tr>
		<td colspan="2">
			<?php echo $pagination->getLimitBox(); ?>
		</td>
		<td class="text-right" colspan="<?php echo count($columns) + 1; ?>">
			<?php echo $pagination->getListFooter(); ?>
		</td>
	</tr>
	</tfoot>
</table>