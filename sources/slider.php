<script type="text/javascript" src="<?= URLPATH ?>templates/module/slider/jssor.slider.min.js"></script>
<script>
    jQuery(document).ready(function($) {
        var slideTransitions = [{
                $Duration: 1400,
                x: 0.3,
                y: -0.3,
                $Delay: 20,
                $Cols: 8,
                $Rows: 4,
                $Clip: 15,
                $During: {
                    $Left: [0.1, 0.9],
                    $Top: [0.1, 0.9]
                },
                $SlideOut: true,
                $Formation: $JssorSlideshowFormations$.$FormationStraightStairs,
                $Assembly: 260,
                $Easing: {
                    $Left: $Jease$.$InJump,
                    $Top: $Jease$.$InJump,
                    $Clip: $Jease$.$OutQuad
                },
                $Outside: true,
                $Round: {
                    $Left: 0.8,
                    $Top: 2.5
                }
            },
            {
                $Duration: 500,
                $Delay: 80,
                $Cols: 8,
                $Rows: 4,
                $Clip: 15,
                $Easing: $Jease$.$InQuad
            },
            {
                $Duration: 1200,
                x: 0.3,
                $Cols: 2,
                $SlideOut: true,
                $ChessMode: {
                    $Column: 3
                },
                $Easing: {
                    $Left: $Jease$.$InCubic,
                    $Opacity: $Jease$.$Linear
                },
                $Opacity: 2
            }
        ];
        var captureTransitions = [
            [{
                b: -1,
                d: 1,
                o: -1
            }, {
                b: 0,
                d: 1200,
                y: 300,
                o: 1,
                e: {
                    y: 24,
                    o: 6
                }
            }, {
                b: 5600,
                d: 800,
                y: -200,
                o: -1,
                e: {
                    y: 5
                }
            }],
        ];
        var options = {
            $AutoPlay: 1,
            $PauseOnHover: 0,
            $SlideDuration: 800,
            $SlideshowOptions: {
                $Class: $JssorSlideshowRunner$,
                $Transitions: slideTransitions,
                $TransitionsOrder: 1
            },
            $SlideEasing: $Jease$.$OutQuint,
            $ArrowNavigatorOptions: {
                $Class: $JssorArrowNavigator$,
                $ChanceToShow: 1
            },
            $CaptionSliderOptions: {
                $Transitions: captureTransitions,
            },
            $BulletNavigatorOptions: {
                $Class: $JssorBulletNavigator$
            }
        };

        var jssor_slider = new $JssorSlider$("jssor_1", options);

        /*#region responsive code begin*/
        /*you can remove responsive code if you don't want the slider scales while window resizing*/
        function ScaleSlider() {
            var refSize = jssor_slider.$Elmt.parentNode.clientWidth;
            if (refSize) {
                refSize = Math.min(refSize, 1920);
                jssor_slider.$ScaleWidth(refSize);
            } else {
                window.setTimeout(ScaleSlider, 30);
            }
        }
        ScaleSlider();
        $(window).bind("load", ScaleSlider);
        $(window).bind("resize", ScaleSlider);
        $(window).bind("orientationchange", ScaleSlider);
    });
</script>
<?php
$textslide = $d->getImg(1130);
?>
<div class="slide" style="position: relative;">
    <!--  <div class="group-right-hedaer">
        <img src="<?= URLPATH . 'templates/images/ic2.png' ?>" alt="img">
        
    </div> -->

    <div class="p0">
        <div class="wrap-slide">
            <div id="jssor_1" style="position:relative;margin:0 auto;top:0px;left:0px;width:1423px;height:620px;overflow:hidden;visibility:hidden;">
                <!-- Loading Screen -->
                <div data-u="loading" class="jssorl-oval" style="position:absolute;top:0px;left:0px;text-align:center;background-color:rgba(0,0,0,0.7);">
                    <img style="margin-top:-19.0px;position:relative;top:50%;width:38px;height:38px;" src="<?= URLPATH ?>templates/module/slider/svg/loading/static-svg/oval.svg" />
                </div>
                <!-- slides container -->
                <div data-u="slides" style="cursor:default;position:relative;top:0px;left:0px;width:1423px;height:620px;overflow:hidden;">
                    <?php foreach ($textslide as $i => $item) { ?>
                        <div data-idle="4000" class="j-item">
                            <a href="<?=$item['link']?>">
                                <img data-u="image" src="<?= URLPATH ?>img_data/images/<?= $item['picture'] ?>" alt="<?= $item['title_' . $_SESSION['lang']] ?>" />
                            </a>
                        </div>
                    <?php } ?>
                </div>

                <!--#region Bullet Navigator Skin Begin -->
                <!-- Help: https://www.jssor.com/development/slider-with-bullet-navigator.html -->
                <style>
                    .jssorb051 .i {
                        position: absolute;
                        cursor: pointer;
                    }

                    .jssorb051 .i .b {
                        fill: #fff;
                        fill-opacity: 0.5;
                        stroke: #000;
                        stroke-width: 400;
                        stroke-miterlimit: 10;
                        stroke-opacity: 0.5;
                    }

                    .jssorb051 .i:hover .b {
                        fill-opacity: .7;
                    }

                    .jssorb051 .iav .b {
                        fill-opacity: 1;
                    }

                    .jssorb051 .i.idn {
                        opacity: .3;
                    }
                </style>
                <div data-u="navigator" class="jssorb051" style="position:absolute;bottom:12px;right:12px;" data-autocenter="1" data-scale="0.5" data-scale-bottom="0.75">
                    <div data-u="prototype" class="i" style="width:20px;height:20px;">
                        <svg viewBox="0 0 16000 16000" style="position:absolute;top:0;left:0;width:100%;height:100%;">
                            <circle class="b" cx="8000" cy="8000" r="5800"></circle>
                        </svg>
                    </div>
                </div>
                <!--#endregion Bullet Navigator Skin End -->

                <!--#region Arrow Navigator Skin Begin -->
                <!-- Help: https://www.jssor.com/development/slider-with-arrow-navigator.html -->
                <style>
                    .jssora051 {
                        display: block;
                        position: absolute;
                        cursor: pointer;
                    }

                    .jssora051 .a {
                        fill: none;
                        stroke: #fff;
                        stroke-width: 360;
                        stroke-miterlimit: 10;
                    }

                    .jssora051:hover {
                        opacity: .8;
                    }

                    .jssora051.jssora051dn {
                        opacity: .5;
                    }

                    .jssora051.jssora051ds {
                        opacity: .3;
                        pointer-events: none;
                    }
                </style>
                <div data-u="arrowleft" class="jssora051" style="width:75px;height:75px;top:0px;left:25px;" data-autocenter="2" data-scale="0.75" data-scale-left="0.75">
                    <svg viewBox="0 0 16000 16000" style="position:absolute;top:0;left:0;width:100%;height:100%;">
                        <polyline class="a" points="11040,1920 4960,8000 11040,14080 "></polyline>
                    </svg>
                </div>
                <div data-u="arrowright" class="jssora051" style="width:75px;height:75px;top:0px;right:25px;" data-autocenter="2" data-scale="0.75" data-scale-right="0.75">
                    <svg viewBox="0 0 16000 16000" style="position:absolute;top:0;left:0;width:100%;height:100%;">
                        <polyline class="a" points="4960,1920 11040,8000 4960,14080 "></polyline>
                    </svg>
                </div>
                <!--#endregion Arrow Navigator Skin End -->
            </div>
        </div>
    </div>



</div>