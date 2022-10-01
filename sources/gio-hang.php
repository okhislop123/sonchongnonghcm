<?php
$thanhpho = $d->o_fet("select * from #_thanhpho where hien_thi=1 order by ten_vn asc");
if (!isset($_SESSION)) {
    session_start();
}
if (isset($_POST['addcart'])) {
    $id = $_POST['id'];
    $soluong = isset($_POST['soluong']) ? $_POST['soluong'] : 1;
    $soluong = (int)$soluong;
    $size = $_POST['size'] ?  $_POST['size'] : "0";
    $color = $_POST['color'] ? $_POST['color'] : "0";
    // $idframe = $_POST['idframe'];
    $price = $_POST['gia'];
    // $fileImg = $_POST['fileImg'];



    $detail = $d->simple_fetch("select * from #_sanpham where id={$id}");
    if (!empty($detail)) {
        $id_pro = $detail['id'] . "_" . $size . "_" . $color;
        if (isset($_SESSION['cart'][$id_pro])) {
            $_SESSION['cart'][$id_pro]['so_luong'] = $_SESSION['cart'][$id_pro]['so_luong'] + $soluong;
            $_SESSION['cart'][$id_pro]['mau'] =  $color;
            // $_SESSION['cart'][$id_pro]['frame'] =  $frame;
            // $_SESSION['cart'][$id_pro]['idframe'] =  $idframe;
            $_SESSION['cart'][$id_pro]['size'] =  $size;
            $_SESSION['cart'][$id_pro]['price'] =  $detail["gia"];
            // $_SESSION['cart'][$id_pro]['fileImg'] =  $fileImg;
        } else {
            $_SESSION['cart'][$id_pro]['so_luong'] = $soluong;
            $_SESSION['cart'][$id_pro]['mau'] =  $color;
            $_SESSION['cart'][$id_pro]['size'] =  $size;
            // $_SESSION['cart'][$id_pro]['frame'] =  $frame;
            // $_SESSION['cart'][$id_pro]['idframe'] =  $idframe;
            $_SESSION['cart'][$id_pro]['price'] =  $detail["gia"];
            // $_SESSION['cart'][$id_pro]['fileImg'] =  $fileImg;
        }
    }
}


