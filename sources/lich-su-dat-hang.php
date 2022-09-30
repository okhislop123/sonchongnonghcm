 <?php
 		$diachius = '';
 		if(isset($_SESSION['user_admin1'])){
            $tk1 = $_SESSION['user_hash1'];
            $login = $d->simple_fetch("select * from #_thanhvien where thanhvien_hash = '{$tk1}'");
            //echo '<pre>'; print_r($login); echo '</pre>'; exit;
          
            $diachius =$login['dia_chi'];
        }
        $lsdh = $d->o_fet("select * from #_dathang where idkh = '{$login['tai_khoan']}' order by  id desc");
 		//echo '<pre>'; print_r($lsdh); echo '</pre>'; exit;
 ?>

 <div class="group-aada" style="min-height: 30vh;">
 	<div class="container">
 	<h2 class="title-1h">Lịch sử đặt hàng</h2>
 	<?php if(isset($_SESSION['user_hash1'])) { ?>

 	<table class="table">
          <thead>
            <tr>
              <th scope="col">Số thứ tự</th>
              <th scope="col">Mã đơn hàng</th>
              <th scope="col">Tên khách hàng</th>
              <th scope="col">Ngày đặt</th>
              <th scope="col">Xem chi tiết</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach($lsdh as $ls => $ls1) { ?>
                <tr>
                  <th scope="row"><?=$ls+1?></th>
                  <td><?=$ls1['ma_dh']?></td>
                  <td><?=$ls1['ho_ten']?></td>
                  <td><?=date('d-m-Y H:i:s',$ls1['ngay_dat_hang']) ?></td>
                  <td>Xem chi tiết</td>
                </tr>
            <?php } ?>
         
          </tbody>
        </table>


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

 