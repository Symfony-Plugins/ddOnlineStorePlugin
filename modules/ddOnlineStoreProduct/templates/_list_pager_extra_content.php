<?php if(isset($attributes['includeVendorName']) && $attributes['includeVendorName'] === true): ?>
<p id="products_showing">Showing 56 products from Accenture</p>
<?php endif; ?>

<?php if(isset($attributes['includeSort']) && $attributes['includeSort'] === true): ?>
<form name="pager_sort_by" id="pager_sort_by" action="<?php echo url_for('localized_homepage') ?>" method="get">
	<label for="sort_by">Sort By:</label>
	<select name="sort" id="sort_by">
    	<option value="is_featured|desc"<?php echo (implode('|', $attributes['sort']->getRawValue()) == 'is_featured|desc')?' selected="selected"':'' ?>>Featured first</option>
        <option value="category_id|asc"<?php echo (implode('|', $attributes['sort']->getRawValue()) == 'category_id|asc')?' selected="selected"':'' ?>>Category</option>
        <option value="price|asc"<?php echo (implode('|', $attributes['sort']->getRawValue()) == 'price|asc')?' selected="selected"':'' ?>>Price (min to max)</option>
        <option value="price|desc"<?php echo (implode('|', $attributes['sort']->getRawValue()) == 'price|desc')?' selected="selected"':'' ?>>Price (max to min)</option>
        <option value="capacity|asc"<?php echo (implode('|', $attributes['sort']->getRawValue()) == 'capacity|asc')?' selected="selected"':'' ?>>Storage capaticty (min to max)</option>
        <option value="capacity|desc"<?php echo (implode('|', $attributes['sort']->getRawValue()) == 'capacity|desc')?' selected="selected"':'' ?>>Storage capaticty (max to min)</option>
	</select>
</form>

<script type="text/javascript">
<!--
$(document).ready(function(){
	$('#sort_by').change(function(){
		$('#pager_sort_by').submit();
	});
});
//-->
</script>
<?php endif; ?>