if (isset($_POST['guidonhang'])) {

    if (isset($_SESSION['cart'])) {
        //kiem tra so luong don hang

        if (isset($_SESSION['user_admin1'])) {
            $idkh = $_SESSION['user_admin1'];
        } else {
            $idkh = '';
        }

        $ma_donhang = 'DH' . $d->chuoird('5');

        $d->reset();
        $data['trang_thai'] = 0;
        $data['ho_ten'] = $d->clear($_POST['ten']);
        $data['idkh'] = $idkh;
        $data['email'] = $d->clear($_POST['email']);
        $data['dia_chi'] = $d->clear($_POST['diachi']);
        $data['dien_thoai'] = $d->clear($_POST['dienthoai']);
        $data['hinh_thuc_thanh_toan'] = $d->clear($_POST['thanhtoan']);
        $data['loi_nhan'] = addslashes($_POST['loinhan']);
        $data['ma_dh'] = $ma_donhang;
        $data['ngay_dat_hang'] = time();
        $d->setTable('#_dathang');
        if ($id_don = $d->insert($data)) {

            $hinhthuc = $d->simple_fetch("select * from #_hinhthucthanhtoan where id={$data['hinh_thuc_thanh_toan']}");
            $row_nd = "";
            $total = 0;
            $tong = 0;

            foreach ($_SESSION['cart'] as $key => $value) {
                $newArray = explode("_", $key);
                $product = $d->simple_fetch("select * from #_sanpham where id={$newArray[0]}");
                if (!empty($product)) {

                    $addPrice = 0;
                    if ($newArray[1]) {
                        $sizes = json_decode($product['size'], true);
                        // $size = $d->simple_fetch("select * from #_size where id={$newArray[1]}");
                        foreach ($sizes as $s => $si) {
                            if ($si["id"] == $newArray[1]) {
                                $addPrice = $si["price"];
                                break;
                            }
                        }
                    }

                    $price = $value['price'] + $addPrice;
                    $id_product = $product['id'];
                    $tongtien = $tongtien + ($price * $value['so_luong']);

                    $d->reset();
                    $data_2['ma_dh'] = $ma_donhang;
                    $data_2['id_dh'] = $id_don;
                    $data_2['gia'] = $price;
                    $data_2['id_sp'] = $id_product;
                    $data_2['so_luong'] = $value['so_luong'];
                    $data_2['mau'] = $value['mau'];
                    $data_2['size'] = $value['size'];
                    $data_2['price'] = $price * $value['so_luong'];

                    $d->setTable('#_chitietdathang');
                    $d->insert($data_2);


                    $row_nd .= '
                    <tr>
                        <td style="background-color:white;color:#000">' . $value['so_luong'] . '</td>
                        <td style="background-color:white;color:#000"><img src="' . URLPATH . "thumb.php?src=" . URLPATH . "img_data/images/" . $product['hinh_anh'] . '&h=50" alt="' . $product['ten_' . $_SESSION['lang']] . '"></td>
                        <td style="background-color:white;color:#000">' . $product['ten_' . $_SESSION['lang']] . '</td>
                        <td style="background-color:white;color:#000;text-align:right">' . number_format($price) . ' VNĐ</td>
                        <td style="background-color:white;color:#000;text-align:right">' . number_format($price * $value['so_luong']) . ' VNĐ</td>
                    </tr>                       
                                            ';
                }
            }

            $noidung = '
                    <h3><b>Mã đơn hàng: ' . $_SESSION['madonhang'] . '</b></h3><br>                 
                    <table style="width:100%;min-width:800px;margin:auto;background-color:#ccc;font-size:14px;font-family:Tahoma,Geneva,sans-serif;line-height:20px" border="0" cellpadding="8" cellspacing="1">
                        <tbody>
                            <tr style="background: linear-gradient(#ffffff, #f1f1f1);font-weight:bold">
                                <td style="color:#000">Số lượng</td>
                                <td style="color:#000">Hình ảnh</td>
                                <td style="color:#000">Tên</td>
                                <td style="color:#000">Giá</td>
                                <td style="color:#000">Thành tiền</td>
                            </tr>' . $row_nd . '
                            <tr>
                                <td colspan="3" style="background-color:white;color:#000"></td>
                                <td style="background-color:white;color:#000;text-align:right"><b>Tổng tiền:</b></td>
                                <td style="background-color:white;color:#000;text-align:right;color:red"><b>' . number_format($tongtien) . ' VNĐ</b></td>
                            </tr>
                        </tbody>
                    </table>                

                    <br></br>               
                                        
                    <table style="width:100%;min-width:800px;margin:auto;background-color:#ccc;font-size:14px;font-family:Tahoma,Geneva,sans-serif;line-height:20px" border="0" cellpadding="8" cellspacing="1">
                        <tbody>
                            <tr style="background: linear-gradient(#ffffff, #f1f1f1);">
                                <td colspan="2" style="color:#000"><b>Thông tin khách hàng</b></td>
                            </tr>
                            <tr>
                                <td style="background-color:white;color:#000">Họ tên</td>
                                <td style="background-color:white;color:#000">' . $data['ho_ten'] . '</td>
                            </tr>
                            <tr>
                                <td style="background-color:white;color:#000">Email</td>
                                <td style="background-color:white;color:#000">' . $data['email'] . '</td>
                            </tr>
                            <tr>
                                <td style="background-color:white;color:#000">Điện thoại</td>
                                <td style="background-color:white;color:#000">' . $data['dien_thoai'] . '</td>
                            </tr>
                            <tr>
                                <td style="background-color:white;color:#000">Địa chỉ</td>
                                <td style="background-color:white;color:#000">' . $data['dia_chi'] . '</td>
                            </tr>
                            <tr>
                                <td style="background-color:white;color:#000">Hình thức thanh toán</td>
                                <td style="background-color:white;color:#000">' . $hinhthuc['noi_dung_' . $_SESSION['lang']] . '</td>
                            </tr>
                        </tbody>
                    </table>                        
                    ';
            $madh = $ma_donhang;

            include "./smtp/index.php";
            $thongtin = $d->simple_fetch("select * from #_thongtin limit 0,1");
            unset($_SESSION['cart']);
            // sendmail("Bạn có 1 đơn đặt hàng mới!", $noidung, $thongtin['email'] , $thongtin['email'] ,  $data['ho_ten']);

            // sendmail("Bạn có 1 đơn đặt hàng mới!", $noidung, $thongtin['email'] , $thongtin['email'] , $data['ho_ten'], $thongtin['email_smtp'], $thongtin['pass_smtp'] );
            // sendmail("Buy successful!", $noidung, $thongtin['email'] , $data['email'] , $thongtin['name_email'], $thongtin['email_smtp'], $thongtin['pass_smtp'] );
            header("Location:" . URLPATH . "cart-success.html?id=" . $madh);
        } else {
            $d->alert("The order has been sent or cart empty!");
        }
    }
}

