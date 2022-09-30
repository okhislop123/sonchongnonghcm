<?php
	$Link = $Link2 = '';
	$dir=URLPATH.'sources/pXML.xml';
	if(!is_dir($dir)) mkdir($dir,0755,true);
	$Link = $dir;
	$Link2 = 'http://vietcombank.com.vn/ExchangeRates/ExrateXML.aspx';
	$content = @file_get_contents($Link2);
	
	if($content==''){
	  $content = @file_get_contents($Link);
	  //echo '<pre>'; print_r($content); echo '</pre>'; exit;
	}else{
	  copy($Link2,$Link);
	} 
	if($content!='' and preg_match_all('/Exrate CurrencyCode="(.*)" CurrencyName="(.*)" Buy="(.*)" Transfer="(.*)" Sell="(.*)"/',$content,$matches) and count($matches)>0){

	  $exchange_rates=array(

	  'USD'=>array()

	  ,'EUR'=>array()

	  ,'GBP'=>array()

	  ,'HKD'=>array()

	  ,'JPY'=>array()

	  ,'CHF'=>array()

	  ,'AUD'=>array()

	  ,'CAD'=>array()

	  ,'SGD'=>array()

	  ,'THB'=>array()

	  );

	  foreach($matches[1] as $key=>$value){

	  if(isset($exchange_rates[$value])){

	  $exchange_rates[$value]=array(

	  'id'=>$value

	  ,'name'=>$matches[2][$key]

	  ,'buy'=>$matches[3][$key]

	  ,'transfer'=>$matches[4][$key]

	  ,'sell'=>$matches[5][$key]

	  );

	  }

	  }
	}

	function getExchangeRatesVCB(){
		$Link = $Link2 = '';
		$dir=URLPATH.'sources/pXML.xml';
		if(!is_dir($dir)) mkdir($dir,0755,true);
		$Link = $dir;
		$Link2 = 'http://vietcombank.com.vn/ExchangeRates/ExrateXML.aspx';
		$content = @file_get_contents($Link2);
		if($content==''){
		  $content = @file_get_contents($Link);
		}else{
		  copy($Link2,$Link);
		} 

		if($content!='' and preg_match_all('/Exrate CurrencyCode="(.*)" CurrencyName="(.*)" Buy="(.*)" Transfer="(.*)" Sell="(.*)"/',$content,$matches) and count($matches)>0){
		  $exchange_rates=array(
		  'USD'=>array()
		  ,'EUR'=>array()
		  ,'GBP'=>array()
		  ,'HKD'=>array()
		  ,'JPY'=>array()
		  ,'CHF'=>array()
		  ,'AUD'=>array()
		  ,'CAD'=>array()
		  ,'SGD'=>array()
		  ,'THB'=>array()
		  );
		  foreach($matches[1] as $key=>$value){
		  if(isset($exchange_rates[$value])){
		  $exchange_rates[$value]=array(
		  'id'=>$value
		  ,'name'=>$matches[2][$key]
		  ,'buy'=>$matches[3][$key]
		  ,'transfer'=>$matches[4][$key]
		  ,'sell'=>$matches[5][$key]
		  );
		  }
		  }
		  Return $exchange_rates;
		}
	}
	$data1=getExchangeRatesVCB();

?>
<div class="table2">
  <div class="title-bn">
   
      <div ><?=($lang == 'vn') ? 'Mã NT' : 'Code NT'?></div>
      <div ><?=($lang == 'vn') ? 'Mã NT' : 'Buy cash'?></div>
      <div ><?=($lang == 'vn') ? 'Mã NT' : 'Buy by transfer'?></div>
      <div ><?=($lang == 'vn') ? 'Bán' : 'Sell'?></div>
    
  </div>
  <div>
  	<?php
		foreach($data1 as $id=>$item){
	?>
    <div class="item-s">
		<div><?php echo $id?></div>
		<!-- <div><?php echo $item['name']?></div> -->
		<div><?php echo $item['buy']?></div>
		<div><?php echo $item['transfer']?></div>
		<div><?php echo $item['sell']?></div>
	</div>
   	<?php
		}
	?>
  </div>
</div>


