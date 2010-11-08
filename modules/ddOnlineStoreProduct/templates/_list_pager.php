<div class="pager">&nbsp;
	<?php include_partial('ddOnlineStoreProduct/list_pager_extra_content', array('pager' => $pager, 'attributes' => $attributes)) ?>
	
	<?php if($pager->haveToPaginate()): ?>
	<div class="pager_links">
		<a class="pager_control pager_left_full" href="<?php echo url_for($attributes['route_name'], array('page' => $pager->getFirstPage())) ?>">&laquo;</a>
		<a class="pager_control pager_left_prev" href="<?php echo url_for($attributes['route_name'], array('page' => $pager->getPreviousPage())) ?>">&lsaquo;</a> 
		<?php foreach ($pager->getLinks() as $page): ?>
		<?php   if($pager->getPage() == $page): ?>
		<span><?php echo $page ?></span>
		<?php   else: ?>
		<a href="<?php echo url_for($attributes['route_name'], array('page' => $page)) ?>"><?php echo $page ?></a> 
		<?php   endif; ?>
		<?php endforeach; ?>
		<a class="pager_control pager_right_next" href="<?php echo url_for($attributes['route_name'], array('page' => $pager->getNextPage())) ?>">&rsaquo;</a> 
		<a class="pager_control pager_right_full" href="<?php echo url_for($attributes['route_name'], array('page' => $pager->getLastPage())) ?>">&raquo;</a>
	</div>
	<?php endif; ?>
</div>