<?php if(isset($attributes['includeVendorName']) && $attributes['includeVendorName'] === true): ?>
<p id="products_showing">Showing 56 products from Accenture</p>
<?php endif; ?>

<?php if(isset($attributes['includeSort']) && $attributes['includeSort'] === true): ?>
<form name="pager_sort_by" id="pager_sort_by" action="#" method="post">
	<label for="sort_by">Sort By:</label>
	<select name="sort_by" id="sort_by">
    	<option value="0">Option 1</option>
        <option value="1">Option 2</option>
        <option value="2">Option 3</option>
	</select>
</form>
<?php endif; ?>