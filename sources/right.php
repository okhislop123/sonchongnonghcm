<?php

$support1    = $d->simple_fetch("select * from #_hotro where hien_thi=1 order by so_thu_tu asc, id desc");
// echo '<pre>'; print_r($support1); echo '</pre>'; exit;
$nav_left3   = $d->o_fet("select * from #_category where id_loai = 1291 and hien_thi=1 order by so_thu_tu asc, id desc limit 0,20");
$_sanp2 = $d->o_fet("select * from #_sanpham where hien_thi = 1 and tieu_bieu = 1 order by so_thu_tu asc, id desc ");

?>
<div class="xs-none">
    <link rel="stylesheet" type="text/css" href="<?= URLPATH ?>templates/module/slick/slick.css" />
    <link rel="stylesheet" type="text/css" href="<?= URLPATH ?>templates/module/slick/slick-theme.css" />
    <!-- <div class="group-sm-dpgtroip-r">
        <h2 class="title-1h col" style="margin:0;"><?= $lang == 'vn' ? 'Hỗ trợ trực tuyến' : 'Online support' ?></h2>
        <ul class="menu-right support">
            <div class="img-hotro"><img src="<?= URLPATH . 'img_data/images/' . $support1['hinh_anh'] ?>" alt=""></div>
            <div class="hotline-right">
                Hotline: <?= $hotline ?>
            </div>
            <div class="zalo">
                Zalo: <a style="color: #000;" href="http://zalo.me/<?= $zalo ?>"><?= $zalo ?></a>
            </div>
            <div class="email">
                Email: <?= $skype ?>
                
            </div>
        </ul>
    </div> -->
    <div class="group-sm-dpgtroip-r">
        <h2 class="title-1h col" style="margin:0;"><?= $lang == 'vn' ? 'Danh mục sản phẩm' : 'Product portfolio' ?></h2>
        <ul class="menu-right">
            <?php foreach ($nav_left3 as $l => $l1) {
                $id = $l1['id'];
                $nav_left4 = $d->o_fet("select * from #_category where id_loai = {$id} and hien_thi=1 order by so_thu_tu asc, id desc");
            ?>
                <li class="<?= (count($nav_left4) > 0) ? 'hasmenu' : ''; ?>">
                    <a href="<?= URLPATH . $l1['alias_' . $lang] . '.html' ?>"><i class="fa fa-plus-square-o"></i>&nbsp;<?= $l1['ten_' . $lang] ?></a>
                    <ul class="menu-chidl">
                        <?php foreach ($nav_left4 as $l2 => $l3) {  ?>
                            <li> <a href="<?= URLPATH . $l3['alias_' . $lang] . '.html' ?>"><?= $l3['ten_' . $lang] ?></a></li>
                        <?php } ?>
                    </ul>
                </li>
            <?php } ?>
        </ul>
    </div>
    <div class="group-sm-dpgtroip-r">
        <h2 class="title-1h col" style="margin:0;"><?= $lang == 'vn' ? 'Sản phẩm nổi bật' : 'Hot products' ?></h2>
        <div class="spmain">
            <div class="spnb-main">
                <?php foreach ($_sanp2 as $key => $item) {
                    $size = $item['size'];
                    $price = $d->vnd($item["gia"]);
                    $maxPrice = "";
                    if ($size) {
                        $max = 0;
                        $data = json_decode($size, true);
                        foreach ($data as $k => $i) {
                            if ($item["gia"] + $i['price'] > $max) {
                                $max = $item["gia"] + $i["price"];
                            }
                        }
                        $maxPrice = $d->vnd($max);
                    }

                    $pricedown = $d->o_fet("select * from #_custom where idproduct = " . $item['id'] . " order by price asc");
                    $priceup = $d->o_fet("select * from #_custom where idproduct = " . $item['id'] . " order by price desc");
                ?>
                    <div class="col-md-3 col-sm-6" style="padding:0">
                        <div class="item-product-group" style="width:100%;margin: 0;">
                            <div class="img-productimg">
                                <a href="<?= URLPATH . $item['alias_' . $lang] . '.html' ?>"><img src="<?= URLPATH . 'img_data/images/' . $item['hinh_anh'] ?>" alt="<?= $item['ten_' . $lang] ?>"></a>
                            </div>
                            <div class="producmaintf">
                                <a href="<?= URLPATH . $item['alias_' . $lang] . '.html' ?>">
                                    <h3 class="prodcut-name"><?= $d->catchuoi_new($item['ten_' . $lang], 23) ?></h3>
                                    <div class="product__price <?= $maxPrice ? "active" : "" ?>">
                                        <div><?= $price ?></div>
                                        <?= $maxPrice ? "<div>-</div>" : "" ?>
                                        <div><?= $maxPrice ?></div>
                                    </div>
                                    <!-- <div><i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i></div> -->
                                    <!-- <div style="font-size:18px;margin-bottom:5px"  class="price-begin">$<?= number_format($pricedown[0]['price'], 2, '.', '') ?> - $<?= number_format($priceup[0]['price'], 2, '.', '') ?></div> -->
                                </a>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
    <br>


</div>
<script async defer crossorigin="anonymous" src="https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v4.0&appId=350125278987106&autoLogAppEvents=1"></script>
<script type="text/javascript" src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
<script type="text/javascript" src="<?= URLPATH ?>templates/module/slick/slick.min.js"></script>
<script>
    $(document).ready(function() {
        $('#selectlink').click(function(event) {
            $link = $('#selectlink').val();
            console.log($link);
            if ($link != '') {

                window.location.href = $(this).val()
            }
        });
    });
</script>
<script type="text/javascript">
    jQuery(document).ready(function($) {
        $('.spnb-main').slick({
            slidesToShow: 2,
            autoplay: true,
            autoplaySpeed: 4000,
            vertical: true,
            arrows: false
        });
    })
</script>