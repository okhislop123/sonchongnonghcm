<?php
($com != '') ? $linkcom = "&langcom=" . $com : $linkcom = '';
$num_cart = 0;
if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
    foreach ($_SESSION['cart'] as $key => $value) {
        $num_cart = $num_cart + $value['so_luong'];
    }
}
$nav_pro  = $d->o_fet("select * from #_category where id_loai = 1113 order by so_thu_tu asc, id desc");
$nav_km  = $d->o_fet("select * from #_sp_khuyen_mai where hien_thi=1 order by id desc");
$thongtin_head = $d->getTemplates(53);
$slide  = $d->getImg(1130);
?>

<div class="header-tag2">
    <div class="container__item">
        <h3>haha</h3>
    </div>
</div>
<nav class="navbar navbar-default" role="navigation">
    <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="giohang-mobile md-none xs-block" href="<?= URLPATH . $d->getCate(106)['alias_' . $lang] ?>.html">
                <img src="templates/images/icon-cart.png" alt="Giỏ hàng" />
                <span class="num"><?= $num_cart ?></span>
            </a>
            <a class="navbar-brand" href="<?= URLPATH ?>">
                <img src="<?= $logo ?>" alt="<?= $ten_cong_ty ?>" />
                <span style="font-family: 'Roboto Condensed';font-weight: 600;font-size: 18px;margin-left: 5px;position: relative;top: 3px;"><?= $ten_cong_ty ?></span>
            </a>
        </div>
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav navbar-right">
                <li><a href="<?= URLPATH ?>">Trang chủ</a></li>
                <?php include 'module/menu.php'; ?>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="fa fa-search"></span></a>
                    <ul class="dropdown-menu" style="left: auto;right: 0;">
                        <form method="GET" action="index.php" class="nav-form">
                            <input type="hidden" name="com" value="search">
                            <input name="textsearch" type="text" class="nav-input" placeholder="Nhập từ khóa cần tìm...">
                            <button class="btn btn-search" type="submit"></button>
                        </form>
                    </ul>
                </li>
                <li class="giohang">
                    <a href="<?= URLPATH . $d->getCate(106)['alias_' . $lang] ?>.html">
                        <img src="templates/images/icon-cart.png" alt="Giỏ hàng" />
                        <span class="num"><?= $num_cart ?></span>
                        <span>Giỏ hàng<br><?= $num_cart ?> Sản phẩm</span>
                    </a>
                </li>
            </ul>
        </div>
        <!-- /.navbar-collapse -->
    </div>
    <!-- /.container-fluid -->
</nav>

<?php if ($detect->isMobile() && !$detect->isTablet()) {
    include 'module/mmenu.php';
} ?>