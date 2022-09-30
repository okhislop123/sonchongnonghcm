<?php
	if(!empty($_POST['xac_nhan'])){
		$ma = addslashes($_POST['xac_nhan']);
		if($ma == '300999'){
			setcookie('code', '300999', time() + (86400 * 30 *365), "/"); // 86400 = 1 day
			$d->redirect(URLPATH);
		}
	}
?>
<style type="text/css">
	.wp-fix{ position: fixed; width: 100%; height: 100%; text-align: center; z-index: 99; background: #e7e7e7; } .input-fix{ margin-top: 10%; position: relative; z-index: 9999; } .input-fix input{height: 40px; min-width: 250px; border-radius: 6px; border: 0; margin-top: 15px; padding: 3px 15px; } .bg-bubbles {position: absolute; top: 0; left: 0; width: 100%; height: 100%; z-index: 1; } .bg-bubbles li {position: absolute; list-style: none; display: block; width: 40px; height: 40px; background-color: rgba(255, 0, 0, 0.15); bottom: -160px; -webkit-animation: square 25s infinite; animation: square 25s infinite; -webkit-transition-timing-function: linear; transition-timing-function: linear; } .bg-bubbles li:nth-child(1) {left: 10%; } .bg-bubbles li:nth-child(2) {left: 20%; width: 80px; height: 80px; -webkit-animation-delay: 2s; animation-delay: 2s; -webkit-animation-duration: 20s; animation-duration: 20s; } .bg-bubbles li:nth-child(3) {left: 25%; -webkit-animation-delay: 4s; animation-delay: 4s; } .bg-bubbles li:nth-child(4) {left: 40%; width: 60px; height: 60px; -webkit-animation-duration: 22s; animation-duration: 22s; background-color: rgba(255, 0, 0, 0.25); } .bg-bubbles li:nth-child(5) {left: 70%; } .bg-bubbles li:nth-child(6) {left: 80%; width: 120px; height: 120px; -webkit-animation-delay: 3s; animation-delay: 3s; background-color: rgba(255, 0, 0, 0.2); } .bg-bubbles li:nth-child(7) {left: 32%; width: 160px; height: 160px; -webkit-animation-delay: 7s; animation-delay: 7s; } .bg-bubbles li:nth-child(8) {left: 55%; width: 20px; height: 20px; -webkit-animation-delay: 15s; animation-delay: 15s; -webkit-animation-duration: 40s; animation-duration: 40s; } .bg-bubbles li:nth-child(9) {left: 25%; width: 10px; height: 10px; -webkit-animation-delay: 2s; animation-delay: 2s; -webkit-animation-duration: 40s; animation-duration: 40s; background-color: rgba(255, 0, 0, 0.3); } .bg-bubbles li:nth-child(10) {left: 90%; width: 160px; height: 160px; -webkit-animation-delay: 11s; animation-delay: 11s; } @-webkit-keyframes square {0% {-webkit-transform: translateY(0); transform: translateY(0); } 100% {-webkit-transform: translateY(-700px) rotate(600deg); transform: translateY(-700px) rotate(600deg); } } @keyframes square {0% {-webkit-transform: translateY(0); transform: translateY(0); } 100% {-webkit-transform: translateY(-700px) rotate(600deg); transform: translateY(-700px) rotate(600deg); } } 
	.wp-fix h1{ font-size: 36px; }
	.btn-enter{ height: 36px; }
	.input-fix {
	    margin-top: 18%;
	    position: relative;
	    z-index: 9999;
	}
	.input-fix form{ position: relative;
    display: inline-block; }
    .input-fix input {
    height: 40px;
    min-width: 300px;
     border-radius: 0; 
    border: 0;
     margin-top: 0; 
    padding: 3px 15px;
}
.btn-enter {
    height: 40px;
    width: 45px;
    background: #ccc;
    border: 0;
    margin-left: -4px;
    position: absolute;
    top: 0;
    right: 0;
}
</style>
<?php if(!isset($_COOKIE['code']) || $_COOKIE['code'] != '300999'){ ?>
	<div class="wp-fix">
		<ul class="bg-bubbles">
            <li></li> <li></li> <li></li> <li></li> <li></li> <li></li> <li></li> <li></li> <li></li> <li></li> <li></li> <li></li> </ul>
		<div class="input-fix">
			<h1>Trang web đang xử lý</h1>
			<form method="POST" action="">
				<input type="text" name="xac_nhan" placeholder="Mật khẩu">
				<button class="btn-enter"><i class="fa fa-arrow-right" aria-hidden="true"></i></button>
			</form>
		</div>
	</div>
	<?php exit(); ?>
<?php } ?>