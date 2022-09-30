<?php
$textslide = $d->getImg(1130);
$product__nb = $d->getImg(1302);
$product__title = $d->simple_fetch("select * from #_category where id = 1302");
$product__link = $d->simple_fetch("select * from #_category where id = 1291");
$project__title = $d->simple_fetch("select * from #_category where id = 1303");
$video__item = $d->simple_fetch("select * from #_category where id = 1304");
$productCategory = $d->o_fet("select * from #_category where id_loai = 1291");
$project__list = $d->o_fet("select * from #_tintuc where id_loai = 1303 and noi_bat = 1 order by so_thu_tu asc, id desc limit 0,4");

$intro__title = $d->simple_fetch("select * from #_category where id = 1311");

$pro__title = $d->simple_fetch("select * from #_category where id = 1312");
$pro__list = $d->o_fet("select * from #_tintuc where id_loai = 1312 and noi_bat = 1 order by so_thu_tu asc, id desc limit 0,4");

$video__title = $d->simple_fetch("select * from #_category where id = 1309");

$need__title = $d->simple_fetch("select * from #_category where id = 1319");
$need__list = $d->o_fet("select * from #_tintuc where id_loai = 1319 and noi_bat = 1 order by so_thu_tu asc, id desc limit 0,3");

?>

<div style="display: none;" class="uk-section-default uk-section uk-padding-remove-vertical uk-flex uk-flex-middle" uk-height-viewport="offset-top: true;" style="min-height: calc(100vh - 145.594px);">
    <div class="uk-width-1-1">
        <div class="tm-grid-expand uk-child-width-1-1 uk-margin-remove-vertical uk-grid uk-grid-stack" uk-grid>
            <div class="uk-width-1-1@m uk-first-column" uk-height-viewport="offset-top: true;" style="min-height: calc(100vh - 145.594px);">
                <div uk-slideshow="ratio: false; animation: fade; autoplay: 1;" class="mascoat-main-trans uk-margin uk-slideshow">
                    <div class="uk-position-relative">

                        <ul class="uk-slideshow-items" uk-height-viewport="offset-top: true; minHeight: 300;" style="min-height: calc(100vh - 145.594px);">
                            <?php foreach ($textslide as $key => $item) { ?>
                                <li class="el-item">
                                    <a class="uk-position-cover uk-animation-kenburns uk-animation-reverse uk-transform-origin-top-left" href="<?= $item['link'] ?>">
                                        <img class="el-image" alt="Industrial Pipelin" uk-img="target: !.uk-slideshow-items" uk-cover="" data-src="<?= URLPATH . 'img_data/images/' . $item['picture'] ?>" data-srcset="<?= URLPATH . 'img_data/images/' . $item['picture'] ?>" data-sizes="(max-aspect-ratio: 2000/980) 204vh" data-width="2000" data-height="980" sizes="(max-aspect-ratio: 2000/980) 204vh" src="<?= URLPATH . 'img_data/images/' . $item['picture'] ?>" style="height: 898px; width: 1832px;">
                                    </a>
                                    <!-- <div class="uk-position-cover uk-flex uk-flex-left uk-flex-middle uk-padding">
                                        <div class="el-overlay uk-panel uk-margin-remove-first-child">
                                            <div class="el-content uk-panel uk-margin-top">
                                                <div class="uk-card uk-width-1-1 uk-card-default uk-text-center">
                                                    <div class="uk-padding">
                                                        <div class="uk-heading-2xlarge uk-text-secondary uk-margin-small"><?= $item['title_' . $lang] ?></div>
                                                        <div class="uk-text-secondary uk-margin-remove" style="font-size:2rem; line-height:2.5rem;"><strong><?= $item['body_' . $lang] ?></strong></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div> -->
                                </li>
                            <?php } ?>
                        </ul>

                        <a class="uk-position-center-left uk-position-small uk-hidden-hover" href="#" uk-slidenav-previous uk-slideshow-item="previous"></a>
                        <a class="uk-position-center-right uk-position-small uk-hidden-hover" href="#" uk-slidenav-next uk-slideshow-item="next"></a>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include 'module/slider.php' ?>

