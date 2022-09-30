<?php
 $menu = "";
    $nav  = $d->o_fet("select * from #_category where id=1202 and hien_thi=1  order by so_thu_tu asc, id desc ");
    if($com != ''){
        $tintauc = $d->simple_fetch("select * from #_category where hien_thi = 1 and alias_".$lang." = '".$com."' limit 0,1");

       if(count($tintauc) > 0){
           
            $tintuca2 = $d->simple_fetch("select * from #_category where id = ".$tintauc['id_loai']."");

       }    
       
    }
    
    

    //echo '<pre>'; print_r($tintauc); echo '</pre>'; 
    //echo '<pre>'; print_r($tintuca2); echo '</pre>'; 
    foreach($nav as $item) {
        $active = $item['alias_'.$lang] == $com ? 'active' : '';
        $active2 = $item['id'] == $tintuca2 ? 'active' : '';
        $sub=$d->o_fet("select * from #_category where id_loai={$item['id']} and hien_thi=1 order by so_thu_tu asc, id desc limit 0,7");
        if(count($sub)>0) {
            $menusub="";
            foreach ($sub as $key => $item1) {

                $sub1=$d->o_fet("select * from #_category where id_loai={$item1['id']} and hien_thi=1 order by so_thu_tu asc, id desc");
                if(count($sub1)>0){
                    $menusub2="";
                    foreach ($sub1 as $key1 => $item2) {
                        $menusub2.='<li><a href="'.URLPATH.$item2['alias_'.$lang].'.html" title="'.$item2['ten_'.$lang].'">'.$item2['ten_'.$lang].'</a></li>';
                    }
                    $menusub.='
                        <li  class="sub-nav">
                            <a href="'.URLPATH.$item1['alias_'.$lang].'.html" title="'.$item1['ten_'.$lang].'">'.$item1['ten_'.$lang].' </a>
                            <ul>'.$menusub2.'</ul>
                        </li>'; 
                }  else {
                   $menusub.='<li><a href="'.URLPATH.$item1['alias_'.$lang].'.html" title="'.$item1['ten_'.$lang].'">'.$item1['ten_'.$lang].'</a></li>'; 
                }
                
            }
            $menu.='<li class="dropdown dropdown2">
                        <a class="'.$active.'" href="'.URLPATH.$item['alias_'.$lang].'.html" title="'.$item['ten_'.$lang].'">Danh mục sản phẩm </a>
                        <ul class="dropdown-menu">
                            '.$menusub.'
                        </ul>
                    </li>';
        }  else {
            $menu.='<li><a class="'.$active .'" href="'.URLPATH.$item['alias_'.$lang].'.html" title="'.$item['ten_'.$lang].'">Danh mục sản phẩm</a></li>';
        }
        
    }
    echo $menu;