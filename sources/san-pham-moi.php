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
$maxR = 24;
$maxP = 3;
$phantrang = $d->phantrang($sanpham, $url, $curPage, $maxR, $maxP, 'classunlink', 'classlink', 'page');
$sanpham = $phantrang['source'];
$loaisub = $d->o_fet("select * from #_category where hien_thi = 1 and (id_loai = " . $loai['id'] . " or id_loai = " . $loai['id_loai'] . " or id = " . $loai['id_loai'] . ") and id_loai <>0");

?>




<?php if(count($loai1)) { ?>
    <section class="product__cate">
        <div class="container">
            <div class="row">
                <?php foreach($loai1 as $key => $item) { 
                    $img = $item['hinh_anh'] ? URLPATH.'img_data/images/'.$item['hinh_anh'] : URLPATH.'templates/error/error.jpg';
                ?>
                    <div class="col-md-3 col-sm-6">
                        <div class="product__cate_item">
                            <div class="img">
                                <a href="<?=URLPATH.$item['alias_'.$lang].'.html'?>"><img src="<?=$img?>" alt="<?=$item['ten_'.$lang]?>">  </a> 
                            </div>
                            <div class="item__cateproduct">
                                <h1><a href="<?=URLPATH.$item['alias_'.$lang].'.html'?>"><?=$item['ten_'.$lang]?></a></h1>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </section>
<?php } else { ?>
    <div class="container">
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
<?php } ?>