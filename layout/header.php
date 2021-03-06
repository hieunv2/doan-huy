<?php
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIONS");
$list_buy = get_list_by_cart();
$list_info = get_info_cart();
$list_menus = db_fetch_array("SELECT*FROM `tbl_menus` ORDER BY `menu_order` ASC");
?>
<!DOCTYPE html>
<html>

<head>
    <title>ISMART STORE</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <base href="<?php echo base_url(); ?>" />
    <link href="public/css/bootstrap/bootstrap-theme.min.css" rel="stylesheet" type="text/css" />
    <link href="public/css/bootstrap/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="public/reset.css" rel="stylesheet" type="text/css" />
    <link href="public/css/carousel/owl.carousel.css" rel="stylesheet" type="text/css" />
    <link href="public/css/carousel/owl.theme.css" rel="stylesheet" type="text/css" />
    <link href="public/css/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
    
    <link href="public/style.css" rel="stylesheet" type="text/css" />
   
    <script
  src="https://code.jquery.com/jquery-3.6.0.js"
  integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk="
  crossorigin="anonymous"></script>

    
    <script src="public/js/elevatezoom-master/jquery.elevatezoom.js" type="text/javascript"></script>
    <script src="public/js/bootstrap/bootstrap.min.js" type="text/javascript"></script>
    <script src="public/js/carousel/owl.carousel.js" type="text/javascript"></script>
    <script src="public/js/main.js" type="text/javascript"></script>
    <script src="public/js/app.js" type="text/javascript"></script>
</head>

<body>
    
    <div id="site">
        <div id="container">
            <div id="header-wp">
                <div id="head-top" class="clearfix">
                    <div class="wp-inner">
                        <a href="" title="" id="logo" class="fl-left"><i class="fa fa-yelp"></i> ELSTORE</a>
                       
                        <div id="main-menu-wp" class="fl-right">
                            <?php if (!empty($list_menus)) {
                            ?>
                                <ul id="main-menu" class="clearfix">
                                    <?php foreach ($list_menus as $menu) {
                                    ?>
                                        <li>
                                            <a href="<?php echo $menu['menu_url_static'] ?>-<?php echo $menu['menu_id'] ?>.html" title=""><?php echo $menu['menu_title'] ?></a>
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
                </div>
                <div id="head-body" class="clearfix">
                    <div class="wp-inner">
                   

                        <div id="search-wp" class="fl-left">
                            <form method="POST" action="tim-kiem.html">
                                <input type="text" name="value" id="s" placeholder="NH???P T??? KH??A" value="<?php echo set_value('value') ?>">
                                <button type="submit" id="sm-s" name="sm_s" class="fa fa-search"></button>
                            </form>
                        </div>
                        <div id="action-wp" class="fl-right">
                            <div id="advisory-wp" class="fl-left">
                                <span class="title">T?? v???n</span>
                                <span class="phone">0987.654.321</span>
                            </div>
                            <div id="btn-respon" class="fl-right"><i class="fa fa-bars" aria-hidden="true"></i></div>
                            <a href="?page=cart" title="gi??? h??ng" id="cart-respon-wp" class="fl-right">
                                <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                                <span id="num"><?php if (!empty($list_buy)) {
                                                    echo count($list_buy);
                                                } else {
                                                    echo '0';
                                                } ?></span>
                            </a>
                            <div id="cart-wp" class="fl-right">
                                <div id="btn-cart">
                                    <a href="gio-hang.html"> <i class="fa fa-shopping-cart" aria-hidden="true"></i></a> 
                                    <span id="num"><?php if (!empty($list_buy)) {
                                                        echo count($list_buy);
                                                    } else {
                                                        echo '0';
                                                    } ?></span>
                                </div>
                                <div id="dropdown">
                                    <p class="desc">C?? <span><?php if (!empty($list_buy)) {
                                                                    echo count($list_buy);
                                                                } else {
                                                                    echo '0';

                                                                } ?> s???n ph???m</span> trong gi??? h??ng</p>
                                    <?php if (!empty($list_buy)) {
                                    ?>
                                        <ul class="list-cart">
                                            <?php foreach ($list_buy as $product) {
                                            ?>
                                                <li class="clearfix">
                                                    <a href="<?php echo $product['slug'] ?>-<?php echo $product['product_id'] ?>-i.html" title="" class="thumb fl-left">
                                                        <img src="admin/<?php echo  $product['product_thumb'] ?>" alt="">
                                                    </a>
                                                    <div class="info fl-right">
                                                        <a href="<?php echo $product['slug'] ?>-<?php echo $product['product_id'] ?>-i.html" title="" class="product-name"><?php echo  $product['product_title'] ?></a>
                                                        <p class="price"><?php echo currency_format($product['product_price_new']) ?></p>
                                                        <p class="qty">S??? l?????ng: <span><?php echo  $product['qty'] ?></span></p>
                                                    </div>
                                                </li>
                                            <?php
                                            }
                                            ?>
                                        </ul>
                                    <?php
                                    }
                                    ?>
                                    <div class="total-price clearfix">
                                        <p class="title fl-left">T???ng:</p>
                                        <p class="price fl-right"><?php echo currency_format($list_info['total']) ?></p>
                                    </div>
                                    <div class="action-cart clearfix">
                                        <a href="gio-hang.html" title="Gi??? h??ng" class="view-cart fl-left">Gi??? h??ng</a>
                                        <a href="thanh-toan.html" title="Thanh to??n" class="checkout fl-right">Thanh to??n</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <script>

            window.onscroll = function() {scrollFunction()};

function scrollFunction() {
  if (document.body.scrollTop > 80 || document.documentElement.scrollTop > 80) {
    document.getElementById("head-top").style.padding = "0px 0px";
    document.getElementById("logo").style.fontSize = "18px";
    document.getElementById("head-top").style.boxShadow = "5px 5px 10px lightblue";
    
  } else {
    document.getElementById("head-top").style.padding = "10px 0px";
    document.getElementById("logo").style.fontSize = "1.5rem";
    document.getElementById("head-top").style.boxShadow = "0px 0px 0px 0";
    
    


  }
}
</script>