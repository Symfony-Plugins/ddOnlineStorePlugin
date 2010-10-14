<?php include_partial('ddOnlineStoreProduct/list_pager', array('pager' => $pager, 'attributes' => $attributes)) ?>

<ul class="product_list">
	<?php $i = 1;?>
	<?php foreach($pager->getResults() as $product): ?>
		<?php include_partial('ddOnlineStoreProduct/list_item', array('product' => $product, 'i' => $i))?>
    <?php $i++;?>
    <?php endforeach; ?>
</ul>

<?php include_partial('ddOnlineStoreProduct/list_pager', array('pager' => $pager, 'attributes' => $attributes)) ?>