<?php
    $hotro= $d->simple_fetch("select * from #_hotro limit 0,1");
?>
<style>

.btn-phone01 {
    position: fixed;
    left: 20px;
   
    z-index: 99;
}

.btn-phone01{
    bottom: 25px;
}
.btn-phone01.btn-phone011{
    bottom: 300px;
}
.btn-phone01 a i{
    font-size: 24px;
    color: #fff;
}
 
.btn-phone01 a{
    background: #e60808;
    border-radius: 50%;
    box-shadow: -2px 0px 8px -3px black;
    display: block;
    line-height: 53px;
    text-align: center;
    width: 45px;
    height: 45px;
}
.btn-phone01 a:after{
    content: '';
    display: block;
    position: absolute;
    width: 100%;
    height: 100%;
    top: 0;
    right: 0;
    background-color: inherit;
    border-radius: inherit;
    -webkit-animation: pulse-animation 1.5s cubic-bezier(0.24, 0, 0.38, 1) infinite;
    animation: pulse-animation 1.5s cubic-bezier(0.24, 0, 0.38, 1) infinite;
    z-index: -1;
}
span.number-phone01{
    position: absolute;
    background: #e60808;
    bottom: 0;
    left: 30%;
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


.touch span.number-phone01.no-hover, span.number-phone01{
    transform: scaleX(0);
}
.btn-phone01 span.number-phone01, .btn-phone01 span.number-phone01 {
    transform: scaleX(1);
    width: 230px;
    display: flex;
    justify-content: flex-end;
    border: 2px solid #fff;
    padding-right: 25px;
    align-items: center;
}

@keyframes pulse-animation{
    0%{

        transform: scale(1);
        opacity: .6;
    }
    40%{

        transform: scale(1.3);
        opacity: .6;
    }
    
    100%{
        transform: scale(2);
        opacity: 0;
    }
}
@media  (max-width: 767px) {
.btn-phone01 {
    bottom: 115px;
}
}

</style>

<div class="btn-phone01">
    <a href="tel:<?= $hotro['sdt'] ?> "><i class="fa fa-phone"></i></a>
</div>
