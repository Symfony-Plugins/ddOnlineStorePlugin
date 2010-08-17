<?php if($product->getImageName()): ?>
<img src="<?php echo $product->getImageWithPath('list'); ?>" alt="image" />
<?php endif; ?>