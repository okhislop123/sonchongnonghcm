<?php
if (!isset($_SESSION)) {
    session_start();
}
//include "./smtp/index.php";
date_default_timezone_set('Asia/Ho_Chi_Minh');
$textfooter = $d->getTemplates(53);


if (isset($_POST['sub_email'])) {
    // $chuoi1 = strtolower($_SESSION['captcha_code']);
    // $chuoi2 = strtolower($_POST['captcha']);
    // if ($chuoi1 == $chuoi2) {
    $d->reset();
    $data['ho_ten'] = addslashes($_POST['ho_ten']);
    $data['email'] = addslashes($_POST['email']);
    $data['sdt'] = addslashes($_POST['so_dien_thoai']);
    $data['noi_dung'] = addslashes($_POST['noi_dung']);
    // $data['dia_chi'] = addslashes($_POST['dia_chi']);
    $data['ngay_hoi'] = date('d-m-Y H:i:s');
    $data['trang_thai'] = '0';
    $data['tieu_de'] = "Liên hệ";

    $d->setTable('#_lienhe');
    $noidung = "<div style='margin-bottom:5px;'>Bạn nhận được tin nhắn từ website: " . URLPATH . " : </div>";
    $noidung .= "<div style='margin-bottom:5px;'>Thông tin: </div>";
    $noidung .= "<div style='margin-bottom:5px;'>Họ tên: " . $_POST['ho_ten'] . "</div>";
    // $noidung .= "<div style='margin-bottom:5px;'>Địa chỉ: " . $_POST['dia_chi'] . "</div>";
    $noidung .= "<div style='margin-bottom:5px;'>Số điện thoại: " . $_POST['so_dien_thoai'] . "</div>";
    $noidung .= "<div style='margin-bottom:5px;'>Email: " . $_POST['mail'] . "</div>";
    // $noidung .= "<div style='margin-bottom:5px;'>Tiêu đề: ".$_POST['tieu_de']."</div>";
    $noidung .= "<div style='margin-bottom:5px;    line-height: 1.5;'>Content: " . $_POST['noi_dung'] . "</div>";
    $noidung .= "<div style='margin-bottom:5px;'>Date: " . date('d-m-Y h:i:s', time()) . "</div>";
    $noidung .= "<div style='color:red; margin-top:10px; font-style:italic; font-size:12px'>Đây là thư gửi tự động, vui lòng ko trả lời thư này!</div>";
    if ($d->insert($data)) {
        // if(sendmail("Liên hệ từ website ".URLPATH, $noidung, $_POST['mail'] , $thongtin[0]['email'] ,  $data['ho_ten'])) {
        // }
        $d->alert("Gửi thành công!");
        $d->location(URLPATH);
    } else {
        $d->alert("Error!");
    }
    // } 
    // else {
    //     $d->alert("Security code is incorrect");
    // }
}
$dulieu = $d->getTemplates(10);
$bg = $d->getTemplates(60);
$textfooter = $d->getTemplates(28);
$textfooter2 = $d->getTemplates(59);

$dulieu_1 = $d->simple_fetch("select * from #_category where hien_thi = 1 and id = 1301");
$loai = $d->simple_fetch("select * from #_category where hien_thi = 1 and alias_{$lang} = '$com'");
?>

<!-- <div class="bradcum-news">
    <div class="brea2">
        <div class="container__item">
            <div class="bregroup" style="background: url(<?= URLPATH . 'img_data/images/' . $bg['hinh_anh'] ?>);">
                <h1 class="title-home"><span><?= $loai['ten_' . $lang] ?></span></h1>
                <?= $d->breadcrumbList($loai['id'], $lang, URLPATH) ?>
            </div>
        </div>
    </div>
</div> -->

