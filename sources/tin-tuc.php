<?php
$time_cur = time();

if ($com == 'tags') {
    $tags = addslashes($_REQUEST['alias']);
    $query = $d->simple_fetch("select * from #_tags where alias = '$tags'");
    $tintuc = $d->o_fet("select  * from #_tintuc where hien_thi = 1 and tags_hienthi like '%" . $query['ten_vn'] . "%' order by so_thu_tu asc, id desc");
} else {
    $loai = $d->simple_fetch("select * from #_category where hien_thi = 1 and alias_{$lang} = '$com'");

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

?>
<?php if (count($tintuc)) { ?>
    <section class="news__detail">
        <div class="container__item">
            <h2 class="title__tesst mt-30 text-center"><?= $loai['ten_' . $lang] ?></h2>
            <div class="row">
                <div class="col-md-9 col-sm-8">
                    <div class="clearfix"></div>

                    <div class="item-new">
                        <div class="row">
                            <?php foreach ($tintuc2  as $i => $item) {
                                $day = date("d", $item['ngay_dang']);
                                $month = date("m", $item['ngay_dang']);
                            ?>
                                <div class="col-md-12 col-sm-12">
                                    <div class="row itemdetailnew">

                                        <div class="col-md-5 col-sm-6 col-xs-12">
                                            <div class="date_news">
                                                <?= $day ?>
                                                <div>Th<?= $month ?></div>
                                            </div>
                                            <div class="img-tintuc">

                                                <a href="<?= URLPATH . $item['alias_' . $lang] ?>.html" title="<?= $item['ten_' . $lang] ?>">
                                                    <img src="<?= URLPATH ?>img_data/images/<?= $item['hinh_anh'] ?>" alt="<?= $item['ten_' . $lang] ?>" onerror="this.src='<?= URLPATH ?>templates/error/error.jpg';">
                                                </a>
                                            </div>
                                        </div>
                                        <div class="col-md-7 col-sm-6 col-xs-12">
                                            <div class="noidung-tt">
                                                <h3><a href="<?= URLPATH . $item['alias_' . $lang] ?>.html" title="$item['ten_'.$lang] ?>"><?= $item['ten_' . $lang] ?></a></h3>
                                                <div class="mota">
                                                    <?= $d->catchuoi_new(strip_tags($item['mo_ta_' . $lang]), 350) ?>
                                                </div>


                                            </div>
                                        </div>


                                    </div>

                                </div>

                            <?php } ?>
                        </div>
                    </div>
                    <div class="pagination-page">
                        <?php echo @$phantrang['paging'] ?>
                    </div>

                </div>
                <div class="col-md-3 col-sm-4">
                    <?php include 'right.php' ?>
                </div>
            </div>
        </div>
    </section>
<?php } else { ?>
    <section class="news__detail">
        <div class="container__item">
            <div class="news__detail__content">
                <h1><?= $loai['ten_' . $lang] ?></h1>
                <div><?= $loai['mo_ta_' . $lang] ?></div>
                <div><?= $loai['noi_dung_' . $lang] ?></div>
            </div>
        </div>
    </section>
<?php } ?>