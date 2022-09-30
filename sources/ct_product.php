<?php foreach ($sanpham as $key => $item) {
    $size = $item['size'];
    $price = $d->vnd($item["gia"]);
    $maxPrice = "";
    if ($size) {
        $max = 0;
        $data = json_decode($size, true);
        foreach($data as $k => $i) {
            if($item["gia"] + $i['price'] > $max) {
                $max = $item["gia"] + $i["price"];
            }
        }
        $maxPrice = $d->vnd($max);
    }

    $pricedown = $d->o_fet("select * from #_custom where idproduct = " . $item['id'] . " order by price asc");
    $priceup = $d->o_fet("select * from #_custom where idproduct = " . $item['id'] . " order by price desc");
?>
    <div class="col-md-3 col-sm-6">
        <div class="item-product-group" style="width:100%;margin: 0;">
            <div class="img-productimg">
                <a href="<?= URLPATH . $item['alias_' . $lang] . '.html' ?>"><img src="<?= URLPATH . 'img_data/images/' . $item['hinh_anh'] ?>" alt="<?= $item['ten_' . $lang] ?>"></a>
            </div>
            <div class="producmaintf">
                <a href="<?= URLPATH . $item['alias_' . $lang] . '.html' ?>">
                    <h3 class="prodcut-name"><?= $d->catchuoi_new($item['ten_' . $lang], 23) ?></h3>
                    <div class="product__price <?=$maxPrice ? "active" : ""?>">
                        <div><?= $price ?></div>
                        <?=$maxPrice ? "<div>-</div>" : ""?> 
                        <div><?= $maxPrice ?></div>
                    </div>
                    <!-- <div><i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i></div> -->
                    <!-- <div style="font-size:18px;margin-bottom:5px"  class="price-begin">$<?= number_format($pricedown[0]['price'], 2, '.', '') ?> - $<?= number_format($priceup[0]['price'], 2, '.', '') ?></div> -->
                </a>
            </div>
        </div>
    </div>
<?php } ?>