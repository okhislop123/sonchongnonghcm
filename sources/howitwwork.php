<?php
$time_cur = time();


$loai = $d->simple_fetch("select * from #_category where hien_thi = 1 and alias_{$lang} = '$com'");

if (count($loai) == 0) $d->location(URLPATH . "404.html");
$id_sub = substr($d->findIdSub($loai['id'], 1), 1);

$id_loai = $loai['id'] . $d->findIdSub($loai['id']);
$tintuc = $d->o_fet("select * from #_tintuc where hien_thi = 1 and hen_ngay_dang < '" . time() . "' and FIND_IN_SET(id_loai,'$id_loai') <> 0 order by so_thu_tu asc, id desc");

if (isset($_GET['page']) && !is_numeric(@$_GET['page'])) $d->location(URLPATH . "404.html");

$curPage = isset($_GET['page']) ? addslashes($_GET['page']) : 1;
$url = $d->fullAddress();
$maxR = 25;
$maxP = 5;
$phantrang = $d->phantrang($tintuc, $url, $curPage, $maxR, $maxP, 'classunlink', 'classlink', 'page');
$tintuc2 = $phantrang['source'];

?>
<!-- Lấy danh sách bài viết của danh mục nếu có -->
<?php if(count($tintuc)) { ?>
    <section class="works">
        <div class="container">
            <h2 class="title__home2">
                <div class="line line_up"></div>
                <div class="line line_down"></div>
                <span><?= $loai['ten_' . $lang] ?></span>
            </h2>
            <div class="des"><?= $loai['mo_ta_' . $lang] ?></div>
            <div class="content">
                <?php foreach ($tintuc as $key => $item) {
                    $img = $item['hinh_anh'] ? URLPATH . 'img_data/images/' . $item['hinh_anh'] : URLPATH . 'templates/error/error.jpg';
                ?>
                    <div class="item">
                        <div class="img"><img src="<?= $img ?>" alt="<?= $item['ten_' . $lang] ?>"></div>
                        <div class="info">
                            <h1><?= $item['ten_' . $lang] ?></h1>
                            <p><?= $item['mo_ta_' . $lang] ?></p>
                        </div>
                    </div>
                <?php } ?>
            </div>
        

        </div>
    </section>
<?php } ?>

<!-- Lấy nội dung của danh mục -->
<section class="howitwork">
    <div class="container">
        <div class="content">
            <?=$loai['noi_dung_'.$lang]?>
        </div>
    </div>
</section>
