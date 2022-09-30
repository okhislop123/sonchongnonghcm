<?php
date_default_timezone_set('Asia/Ho_Chi_Minh');
$thanhcong = $d->getTemplates(29);
?>
<section>

    <div class="page-title">
        <div class="container bg-white">
            <div class="col-md-12 plr10">

            </div>
        </div>
    </div>
    <br>
    <div class="container__item bg-white">
        <div class="row">

            <div class="col-md-9 plr10">
                <div class="clearfix"></div>

                <div class="box-item module" style="margin: 20px 0 40px;">
                    <?= @$thanhcong['noi_dung_' . $_SESSION['lang']]; ?>
                </div>

            </div>
        </div>
    </div>
</section>