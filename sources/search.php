<?php
$t = addslashes($_REQUEST['textsearch']);
$link = explode("?", $_SERVER['REQUEST_URI']);
$vari = explode("&", $link[1]);
$search = array();
foreach ($vari as $item) {
    $str = explode("=", $item);

    $search["$str[0]"] = $str[1];
}
$t1 = $search['dmuasp'];



$s_type = 0;

if (!empty($t1)) {

    $t2 = $t1 . $d->findIdSub($t1);


    $sql = " and id_loai in (" . $t2 . ") ";


    $sanpham = $d->o_fet("select * from #_sanpham where hien_thi = 1 $sql and ten_{$lang} like '%" . $t . "%'  and style=0 order by so_thu_tu asc, id desc");
} else {
    $sanpham = $d->o_fet("select * from #_sanpham where hien_thi = 1 and ten_{$lang} like '%" . $t . "%' order by id desc");
}
if ($s_type == 1) {
    $sanpham = $d->o_fet("select * from #_tintuc where hien_thi = 1 and ten_{$lang} like '%" . $t . "%' order by id desc");
}



$name = _ketquatimkiem . " (" . count($sanpham) . ")";
if (isset($_GET['page']) && !is_numeric(@$_GET['page'])) $d->location(URLPATH . "404.html");

$curPage = isset($_GET['page']) ? addslashes($_GET['page']) : 1;
$url = $d->fullAddress();
$maxR = 20;
$maxP = 5;
$phantrang = $d->phantrang($sanpham, $url, $curPage, $maxR, $maxP, 'classunlink', 'classlink', 'page');
$sanpham = $phantrang['source'];
$bg = $d->getTemplates(60);
?>

<!-- <div class="bradcum-news">
    <div class="brea2">
        <div class="container__item">
            <div class="bregroup" style="background: url(<?= URLPATH . 'img_data/images/' . $bg['hinh_anh'] ?>);">
                <h1 class="title-home"><span>Tìm kiếm</span></h1>
                <ol vocab="https://schema.org/" typeof="BreadcrumbList" class="breadcrumb">
                    <li property="itemListElement" typeof="ListItem">
                        <a property="item" typeof="WebPage" href="<?= URLPATH ?>">
                            <span property="name"><?= _trangchu ?></span>
                        </a>
                        <meta property="position" content="1">
                    </li>

                    <li property="itemListElement" typeof="ListItem">
                        <a class="active" property="item" typeof="WebPage" href="javascript:void(0)">
                            <span property="name">Tìm kiếm</span>
                        </a>
                        <meta property="position" content="2">
                    </li>
                </ol>
            </div>
        </div>
    </div>
</div>
<br><br> -->


<section>
    <div class="container__item bg-white">
        <div class="row">

            <div class="col-md-12 col-sm-12 ">
                <div class="title__tesst mt-5" style="margin-top: 30px;">Tìm kiếm</div>
                <h4 class="title-module"><span><?= $name ?></span></h4>
                <div class="clearfix"></div>
                <div class="box-item module row ">
                    <?php if ($s_type == 1) { ?>
                        <?php foreach ($sanpham  as $i => $item) { ?>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <div class="content2ll">
                                    <div class="row itemdetailnew3">
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <div class="img-tintuc">
                                                <a href="<?= URLPATH . $item['alias_' . $lang] ?>.html?lan=<?= $lang ?>" title="<?= $item['ten_' . $lang] ?>">
                                                    <img src="<?= URLPATH ?>thumb.php?src=<?= URLPATH ?>img_data/images/<?= $item['hinh_anh'] ?>&w=730&h=400" alt="<?= $item['ten_' . $lang] ?>" onerror="this.src='<?= URLPATH ?>templates/error/error.jpg';">
                                                </a>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <div class="noidung-tt">
                                                <h3><a href="<?= URLPATH . $item['alias_' . $lang] ?>.html?lan=<?= $lang ?>" title="$item['ten_'.$lang] ?>"><?= $item['ten_' . $lang] ?></a></h3>
                                                <div class="mota">
                                                    <?= $d->catchuoi_new(strip_tags($item['mo_ta_' . $lang]), 350) ?>
                                                </div>
                                                <div class="text-right">
                                                    <a href="<?= URLPATH . $item['alias_' . $lang] ?>.html">Xem chi tiết</a>
                                                </div>

                                            </div>
                                        </div>
                                    </div>

                                </div>

                            </div>
                        <?php } ?>
                    <?php } else { ?>
                        <?php include("ct_product.php"); ?>
                    <?php } ?>
                </div>
                <div class="clearfix"></div>
                <?php if (@$phantrang['paging'] <> '') { ?>
                    <div class="pagination-page">
                        <?php echo @$phantrang['paging'] ?>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
</section>
<br>