if (isset($_POST['capnhatsl'])) {
    $id = addslashes($_POST['id']);
    $soluong = addslashes($_POST['soluong']);
    $d->reset();
    $data['so_luong'] = $soluong;
    $d->setWhere('id', $id);
    $d->setTable('#_chitietdathang');
    if (is_numeric($soluong) && $soluong > 0) {
        if ($d->update($data)) {
            $d->location(URLPATH . "gio-hang.html");
        }
    } else {
        $d->alert("Giỏ hàng trống");
    }
}

if (isset($_POST['xoasp'])) {
    $id = addslashes($_POST['id']);
    $d->reset();
    $d->setWhere('id', $id);
    $d->setTable('#_chitietdathang');
    if ($d->delete()) {
        $d->location(URLPATH . "gio-hang.html");
    }
}

if (isset($_POST['xoaall'])) {
    $d->reset();
    $d->setWhere('id_dh', @$_SESSION['iddonhang']);
    $d->setTable('#_chitietdathang');
    if ($d->delete()) {
        $d->location(URLPATH . "gio-hang.html");
    }
}

if (isset($_SESSION['id_thanhvien']) and $_SESSION['id_thanhvien'] != "") {
    $row = $thongtin = $d->simple_fetch("select * from #_thanhvien where id = " . $_SESSION['id_thanhvien'] . " ");
}
?>
</div>

<style type="text/css">
    .table tr th a {
        color: #000;
    }

    .wrapper-contai {
        position: static;
    }
</style>

