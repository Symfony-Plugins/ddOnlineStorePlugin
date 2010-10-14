<li<?php echo ($i%4 == 0)?' class="last"':''?>>
	<a href="javascript:void(0);" onclick="fadeIn('product_detail_<?php echo $product->getId() ?>');"<?php echo ($product->getIsFeatured())?' class="special"':'' ?>> 
		<img src="<?php echo $product->getMainImage()->getImageSrc('image_name', 'thumb') ?>" alt="<?php echo $product->getName() ?>" /> 
		<span class="product_info"> 
			<span class="product_name"><?php echo $product->getName() ?></span> 
            <span class="product_desc"><?php echo $product->getSubname() ?></span> 
            <span class="product_price">$ <?php echo $product->getPrice() ?></span> 
		</span> 
	</a>
</li>