<?php include_partial('ddOnlineStoreProduct/list_header', array('pager' => $pager, 'attributes' => $attributes)) ?>

<?php include_partial('ddOnlineStoreProduct/list', array('pager' => $pager, 'attributes' => $attributes)) ?>

<?php include_partial('ddOnlineStoreProduct/list_footer', array('pager' => $pager, 'attributes' => $attributes)) ?>

<div class="_cb_popup_wrapper" id="product_detail_1">
    <div class="popup_content">
        <div class="popup_content_wrapper">
            <a href="javascript:void(0);" onclick="fadeOut('product_detail_1');" class="popup_close">X</a>
            <div class="popup_left_column">
                <img src="/images/product_test_images/popup_test.jpg" alt="" />
            </div>
            <div class="popup_right_column">
                <p><b>16GB USB Flash Thumb Drive Store &amp; Move Files</b></p>
                <p><span class="popup_price">$ 20.00</span></p>
                <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam
                nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat
                volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation
                ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat.</p>
                <p><b>Sold by:</b> <a href="<?php //echo url_for('vendor_show') ?>" class="brand">Techfresh</a></p>
            </div>
        </div>
    </div>
</div>