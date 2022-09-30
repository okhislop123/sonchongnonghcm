<?php 
if(isset($_POST['sendBtnaa'])){
    
       
        $user_hash = sha1($d->clean(addslashes($_POST['loginName2'])));
        $pass_hash = sha1($d->clean(addslashes($_POST['loginPassword'])));
        
      
        
        $login = $d->o_fet("select * from #_thanhvien where thanhvien_hash = '$user_hash' and pass_hash = '$pass_hash' ");
        
            if(count($login)>0 && $pass_hash==$login[0]['pass_hash']) {
              if($login[0]['hien_thi'] == 1){
                $_SESSION['id_user1'] = $login[0]['id'];
                $_SESSION['user_admin1'] = $login[0]['tai_khoan'];
                $_SESSION['user_hash1'] = $user_hash;
                $_SESSION['quyen1'] = @$login[0]['quyen_han'];
                $_SESSION['name1'] = @$login[0]['ho_ten'];
                $_SESSION['is_admin1'] = $login[0]['is_admin'];
                $_SESSION['sdt1'] = $login[0]['dien_thoai'];
                echo '<script>alert("Đăng nhập thành công")</script>';
                $d->location(URLPATH."dang-nhap.html");
              }
              else{
               echo '<script>alert("Tài khoản đang bị khóa")</script>';
            }
              
            }else{
                echo '<script>alert("Tài khoản hoặc mật khẩu không chính xác")</script>';
                 $d->location(URLPATH."dang-nhap.html");
            }
        
        
       
    }
 if(isset($_POST['btndx'])){

        unset($_SESSION['id_user1']);
        unset($_SESSION['user_admin1']);
        unset($_SESSION['user_hash1']);
        unset($_SESSION['quyen1']);
        unset($_SESSION['name1']);
        unset($_SESSION['user_admin1']);
        unset($_SESSION['sdt1']);
        $d->location(URLPATH."dang-nhap.html");
    }
?>

<?php if(!(isset($_SESSION['user_admin1']))){ ?>

<div class="group-dskdn">
  <div class="bradcum-news">
    <div class="container">
        <div class="bregroup">
            <h1 class="title-home"><span>Đăng Nhập</span></h1>
            <ol vocab="https://schema.org/" typeof="BreadcrumbList" class="breadcrumb"> 
                <li property="itemListElement" typeof="ListItem"> 
                    <a property="item" typeof="WebPage" href="<?=URLPATH?>"> 
                            <span property="name">Trang chủ</span>
                    </a> <meta property="position" content="1"> 
                </li>
                 
                <li property="itemListElement" typeof="ListItem"> 
                    <a class="active" property="item" typeof="WebPage" href="<?=URLPATH ?>dang-nhap.html"> 
                        <span property="name">Đăng Nhập</span>
                    </a> <meta property="position" content="2"> 
                </li>
            </ol>
        </div>
    </div>
</div>
  <div class="container">
   


    <div class="col-md-6 col-sm-6">
      <div class="well">
              <h2 class="secondary-title">Khách hàng mới</h2>
              <div class="login-wrap">
                <p><strong>Đăng ký</strong></p>
                <p>Bằng cách tạo tài khoản bạn sẽ có thể mua sắm nhanh hơn.</p>
              </div>
              <hr>
              <a href="<?=URLPATH.'dang-ky.html'?>" class="btn btn-primary button">Tiếp tục</a>
          </div></div>
    <div class="col-md-6 col-sm-6">
      <div class="well">
            <h2 class="secondary-title">Khách hàng cũ</h2>
             <form id="loginform" name="loginform" method="post" action="">
                  <!-- <h3 class="title">Bạn đã là hội viên</h3> -->
                  <div class="form-group">
                    <label class="control-label" for="input-email">Tài khoản：</label>
                    <input type="text" name="loginName2" value=""  id="loginName2" class="form-control">
                  </div> 
                  <div class="form-group">
                    <label class="control-label" for="input-email">Mật khẩu：</label>
                    <input type="password" name="loginPassword" value=""  id="loginPassword" class="form-control">
                  </div>

                  
                  <br>
                  <p class="send"><button id="loginBtan" type="submit" name="sendBtnaa" class="sendBtnaa btn btn-primary" >Đăng nhập</button><!-- <a class="forget" href="/forgetpassword.html">Quên mật khẩu</a> --></p>
              </form>
          
          </div>
    </div>
  </div>
</div>

<?php } else { ?>

  <div class="bradcum-news">
    <div class="container">
        <div class="bregroup">
            <h1 class="title-home"><span>Tài khoản</span></h1>
            <ol vocab="https://schema.org/" typeof="BreadcrumbList" class="breadcrumb"> 
                <li property="itemListElement" typeof="ListItem"> 
                    <a property="item" typeof="WebPage" href="<?=URLPATH?>"> 
                            <span property="name">Trang chủ</span>
                    </a> <meta property="position" content="1"> 
                </li>
                 
                <li property="itemListElement" typeof="ListItem"> 
                    <a class="active" property="item" typeof="WebPage" href="<?=URLPATH ?>dang-nhap.html"> 
                        <span property="name">Tài khoản</span>
                    </a> <meta property="position" content="2"> 
                </li>
            </ol>
        </div>
    </div>
</div>
  <div class="container">
   
      <div id="content" class="col-sm-12" style="min-height: 30vh;">
        <h2 class="secondary-title">Tài khoản của tôi</h2>
        <div class="content my-account">
          <ul class="list-unstyled">
            <li><a href="<?=URLPATH.'account.html'?>">Thay đổi thông tin tài khoản</a></li>
            <li><a href="<?=URLPATH.'doimk.html';?>">Thay đổi mật khẩu</a></li>
            <li><div class="dk"><a href=""><form action="" method="post">
                          <button  type="submit" name="btndx">Đăng xuất</button>
                        </form></a></div></li>
            <!-- <li><a href="<?=URLPATH.'doidc.html';?>">Thay đổi sổ địa chỉ</a></li> -->
            <!-- <li><a href="<?=URLPATH.'dang-nhap.html'?>">Mặt hàng yêu thích (%s)</a></li> -->
          </ul>
        </div>
             <!--  <h2 class="secondary-title">Đơn hàng của tôi</h2>
        <div class="content my-orders">
          <ul class="list-unstyled">
            <li><a href="<?=URLPATH.'lich-su-dat-hang.html'?>">Lịch sử đặt hàng</a></li>
            
          </ul>
        </div> -->

        
       
        </div>
      </div>
<?php } ?>