<section class="cart__page">
    <div class="container__item">
        <?php if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) { ?>

            <div class="row">
                <div class="col-md-4">
                    <h3 class="title-home" style="font-size: 20px;border: none;text-align: center;margin-bottom: 15px;"><?= ($lang == 'vn') ? 'Thông tin đặt hàng' : 'order information'; ?></h3>
                    <!--ul class="nav nav-tabs">
                <li class="active"><a data-toggle="tab" href="#home">Mua nhanh</a></li>
                <li><a data-toggle="tab" href="#menu1">Đăng nhập thành viên</a></li>
            </ul-->
                    <div class="tab-content" style="background-color: #f3f3f3;padding: 15px;">
                        <div id="home" class="tab-pane fade in active">
                            <div class="login">
                                <?php
                                $tenus = '';
                                $mailus = '';
                                $sdtus = '';
                                $diachius = '';

                                if (isset($_SESSION['user_admin1'])) {
                                    $tk1 = $_SESSION['user_hash1'];
                                    $login = $d->simple_fetch("select * from #_thanhvien where thanhvien_hash = '{$tk1}'");
                                    //echo '<pre>'; print_r($login); echo '</pre>'; exit;
                                    $tenus = $login['ho_ten'];
                                    $mailus = $login['email'];
                                    $sdtus = $login['dien_thoai'];
                                    $diachius = $login['dia_chi'];
                                }
                                ?>
                                <form action="" id="form-shopping" method="post">
                                    <div class="row m-5">
                                        <div class="form-group col-sm-12 p5">
                                            <input value="<?= $tenus ?>" required placeholder="<?= ($lang == 'vn') ? 'Nhập họ tên' : 'Enter your full name (*)' ?>" type="text" class="form-control" id="ten" name="ten" data-error="<?= _typehoten ?>">
                                        </div>
                                        <div class="form-group col-sm-6 p5">
                                            <input value="<?= $mailus ?>" placeholder="<?= ($lang == 'vn') ? 'Email' : 'Enter email (if applicable)' ?>" type="email" class="form-control" id="email" name="email">
                                        </div>
                                        <div class="form-group col-sm-6 p5">
                                            <input value="<?= $sdtus ?>" placeholder="<?= ($lang == 'vn') ? 'Số điện thoại' : 'Enter your phone number(*)' ?>" required type="text" class="form-control" id="dienthoai" name="dienthoai" data-error="<?= _typesodienthoai ?>">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <input value="<?= $diachius ?>" type="text" placeholder="<?= ($lang == 'vn') ? 'Nhập địa chỉ' : 'Enter your shipping address' ?>" required class="form-control" id="diachi" name="diachi" data-error="<?= _typeaddress ?>">
                                    </div>

                                    <input value="0" type="hidden" id="inp_phiship" name="phi_ship">

                                    <div class="form-group">
                                        <textarea id="loinhan" placeholder="<?= ($lang == 'vn') ? 'Lời nhắn' : 'Enter your message' ?>" class="form-control" rows="3" name="loinhan"></textarea>
                                    </div>

                                    <div class="form-group">
                                        <label for="thanhtoan"><?= ($lang == 'vn') ? 'Phương thức thanh toán' : 'Select a payment method' ?></label>
                                        <select name="thanhtoan" class="form-control" id="thanhtoan">
                                            <?php
                                            $_hinhthucthanhtoan = $d->o_sel("*", "#_hinhthucthanhtoan", "hien_thi = 1", "so_thu_tu asc");
                                            foreach ($_hinhthucthanhtoan as $httt) {
                                            ?>
                                                <option value="<?= $httt['id'] ?>" <?php if (!empty($_POST['thanhtoan']) && $_POST['thanhtoan'] == $httt['id']) echo 'selected="selected"' ?>><?= $httt['ten_vn'] ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <!-- <div class="form-group">
                                        <input type="text" required class="form-control" placeholder="<?= ($lang == 'vn') ? 'Mã bão vệ' : 'Enter the security code' ?>" id="captcha" name="captcha" style="background: url(<?= URLPATH . 'sources/capchaimage.php' ?>) center right no-repeat">
                                    </div> -->
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-login" name="guidonhang">Đặt hàng</button>
                                        <div class=" clearfix"></div>
                                    </div>

                                </form>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="col-md-8">
                    <div class="page-cart">
                        <div class="info-cart">
                            <div class="">
                                <h3 class="title-home" style="font-size: 20px;margin-bottom:15px;border: none;text-align: center;margin-bottom: 15px;"><?= ($lang == 'vn') ? 'Chi tiết đơn hàng' : 'Order details' ?></h3>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-hover table-bordered ">
                                    <tbody>
                                        <tr>
                                            <th style="width:3%">STT</th>
                                            <!-- <th style="width:7%;" align="left">Images</th> -->
                                            <th style="width:25%;" class="">Tên sản phẩm</th>
                                            <th style="width:15%; text-align: center;">Giá</th>

                                            <th style="width:10%;" align="center" class="th_soluong">Số lượng</th>
                                            <th style="width:15%;">Thành tiền</th>
                                            <th style="width:10%;">
                                                Xóa
                                            </th>
                                        </tr>
                                        <?php
                                        $stt = 0;
                                        $tongtien = 0;

                                        if (count($_SESSION['cart']) > 0) {
                                            foreach ($_SESSION['cart'] as $key => $value) {
                                                // var_dump($key);
                                                // die();

                                                $newArray = explode("_", $key);
                                                $product = $d->simple_fetch("select * from #_sanpham where id={$newArray[0]}");

                                                // handle color
                                                $color = $d->simple_fetch("select * from #_people where id={$newArray[2]}");
                                                $colorName = $color['ten_' . $_SESSION['lang']] ?  $color['ten_' . $_SESSION['lang']] : "Màu khác";

                                                // handle size

                                                $sizeName = "";
                                                $addPrice = 0;
                                                if ($newArray[1]) {
                                                    $sizes = json_decode($product['size'], true);
                                                    // $size = $d->simple_fetch("select * from #_size where id={$newArray[1]}");
                                                    foreach ($sizes as $s => $si) {
                                                        if ($si["id"] == $newArray[1]) {
                                                            $sizeName = $si["name"];
                                                            $addPrice = $si["price"];
                                                            break;
                                                        }
                                                    }
                                                }

                                                if (!empty($product)) {

                                                    $id_product = $product['id'];
                                                    $price = $value['price'] + $addPrice;
                                                    $tongtien = $tongtien + ($price * $value['so_luong']);
                                                    $stt++;
                                        ?>
                                                    <tr>
                                                        <td><?= $stt ?></td>
                                                        <!-- <td align="left">
                                                    <img onerror="this.src='./img/noImage.gif';" src="<?= URLPATH ?>thumb.php?src=<?= URLPATH ?>img_data/images/<?= @$sanpham[0]['hinh_anh'] ?>&w=50&h=50">
                                                </td> -->
                                                        <td>
                                                            <a href="<?= URLPATH . $product['alias_' . $_SESSION['lang']] ?>.html">
                                                                <?= @$product['ten_' . $_SESSION['lang']] ?>
                                                                <div>Màu: <?= $colorName ?></div>
                                                                <div>Dung tích: <?= $sizeName ?></div>
                                                            </a>
                                                        </td>
                                                        <td align="left"><strong>
                                                                <?= @$d->vnd($price) ?>
                                                                <!-- <div><?= @$d->dolla_vnd($value['frame']) ?></div> -->
                                                            </strong></td>


                                                        <td align="center">
                                                            <input name="soluong" style="width: 50px;" type="number" value="<?= $value['so_luong'] ?>" onchange="chang_soluong(this,'<?= $key ?>','<?= $_SESSION['iddonhang'] ?>')" class="text-center soluong_<?= $value['soluong'] ?>">

                                                        </td>

                                                        <td align="left">
                                                            <div id="thanhtien_117" class="thanhtien_<?= $val['id'] ?> color-main">
                                                                <?php
                                                                echo $d->vnd($price * $value['so_luong'] + $value['frame']);
                                                                ?>
                                                            </div>
                                                        </td>
                                                        <td align="left">
                                                            <a href="javascript:;" onclick="xoa_sp_gh_dh('<?= $key ?>','<?= $_SESSION['iddonhang'] ?>','<?= _redel ?>?')" title="Xóa sản phẩm"><i class="fas fa-trash-alt"></i></a>
                                                        </td>
                                                    </tr>
                                        <?php }
                                            }
                                        } ?>
                                        <tr>
                                            <td colspan="5" class="text-right"><?= ($lang == 'vn') ? 'Tổng tiền:' : 'Total amount:' ?></td>
                                            <td class="text-right">
                                                <font class="color-main"><?= $d->vnd($tongtien) ?></font>
                                            </td>
                                        </tr>
                                        <!--tr>
                                        <td colspan="5"  class="text-right">Phí vận chuyển:</td>
                                        <td class="text-right"><span id="phi_ship">0</span></td>
                                    </tr-->
                                        <tr>
                                            <td colspan="2" style="border-right: 0">
                                                <div class="mua-tiep">
                                                    <a href="<?= URLPATH ?>" style="color: red;"><?= ($lang == 'vn') ? 'Tiếp tục mua hàng' : 'Continue buying' ?></a>
                                                </div>
                                            </td>
                                            <td colspan="4" style="border-left: 0;">
                                                <div class="tong_tt">
                                                    <h3 class="text-right"><span><?= ($lang == 'vn') ? 'Số tiền phải trả:' : 'Amount to pay:' ?></span>
                                                        <font id="tong_tien_gh" class="color-main"><?= $d->vnd($tongtien) ?></font>
                                                    </h3>
                                                </div>
                                            </td>

                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php } else { ?>

            <div class="well text-center">
                <a href="javascript:history.back()"><?= _cartblank ?></a>
            </div>

        <?php } ?>
    </div>
    <br>
</section>


<style type="text/css">
    table th,
    table td {
        text-align: center;
    }

    #form-shopping button.button {
        margin-right: 15px;
    }
