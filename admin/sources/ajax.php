<?php
	define('_lib','../lib/');
	@include _lib."config.php";
	@include_once _lib."function.php";
	$d = new func_index($config['database']);

	$do = addslashes($_POST['do']);
	
	if($do=='update_stt') {
		$table = $_POST['table'];
		$col = $_POST['col'];
		$val = $_POST['val'];
		$id = $_POST['id'];
		$d->o_que("update $table set $col=$val where id=$id");
	}
	if($do=='createTable') {
		
		$people = $_POST['people'];
		$size = $_POST['size'];
		$saveSize = ','.$size.',';
		$id = $_POST['id'];
		$d -> setTable('#_sanpham');
		$d-> setWhere('id',$id);
		$data = array(
			'size'  => $saveSize,
			'people' => $people,
		);
		if ($d -> update($data));
		$listsize = $d->o_fet("select * from #_size where id in ($size) order by so_thu_tu asc, id desc");
		$listsize = $d->o_fet("select * from #_size where id in ($size) order by so_thu_tu asc, id desc");
		
		$content = "";
		$content .= "
			<thead>
			<tr>
				<td style='text-align:center;min-width:150px;max-width:150px;'>Size</td>";
				for($i = 1; $i<= $people;$i++){
					$content .= "<td style='text-align:center;'>".$i." người</td>";
				}
				
			$content .= "</tr></thead>
		";
		$content.= "
			<tbody>	";
				foreach($listsize as $key => $item){
					$content .= "
						<tr>
							<td style='text-align:center;'>".$item['ten_vn']."</td>";
							for($i = 1; $i<= $people;$i++){
								$price = $d->o_fet("select * from #_custom where idsize = ".$item['id']." and idpeople = $i and idproduct = $id ");
								if(count($price)){
									$gia = $price[0]['price'];
									$dataid = $price[0]['id'];
								}else{
									$gia = "";
									$dataid = 0;
								}
								
								

								$content .= "<td   style='text-align:center;width:15%'>
									<input onchange=\"savePrice(event)\"  data-product=\"$id\" data-id=\"$dataid\" data-size =".$item['id']." data-people=\"$i\" placeholder=\"Price\" value=\"$gia\"  type=\"text\" style='border:none;text-align:center;'>
								</td>";
							}
							$content .= "</tr>
					";
				}
			$content.= "</tbody>
		";
		
		echo $content;
	}
	else if($do=='savePrive') {

		$idproduct = $_POST['idproduct'];
		$idpeople = $_POST['idpeople'];
		$idsize = $_POST['idsize'];
		
		if(!$_POST['price']){
			$price = NULL;
		}else{
			$price = $_POST['price'];
		}
		$id = $_POST['id'];
		$data = array(
			'idproduct'=>$idproduct,
			'idsize'=>$idsize,
			'idpeople'=>$idpeople,
			'price'=>$price,
		);
		if(!$id){
			$d -> setTable('#_custom');
			$d -> insert($data);
		}else{
			if($price){
				$d -> setTable('#_custom');
				$d-> setWhere('id',$id);
				$d -> update($data);
			}else{
				$d -> setTable('#_custom');
				$d-> setWhere('id',$id);
				$d -> delete();
			}
			
		}
		
		

	}
	else if($do=='removeProduct') {

		$id = $_POST['id'];
		$product_c = $d->o_fet("select * from #_sanpham where id in ($id)");
		foreach($product_c as $key => $item){
			if($item['ten_vn'] == ""){
				$d -> setTable('#_sanpham');
				$d-> setWhere('id',$item['id']);
				$d -> delete();
				
			}
		}
		
	}
	
	else if($do=='get_list_extra') {

		$id = $_POST['id'];
		$id =implode(", ", $id);
		$list = $d->o_fet("select * from #_extra where id IN ($id) order by stt asc,id desc");
		//$selected="selected='selected'";
		//echo $str1 ='<option></option>';
		foreach($list as $a) {
			
			echo $str = "<option value='{$a['id']}' >{$a['title_vn']}</option>";
		}

	}
	// if($do =='check_key'){
    //     $key1 = md5(trim($_SERVER["SERVER_NAME"],'www.'));
	// 	$key2 = $d->simple_fetch("select * from #_thongtin");
	// 	if (!empty($key2['code'])){
	// 		$arr = explode('-',$key2['code']);
	// 		$c=0;
	// 		foreach ($arr as $key){
	// 			$key=trim($key,'');
	// 			if ($key1==$key)
	// 				$c++;
	// 		}
	// 		if ($c==0)
	// 		echo 'ok';
	// 	}else{
	// 		echo 'ok';
	// 	}
    // }

?>