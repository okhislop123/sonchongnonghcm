<?php
$time_cur = time();

if ($com == 'tags') {
    $tags = addslashes($_REQUEST['alias']);
    $query = $d->simple_fetch("select * from #_tags where alias = '$tags'");
    $tintuc = $d->o_fet("select  * from #_tintuc where hien_thi = 1 and tags_hienthi like '%" . $query['ten_vn'] . "%' order by so_thu_tu asc, id desc");
} else {
    $loai = $d->simple_fetch("select * from #_category where hien_thi = 1 and alias_{$lang} = '$com'");
    $loai_c = $d->o_fet("select * from #_category where hien_thi = 1 and id_loai = " . $loai['id'] . " order by so_thu_tu asc, id desc ");
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


<section class="help">
    <div class="container">
        <div class="content">
            <?php if (count($loai_c)) { 
                header('location:'.URLPATH.$loai_c[0]['alias_'.$lang].'.html');
            } else { ?>

                <?=$loai['noi_dung_'.$lang]?>

            <?php } ?>
        </div>
    </div>
</section>