 <?php
 		if(isset($_POST['btndoimk'])){
 			$mkmoi = $_POST['mkmoi'];
 			$mknl = $_POST['nhapmkmoi'];
 			
 		}
 		 	$tenus = '';
	        $mailus ='';
	        $sdtus = '';
	        $diachius ='';

	        if(isset($_SESSION['user_admin1'])){
	            $tk1 = $_SESSION['user_hash1'];
	            $login = $d->simple_fetch("select * from #_thanhvien where thanhvien_hash = '{$tk1}'");
	            //echo '<pre>'; print_r($login); echo '</pre>'; exit;
	            $tenus = $login['ho_ten'];
	            $mailus =$login['email'];
	            $sdtus = $login['dien_thoai'];
	            $diachius =$login['dia_chi'];
	        }
 ?>

 <div class="group-aada" style="min-height: 30vh;">
 	<div class="container">
 	<h2 class="title-1h">Thay đổi thông tin</h2>
 	<?php if(isset($_SESSION['user_hash1'])) { ?>
 	<form action="" method="post" id="dmk">
 		<label for="tentk">Tên tài khoản:</label>
 		<input id="tentk" type="text" readonly value="<?=$_SESSION['user_admin1']?>">

 		<label for="hoten">Họ tên:</label>
 		<input id="hoten" type="text" value="<?=$tenus?>">

 		<label for="sdt">Số điện thoại:</label>
 		<input id="sdt" type="text"  value="<?=$sdtus?>">

 		<label for="emailaa">Email:</label>
 		<input id="emailaa" type="text"  value="<?=$mailus?>">

        <label for="txtdiachi">Địa chỉ:</label>
        <textarea placeholder="Địa chỉ" name="ttxt_diachi" id="txtdiachi" ><?=$diachius?></textarea>

 		<input type="hidden" id="userhash" name="userhash" value="<?=$_SESSION['user_hash1']?>">
 		
 		<button class="" name="btndoimkdd" id=""><a style="color:#fff;" href="<?=URLPATH.'dang-nhap.html'?>">Trở lại</a></button>
 		<button class="" name="btndoitt" id="btndoitt">Cập nhật</button>
 	</form>
 	<?php } else { ?>
 		<?php $d->location(URLPATH."dang-nhap.html");?>
 	<?php } ?>
 	</div>	
 </div>


<script>
	$('#btndoitt').click(function(event){
		event.preventDefault();
	
		
		var id = $('#userhash').val();
		var txtdiachi = $('#txtdiachi').val();
		var err ='';

		var ten = $('#hoten').val();
		var email = $('#emailaa').val();
        var sdt = $('#sdt').val();
        var re = /^\S+$/g;
        var numberphone = /^[+]*[(]{0,1}[0-9]{1,4}[)]{0,1}[-\s\./0-9]*$/g;
        var emairg = /^[a-z][a-z0-9_\.]{5,32}@[a-z0-9]{2,}(\.[a-z0-9]{2,4}){1,2}$/g;
         if (!numberphone.test(sdt)) {
            err = "Số điện thoại không hợp lệ";
        }
        if (!emairg.test(email)) {
            err = "Email không hợp lệ";
        }
        if (ten.length < 1 ) {
            err = 'Tên không được trống';
        }
        if (txtdiachi.length < 1 ) {
            err = 'Chưa nhập địa chỉ';
        }
		if (err) {
			swal(err,'','warning');
		}
        
       
		else{
			$.ajax({
                url: "sources/ajax.php",
                type: 'POST',
                dataType:'json',
            
                data:{
                    do : 'changthontin',
                    ten: ten,
                    email :email,
                    txtdiachi: txtdiachi,
                    sdt :sdt,
                    id: id,
                },
                success:function(result){
                    if (result.status == 'success') {
                     
                        swal(result.message,'',result.status);
                        setTimeout(function(){
                           window.location.reload(1);
                        }, 1000);
                    }
                    else{
                        swal(result.message,'',result.status);
                    }
                    
                }

         });
		}

	})
</script>

 