<?php
$time_cur = time();

if ($com == 'tags') {
    $tags = addslashes($_REQUEST['alias']);
    $query = $d->simple_fetch("select * from #_tags where alias = '$tags'");
    $tintuc = $d->o_fet("select  * from #_tintuc where hien_thi = 1 and tags_hienthi like '%" . $query['ten_vn'] . "%' order by so_thu_tu asc, id desc");
} else {
    $loai = $d->simple_fetch("select * from #_category where hien_thi = 1 and alias_{$lang} = '$com'");
    $loai_c = $d->o_fet("select * from #_category where hien_thi = 1 and id_loai = " . $loai['id'] . " order by so_thu_tu asc, id desc");

    if (count($loai) == 0) $d->location(URLPATH . "404.html");
    $id_sub = substr($d->findIdSub($loai['id'], 1), 1);

    $id_loai = $loai['id'] . $d->findIdSub($loai['id']);
    $tintuc = $d->o_fet("select * from #_tintuc where hien_thi = 1 and hen_ngay_dang < '" . time() . "' and FIND_IN_SET(id_loai,'$id_loai') <> 0 order by so_thu_tu asc, id desc");
}
if (isset($_GET['page']) && !is_numeric(@$_GET['page'])) $d->location(URLPATH . "404.html");

$curPage = isset($_GET['page']) ? addslashes($_GET['page']) : 1;
$url = $d->fullAddress();
$maxR = 25;
$maxP = 5;
$phantrang = $d->phantrang($tintuc, $url, $curPage, $maxR, $maxP, 'classunlink', 'classlink', 'page');
$tintuc2 = $phantrang['source'];
//$loaisub = $d->o_fet("select * from #_category where hien_thi = 1 and (id_loai = ".$loai['id']." or id_loai = ".$loai['id_loai']." or id = ".$loai['id_loai'].") and id_loai <>0");
//$id_loai2='1026'.$d->findIdSub(1026);
//$news_home = $d->o_fet("select * from #_tintuc where hien_thi = 1 and noi_bat = 1 and FIND_IN_SET(id_loai,'$id_loai2') <> 0 order by id desc limit 0,10");

$bg = $d->getTemplates(60);
?>

<div class="bradcum-news">
    <div class="brea2">
        <div class="container__item">
            <div class="bregroup" style="background: url(<?= URLPATH . 'img_data/images/' . $bg['hinh_anh'] ?>);">
                <h1 class="title-home"><span><?= $loai['ten_' . $lang] ?></span></h1>
                <?= $d->breadcrumbList($loai['id'], $lang, URLPATH) ?>
            </div>
        </div>
    </div>
</div>
<br><br>

<section class="gallarydetail">
    <div class="container__item__3">
        <div class="content__a">
            <?= $loai['mo_ta_' . $lang] ?><br>
            <?= $loai['noi_dung_' . $lang] ?><br>
            <?php if (count($tintuc) > 0) { ?>


                <div class="panel-group" id="accordion">
                    <?php foreach ($tintuc as $key => $item) { ?>
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <a data-toggle="collapse" data-parent="#accordion" href="#collapse<?=$item['id']?>">
                                        <?=$item['ten_'.$lang]?></a>
                                </h4>
                            </div>
                            <div id="collapse<?=$item['id']?>" class="panel-collapse collapse">
                                <div class="panel-body"><?=$item['noi_dung_'.$lang]?></div>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            <?php } ?>

        </div>
        <br>
    </div>
</section>