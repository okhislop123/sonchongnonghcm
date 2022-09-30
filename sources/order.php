<?php 
   
    if(isset($_POST['addOrder'])){
        $id = $_POST['id'];
        $price = $_POST['price'];
        $amount = isset($_POST['soluong'])?$_POST['soluong']:1;
        $amount = (int)$amount;
        
        $countfiles = count($_FILES['fileUpLoad']['name']);
        $file_name=$d->fns_Rand_digit(0,9,12);
        for($i=0;$i<$countfiles;$i++){
            $filename = $_FILES['fileUpLoad']['name'][$i];
            $ext = explode('.',$_FILES['fileUpLoad']['name'][$i]);
            $newname = $ext[0].'_'.time().'.'.$ext[1];
            
            // Upload file
            move_uploaded_file($_FILES['fileUpLoad']['tmp_name'][$i],'./img_data/icon/'.$newname);
             
        }
        
    }
    $arrS = [];
    
    $countfiles = count($_FILES['fileUpLoad']['name']);
    for($i=0;$i<$countfiles;$i++){
        $filename = $_FILES['fileUpLoad']['name'][$i];
        $ext = explode('.',$_FILES['fileUpLoad']['name'][$i]);
        $newname = $ext[0].'_'.time().'.'.$ext[1];
        array_push($arrS,$newname);
    }
    
    $tringFile = implode(',',$arrS);
    
    $link=explode("?",$_SERVER['REQUEST_URI']);
   
    $vari=explode("&",$link[1]);
    $search=array();
    foreach($vari as $item) {
        $str=explode("=",$item);

        $search["$str[0]"]=$str[1];
        
    }
    $step = $search['step'];
    
    $listFrame = $d->o_fet("select * from #_frame where hien_thi = 1  order by gia asc");
    
?>
<img src="../img_data/icon/" alt="">

<section class="frame">
    <div class="container">
        <div class="content">
            <?php foreach($listFrame as $key => $item) {
                $img = $item['hinh_anh'] ? URLPATH.'img_data/images/'.$item['hinh_anh'] : URLPATH.'templates/error/error.jpg';
                $price = $item['gia'] ? '$ '.number_format($item['gia'], 2, '.', '') : 'Free';
            ?>
                <div data-price="<?=$item['gia']?>" data-id="<?=$item['ten_'.$lang]?>" class="item <?=$key == 0 ? 'selected':''?>" onclick="choseGallery(event)">
                    <div class="img">
                        <img src="<?=$img?>" alt="<?=$item['ten_'.$lang]?>">
                    </div>
                    <div class="info">
                        <h1><?=$item['ten_'.$lang]?></h1>
                        <div><?=$price?></div>
                    </div>
                </div>
            <?php } ?>

        </div>
    </div>
</section>

<section class="cart">
    <div class="container">
        <form action="<?= URLPATH . "gio-hang.html" ?>" method="post">
            <input type="hidden" name="id" value="<?=$_POST['id']?>">
            <input type="hidden" name="fileImg" value="<?=$tringFile?>">
            <input type="hidden" name="soluong" value="<?=$_POST['soluong']?>">
            <input type="hidden" name="gia" value="<?=$_POST['price']?>">
            <input type="hidden" name="frame" value="" id="frame">
            <input type="hidden" name="idframe" value="" id="idframe">
            <button type="submit" name="addcart" class="" >Next</button>
        </form>
    </div>
</section>

<script>
    var choseGallery = (event) => {
        var current = event.currentTarget;
        var listItem = document.querySelector('.frame .item.selected');
        listItem.classList.remove('selected');
        current.classList.add('selected');
        setPrice();
    }
    var setPrice = () => {
        var listItem = document.querySelector('.frame .item.selected');
        var price = listItem.getAttribute('data-price');
        var id = listItem.getAttribute('data-id');
        document.getElementById('frame').value = price;
        document.getElementById('idframe').value = id;
    }
    setPrice();
</script>