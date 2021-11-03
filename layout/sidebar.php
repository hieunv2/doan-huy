<?php
$list_category_0 = db_fetch_array("SELECT*FROM `tbl_product_cat` WHERE `parent_id` = 0");
$list_products = db_fetch_array("SELECT*FROM `tbl_products` ORDER BY  `sold_product` DESC");
$list_best_selling_product = array_slice($list_products, 0, 8);
?>
<div class="sidebar fl-left">
            <div class="section" id="category-product-wp">
                <div class="section-head">
                    <h3 class="section-title">
                            <a href="" class="typewrite" data-period="2000" data-type='[ "DANH MỤC SẢN PHẨM", "ĐIỆN THOẠI CHÍNH HÃNG", "PHỤ KIỆN CÔNG NGHỆ" ]'>
                                <span class="wrap"></span>
                            </a>
                       </h3>
                </div>
                <div class="secion-detail">
                    <?php if(!empty($list_category_0)){
                        ?>
                    <ul class="list-item">
                        <?php foreach($list_category_0 as $category_0){
                            $list_category_1 = db_fetch_array("SELECT*FROM `tbl_product_cat` WHERE `parent_id` = '{$category_0['cat_id']}'");
                            ?>
                            <li>
                                <a href="danh-muc/<?php echo $category_0['slug'] ?>-<?php echo $category_0['cat_id'] ?>.html" title=""><?php echo $category_0['title']?></a>
                                <?php if(!empty($list_category_1)){
                                    ?>
                                <ul class="sub-menu">
                                <?php foreach($list_category_1 as $category_1){
                                $list_category_2 = db_fetch_array("SELECT*FROM `tbl_product_cat` WHERE `parent_id` = '{$category_1['cat_id']}'");
                                    ?>
                                    <li>
                                        <a href="danh-muc/<?php echo $category_1['slug'] ?>-<?php echo $category_1['cat_id'] ?>.html" title=""><?php echo $category_1['title']?></a>
                                        <?php if(!empty($list_category_2)){
                                            ?>
                                        <ul class="sub-menu">
                                        <?php foreach($list_category_2 as $category_2){
                                            ?>
                                            <li>
                                                <a href="danh-muc/<?php echo $category_2['slug'] ?>-<?php echo $category_2['cat_id'] ?>.html" title=""><?php echo $category_2['title']?></a>
                                            </li>
                                            <?php
                                        }
                                        ?>
                                        </ul>
                                        <?php
                                        }
                                    ?>
                                    </li>
                                    <?php
                                }
                                ?>
                                </ul>
                                <?php
                                }
                            ?>
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
            <div class="section" id="selling-wp">
                <div class="section-head">
                    <h3 class="section-title">Sản phẩm bán chạy</h3>
                </div>
                <div class="section-detail">
                <?php if(!empty($list_best_selling_product)){
                    ?>
                    <ul class="list-item">
                        <?php foreach($list_best_selling_product as $best_selling_product){
                            ?>
                        <li class="clearfix">
                            <a href="<?php echo $best_selling_product['slug'] ?>-<?php echo $best_selling_product['product_id']?>-i.html" title="" class="thumb fl-left">
                                <img src="admin/<?php echo $best_selling_product['product_thumb']?>" alt="">
                            </a>
                            <div class="info fl-right">
                                <a href="<?php echo $best_selling_product['slug'] ?>-<?php echo $best_selling_product['product_id']?>-i.html" title="" class="product-name"><?php echo $best_selling_product['product_title']?></a>
                                <div class="price">
                                    <span class="new"><?php echo currency_format($best_selling_product['product_price_new'])?></span>
                                    <span class="old"><?php if(!empty($best_selling_product['product_price_old'])) echo currency_format($best_selling_product['product_price_old'])?></span>
                                </div>
                                <a href="dat-hang-<?php echo $best_selling_product['product_id'] ?>-b.html" title="" class="buy-now">Mua ngay</a>
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
            <div class="section" id="banner-wp">
                <div class="section-detail">
                    <a href="" title="" class="thumb">
                        <img src="public/images/new.png" alt="">
                    </a>
                </div>
            </div>
        </div>
        <script>
        var TxtType = function(el, toRotate, period) {
    this.toRotate = toRotate;
    this.el = el;
    this.loopNum = 0;
    this.period = parseInt(period, 10) || 2000;
    this.txt = '';
    this.tick();
    this.isDeleting = false;
};

TxtType.prototype.tick = function() {
    var i = this.loopNum % this.toRotate.length;
    var fullTxt = this.toRotate[i];

    if (this.isDeleting) {
    this.txt = fullTxt.substring(0, this.txt.length - 1);
    } else {
    this.txt = fullTxt.substring(0, this.txt.length + 1);
    }

    this.el.innerHTML = '<span class="wrap">'+this.txt+'</span>';

    var that = this;
    var delta = 200 - Math.random() * 100;

    if (this.isDeleting) { delta /= 2; }

    if (!this.isDeleting && this.txt === fullTxt) {
    delta = this.period;
    this.isDeleting = true;
    } else if (this.isDeleting && this.txt === '') {
    this.isDeleting = false;
    this.loopNum++;
    delta = 500;
    }

    setTimeout(function() {
    that.tick();
    }, delta);
};

window.onload = function() {
    var elements = document.getElementsByClassName('typewrite');
    for (var i=0; i<elements.length; i++) {
        var toRotate = elements[i].getAttribute('data-type');
        var period = elements[i].getAttribute('data-period');
        if (toRotate) {
          new TxtType(elements[i], JSON.parse(toRotate), period);
        }
    }
    // INJECT CSS
    var css = document.createElement("style");
    css.type = "text/css";
    css.innerHTML = ".typewrite > .wrap { border-right: 0.08em solid #fff}";
    document.body.appendChild(css);
};
    </script>