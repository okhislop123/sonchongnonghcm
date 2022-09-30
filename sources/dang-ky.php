<?php
   if(!isset($_SESSION)){
    session_start();
   }
  
   
   
   ?>
<div class="bradcum-news">
    <div class="container">
        <div class="bregroup">
            <h1 class="title-home"><span>Đăng ký</span></h1>
            <ol vocab="https://schema.org/" typeof="BreadcrumbList" class="breadcrumb"> 
                <li property="itemListElement" typeof="ListItem"> 
                    <a property="item" typeof="WebPage" href="<?=URLPATH?>"> 
                            <span property="name">Trang chủ</span>
                    </a> <meta property="position" content="1"> 
                </li>
                 
                <li property="itemListElement" typeof="ListItem"> 
                    <a class="active" property="item" typeof="WebPage" href="<?=URLPATH ?>dang-ky.html"> 
                        <span property="name">Đăng ký</span>
                    </a> <meta property="position" content="2"> 
                </li>
            </ol>
        </div>
    </div>
</div>
<section>
   <div class="container bg-white">
      <div class="row10">
        <div class="col-md-3">
            <?php include("right.php");?>
         </div>
         <div class="col-md-9 plr10">
           
            <div class="shadowBox">
                <form id="joinform" name="joinform" method="post">
                    <h3 class="title">Đăng ký tài khoản</h3>
                    <article>Chào mừng bạn ! Xin vui lòng điền thông tin<b class="required">(*Bắt buộc phải điền)</b></article>
                    <ul>
                        <li><label><b class="required">*</b>Tên：</label><input type="text" id="CustomerName" name="CustomerName"></li>
                        <li><label><b class="required">*</b>Tài khoản：</label><input type="text" id="JLoginName" name="JLoginName"><i></i></li>
                        <li><label><b class="required">*</b>Mật khẩu：</label><input type="password" id="LoginPassword1" name="LoginPassword1"></li>
                        <li><label><b class="required">*</b>Xác nhận mật khẩu：</label><input type="password" id="LoginPassword2" name="LoginPassword2"></li>
                        <li><label><b class="required">*</b>Email：</label><input type="email" id="Email" name="Email"><i></i></li>
                        <li><label><b class="required">*</b>Số di động：</label><input type="tel" pattern="\d*" id="Mobile" name="Mobile"><i></i></li>
                        <!-- <li class="db"><input type="checkbox" name="chke">&nbsp;Tôi đã đọc và đồng ý với điều khoản Chính sách bảo mật</li> -->
                       <!--  <li>

                             <label><b class="required">*</b>Nhập mã capcha：</label>
                            <input type="text" required   id="captcha" name="captcha" > <span id="str"><?=strtolower($_SESSION['captcha_code'])?></span>
                              <i></i>      
                               <input type="hidden" id = "cap" name="capcha" value=<?=strtolower($_SESSION['captcha_code'])?>>
                           
                        </li> -->
                    </ul>
                    
                    <p class="send"><button id="joinBtn" name="joinBtn" class="joinBtn" type="submit">Đăng ký </button></p>
                </form>

               
            </div>
         </div>
      </div>
   </div>
</section>
<script type="text/javascript">
     $('#joinBtn').click(function(event){
        event.preventDefault();
        var ten = $('#CustomerName').val();
        var taikhoan  = $('#JLoginName').val();
        var matkhau  = $('#LoginPassword1').val();
        var matkhau2  = $('#LoginPassword2').val();
       
        //var capcha  = $('#cap').val();
        //var capcha2  = $('#captcha').val();
        
        var email = $('#Email').val();
        var hoten = $('#txthotensp').val();
        var soluong = $('#txtsoluong').val();
        var sdt = $('#Mobile').val();
        var re = /^\S+$/g;
        var numberphone = /^[+]*[(]{0,1}[0-9]{1,4}[)]{0,1}[-\s\./0-9]*$/g;
        var emairg = /^[a-z][a-z0-9_\.]{5,32}@[a-z0-9]{2,}(\.[a-z0-9]{2,4}){1,2}$/g;
        var err = '';
        // if(capcha2 != capcha){
        //     err = "Mã capcha chưa đúng";
        // }
         if (!numberphone.test(sdt)) {
            err = "Số điện thoại không hợp lệ";
        }
        if (!emairg.test(email)) {
            err = "Email không hợp lệ";
        }
       
        if (matkhau2 != matkhau) {
            err = 'Nhập lại mật khẩu chưa đúng';
        }

        if ((matkhau.length < 4 || matkhau.length > 21) && !re.test(matkhau)) {
            err = 'Độ dài mật khẩu từ 5 đến 20 ký tự và không có khoảng trắng';
        }

        if ((taikhoan.length < 4 || taikhoan.length > 21) && !re.test(taikhoan)) {

            err = 'Độ dài tên tài khoản từ 5 đến 20 ký tự và không có khoảng trắng ';
        }

         if (ten.length < 1 ) {
            err = 'Tên không được trống';
        }
        
       

        
       
        if(err != ''){
            swal(err,'','warning');
        }
       
        else{
            // $('#joinform').submit();
             $.ajax({
                url: "sources/ajax.php",
                method: 'POST',
                dataType:'json',
                data:{
                    do : 'dktaikhoan',
                    ten: ten,
                    taikhoan :taikhoan,
                    matkhau :matkhau,
                    email :email,
                    
                    sdt :sdt,
                   
                },
                success:function(result){
                    if (result.status == 'success') {
                     
                        swal(result.message,'',result.status);
                        setTimeout(function(){
                           $(location).attr('href', '<?=URLPATH.'dang-nhap.html'?>')

                        }, 1500);
                    }
                    else{
                        swal(result.message,'',result.status);
                    }
                    
                }

            });
        }
        
       
    });
</script>