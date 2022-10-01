<?php
$ctsp = $d->o_fet("select * from #_sanpham where hien_thi = 1 and alias_" . $_SESSION['lang'] . " = '" . $com . "'");
$property = explode('@1@', $ctsp[0]['property']);
if (count($ctsp) == 0) $d->location(URLPATH . "404.html");
$loai = $d->simple_fetch("select * from #_category where hien_thi = 1 and id = " . $ctsp[0]['id_loai'] . " ");
$sanpham = $d->o_fet("select * from #_sanpham where hien_thi = 1  and id <> '" . @$ctsp[0]['id'] . "' and id_loai = '" . @$ctsp[0]['id_loai'] . "' order by id desc limit 0,6");
$hinh_anh_sp = $d->o_fet("select * from #_sanpham_hinhanh where id_sp = '" . @$ctsp[0]['id'] . "' order by id desc");

$list_color = $d->o_fet("select * from #_sanpham_phienban where type = 0 and id_sanpham = '" . $ctsp[0]['id'] . "'");
$list_size = $d->o_fet("select * from #_sanpham_phienban where type = 1 and id_sanpham = '" . $ctsp[0]['id'] . "'");
if ($ctsp[0]['gia'] == '') {
    $gia = '<span class="p-price gia-center">' . _lienhe . '</span>';
} else {
    if ($item['khuyen_mai'] == '') {
        $gia = '<span class="p-price gia-center">' . $ctsp[0]['gia'] . ' VNĐ</span>';
    } else {
        $gia = ' 
        <span class="p-price">' . $ctsp[0]['khuyen_mai'] . ' VNĐ</span>
        <span class="p-oldprice">' . $ctsp[0]['gia'] . ' VNĐ</span>';
    }
}
if ($ctsp[0]['gia'] == '' || $ctsp[0]['gia'] == 0) {
    $gia1 = '<span class="p-price gia-center">' . _lienhe . '</span>';
} else {

    $gia1 = '<span class="p-price gia-center">' . number_format((float)$ctsp[0]['gia']) . ' Đ</span>';
}
if ($ctsp[0]['khuyen_mai'] != '' || $ctsp[0]['khuyen_mai'] != 0) {
    $gia2 = '<span class="p-price gia-center">' . number_format((float)$ctsp[0]['khuyen_mai']) . ' Đ</span>';
}

$active = ($ctsp[0]['khuyen_mai'] != '' || $ctsp[0]['khuyen_mai'] != 0) ? 'active' : '';
?>
<link rel="stylesheet" href="<?= URLPATH ?>templates/module/owlcarousel/assets/owl.carousel.min.css">
<link rel="stylesheet" href="<?= URLPATH ?>templates/module/owlcarousel/assets/owl.theme.default.min.css">
<link href="<?= URLPATH ?>templates/module/magiczoomplus/magiczoomplus.css" rel="stylesheet" />
<script src="<?= URLPATH ?>templates/module/magiczoomplus/magiczoomplus.js"></script>
<div class="bradcum-news">
    <div class="container">
        <div class="bregroup">
            <div class="title-nothome-2"><span><?= $loai['ten_' . $lang] ?></span></div>
            <?= $d->breadcrumbList($loai['id'], $lang, URLPATH) ?>
        </div>
    </div>