<section class="product-nb">
    <div class="container__item">
        <h2 class="title__pro">Danh mục sản phẩm</h2>
        <br>
        <div class="product__category owl-carousel" style="margin-top:20px">
            <?php foreach ($productCategory as $key => $item) {
                $sanpham = $d->o_fet("select * from #_sanpham where id_loai = " . $item["id"] . "");
            ?>
                <div class="product__item">
                    <div class="product__img">
                        <a href="<?= URLPATH . $item['alias_' . $lang] . '.html' ?>">
                            <img src="<?= URLPATH . 'img_data/images/' . $item['hinh_anh'] ?>" alt="<?= $item['ten_' . $lang] ?>">
                        </a>

                    </div>
                    <div class="product__info">
                        <h1> <a style="color: #fff;" href="<?= URLPATH . $item['alias_' . $lang] . '.html' ?>"><?= $item['ten_' . $lang] ?></a></h1>
                        <div><?= count($sanpham) ?> sản phẩm</div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
</section>

<section class="intro" style="background-image: url(<?= URLPATH . 'img_data/images/' . $intro__title["hinh_anh"] ?>);">
    <div class="container__item">
        <div class="row">
            <div class="col-md-7 col-sm-6 col-xs-12">
                <div class="intro_group">
                    <h2 class="title__pro"><?= $intro__title['ten_' . $lang] ?></h2>
                    <div class="inro__content">
                        <?= $intro__title['mo_ta_' . $lang] ?>
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>


<section class="special">
    <div class="container__item">
        <div class="row">
            <div class="col-md-6 col-xs-12">
                <div class="special__img">
                    <img src="<?= URLPATH . 'img_data/images/' . $pro__title['hinh_anh'] ?>" alt="hinh_anh_son">
                </div>
            </div>
            <div class="col-md-6 col-xs-12">
                <div class="special__group">
                    <?php foreach ($pro__list as $key => $item) { ?>
                        <div class="special__item">
                            <img src="<?= URLPATH . 'img_data/images/' . $item['hinh_anh'] ?>" alt="<?= $item['ten_' . $lang] ?>">
                            <div class="group">
                                <h1><?= $item['ten_' . $lang] ?></h1>
                                <div><?= $item['mo_ta_' . $lang] ?></div>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="videon">
    <div class="container__item">
        <div class="row">
            <div class="col-md-6 col-sm-6 col-xs-12">
                <div class="img__video">
                    <a data-fancybox href="https://www.youtube.com/watch?v=<?= $video__title['video'] ?>">
                        <i class="fa fa-play"></i>
                        <img src="https://img.youtube.com/vi/<?= $video__title['video'] ?>/sddefault.jpg" alt="img">
                    </a>
                </div>
            </div>
            <div class="col-md-6 col-sm-6 col-xs-12">
                <div class="video__des">
                    <h2 class="title__vi"><?= $video__title['ten_' . $lang] ?></h2>
                    <div class="des_v">
                        <?= $video__title['mo_ta_' . $lang] ?>
                    </div>
                    <div class="view__more">
                        <a href="<?= URLPATH . $video__title['alias_' . $lang] . '.html' ?>">Xem thêm</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="youneed">
    <div class="container__item">
        <h2 class="title__pro"><?= $need__title['title_' . $lang] ?></h2>
        <div class="row">
            <?php foreach ($need__list as $key => $item) { ?>
                <div class="col-md-4 col-sm-6 col-xs-12">
                    <div class="youneed__item">
                        <div class="youneed__img">
                            <img src="<?= URLPATH . 'img_data/images/' . $item['hinh_anh'] ?>" alt="<?= $item['ten_' . $lang] ?>">
                        </div>
                        <div class="youneed__info">
                            <h1><?= $item['ten_' . $lang] ?></h1>
                            <div><?= $item['mo_ta_' . $lang] ?></div>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
</section>

<section class="form-contact" style="background-image: url(<?= URLPATH . 'templates/images/bgson.jpg' ?>);">
    <div class="container__item">
        <div class="form__contact__group">
            <h2 class="title__pro">Đăng ký tư vấn</h2>
            <div class="title_s">Gửi cho chúng tôi yêu cầu của bạn</div>
            <form action="" method="post" id="frm__l">
                <div class="group__input">
                    <label for="">Họ tên:</label>
                    <input type="text" id="txtFullname">
                </div>
                <div class="group__input">
                    <label for="">Điện thoại:</label>
                    <input type="text" id="txtPhone">
                </div>
                <div class="group__input">
                    <label for="">Email:</label>
                    <input type="text" id="txtEmail">
                </div>
                <div class="group__input">
                    <label for="">Địa chỉ:</label>
                    <input type="text" id="txtAddress">
                </div>
                <div class="group__input w-100">
                    <label for="">Yêu cầu:</label>
                    <textarea type="text" id="txtContent"></textarea>
                </div>
                <div class="group__input w-100 text-center"> <button>Gửi yêu cầu</button></div>

            </form>
        </div>
    </div>
</section>