</style>

<script>
    function formatNumber(nStr, decSeperate, groupSeperate) {
        nStr += '';
        x = nStr.split(decSeperate);
        x1 = x[0];
        x2 = x.length > 1 ? '.' + x[1] : '';
        var rgx = /(\d+)(\d{3})/;
        while (rgx.test(x1)) {
            x1 = x1.replace(rgx, '$1' + groupSeperate + '$2');
        }
        return x1 + x2;
    }
    //$('.quan_1').change(function(){
    // phi_ship = $(".quan_1 option:selected").attr('data_ship');
    //$("#phi_ship").html(formatNumber(phi_ship, ',', '.')+' <sup>đ</sup>');
    //thanhtien = Number(<?= $tongtien ?>)+Number(phi_ship);
    //$("#tong_tien_gh").html(formatNumber(thanhtien, ',', '.')+' <sup>đ</sup>');
    //$("#inp_phiship").val(phi_ship);
    //});
    $('#nhan_khac').click(function() {
        if ($(this).is(":checked")) {
            $("#tt_nhan").show();
        } else if ($(this).is(":not(:checked)")) {
            $("#tt_nhan").hide();
        }
    });

    function getDistrict(_this, el) {
        var id = _this.value;
        $.ajax({
                url: './sources/ajax.php',
                type: 'POST',
                data: {
                    do: 'get_quan',
                    id: id
                },
            })
            .done(function(data) {
                $(el).html(data);
            });

    }

    function xoa_sp_gh_dh(id, iddh, al) {
        var cf = confirm(al);
        if (cf) {
            $.ajax({
                url: "./sources/ajax.php",
                type: 'POST',
                data: {
                    'do': 'xoa_sp_gh',
                    'id': id,
                    'iddh': iddh
                },
                success: function(data) {
                    window.location.href = "<?= URLPATH ?>gio-hang.html";
                }
            })
        }
    }

    function thanhtien(id, iddh) {
        var cls = ".thanhtien_" + id;
        $.ajax({
            url: "./sources/ajax.php",
            type: 'POST',
            data: {
                'do': 'thanh_tien',
                'id': id,
                'iddh': iddh
            },
            success: function(data) {
                $(cls).html(data);
            }
        })
    }

    function tongtien(id, iddh) {
        $.ajax({
            url: "./sources/ajax.php",
            type: 'POST',
            data: {
                'do': 'tong_tien',
                'id': id,
                'iddh': iddh
            },
            success: function(data) {
                $("#tong_tien_gh").html(data);
            }
        })
    }

    function chang_soluong(obj, id, iddh) {
        var sl = $(obj).val();
        $.ajax({
            url: "./sources/ajax.php",
            type: 'POST',
            data: {
                'do': 'change_so_luong',
                'id': id,
                'iddh': iddh,
                'sl': sl
            },
            success: function(data) {
                if (data == 0) {
                    alert("Số lượng nhập không hợp lệ!");
                } else {
                    console.log(data);
                    window.location.href = "<?= URLPATH ?>gio-hang.html";
                    // thanhtien(id,iddh);
                    // tongtien(id,iddh);
                }
            }
        })
    }
</script>