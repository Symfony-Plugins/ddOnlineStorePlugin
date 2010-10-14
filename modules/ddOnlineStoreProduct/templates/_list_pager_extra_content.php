<?php if(isset($attributes['includeVendorName']) && $attributes['includeVendorName'] === true): ?>
<p id="products_showing">Showing 56 products from Accenture</p>
<?php endif; ?>

<?php if(isset($attributes['includeSort']) && $attributes['includeSort'] === true): ?>
<form name="pager_sort_by" id="pager_sort_by" action="#" method="get">
	<label for="sort_by">Sort By:</label>
	<select name="sort" id="sort_by">
    	<option value="is_featured|desc">Featured first</option>
        <option value="category|asc">Category</option>
        <option value="price|asc">Price (min to max)</option>
        <option value="price|desc">Price (max to min)</option>
        <option value="capacity|asc">Storage capaticty (min to max)</option>
        <option value="capacity|desc">Storage capaticty (max to min)</option>
	</select>
</form>
<?php endif; ?>