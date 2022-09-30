 <?php
 		if(isset($_POST['btndoimk'])){
 			$mkmoi = $_POST['mkmoi'];
 			$mknl = $_POST['nhapmkmoi'];
 			
 		}
 		
 ?>

 <div class="group-aada" style="min-height: 30vh;">
 	<div class="container">
 	<h2 class="title-1h">Thay đổi mật khẩu</h2>
 	<?php if(isset($_SESSION['user_hash1'])) { ?>
 	<form action="" method="post" id="dmk">
 		<input type="hidden" id="userhash" name="userhash" value="<?=$_SESSION['user_hash1']?>">
 		<input  type="password" id="mkht1" name="mkmoi" placeholder="Mật khẩu mới">
 		<input type="password" id="mkht2" name="nhapmkmoi" placeholder="Nhập lại mật khẩu">
 		<button class="" name="btndoimk" id=""><a style="color:#fff;" href="<?=URLPATH.'dang-nhap.html'?>">Trở lại</a></button>
 		<button class="" name="btndoimk" id="btndoimk">Đổi mật khẩu</button>
 	</form>
 	<?php } else { ?>
 		<?php $d->location(URLPATH."dang-nhap.html");?>
 	<?php } ?>
 	</div>	
 </div>


<script>
	$('#btndoimk').click(function(event){
		event.preventDefault();
	
		var mkmoi1 = $('#mkht1').val();
		var mkmoi2 = $('#mkht2').val();
		var id = $('#userhash').val();
		console.log(id);
		var err ='';

		if (mkmoi2 != mkmoi1) {
			err = 'Nhập lại mật khẩu không đúng';
		}
		if (mkmoi1.length < 5 || mkmoi1.length > 20) {
			err = 'Mật khẩu mới quá ngắn';
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
                    do : 'changmk',
                    mkmoi1: mkmoi1,
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

 