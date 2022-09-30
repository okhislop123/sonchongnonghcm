<?php
if(!isset($_SESSION))
{
	session_start();
}
	error_reporting(0); 
	define('_source','../sources/');
	define('_lib','../admin/lib/');
	@include _lib."config.php";
	@include_once _lib."function.php";
	$d = new func_index($config['database']);

	$do = addslashes($_POST['do']);
	
	if($do=='xoa_sp_gh') {
		$id = addslashes($_POST['id']);
		unset($_SESSION['cart'][$id]);		
	}
	if($do=='getPrice') {
		$idSize = addslashes($_POST['idSize']);
		$idPeople = addslashes($_POST['idPeople']);
		$idProduct = addslashes($_POST['idProduct']);
		$listSize = $d->o_fet("select * from #_custom where idproduct = $idProduct and idpeople = ".$idPeople." and idsize = $idSize");
		$price__format = '$ '.number_format($listSize[0]['price'], 2, '.', '');
		
		$price = $listSize[0]['price'];
		
		echo json_encode([
			'price' => $price,
			'price__format' => $price__format,
		]);
	}
		
	if($do=='getListSize') {
		$people = addslashes($_POST['people']);
		$product = addslashes($_POST['product']);
		$size = rtrim(ltrim(addslashes($_POST['size']),','),',');
		$listSize = $d->o_fet("select * from #_custom where idproduct = $product ");
		
		// $arrId = [];
		// foreach($listSize as $key => $item){
		// 	array_push($arrId,$item['idsize']);
		// }
		$string = implode(',',$arrId);
		$listSizeSelect = $d->o_fet("select * from #_size where id in ($size)");
		$content = "";
		foreach($listSizeSelect as $key => $item) { 
			
			$content .= '<div class="item__size">
				<input';
				
				$content .= ' onchange="getPrice()" name="size" type="radio" id="'.$item['id'] .'" value="'.$item['id'] .'">
				<label for="'. $item['id'] .'">'. $item['ten_vn'] .'</label>
			</div>';
		}
		echo $content;
		
	}

	if($do=='getListNumber') {
		
		$product = addslashes($_POST['product']);
		$size = addslashes($_POST['size']);

		$listSize = $d->o_fet("select * from #_custom where idproduct = $product and idsize = $size");
		$content = '';
		foreach($listSize as $key => $item){ 
			$content .= "
				<div class=\"item\">
					<input onchange=\"getPrice()\"  name=\"numbera\" type=\"radio\" id=".$item['idpeople']." value=".$item['idpeople'].">
					<label for=".$item['idpeople'].">".$item['idpeople']." character</label>
			</div>
			";
		}
		echo $content;
	}

	if($do=='xoa_sp_gh2') {
		$id = addslashes($_POST['id']);
		unset($_SESSION['cart2'][$id]);		
	}
	else if($do=='thanh_tien') {
		$id = addslashes($_POST['id']);
		$iddh= addslashes($_POST['iddh']);
		$thanhtien = $d->o_fet("select * from  #_chitietdathang where id= '".$id."'");
		$tt = 0;
		if(@$thanhtien[0]['khuyen_mai'] <> 0){
			$tt = @$thanhtien[0]['so_luong']*@$thanhtien[0]['khuyen_mai'];
		}else{
			$tt = @$thanhtien[0]['so_luong']*@$thanhtien[0]['gia'];
		}
		echo $d->vnd($tt);		
	}
	else if($do == "menu_hide") {
		$id = $_POST['id'];
		$nav  = $d->o_fet("select * from #_category where id_loai = $id and hien_thi=1 order by so_thu_tu asc, id desc"); 
	?>
			<ul class="menu__wtf <?=$id == '1288' ? "wpt2":""?>">
				<?php foreach($nav as $key => $item) { ?>
					<li class="sub_menu_wtf <?=$item['id_loai'] == '1288' ? "wpt-50":""?>"><a href="<?=URLPATH.$item['alias_'.$_SESSION['lang']].'.html'?>"><?=$item['ten_'.$_SESSION['lang']]?></a></li>
				<?php } ?>
            </ul>
		<?php
	}
	else if($do=='tong_tien') {
		$id = addslashes($_POST['id']);
		$iddh= addslashes($_POST['iddh']);
		$thanhtien = $d->o_fet("select * from  #_chitietdathang where id_dh = '".$iddh."'");
		
		$tt = 0;
		if(count($thanhtien) >0 ){
			foreach ($thanhtien as $val) {
				if($val['khuyen_mai'] <> 0){
					$tt += $val['khuyen_mai']*$val['so_luong'];
				}else{
					$tt +=  $val['so_luong']*$val['gia'];
				}
			}
		}

		echo $d->vnd($tt);		
	}
	else if($do=='changmk') {
		$data = "";
		 $id = $_POST['id'];
		$mkmoi1 = sha1($_POST['mkmoi1']);

		$data = array(
			'pass_hash'=> $mkmoi1,
			
		);
		$d -> setTable('#_thanhvien');
		$d-> setWhere('thanhvien_hash',$id);
		if ($d -> update($data)) {
			echo json_encode(['message' => 'Cập nhật thành công', 'status' => 'success']);
		}
		else
		{
			echo json_encode(['message' => 'Cập nhật thất bại', 'status' => 'warning']);
		}
		
		
		
		
	}
	else if($do=='dkemail') {
		$data = "";
		$email = $_POST['email'];
		$data = array(
			
			'email'=>$email,
			'tieu_de'=>'Đăng ký nhận mail',
			'ngay_hoi'=>date('d-m-Y H:i:s'),
			'trang_thai'=>0,
		);
		$d -> setTable('#_lienhe');
		if ($d -> insert($data)) {
			echo json_encode(['message' => 'Đặng ký thành công', 'status' => 'success']);

		}
		else
		{
			echo json_encode(['message' => 'Đặng ký thất bại', 'status' => 'warning']);
		}
		
	}
	else if($do=='changdc') {
		$data = "";
		 $id = $_POST['id'];
		$txtdiachi = ($_POST['txtdiachi']);

		$data = array(
			'dia_chi'=> $txtdiachi,
			
		);
		$d -> setTable('#_thanhvien');
		$d-> setWhere('thanhvien_hash',$id);
		if ($d -> update($data)) {
			echo json_encode(['message' => 'Cập nhật thành công', 'status' => 'success']);
		}
		else
		{
			echo json_encode(['message' => 'Cập nhật thất bại', 'status' => 'warning']);
		}
		
		
		
		
	}






	else if($do=='themghang') {
		$data ="";
		date_default_timezone_set('Asia/Ho_Chi_Minh');
		$id = $_POST['id'];
		$sanpham = $d->simple_fetch("select * from  #_sanpham where id= '".$id."'");
		
		if(($sanpham['khuyen_mai'] !=0 || $sanpham['khuyen_mai'] != '')){
			$gia = $sanpham['khuyen_mai'];
		}
		else{
			if(($sanpham['gia'] !=0 || $sanpham['gia'] != '')){
				$gia = $sanpham['gia'];
			}else{
				$gia = 0;
			}
		}

		$stt = 0;
		
			
		if(!empty($sanpham)){
            $id_pro = $sanpham['id'];
            if(isset($_SESSION['cart'][$id_pro])){
                $_SESSION['cart'][$id_pro]['so_luong'] = $_SESSION['cart'][$id_pro]['so_luong'] + 1;
                $hinh = URLPATH.'img_data/images/'.$sanpham['hinh_anh'];
                $stt = 1;
            }
            else{
                $_SESSION['cart'][$id_pro]['so_luong'] = 1;
                $hinh = URLPATH.'img_data/images/'.$sanpham['hinh_anh'];
             	$stt = 1;
                //echo json_encode(['message' => 'Thêm giỏ hàng thành công', 'status' => 'success']);
               
            }
            

        }

         $data .= '<div class="item-dms1anpham2">
			<div class="img-ghang">
				<img src="'.URLPATH.'img_data/images/'.$sanpham['hinh_anh'].'" alt="">		
			</div>	
			<div class="sluong">
				'.$_SESSION['cart'][$id_pro]['so_luong'].'		
			</div>	
			<div class="dongia">
				'.$gia.'	
			</div>		
		</div>';
       


        if($stt = 1){
        	 echo json_encode(['message' => 'Thêm giỏ hàng thành công', 'status' => 'success','data' => $data]);


        }else{
        	echo json_encode(['message' => 'Thêm giỏ hàng không thành công', 'status' => 'warning']);
        }

		
		
	}
	else if($do=='loadsp') {
		$text = addslashes($_POST['text']);
		
		$kq = '';
		if ($text != '') {
			$sanpham = $d->o_fet("select * from  #_sanpham where ten_vn like '%".$text."%'");
			$kq .= '<div class="group-spaj">';
			foreach ($sanpham as $item)
	   		{
	   			if($item['gia']=='' || $item['gia'] == 0){
			      $gia1='<span class="p-price gia-center">Liên hệ</span>';
			      }else{
			          
			               $gia1='<span class="p-price gia-center">'.number_format((float)$item['gia']).' Đ</span>';
			          

			      }
			      if ($item['khuyen_mai']!='' || $item['khuyen_mai'] != 0) {
			            $gia2='<span class="p-price gia-center">'.number_format((float)$item['khuyen_mai']).' Đ</span>';
			      }

         		$active = ($item['khuyen_mai']!='' || $item['khuyen_mai'] != 0) ? 'active':'';
				

	   			$kq.='<div class="item-sp">
	   					<div class="img-spaj">
	   						<a href="'.URLPATH.$item['alias_vn'].'.html'.'"><img src="'.URLPATH.'img_data/images/'.$item['hinh_anh'].'" alt="h1"></a>
	   					</div>
	   					<div class="group-ajsp">
	   						<a href="'.URLPATH.$item['alias_vn'].'.html'.'">
		   						<div class="ten-spaj">
		   							'.$item['ten_vn'].'
		   						</div>
		   						<div class="group-desciption aj">
		   							 <div style="text-align:left" class="giagoc '.$active.'">Giá: <span style="color:red;">'.$gia1.' </span></div>
			                          <div style="text-align:left">';
			                           if ($item['khuyen_mai']!='' || $item['khuyen_mai'] != 0) { 

			                              $kq.='<div style="" class="giagoc">Khuyến mãi: <span style="color:red;">'.$gia2.'</span></div>';
			                          } 
			                          $kq.=' </div>
		   						</div>	
	   						</a>
	   					</div>
	   			</div><hr>';
	   		}
	   		$kq.='</div>';
   		}
   		else{
   			$kq='';
   		}
   		echo $kq;
	
	}
	else if($do=='change_so_luong') {
		$id = addslashes($_POST['id']);
		$sl= addslashes($_POST['sl']);
		if($sl == 0){
			unset($_SESSION['cart'][$id]);
		}
		else{
			$_SESSION['cart'][$id]['so_luong'] = $sl;
		}	
		echo 1;		
	}
	else if($do=='change_so_luong2') {
		$id = addslashes($_POST['id']);
		$sl= addslashes($_POST['sl']);
		if($sl == 0){
			unset($_SESSION['cart2'][$id]);
		}
		else{
			$_SESSION['cart2'][$id]['so_luong'] = $sl;
		}	
		echo 1;		
	}
	else if($do=='dkda') {
		$data ="";
		date_default_timezone_set('Asia/Ho_Chi_Minh');
		$ten = $_POST['ten'];
 
        $dienthoai = $_POST['dienthoai'];
        $email = $_POST['email'];
        $loinhan = $_POST['loinhan'];
		$address = $_POST['address'];


		$data = array(
			'ho_ten'=> $ten,
			'email'=>$email,
			'sdt'=>$dienthoai,
			'noi_dung'=>$address + "<br />" + $loinhan ,
			'tieu_de'=>'Liên hệ',
			'ngay_hoi'=>date('d-m-Y H:i:s'),
			'trang_thai'=>0,
		);
		$d -> setTable('#_lienhe');
		if ($d -> insert($data)) {
			echo json_encode(['message' => 'Gửi liên hệ thành công', 'status' => 'success']);

		}
		else
		{
			echo json_encode(['message' => 'Gửi liên hệ thất bại', 'status' => 'warning']);
		}
		
	}
	else if($do=='register_email1') {
		$data = "";
		$data = array(
			'email' => $d->clear($_POST['email']),
			'ngay_gui' => time(),
		);
		$check = $d->o_fet("select * from #_email where email='{$data['email']}'");
		if(count($check)>0) {
			echo "replace";
		}
		else {
			$d->setTable('#_email');
			if($d->insert($data)) {
				echo "ok";
			}
			else echo mysql_error();
		}
		
	}
	else if($do=='register_email') {
		$data = "";
		$data = array(
			'email' 		=> $d->clear($_POST['email']),
			'dien_thoai' 	=> $d->clear($_POST['email2']),
			'ngay_gui' 		=> time(),
		);
		$check = $d->o_fet("select * from #_email where email='{$data['email']}'");
		if(count($check)>0) {
			echo "replace";
		}
		else {
			$d->setTable('#_email');
			if($d->insert($data)) {
				echo "ok";
			}
			else echo mysql_error();
		}
		
	}
	else if($do=='dang_ky') {
		$data = "";
		$ngay_sinh = strtotime($d->clear($_POST['ngay'])."-".$d->clear($_POST['thang'])."-".$d->clear($_POST['nam']));
		$data = array(
			'token' => $d->token(),
			'tai_khoan' => $d->username($d->clear($_POST['tai_khoan'])),
			'user_hash' => sha1($d->clear($_POST['tai_khoan'])),
			'pass_hash' => sha1($d->clear($_POST['pass'])),
			'email' => $d->clear($_POST['email']),
			'ho_ten' => $d->clear($_POST['ho_ten']),
			'dien_thoai' => $d->clear($_POST['dien_thoai']),
			'dia_chi' => $d->clear($_POST['dia_chi']),
			'ngay_sinh' => $ngay_sinh,
			'gioi_tinh' => $d->clear($_POST['gioi_tinh']),
			'quyen_han' => 0,
			'hien_thi' => 0,
			'ngay_tao' => time(),
		);

		$d->setTable('#_user');
		if($d->insert($data)) {
			echo "ok";
		}
		else echo mysql_error();
		
	}
	else if($do=='dktaikhoan') {
		$data ="";
		date_default_timezone_set('Asia/Ho_Chi_Minh');
		$ten = $_POST['ten'];
		$taikhoan = $_POST['taikhoan'];
		$matkhau = $_POST['matkhau'];
		$email = $_POST['email'];
		$sdt = $_POST['sdt'];
		

		$data = array(
			'tai_khoan'=> $d->clear($_POST['taikhoan']),
			'thanhvien_hash'=>sha1($d->clear($_POST['taikhoan'])),
			'ho_ten'=>$ten,
			'pass_hash'=>sha1($matkhau),
			'dien_thoai'=>$sdt,
			'email'=>$email,
			'hien_thi'=>1,
			'ngay_tao'=>time(),
			'quyen_han'=>2,
			
		);
		$tk = sha1($d->clear($_POST['taikhoan']));
		$login = $d->o_fet("select * from #_thanhvien where thanhvien_hash = '{$tk}'");
		$login1 = $d->o_fet("select * from #_thanhvien where email = '{$email}'");
		$login2 = $d->o_fet("select * from #_thanhvien where dien_thoai = '{$sdt}'");
		$sl = count($login);
		$sl1 = count($login1);
		$sl2 = count($login2);
		
		
		if($sl > 0)
		{
			echo json_encode(['message' => 'Tài khoản đã tồn tại', 'status' => 'warning']);
		}else if($sl1 > 0){
			echo json_encode(['message' => 'Email đã được sử dụng', 'status' => 'warning']);
		}else if($sl2 > 0){
			echo json_encode(['message' => 'Số điện thoại đã được sử dụng', 'status' => 'warning']);
		}
		else{
			$d -> setTable('#_thanhvien');
			if ($d -> insert($data)) {
				echo json_encode(['message' => 'Đăng ký thành công', 'status' => 'success']);

			}
			else
			{
				echo json_encode(['message' => 'Đăng ký thất bại', 'status' => 'warning']);
			}
		}
		
		
		
		
		
	}
	else if($do=='changthontin') {
		$data = "";
		$id = $_POST['id'];
		$ten = $_POST['ten'];
		$email = $_POST['email'];
		$sdt = $_POST['sdt'];
		$txtdiachi = ($_POST['txtdiachi']);

		$login1 = $d->o_fet("select * from #_thanhvien where thanhvien_hash != '{$id}' and email = '{$email}'");
		$login2 = $d->o_fet("select * from #_thanhvien where thanhvien_hash != '{$id}' and dien_thoai = '{$sdt}'");
		
		$sl1 = count($login1);
		$sl2 = count($login2);

		$data = array(
			'ho_ten'=> $ten,
			'dien_thoai'=> $sdt,
			'email'=> $email,
			'dia_chi' => $txtdiachi,
			
		);
		if($sl1 > 0){
			echo json_encode(['message' => 'Email đã được sử dụng', 'status' => 'warning']);
		}else if($sl2 > 0){
			echo json_encode(['message' => 'Số điện thoại đã được sử dụng', 'status' => 'warning']);
		}
		else{
			$d -> setTable('#_thanhvien');
			$d-> setWhere('thanhvien_hash',$id);
			if ($d -> update($data)) {
				echo json_encode(['message' => 'Cập nhật thành công', 'status' => 'success']);
			}
			else
			{
				echo json_encode(['message' => 'Cập nhật thất bại', 'status' => 'warning']);
			}
		}
		
		
		
		
	}
	else if($do=='check_mail_ton') {
		$email = $_POST['email'];
		$check2 = $d->o_fet("select * from #_member where email = '".$email."'");

		if (count($check2)>0) {
			echo "Email đã tồn tại vui lòng sử dụng Email khác";
		} 
	}
	else if($do=='check_tai_khoan') {
		$tai_khoan = $d->username($d->clear($_POST['tai_khoan']));

		if($tai_khoan!=''){
			$check = $d->num_rows("select tai_khoan from #_user where tai_khoan='{$tai_khoan}'");

			if($check==0) {
				$valid = true;
			}
			else {
				$valid = false;
			}
		} 
		else {
			$valid = false;
		}
		echo json_encode($valid);	
	}
	else if($do=='check_email') {
		$email = $d->clear($_POST['email']);

		if($email!=''){
			$check = $d->num_rows("select email from #_user where email='{$email}'");

			if($check==0) {
				$valid = true;
			}
			else {
				$valid = false;
			}
		} 
		else {
			$valid = false;
		}
		echo json_encode($valid);		
	}
	else if($do=='dang_nhap') {
		$user_hash = sha1($d->clear($_POST['username']));
		$pass_hash = sha1($d->clear($_POST['pass']));
		$query = $d->o_fet("select * from #_user where user_hash='$user_hash' and pass_hash='$pass_hash'");
		if(count($query)>0 && $user_hash==$query[0]['user_hash'] && $pass_hash==$query[0]['pass_hash']) {
			$_SESSION['user'] = array(
				'id' => $query[0]['id'],
				'token' => $query[0]['token'],
				'tai_khoan' => $query[0]['tai_khoan'],
				'ho_ten' => $query[0]['ho_ten'],
				'quyen_han' => $query[0]['quyen_han'],
			);
			echo "ok";
		}
		else {
			echo "error";
		}
	}
	else if($do=='dang_xuat') {
		unset($_SESSION['user']);
		echo "ok";
	}
	else if($do=='tim_kiem') {
		
		$check = $_POST['ch_search'];
		foreach($check as $keyword){
			
			 $keywordarray[] = $keyword;
			
		}
		 $keywords = implode (",", $keywordarray);
		echo URLPATH."search.html?q=$keywords";
	}
	else if($do=='change_video') {
		
		$id = $_POST['id'];
		$video = $d->simple_fetch("select * from #_video where id={$id} limit 0,1");
		if(!empty($video)){ ?>
			<iframe width="300" height="150" src="https://www.youtube.com/embed/<?= $video['link']; ?>" frameborder="0" allowfullscreen=""></iframe>
		<?php }
	}
	else if($do=='send_comment') {
		header('Content-Type: application/json');
		$data = "";
		$data = array(
			'parent' => $d->clear($_POST['parent']),
			'alias' => $d->clear($_POST['alias']),
			'hoten' => $d->clear($_POST['hoten']),
			'email' => $d->clear($_POST['email']),
			'dienthoai' => $d->clear($_POST['dienthoai']),
			'noidung' => $d->clear($_POST['noidung']),
			'link' => $d->clear($_POST['link']),
			'ngaytao' => time(),
		);
		$d->setTable('#_binhluan');
		if($d->insert($data)) {
			echo json_encode(array('ok'=>'ok','error'=>0));
		}
		else echo mysql_error();
	}
        else if($do=='get_quan') {
            $id = (int)$_POST['id'];
            $quan = $d->o_fet("select * from #_quan where id_loai = '".$id."' order by ten_vn asc");
            echo '<option value="">Chọn quận huyện</option>';
            foreach ($quan as $key => $value) {
                echo '<option value="'.$value['id'].'" data_ship="'.$value['phi_ship'].'">'.$value['ten_vn'].'</option>';
            }
        }
?>