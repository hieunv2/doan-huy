<?php
get_header();
$list_products = db_fetch_array("SELECT* FROM `tbl_products` ORDER BY `product_id` DESC");
$list_product_cat = db_fetch_array("SELECT* FROM `tbl_product_cat` WHERE `parent_id` = 0");

$list_slider = db_fetch_array("SELECT* FROM `tbl_sliders`");
$list_product_pro = get_list_product_pro($list_products);
?>
<div id="main-content-wp" class="home-page clearfix">
    <div class="wp-inner">
        <div class="main-content fl-right">
            <div class="section" id="slider-wp">
                <?php if (!empty($list_slider)) {
                ?>
                    <div class="section-detail">
                        <?php foreach ($list_slider as $slider) {
                        ?>
                            <div class="item">
                                <img src="admin/<?php echo $slider['slider_thumb'] ?>" alt="">
                            </div>
                        <?php
                        }
                        ?>
                    </div>
                <?php
                }
                ?>
            </div>
            <div class="section" id="support-wp">
               
                    
              
                <div class="section-card">
                    <div class="logo">
                        <img src="public/images/iphone.png" alt="">


                    </div>
                    
                </div>
                <div class="section-card">
                    <div class="logo">
                        <img src="public/images/samsung.png" alt="">


                    </div>
                   
                </div>
                <div class="section-card">
                    <div class="logo">
                        <img src="public/images/oppo.png" alt="">


                    </div>
                    
                </div>
                <div class="section-card">
                    <div class="logo">
                        <img src="public/images/xiaomi.png" alt="">


                    </div>
                  
                </div>
                <div class="section-card">
                    <div class="logo">
                        <img src="public/images/asus.png" alt="">
                    </div>
                    
                </div>
            </div>

            <div class="section" id="feature-product-wp">
                <div class="section-head">
                    <h3 class="section-title">S???n ph???m n???i b???t</h3>
                </div>
                <div class="section-detail">
                    <?php if (!empty($list_product_pro)) {
                    ?>
                        <ul class="list-item">
                            <?php foreach ($list_product_pro as $product_pro) {
                            ?>
                                <li>
                                    <a href="<?php echo $product_pro['slug'] ?>-<?php echo $product_pro['product_id'] ?>-i.html" title="" class="thumb">
                                        <img src="admin/<?php echo $product_pro['product_thumb'] ?>">
                                    </a>
                                    <a href="<?php echo $product_pro['slug'] ?>-<?php echo $product_pro['product_id'] ?>-i.html" title="" class="product-name"><?php echo $product_pro['product_title'] ?></a>
                                    <div class="price">
                                        <span class="new"><?php echo currency_format($product_pro['product_price_new']) ?></span>
                                        <span class="old"><?php echo currency_format($product_pro['product_price_old']) ?></span>
                                    </div>
                                    <div class="action clearfix">
                                        <a href="gio-hang-<?php echo $product_pro['product_id'] ?>-c.html" title="" class="add-cart fl-left">Th??m gi??? h??ng</a>
                                        <a href="thanh-toan-<?php echo $product_pro['product_id'] ?>-b.html" title="" class="buy-now fl-right">Mua ngay</a>
                                    </div>
                                </li>
                            <?php
                            }
                            ?>
                        </ul>
                    <?php
                    }
                    ?>
                </div>
            </div>
            <?php if (!empty($list_product_cat)) {
            ?>
                <?php foreach ($list_product_cat as $product_cat) {
                    // $list_products_by_cat= get_product_by_parent_cat($product_cat['title']);
                    # Get products by cat and created date near
                    $list_products_by_cat = db_fetch_array("SELECT * FROM `tbl_products` WHERE `parent_cat`= '{$product_cat['title']}' ORDER BY `created_date` DESC");
                    # Get products by cat has price old
                    $list_products_by_cat_pro = get_list_product_pro($list_products_by_cat);
                    # Get products by cat has lim
                    if (!empty($list_products_by_cat_pro)) {
                        $list_products_by_cat_pro_lim = array_slice($list_products_by_cat_pro, 0, 8);
                    } else {
                        $list_products_by_cat_pro_lim = $list_products_by_cat_pro;
                    }
                ?>
                    <div class="section" id="list-product-wp">
                        <div class="section-head">
                            <h3 class="section-title"><?php echo $product_cat['title'] ?> n???i b???t</h3>
                        </div>
                        <div class="section-detail">
                            <?php if (!empty($list_products_by_cat_pro_lim)) {
                                $error = array();
                            ?>
                                <ul class="list-item clearfix">
                                    <?php foreach ($list_products_by_cat_pro_lim as $product_by_cat_pro) {
                                    ?>
                                        <li>
                                            <a href="<?php echo $product_by_cat_pro['slug'] ?>-<?php echo $product_by_cat_pro['product_id'] ?>-i.html" title="" class="thumb">
                                                <img src="admin/<?php echo $product_by_cat_pro['product_thumb'] ?>">
                                            </a>
                                            <a href="<?php echo $product_by_cat_pro['slug'] ?>-<?php echo $product_by_cat_pro['product_id'] ?>-i.html" title="" class="product-name"><?php echo $product_by_cat_pro['product_title'] ?></a>
                                            <div class="price">
                                                <span class="new"><?php echo currency_format($product_by_cat_pro['product_price_new']) ?></span>
                                                <span class="old"><?php echo currency_format($product_by_cat_pro['product_price_old']) ?></span>
                                            </div>
                                            <div class="action clearfix">
                                                <a href="gio-hang-<?php echo $product_by_cat_pro['product_id'] ?>-c.html" title="Th??m gi??? h??ng" class="add-cart fl-left">Th??m gi??? h??ng</a>
                                                <a href="dat-hang-<?php echo $product_by_cat_pro['product_id'] ?>-b.html" title="Mua ngay" class="buy-now fl-right">Mua ngay</a>
                                            </div>
                                        </li>
                                    <?php
                                    }
                                    ?>
                                </ul>
                            <?php
                            } else {
                                $error['product_cat'] = 'Hi???n kh??ng t???n t???i s???n ph???m ' . $product_cat['title'] . ' n???i b???t n??o!';
                            ?>
                                <p class="error"><?php echo  $error['product_cat'] ?></p>
                            <?php
                            }
                            ?>
                        </div>
                    </div>
                <?php
                }
                ?>
            <?php
            }
            ?>
        </div>
        <?php get_sidebar(); ?>
    </div>
</div>
<?php
get_footer();
?>