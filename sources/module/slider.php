<?php

$slide  = $d->getImg(1130);
$chuoi = "";
foreach ($slide as $key => $item_sl) {
    $chuoi .= '
    <a href="' . $item_sl['link'] . '">
        <img src="' . URLPATH . 'img_data/images/' . $item_sl['picture'] . '" data-thumb="' . URLPATH . 'img_data/images/' . $item_sl['picture'] . '" alt="' . $item_sl['title_vn'] . '"/>
    </a> 
    ';
}
?>
<link rel="stylesheet" href="<?= URLPATH ?>templates/module/nivo-slider/css/themes/default/default.css" type="text/css" media="screen" />
<link rel="stylesheet" href="<?= URLPATH ?>templates/module/nivo-slider/css/nivo-slider.css" type="text/css" media="screen" />
<div class="slider-wrapper theme-default">
    <div id="slider" class="nivoSlider">
        <?= $chuoi ?>
    </div>
</div>
<script type="text/javascript" src="<?= URLPATH ?>templates/module/nivo-slider/js/jquery.nivo.slider.js"></script>
<script type="text/javascript">
    $(window).load(function() {
        $('#slider').nivoSlider({
            controlNav: false,
        });
    });
</script>