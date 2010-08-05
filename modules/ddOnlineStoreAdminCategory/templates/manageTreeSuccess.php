<?php use_helper('JavascriptBase', 'I18N', 'Date', 'sfJqueryTreeDoctrine'); ?>
<?php include_partial('ddOnlineStoreAdminCategory/assets') ?>
<?php add_needed_assets(); ?>
<div id="sf_admin_container">
	<h1><?php echo '"'.$category->getName().'" '.__('subcategories', array(), 'messages') ?></h1>
    <?php include_partial('ddOnlineStoreAdminCategory/flashes') ?>
    <div id="sf_admin_content">
		<?php include_partial('sfJqueryTreeDoctrineManager/manager_tree', array('model' => 'ProductCategory', 'field' => 'name', 'root' => $category->getId(), 'records' => $records, 'hasManyRoots' => true)) ?>
	</div>	
</div>