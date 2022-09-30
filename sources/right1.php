<?php 
    $nav_left   = $d->o_fet("select * from #_category where id_loai = 1113 and hien_thi=1 order by so_thu_tu asc, id desc limit 0,10");
    $nav_left3   = $d->o_fet("select * from #_category where id_loai = 1202 and hien_thi=1 order by so_thu_tu asc, id desc limit 0,10");
    $support1    = $d->o_fet("select * from #_hotro where hien_thi=1 order by so_thu_tu asc, id desc");
    $news_left  = $d->o_fet("select * from #_tintuc where noi_bat=1 and hien_thi=1 and id_loai=1183  order by so_thu_tu asc, id desc limit 0,10");   
     $noibatsp = $d->o_fet("select * from #_sanpham where hien_thi = 1 and tieu_bieu = 1 order by so_thu_tu asc, id desc");
    $video = $d->getTemplates(52);
    $thongtinft= $d->simple_fetch("select * from #_thongtin limit 0,1");
    $hotro= $d->simple_fetch("select * from #_thongtin limit 0,1");
    $lkws = $d->o_fet("select * from #_category where hien_thi = 1 and id = 1241");
    $lkitem = $d->getImg(1241);
    $_sanp2 = $d->o_fet("select * from #_sanpham where hien_thi = 1 and tieu_bieu = 1 order by so_thu_tu asc, id desc ");
    //echo '<pre>'; print_r($lkitem); echo '</pre>'; exit;
  
?>
<div class="xs-none">
<link rel="stylesheet" type="text/css" href="<?=URLPATH?>templates/module/slick/slick.css"/>
<link rel="stylesheet" type="text/css" href="<?=URLPATH?>templates/module/slick/slick-theme.css"/>
    <div class="group-sm-dpgtroip-r">
        <h2 class="title-1h col" style="margin:0;"><?=$lang == 'vn' ? 'Danh mục sản phẩm' : 'Product portfolio'?></h2>
        <ul class="menu-right">
            <?php foreach($nav_left3 as $l => $l1){ 
                $id = $l1['id'];
                $nav_left4 = $d->o_fet("select * from #_category where id_loai = {$id} and hien_thi=1 order by so_thu_tu asc, id desc");
            ?>
                 <li class="<?=(count($nav_left4) > 0) ? 'hasmenu' : '';?>">
                    <a href="<?=URLPATH.$l1['alias_'.$lang].'.html'?>"><i class="fa fa-plus-square-o"></i>&nbsp;<?=$l1['ten_'.$lang]?></a>
                    <ul class="menu-chidl">
                        <?php foreach($nav_left4 as $l2 => $l3){  ?>
                            <li> <a href="<?=URLPATH.$l3['alias_'.$lang].'.html'?>"><?=$l3['ten_'.$lang]?></a></li>
                        <?php } ?>
                    </ul>
                </li>
            <?php } ?>
        </ul>
    </div>
   
    <br>
    <div class="group-sm-dpgtroip-r">
        <h2 class="title-1h col" style="margin:0;"><?=$lang == 'vn' ? 'Sản phẩm nổi bật' : 'Hot products'?></h2>
        <div class="spmain">
            <div class="spnb-main">
                <?php foreach($_sanp2 as $key => $sp) { 
                     $gia = ($sp['gia'] != '' ) ? number_format((float)$sp['gia']).' đ' : _lienhe ;
                  ?>
                    <div class="item-sp-homea" style="margin: 0;margin-bottom: 20px;">
                      <div class="img-sphomea"><a href="<?=URLPATH.$sp['alias_'.$lang].'.html'?>"><img src="<?=URLPATH.'img_data/images/'.$sp['hinh_anh']?>" alt="<?=$sp['ten_'.$lang]?>"></a></div>
                      <div class="group-giatt">
                        <a href="<?=URLPATH.$sp['alias_'.$lang].'.html'?>">
                          <div class="ten-sphome"><?=$sp['ten_'.$lang]?></div>
                          <div class="giasphomea"><?=$gia?> </div>
                        </a>
                      </div>
                    </div>
                  <?php } ?>
            </div>
        </div>
    </div>
    <br>


</div>
<script async defer crossorigin="anonymous" src="https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v4.0&appId=350125278987106&autoLogAppEvents=1"></script>
<script type="text/javascript" src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
<script type="text/javascript" src="<?=URLPATH?>templates/module/slick/slick.min.js"></script>
<script>
    $(document).ready(function(){
        $('#selectlink').click(function(event){
            $link = $('#selectlink').val();
            console.log($link);
            if($link != ''){

                window.location.href = $(this).val()
            }
        });
    });
</script>   
<script type="text/javascript">
    jQuery(document).ready(function($) {
        $('.spnb-main').slick({
            slidesToShow: 1,
            autoplay:true,
            autoplaySpeed: 4000,
            vertical: true,
            arrows:false
        });
     })
</script>

 