</div>
<div class="container__item">
    <div class="row">

        <div class="col-md-12 col-sm-12">
            <!-- <h1 class="title-home-2-tt"><span><?= $ctsp[0]['ten_vn'] ?></span></h1> -->

            <div class="clearfix"></div>
            <div class="row">

                <div class="col-md-6 col-sm-6 hinh-sp">
                    <div class="zoom-gallery">
                        <a class="MagicZoom" id="Zoom-v" title="" href="<?= URLPATH ?>img_data/images/<?= $ctsp[0]['hinh_anh'] ?>">
                            <img src="<?= URLPATH ?>img_data/images/<?= $ctsp[0]['hinh_anh'] ?>">
                        </a>
                    </div>
                    <?php if (count($hinh_anh_sp) > 0) { ?>
                        <br>
                        <div class="slide-sp owl-carousel owl-theme">
                            <div class="item">
                                <a class="thumb-item" style="background-image:url('<?= URLPATH ?>img_data/images/<?= $ctsp[0]['hinh_anh'] ?>');" data-image="<?= URLPATH ?>img_data/images/<?= $ctsp[0]['hinh_anh'] ?>">
                                </a>
                            </div>
                            <?php foreach ($hinh_anh_sp as $key => $item) { ?>
                                <div class="item">
                                    <a class="thumb-item" style="background-image:url(<?= URLPATH ?>img_data/images/<?= $item['hinh_anh'] ?>);" data-image="<?= URLPATH ?>img_data/images/<?= $item['hinh_anh'] ?>">
                                    </a>
                                </div>
                            <?php } ?>
                        </div>
                    <?php } ?>
                </div>

                <div class="col-md-6 col-sm-12">
                    <h1 class="title-sp"><?= $ctsp[0]['ten_' . $lang] ?></h1>
                    <hr style="margin-top: 10px;margin-bottom: 10px;border-color: #eae8e8;">
                    <strong><?= ($lang == 'vn') ? 'Mã sản phẩm:' : 'Product code:'; ?> <?= $ctsp[0]['ma_sp'] ?></strong>

                    <!-- handle show price -->
                    <?php
                    $size = $ctsp[0]['size'];
                    $price = $d->vnd($ctsp[0]["gia"]);
                    $maxPrice = "";
                    if ($size) {
                        $max = 0;
                        $data = json_decode($size, true);
                        foreach ($data as $k => $i) {
                            if ($ctsp[0]["gia"] + $i['price'] > $max) {
                                $max = $ctsp[0]["gia"] + $i["price"];
                            }
                        }
                        $maxPrice = $d->vnd($max);
                    }
                    ?>
                    <hr style="margin-top: 10px;margin-bottom: 10px;border-color: #eae8e8;">
                    <div class="product__price <?= $maxPrice ? "active" : "" ?>" style="text-align: left;justify-content: start;">
                        <div><?= $price ?></div>
                        <?= $maxPrice ? "<div>-</div>" : "" ?>
                        <div><?= $maxPrice ?></div>
                    </div>
                    <hr style="margin-top: 10px;margin-bottom: 10px;border-color: #eae8e8;">
                    <?php
                    $priceCreate = $ctsp[0]['gia'];
                    if ($ctsp[0]['color']) {
                        $color = $d->o_fet("select * from #_people where id in (" . $ctsp[0]['color'] . ") ");
                        $priceCreate += $color[0]['price'];
                    ?>
                        <div class="title__pro_detail"><b>Màu sắc:</b> <span class="color_name_active"><?= $color[0]['ten_' . $lang] ?></span></div>
                        <div class="group__color_detail">
                            <?php foreach ($color as $key => $item) { ?>
                                <div data-id="<?= $item['id'] ?>" data-name="<?= $item['ten_' . $lang] ?>" onclick="handleChangeColor(this)" class="border_color <?= !$key ? "active" : "" ?>">
                                    <div class="size_color <?= $item["id"] ? "" : "special" ?>" style="background: <?= $item['mamau'] ?>;">
                                        <i class="fa fa-check"></i>
                                        <span><?= $item['ten_' . $lang] ?></span>
                                    </div>
                                </div>
                            <?php } ?>
                        </div>
                        <div onclick="handleModal(true)" class="another__color d-none" style="margin-top: 20px;cursor: pointer;color:red;">
                            Xem màu khác tại đây
                        </div>
                        <div onclick="handleModal(false)" class="content__another__color">
                            <?php
                            $pay = $d->getTemplates(59);
                            ?>
                            <div class="child__ct">
                                <i class="fa fa-times"></i>
                                <img src="<?= URLPATH . 'img_data/images/' . $pay['hinh_anh'] ?>" alt="mau_son_khac">
                                <div><?= $pay['noi_dung_' . $lang] ?></div>
                            </div>
                        </div>
                        <hr style="margin-top: 10px;margin-bottom: 10px;border-color: #eae8e8;">
                    <?php  } ?>

                    <!-- handle size -->
                    <?php
                    if ($ctsp[0]['size']) {
                        $sizes = json_decode($ctsp[0]['size'], true);

                    ?>
                        <div class="title__pro_detail"><b>Dung lượng:</b> <span class="sizes_name_active"><?= $sizes[0]['name'] ?></span></div>
                        <div class="group__size_detail">
                            <?php foreach ($sizes as $key => $item) { ?>
                                <div onclick="handleChangeSize(this)" data-price="<?= $item['price'] ?>" data-current-price="<?= $ctsp[0]["gia"] ?>" data-id="<?= $item['id'] ?>" data-name="<?= $item['name'] ?>" class="sizegroup  <?= !$key ? "active" : "" ?>">
                                    <div class="size__contents">
                                        <span><?= $item['name'] ?></span>
                                    </div>
                                </div>
                            <?php } ?>
                        </div>
                        <hr style="margin-top: 10px;margin-bottom: 10px;border-color: #eae8e8;">
                        <b class="price__activate"><?= $d->vnd($priceCreate) ?></b>
                        <hr style="margin-top: 10px;margin-bottom: 10px;border-color: #eae8e8;">
                    <?php  } ?>

                    <p><b><?= ($lang == 'vn') ? 'Mô tả sản phẩm:' : 'Product Description:'; ?></b></p>
                    <div>
                        <?= $ctsp[0]['mo_ta_' . $lang] ?>
                    </div>

                    <div class="lienhe-sp">
                        <form method="post" action="<?= URLPATH . "gio-hang.html" ?>">
                            <input type="hidden" name="id" value="<?= $ctsp[0]['id'] ?>">
                            <input type="hidden" name="size" id="size_value" value="<?= $sizes[0]['id'] ? $sizes[0]['id'] : 0 ?>">
                            <input type="hidden" name="color" id="color_value" value="<?= $color[0]['id'] ? $color[0]['id'] : 0 ?>">
                            <div class="row m-5">
                                <div class="col-sm-3 box-sl p5">
                                    <input type="number" min="1" value="1" name="soluong" class="soluong" />
                                    <div class="clearfix"></div>
                                </div>
                                <div class="col-sm-9 p5">
                                    <button type="submit" name="addcart" class="btn btn-block btn-lienhe"><i class="fa fa-shopping-cart" aria-hidden="true"></i> <?= _buypro ?></button>
                                </div>
                            </div>

                        </form>

                    </div>
                </div>
            </div>


        </div>
    </div>
    <div class="row" style="margin-top: 30px;">
        <div class="col-md-8 col-sm-7 col-xs-12">

            <ul class="nav nav-tabs tab-sp">
                <li class="active"><a data-toggle="tab" href="#home"><?= ($lang == 'vn') ? 'Thông tin chi tiết' : 'Details'; ?></a></li>
                <!--li><a data-toggle="tab" href="#menu2">Hướng dẫn thanh toán</a></li-->
                <li><a data-toggle="tab" href="#menu3"><?= ($lang == 'vn') ? 'Tài liệu' : 'Evaluate'; ?></a></li>
            </ul>
            <div class="tab-content">
                <div id="home" class="tab-pane fade in active">
                    <div class="chitiettin">
                        <?= $ctsp[0]['thong_tin_' . $lang] ?>
                    </div>
                </div>
                <div id="menu2" class="tab-pane fade">
                    <div class="chitiettin">
                        <?= $ctsp[0]['thong_so_' . $lang] ?>
                    </div>
                </div>
                <div id="menu3" class="tab-pane fade">
                    <?php if ($ctsp[0]['doc']) { ?>
                        <div class="dowload">
                            <a href="<?= URLPATH . 'img_data/images/' . $ctsp[0]['doc'] ?>" download="">Tải tài liệu</a>
                        </div>
                    <?php } else { ?>
                        <p>Chưa có tài liệu</p>
                    <?php } ?>
                </div>
            </div>

            <h3 class="title2-home"><span><?= ($lang == 'vn') ? 'Sản phẩm liên quan' : 'Related products'; ?></span></h3>

        </div>
        <div class="col-md-4 col-sm-5 col-xs-12">
            <div class="des_ad">
                <?= $ctsp[0]['thong_so_' . $lang] ?>
            </div>
        </div>
    </div>
    <div class="row list-product m-5 m2">
        <?php include 'ct_product.php'; ?>
    </div>
