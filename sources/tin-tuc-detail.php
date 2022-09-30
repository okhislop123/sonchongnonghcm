<?php

$tintuc = $d->simple_fetch("select * from #_tintuc where hien_thi = 1 and alias_" . $lang . " = '" . $com . "' limit 0,1");
if (count($tintuc) == 0) {
    $d->location(URLPATH . "404.html");
}
$tintuc_lienquan = $d->o_fet("select * from #_tintuc where hien_thi = 1 and id <> '" . @$tintuc['id'] . "' and id_loai = '" . $tintuc['id_loai'] . "' order by id desc limit 0,12");

$loai = $d->simple_fetch("select * from #_category where id = '" . $tintuc['id_loai'] . "'");
$hinh_anh_slide = $d->o_fet("select * from #_baiviet_hinhanh where id_baiviet = '" . $tintuc['id'] . "' order by id desc");
$loaisub = $d->o_fet("select * from #_category where hien_thi = 1 and (id_loai = " . $loai['id'] . " or id_loai = " . $loai['id_loai'] . " or id = " . $loai['id_loai'] . ") and id_loai <>0");
$id_loai2 = '1026' . $d->findIdSub(1026);
$news_home = $d->o_fet("select * from #_tintuc where hien_thi = 1 and noi_bat = 1 and FIND_IN_SET(id_loai,'$id_loai2') <> 0 order by id desc limit 0,10");
$bg = $d->getTemplates(60);
?>

<!-- <div class="bradcum-news">
    <div class="brea2">
        <div class="container__item">
            <div class="bregroup" style="background: url(<?= URLPATH . 'img_data/images/' . $bg['hinh_anh'] ?>);">
                <h1 class="title-home"><span><?= $loai['ten_' . $lang] ?></span></h1>
                <ol vocab="https://schema.org/" typeof="BreadcrumbList" class="breadcrumb">
                    <li property="itemListElement" typeof="ListItem">
                        <a property="item" typeof="WebPage" href="<?= URLPATH ?>">
                            <span property="name"><?= _trangchu ?></span>
                        </a>
                        <meta property="position" content="1">
                    </li>
                    <li property="itemListElement" typeof="ListItem">
                        <a class="active" property="item" typeof="WebPage" href="<?= URLPATH . $tintuc['alias_' . $lang] . '.html' ?>">
                            <span property="name"><?= $tintuc['ten_' . $lang] ?></span>
                        </a>
                        <meta property="position" content="3">
                    </li>
                </ol>
            </div>
        </div>
    </div>
</div>
<br><br> -->

<div class="content__two">
    <div class="container__item">
        <div class="row">
            <div class="col-md-9 col-sm-8 col-xs-12">
                <div class="des__nes">
                    <h2 class="title__tesst mt-30"><?= $tintuc['ten_' . $lang] ?></h2>
                    <div class="ngay-dang">Ngày đăng: <?= date("d/m/Y", $tintuc['ngay_dang']) ?></div>
                    <?php echo $tintuc['noi_dung_' . $lang]; ?>
                </div>
            </div>
            <div class="col-md-3 col-sm-4 col-xs-12">
                <?php include 'right.php' ?>
            </div>
        </div>
    </div>
</div>

<!-- <div class="container">
    <div class="row">
       
        <div class="col-md-12 col-sm-12">
            
            <div class="clearfix"></div>
            <h1 class="title-tin"><?= $tintuc['ten_' . $lang] ?></h1>
            <div class="ngaydang">
                <span class="pull-left"> <?= ($lang == 'vn') ? 'Ngày đăng:' : 'Date Submitted:' ?> <?= date('d-m-Y h:i:s', $tintuc['ngay_dang']) ?></span>
               
            </div>
            <div class="clearfix"></div>
            <hr>
            <div class="chitiettin">
                <?= $tintuc['noi_dung_' . $lang] ?>
            </div>
            <h3 class="title2-home"><span><?= ($lang == 'vn') ? 'Related posts' : 'Related posts' ?></span></h3>
            <ul class="tinlienquan">
                <?php foreach ($tintuc_lienquan as $key => $value) { ?>
                <li><a href="<?= URLPATH . $value['alias_' . $lang] ?>.html" title="<?= $value['ten_' . $lang] ?>"><?= $value['ten_' . $lang] ?></a></li>  
                <?php } ?>
            </ul>
            <div class="fb-comments" data-href="<?= $url_page ?>" data-width="1140" data-numposts="5"></div>
        </div>
        
    </div>
</div> -->