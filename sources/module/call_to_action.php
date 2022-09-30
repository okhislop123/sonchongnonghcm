<?php
$hotro = $d->simple_fetch("select * from #_thongtin limit 0,1");
?>
<style>
    .bottom-contact {
        display: none
    }

    .btn-phone,
    .btn-zalo,
    .btn-fb {
        position: fixed;
        right: 20px;

        z-index: 99;
    }

    span.number-fb {
        padding-left: 15px !important;
    }

    .btn-phone {
        bottom: 270px;
    }

    .btn-phone.btn-phone1 {
        bottom: 330px;
    }

    .btn-phone a i,
    .btn-zalo a i,
    .btn-fb a i {
        font-size: 24px;
        color: #fff;
    }

    .scroll-top .fa {
        font-size: 20px;
        color: #fff;
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
    }

    .btn-phone a,
    .btn-zalo a,
    .btn-fb a {
        background: #1182fc;
        border-radius: 50%;
        box-shadow: -2px 0px 8px -3px black;
        display: block;
        line-height: 53px;
        text-align: center;
        width: 45px;
        height: 45px;
    }

    .btn-phone a:after,
    .btn-zalo a:after,
    .btn-fb a:after {
        content: '';
        display: block;
        position: absolute;
        width: 100%;
        height: 100%;
        top: 0;
        left: 0;
        background-color: inherit;
        border-radius: inherit;
        -webkit-animation: pulse-animation 1.5s cubic-bezier(0.24, 0, 0.38, 1) infinite;
        animation: pulse-animation 1.5s cubic-bezier(0.24, 0, 0.38, 1) infinite;
        z-index: -1;
    }

    span.number-phone,
    span.number-zalo,
    span.number-fb {
        position: absolute;
        background: #1182fc;
        bottom: 0;
        right: 55%;
        font-size: 18px;
        color: #fff;
        font-weight: 700;
        padding: 0px;
        z-index: -1;
        border-radius: 25px 25px 25px 25px;
        height: 35px;
        line-height: 35px;
        perspective: 1000px;
        transition: all 600ms cubic-bezier(0.04, 0.94, 0.21, 1.22);
        transform-origin: right;
        top: 7px;
        width: 184px;
    }

    .btn-fb {
        bottom: 210px !important;
    }

    .touch span.number-phone.no-hover,
    span.number-phone,
    .touch span.number-zalo.no-hover,
    span.number-zalo,
    .touch span.number-fb.no-hover,
    span.number-fb {
        transform: scaleX(0);
    }

    .btn-phone:hover span.number-phone,
    .btn-phone:focus span.number-phone,
    .btn-zalo:hover span.number-zalo,
    .btn-zalo:focus span.number-zalo,
    .btn-fb:hover span.number-fb,
    .btn-fb:focus span.number-fb {
        transform: scaleX(1);
        width: 250px;
        overflow-x: hidden;
    }

    .btn-zalo img {
        border-radius: 50%;
        width: 100%;
        height: 100%;
        position: absolute;
        top: 0;
        left: 0;
    }

    .btn-zalo {
        bottom: 150px !important;
        width: 45px;
        height: 45px;
        /* position: relative; */
    }

    .scroll-top {
        background-color: #1182fc;
        width: 45px;
        height: 45px;
        border-radius: 50%;
        position: fixed;
        right: 20px;
        bottom: 50px;
        z-index: 99;
    }

    @keyframes pulse-animation {
        0% {

            transform: scale(1);
            opacity: .6;
        }

        40% {

            transform: scale(1.3);
            opacity: .6;
        }

        100% {
            transform: scale(2);
            opacity: 0;
        }
    }

    @media (max-width: 767px) {

        .btn-phone,
        .btn-fb,
        .btn-zalo {
            display: block;
        }

        .bottom-contact {
            display: block;
            position: fixed;
            bottom: 0;
            background: #0a0a0ab5;
            width: 100%;
            z-index: 99;
            box-shadow: 2px 1px 9px #dedede;
            border-top: 1px solid #eaeaea;
        }

        .bottom-contact ul {
            padding: 0px;
        }

        .bottom-contact ul li {
            width: 25%;
            float: left;
            list-style: none;
            text-align: center;
            font-size: 13.5px;
        }

        .bottom-contact ul li span {
            color: #fff
        }

        .bottom-contact ul li img {
            width: 35px;
            margin-top: 10px;
            margin-bottom: 0px;
        }


    }
</style>
<!-- <div class="btn-phone btn-phone1">
    <a href="sms:<?= $hotro['sdt'] ?> "><i class="fa fa-envelope"></i><span class="number-phone"><?= $hotro['sdt'] ?></span></a>
</div> -->
<div class="btn-phone">
    <a target="blank" href="tel:<?= $hotro['hotline'] ?> "><i class="fa fa-phone"></i></a>
</div>
<div class="btn-zalo">
    <a target="blank" href="https://zalo.me/<?= $hotro['toa_do'] ?> "><i class="fa"><img src="<?= URLPATH . 'img_data/images/zalo.png' ?>" alt=""></i></a>
</div>
<div class="btn-fb">
    <a target="blank" href="<?= $hotro['facebook'] ?> "><i class="fab fa-facebook-f"></i></a>
</div>
<div class="scroll-top" id="scroll-top">
    <i class="fa fa-angle-up"></i>
</div>