</div>

<script>
    jQuery('.thumb-item').on('click touch', function() {
        var img = $(this).attr('data-image');
        $('#Zoom-v').attr('href', img);
        $('#Zoom-v img').attr('src', img);
    });

    var mzOptions = {
        zoomMode: "magnifier"
    };
</script>
<script src="<?= URLPATH ?>templates/module/owlcarousel/owl.carousel.min.js"></script>
<script>
    $('.slide-sp').owlCarousel({
        loop: true,
        margin: 5,
        nav: true,
        dots: false,
        //autoplay:true,
        autoplayTimeout: 3000,
        responsive: {
            0: {
                items: 2
            },
            600: {
                items: 3
            },
            1000: {
                items: 4
            }
        }
    })

    const handleModal = (showModal) => {
        if (showModal) {
            document.querySelector(".content__another__color").classList.add("active");
            document.querySelector("body").classList.add("no-scroll");
        } else {
            document.querySelector(".content__another__color").classList.remove("active");
            document.querySelector("body").classList.remove("no-scroll");
        }
    }

    const handleChangeColor = (e) => {

        let id = e.getAttribute("data-id");
        let nameColor = e.getAttribute("data-name");

        if (+id) {
            document.querySelector(".another__color").classList.add("d-none");
        } else {
            document.querySelector(".another__color").classList.remove("d-none");
        }

        document.querySelector(".border_color.active").classList.remove("active");
        e.classList.add("active");

        document.querySelector(".color_name_active").innerHTML = nameColor;
        document.querySelector("#color_value").value = id;
    }

    const handleChangeSize = (e) => {
        let id = e.getAttribute("data-id");
        let nameSize = e.getAttribute("data-name");
        let currentPrice = e.getAttribute("data-current-price");
        let priceAdd = e.getAttribute("data-price");

        let money = currentPrice * 1 + priceAdd * 1;
        const config = {
            style: 'currency',
            currency: 'VND',
            maximumFractionDigits: 9
        }
        const formated = new Intl.NumberFormat('vi-VN', config).format(money);

        document.querySelector(".sizegroup.active").classList.remove("active");
        e.classList.add("active");

        document.querySelector(".sizes_name_active").innerHTML = nameSize;
        document.querySelector(".price__activate").innerHTML = formated;
        document.querySelector("#size_value").value = id;

    }
</script>