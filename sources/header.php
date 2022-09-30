<?php


($com != '') ? $linkcom = "&langcom=" . $com : $linkcom = '';
$num_cart = 0;
if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
    foreach ($_SESSION['cart'] as $key => $value) {
        $num_cart = $num_cart + $value['so_luong'];
    }
}
$camket = $d->getImg(1166);
$hotro = $d->simple_fetch("select * from #_thongtin limit 0,1");
$slogan = $d->getTemplates(53);
$lang = $_SESSION['lang'];
$navTop  = $d->o_fet("select * from #_category where menu=1 and hien_thi=1  order by so_thu_tu asc, id desc");
?>

<div class="header-tag2">
    <div class="container__item">
        <h3></h3>
        <div>
            <ul class="menu-top">
                <?php foreach ($navTop as $key => $item) { ?>
                    <li style="display: none;"> <a href="<?= URLPATH . $item['alias_' . $lang] . '.html' ?>"><?= $item['ten_' . $lang] ?></a></li>
                <?php } ?>
                <div class="search-header">

                    <form method="get" action="index.php" class="navbar-form navbar-right" id="frm1">
                        <input type="hidden" name="com" value="search">
                        <div class="form-group">
                            <input onkeyup="get_search(this.value)" autocomplete="off" type="text" name="textsearch" onfocus="this.placeholder = ''" onblur="this.placeholder = '<?= _typekey ?>'" placeholder="<?= _typekey ?>" class="form-control">
                        </div>
                        <button type="submit" class="btn btn-default"><i class="glyphicon glyphicon-search"></i></button>
                    </form>

                    <a href="gio-hang.html"><i class="fa fa-shopping-cart" aria-hidden="true"></i></a>
                </div>
            </ul>
        </div>

    </div>
</div>

<nav class="navbar navbar-default xs-none <?= ($com) ? 'detail' : '' ?>" role="navigation">
    <div class="container__item">
        <div class="header__container" style="position: relative;">
            <div class="submenu">
                <ul class="menu__wtf">
                </ul>
            </div>
            <div class="logo">
                <a href="<?= URLPATH ?>" title="<?= $ten_cong_ty ?>" class="logo">
                    <img src="<?= $logo ?>" alt="<?= $ten_cong_ty ?>" />
                </a>
            </div>
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1home">

                <ul class="nav navbar-nav ">
                    <!-- <li><a class="<?= ($com == '') ? 'active' : ''; ?>" href="<?= URLPATH ?>"><?= ($lang == 'vn') ? 'Home' : 'Home'; ?></a></li> -->
                    <?php include 'module/menu.php'; ?>

                    <li class="hotline">
                        Hotline: <?= $hotro['hotline'] ?>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</nav>

<nav class="navbar navbar-default md-none xs-block" role="navigation">
    <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand logo" href="<?= URLPATH ?>">
                <img src="<?= $logo ?>" alt="<?= $ten_cong_ty ?>" />
            </a>
        </div>
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <?php include 'module/menu.php'; ?>
            </ul>

            <!-- <div class="group-form-menu">
                <form method="get" action="index.php"class="navbar-form navbar-right" id="frm1">
                    <input type="hidden" name="com" value="search">
                     <div class="form-group">
                        <input onkeyup="get_search(this.value)" autocomplete ="off" type="text" name="textsearch" onfocus="this.placeholder = ''" onblur="this.placeholder = '<?= _typekey ?>'" placeholder="<?= _typekey ?>" class="form-control">
                    </div>
                      <button type="submit" class="btn btn-default"><i class="glyphicon glyphicon-search"></i></button>
                    <div id="livesearch" class="result">
                       
                    </div>

                </form>
                <div class="language">
                    <div class="img-language"><a href="<?= URLPATH . '?lang=us'; ?>"><img src="<?= URLPATH . 'img_data/images/us.png'; ?>" alt=""></a></div>
                    <div class="img-language"><a href="<?= URLPATH . '?lang=vn'; ?>"><img src="<?= URLPATH . 'img_data/images/vn.png'; ?>" alt=""></a></div>
                </div>
            </div> -->
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container-fluid -->
</nav>
<?php include 'module/mmenu.php'; ?>
<form method="get" action="index.php" class=" md-none xs-block" id="frm30" style="display: none;">
    <input type="hidden" name="com" value="search">

    <input onkeyup="get_search(this.value)" autocomplete="off" type="text" name="textsearch" placeholder="Nhập nội dung tìm kiếm ..." class="form-control">

    <button type="submit" class="btn btn-default"><i class="glyphicon glyphicon-search"></i></button>
</form>

<script>
    // document.querySelector(".uk-search-input").focus();
    // document.querySelector(".uk-search-input").select();

    const handleShowSearch = function(e) {
        document.getElementById("bs-example-navbar-collapse-1home").classList.toggle("show-search");
    }
    let currentID = null;
    const handleShowMenu = function(e) {
        // document.querySelector(".submenu").classList.remove("show2");
        const id = e.getAttribute("data-id");
        if (!id) return;

        let idLocal = localStorage.getItem("show-menu-item");
        if (!idLocal) {
            localStorage.setItem("show-menu-item", id);
            document.querySelector(".submenu").classList.add("show2");
        } else {
            if (idLocal == id) {
                localStorage.setItem("show-menu-item", id);
                let test = document.querySelector(".submenu.show2");
                console.log(test)
                if (test) {
                    document.querySelector(".submenu").classList.remove("show2");
                } else {
                    document.querySelector(".submenu").classList.add("show2");
                }

            } else {
                document.querySelector(".submenu").classList.remove("show2");
                localStorage.setItem("show-menu-item", id);
                document.querySelector(".submenu").classList.add("show2");
            }
        }
        console.log(idLocal);
        // localStorage.setItem("show-menu-item",id);
        // document.querySelector(".submenu").classList.toggle("show2");
        $.ajax({
            url: "sources/ajax.php",
            method: "post",
            data: {
                do: "menu_hide",
                id,
            },
            success: function(res) {
                document.querySelector(".menu__wtf").innerHTML = res;
            }
        })

    }

    // Get the header
    var header = document.querySelector(".navbar-default");

    // Get the offset position of the navbar
    var sticky = header.offsetTop;

    // Add the sticky class to the header when you reach its scroll position. Remove "sticky" when you leave the scroll position
    function myFunction() {
        if (window.pageYOffset > 60) {
            header.classList.add("sticky");
        } else {
            header.classList.remove("sticky");
        }
    }

    // When the user scrolls the page, execute myFunction
    $(document).scroll(() => {
        myFunction()
    })
    window.onscroll = function() {
        myFunction()
    };
</script>