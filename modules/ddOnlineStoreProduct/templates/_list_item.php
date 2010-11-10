<li<?php echo ($i%4 == 0)?' class="last"':''?>>
	<a href="#product_detail_<?php echo $product->getId() ?>" class="product_item<?php echo ($product->getIsFeatured())?' special':'' ?>" id="product_<?php echo $product->getId() ?>">
		<?php if($mainImage = $product->getMainImage()): ?> 
		<img src="<?php echo $mainImage->getImageSrc('image_name', 'thumb') ?>" alt="<?php echo $product->getName() ?>" />
		<?php endif; ?> 
		<span class="product_info"> 
			<span class="product_name"><?php echo $product->getName() ?></span> 
            <span class="product_desc"><?php echo $product->getSubname() ?></span> 
            <span class="product_price">$ <?php echo $product->getPrice() ?></span> 
		</span> 
	</a>
	
	<div style="display:none;">
	    <div class="popup_content" id="product_detail_<?php echo $product->getId() ?>">
	        <div class="popup_content_wrapper">
	            <a href="javascript:void(0);" onclick="$.fancybox.close()" class="popup_close">X</a>
	            <div class="popup_left_column">
	                <img src="<?php echo $mainImage->getImageSrc('image_name', 'detail') ?>" alt="" />
	            </div>
	            <div class="popup_right_column">
	                <p><b><?php echo $product->getName() ?></b></p>
	                <p><span class="popup_price">$ <?php echo $product->getPrice() ?></span></p>
	                <p><?php echo $product->getDescription() ?></p>
	                <?php if($product->user->VendorProfile): ?>
	                <p>
	                	<b>Sold by:</b> 
	                	<a href="<?php echo url_for('vendor_show', $product->user->VendorProfile) ?>" class="brand"><?php echo $product->user->VendorProfile->getBusinessName() ?></a>
	                </p>
	                <?php endif; ?>
	            </div>
	        </div>
	    </div>
	</div>
</li>