<!-- <div class="container">
    <div class="row">
       
        <div class="col-md-12">
            
            
            <div class="clearfix"></div>
            <div class="row">
                 <div class="col-12 ttlhe">
                    <?= $textfooter['noi_dung_' . $lang] ?>
                </div>
                <div class="col-12 ttlhe">
                    <?= $dulieu_1['mo_ta_' . $_SESSION['lang']]; ?>
                    <div id="map">  
                        <?php if (!empty($information['map'])) { ?>
                                <?= $information['map'] ?>
                        <?php } else { ?>
                            <div id="map_contact"></div>
                        <?php } ?>
                    </div>
                </div>
                <div class="col-12">
                    <h3 style="padding-left: 15px; text-transform: uppercase;font-size: 20px;font-weight: 600;margin-top: 10px;margin-bottom: 20px;text-align: center;"><?= ($lang == 'vn') ? 'Thông tin liên hệ' : 'Contact information' ?></h3>
                    <form id="form-contact" method="post">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <input type="text" id="ho_ten" required  name="ho_ten" class="form-control"  placeholder="<?= _hoten ?> (*)">
                            </div>
                            <div class="form-group">
                                <input type="text" id="dia_chi" name="dia_chi" class="form-control"  placeholder="<?= _address ?>">
                            </div>
                            <div class="form-group">
                                <input type="email" id="email" name="email" class="form-control"  placeholder="Email ">
                            </div>
                            <div class="form-group">
                                <input type="text" id="so_dien_thoai" required name="so_dien_thoai" class="form-control" placeholder="<?= _sodienthoai ?>(*)">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="textarea-message form-group">
                                <textarea class="form-control"  name="noi_dung" placeholder="<?= ($lang == 'vn') ? 'Nội dung ' : 'Content ' ?>" rows="6"></textarea>
                            </div>
                            <div class="form-group item-captcha">
                                <div class="row">
                                    <div class="col-sm-8">
                                        <input type="text" required class="form-control" placeholder="<?= ($lang == 'vn') ? 'Nhập mã bảo vệ' : 'Enter the security code' ?>" id="captcha" name="captcha" style="background: url(./sources/capchaimage.php) center right no-repeat">
                                    </div>
                                    <div class="col-sm-4">
                                        <button class="form-control btn btn-success btn-send-contact" name="sub_email" type="submit"><?= _send ?> 
                                        <i class="fa fa-paper-plane"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </form>
                </div>
                
            </div>
        </div>
    </div>
</div> -->
<br><br>
<div class="contact__page">
    <div class="container__item_2">
        <div class="row">
            <div class="col-md-12 col-xs-12" style="font-family:ggsanr" style="margin-bottom: 20px">
                <!-- <?= $loai['mo_ta_' . $lang] ?> -->
                <h2 class="title__tesst"><?= $loai['ten_' . $lang] ?></h2>
                <div class="map_f">
                    <?= $information['map'] ?>
                </div>

            </div>
            <div class="group_contact_detail">

                <div class="col-md-6 col-xs-12">
                    <h4 class="title-f-3"><span><?= $textfooter['ten_' . $lang] ?></span></h4>
                    <div class="mo-ta-ft-2">
                        <?= $textfooter['noi_dung_' . $lang] ?>
                    </div>
                </div>
                <div class="col-md-6 col-xs-12">
                    <!-- <h4 class="title-f-3"><span><?= $textfooter2['ten_' . $lang] ?></span></h4> -->
                    <!-- <div class="mo-ta-ft-2">
                    <?= $textfooter2['noi_dung_' . $lang] ?>
                </div> -->
                    <form id="form-contact" method="post">
                        <div class="col-12">
                            <div class="form-group">
                                <label for="" style="width: 100%"><?= _hoten ?></label>
                                <input type="text" id="ho_ten" required name="ho_ten" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="" style="width: 100%"><?= _sodienthoai ?></label>
                                <input type="text" id="so_dien_thoai" required name="so_dien_thoai" class="form-control" placeholder="">
                            </div>
                            <div class="form-group">
                                <label for="" style="width: 100%"><?= _address ?></label>
                                <input type="text" id="dia_chi" name="dia_chi" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="" style="width: 100%"><?= _email ?></label>
                                <input type="email" id="email" name="email" class="form-control">
                            </div>
                            <!-- <div class="form-group">
                        <input type="text" id="so_dien_thoai" required name="so_dien_thoai" class="form-control" placeholder="Phone  (*)">
                    </div> -->
                        </div>
                        <div class="col-12">
                            <div class="textarea-message form-group w-100 ">
                                <label for="" style="width: 100%"><?= _content ?></label>
                                <textarea class="form-control" name="noi_dung" rows="4"></textarea>
                            </div>
                            <div class="form-group item-captcha w-100 ">
                                <div class="row">
                                    <!-- <div class="col-sm-12">
                                    <input type="text" required class="form-control" placeholder="<?= _captcha ?>" id="captcha" name="captcha" style="background: url(./sources/capchaimage.php) center right no-repeat">
                                </div> -->
                                    <div class="col-sm-12 text-center">
                                        <button class="form-control btn btn-success btn-send-contact " style="margin-top:15px" name="sub_email" type="submit"><?= _send ?>

                                        </button>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>