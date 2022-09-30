<?php
  $doitac = $d->getImg(1182); 
?>

<style type="text/css">
    .marquee0{
        width: 100%;
        padding: 0px 15px;
    }
  .marquee0 img{ padding: 5px; border:1px solid #e4e4e4; border-radius: 5px; background: #fff; }
  .marquee0>div{
    width: 100% !important;
  }
  section.sec-partner {
    padding: 40px 0px;
   /* background-color: #eceded;*/
}
</style>
<div class="clearfix"></div>
<section class="sec-partner">
  <div class="container p0">
    <h2 class="title-shome">Đối tác của NCB</h2>
    <div class="wrapper-partner">
      <div style="width:100%; margin:0 auto;">
          <div class="marquee" id="mycrawler2">
            <?php 
                foreach ($doitac as $dt) {
            ?>
          <a class="prods_pic_bg" href="<?=$dt['link'] ?>" >
                  <img onerror="this.src='./img/noImage.gif';" class="img_lkdoitac" src="<?=URLPATH ?>thumb.php?src=<?=URLPATH ?>img_data/images/<?=$dt['picture'] ?>&w=170&h=90&zc=2" style="margin: 0px 5px;" />
              </a>
            <?php } ?>
        </div>
       </div>
    </div>
  </div>
</section>
<div class="clearfix mb20"></div>
<script src="<?=URLPATH?>templates/module/crawler.js"></script>
<script type="text/javascript">
    marqueeInit({
        uniqueid: 'mycrawler2',
        inc: 1, 
        mouse: 'pause',
        moveatleast: 1,
        neutral: 120,
        savedirection: true,
        random: true,
    });
</script>