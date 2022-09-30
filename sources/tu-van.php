<?php
$loai = $d->simple_fetch("select * from #_category where hien_thi = 1 and alias_{$_SESSION['lang']} = '$com'");
$loai1 = $d->o_fet("select * from #_category where  id_loai = " . $loai["id"] . " order by so_thu_tu asc, id desc");


if (count($loai) == 0) $d->location(URLPATH . "404.html");
$id_sub = substr($d->findIdSub($loai['id'], 1), 1);

$id_loai = $loai['id'] . $d->findIdSub($loai['id']);
$listQuestion = $d->o_fet("select * from #_question where hien_thi = 1 order by id desc");
$bg = $d->getTemplates(60);
?>

<div class="bradcum-news">
    <div class="brea2">
        <div class="container__item">
            <div class="bregroup" style="background: url(<?= URLPATH . 'img_data/images/' . $bg['hinh_anh'] ?>);">
                <h1 class="title-home"><span><?= $loai['ten_' . $lang] ?></span></h1>
                <?= $d->breadcrumbList($loai['id'], $lang, URLPATH) ?>
            </div>
        </div>
    </div>
</div>
<br><br>

<div class="container__item">
    <div class="item__cs__a">
        <?= $loai["mo_ta_" . $lang] ?>
        <?= $loai["noi_dung_" . $lang] ?>
    </div>
</div>
<?php if (count($loai1)) { ?>
    <section class="project">
        <div class="project__side__left">
            <div class="content">
                <h3><?= $loai['ten_' . $lang] ?></h3>
            </div>
        </div>

        <div class="project__side__right">
            <div class="content">
                <?php foreach ($loai1 as $key => $item) { ?>
                    <div class="item">
                        <h1><a href="<?= URLPATH . $item['alias_' . $lang] . '.html' ?>"><?= $item['ten_' . $lang] ?></a></h1>
                        <img src="<?= URLPATH . 'img_data/images/' . $item['hinh_anh'] ?>" alt="<?= $item['ten_' . $lang] ?>">
                    </div>
                <?php } ?>
            </div>
        </div>
    </section>
<?php } ?>