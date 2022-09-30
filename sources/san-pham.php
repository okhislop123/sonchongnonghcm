<?php
$query = $d->simple_fetch("select id,ten_vn,alias_vn,mo_ta_vn from #_category where alias_{$_SESSION['lang']}='$com'");
$id_loai = $query['id'];
$all_id = $id_loai . $d->findIdSub($id_loai);

if ($id_loai == '') {
    $d->location(URLPATH . "404.html");
}
$loai = $d->simple_fetch("select * from #_category where hien_thi = 1 and alias_{$lang} = '$com'");
$loai1 = $d->o_fet("select * from #_category where hien_thi = 1 and id_loai = {$id_loai} order by so_thu_tu asc, id desc");


$sanpham = $d->o_fet("select * from #_sanpham where hien_thi = 1  and id_loai in ( $all_id ) and style=0 order by so_thu_tu asc, id desc");



if (isset($_GET['page']) && !is_numeric(@$_GET['page'])) {
    $d->location(URLPATH . "404.html");
}
$curPage = isset($_GET['page']) ? addslashes($_GET['page']) : 1;
$url = $d->fullAddress();
$maxR = 25;
$maxP = 3;
$phantrang = $d->phantrang($sanpham, $url, $curPage, $maxR, $maxP, 'classunlink', 'classlink', 'page');
$sanpham = $phantrang['source'];
$loaisub = $d->o_fet("select * from #_category where hien_thi = 1 and (id_loai = " . $loai['id'] . " or id_loai = " . $loai['id_loai'] . " or id = " . $loai['id_loai'] . ") and id_loai <>0");

?>
<div class="bradcum-news">
    <div class="container">
        <div class="bregroup">
            <h1 class="title-home"><span><?= $loai['ten_' . $lang] ?></span></h1>
            <?= $d->breadcrumbList($loai['id'], $lang, URLPATH) ?>
        </div>
    </div>
</div>

<div class="container__item">
    <div class="row">
        <div class="col-md-12 col-sm-12">

            <div class="clearfix"></div>
            <?php if (count($sanpham) > 0) { ?>
                <div class="row list-product ">
                    <?php include 'ct_product.php'; ?>
                </div>
                <div class="pagination-page">
                    <?php echo @$phantrang['paging'] ?>
                </div>
            <?php } else { ?>
                <p class="text-center">Nội dung đang cập nhật</p>
            <?php } ?>
        </div>


    </div>
</div>