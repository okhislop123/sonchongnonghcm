 <?php
 		if(isset($_POST['btndoimk'])){
 			$mkmoi = $_POST['mkmoi'];
 			$mknl = $_POST['nhapmkmoi'];
 			
 		}
 		$diachius = '';
 		if(isset($_SESSION['user_admin1'])){
            $tk1 = $_SESSION['user_hash1'];
            $login = $d->simple_fetch("select * from #_thanhvien where thanhvien_hash = '{$tk1}'");
            //echo '<pre>'; print_r($login); echo '</pre>'; exit;
          
            $diachius =$login['dia_chi'];
        }
 		
 ?>

 <div class="group-aada" style="min-height: 30vh;">
 	<div class="container">
 	<h2 class="title-1h">Thay đổi địa chỉ</h2>
 	<?php if(isset($_SESSION['user_hash1'])) { ?>
 	<form action="" method="post" id="dmk">
 		<input type="hidden" id="userhash" name="userhash" value="<?=$_SESSION['user_hash1']?>">
 		<textarea placeholder="Địa chỉ" name="ttxt_diachi" id="txtdiachi" ><?=$diachius?></textarea>
 		
 		<button class="" name="btndoidcaa" id=""><a style="color:#fff;" href="<?=URLPATH.'dang-nhap.html'?>">Trở lại</a></button>
 		<button class="" name="btndoidc" id="btndoidc">Cập nhật</button>
 	</form>
 	<?php } else { ?>
 		<?php $d->location(URLPATH."dang-nhap.html");?>
 	<?php } ?>
 	</div>	
 </div>


<script>
	$('#btndoidc').click(function(event){
		event.preventDefault();
	
		var txtdiachi = $('#txtdiachi').val();
		var id = $('#userhash').val();
		
		
		var err ='';

		
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
                    do : 'changdc',
                    txtdiachi: txtdiachi,
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

 