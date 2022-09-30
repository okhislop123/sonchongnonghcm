AOS.init({
  easing: "ease-in-out-sine",
});
$(".sl").each(function () {
  $(this)
    .prop("Counter", 0)
    .animate(
      {
        Counter: $(this).text(),
      },
      {
        duration: 4000,
        easing: "swing",
        step: function (now) {
          $(this).text(Math.ceil(now));
        },
      }
    );
});
// $(window).scroll(function(){
//     var scrollPos = $(document).scrollTop();
//     console.log(scrollPos);
//    if (scrollPos >= 155) {

//      $('.navbar.navbar-default').addClass('menufixed');

//    }
//    else{

//      $('.navbar.navbar-default').removeClass('menufixed');

//    }
// });
$(".arrow-sub #icon1").click(function () {
  $(this).css("display", "none");
  var cha = $(this.parentNode.parentNode);
  $(cha).find("ul").css("display", "block");
  $(cha).find("#icon2").css("display", "block");
});
$(".arrow-sub #icon2").click(function () {
  $(this).css("display", "none");
  var cha = $(this.parentNode.parentNode);
  $(cha).find("ul").css("display", "none");
  $(cha).find("#icon1").css("display", "block");
});
$(document).ready(function () {
  $(".group-dtac.owl-carousel").owlCarousel({
    margin: 20,
    nav: true,
    loop: false,
    navText: [
      '<i class="fa fa-angle-left"></i>',
      '<i class="fa fa-angle-right"></i>',
    ],
    responsive: {
      0: {
        items: 1,
      },
      350: {
        items: 2,
        margin: 5,
      },
      375: {
        items: 2,
        margin: 5,
      },
      450: {
        items: 3,
        margin: 5,
      },
      768: {
        items: 4,
        margin: 5,
      },
      1024: {
        items: 5,
      },
    },
  });
  $(".product__category.owl-carousel").owlCarousel({
    margin: 20,
    nav: true,
    dots: false,
    loop: true,
    autoplay: false,
    autoplayTimeout: 2000,
    autoplayHoverPause: true,
    navText: [
      '<img src="./templates/images/next_03.png" alt="icon1">',
      '<img src="./templates/images/next_05.png" alt="icon2">',
    ],
    responsive: {
      0: {
        items: 1,
        nav: false,
      },
      350: {
        items: 1,
        margin: 5,
        nav: false,
      },
      375: {
        items: 1,
        margin: 5,
        nav: false,
      },
      450: {
        items: 2,
        margin: 5,
        nav: false,
      },
      768: {
        items: 3,
        margin: 5,
        nav: false,
      },
      1024: {
        items: 4,
      },
      1200: {
        items: 4,
      },
    },
  });
  $(".commit .content.owl-carousel").owlCarousel({
    margin: 30,
    nav: true,
    dots: false,
    loop: true,
    autoplay: false,
    autoplayTimeout: 2000,
    autoplayHoverPause: true,
    navText: [
      '<img src="./templates/images/next_03.png" alt="icon1">',
      '<img src="./templates/images/next_05.png" alt="icon2">',
    ],
    responsive: {
      0: {
        items: 1,
        nav: false,
      },
      350: {
        items: 1,
        margin: 5,
        nav: false,
      },
      375: {
        items: 1,
        margin: 15,
        nav: false,
      },
      450: {
        items: 2,
        margin: 15,
        nav: false,
      },
      768: {
        items: 3,
        margin: 15,
        nav: false,
      },
      1024: {
        items: 4,
      },
      1200: {
        items: 4,
      },
    },
  });
  $(".gift .content.owl-carousel").owlCarousel({
    margin: 20,
    nav: true,
    dots: false,
    loop: true,
    autoplay: false,
    autoplayTimeout: 2000,
    autoplayHoverPause: true,
    navText: [
      '<i class="fas fa-chevron-left"></i>',
      '<i class="fas fa-chevron-right"></i>',
    ],
    responsive: {
      0: {
        items: 1,
        nav: false,
      },
      350: {
        items: 1,
        margin: 5,
        nav: false,
      },
      375: {
        items: 1,
        margin: 15,
        nav: false,
      },
      450: {
        items: 2,
        margin: 15,
        nav: false,
      },
      768: {
        items: 3,
        margin: 15,
        nav: false,
      },
      1024: {
        items: 4,
      },
      1200: {
        items: 5,
      },
    },
  });
  $(".galley__slider .content.owl-carousel").owlCarousel({
    margin: 0,
    nav: true,
    dots: false,
    loop: true,
    autoplay: true,
    autoplayTimeout: 5000,
    autoplayHoverPause: true,
    navText: [
      '<i class="fas fa-chevron-left"></i>',
      '<i class="fas fa-chevron-right"></i>',
    ],
    responsive: {
      0: {
        items: 1,
        nav: true,
      },
    },
  });

  $(".customer .content.owl-carousel").owlCarousel({
    margin: 0,
    nav: true,
    dots: false,
    loop: true,
    autoplay: true,
    autoplayTimeout: 5000,
    autoplayHoverPause: true,
    navText: [
      '<i class="fas fa-chevron-left"></i>',
      '<i class="fas fa-chevron-right"></i>',
    ],
    responsive: {
      0: {
        items: 1,
        nav: true,
      },
    },
  });

  $(".group-news21.owl-carousel").owlCarousel({
    margin: 20,
    nav: false,
    loop: false,
    navText: [
      '<i class="fa fa-angle-left"></i>',
      '<i class="fa fa-angle-right"></i>',
    ],
    responsive: {
      0: {
        items: 1,
      },
      350: {
        items: 2,
        margin: 5,
      },
      375: {
        items: 2,
        margin: 5,
      },
      450: {
        items: 3,
        margin: 5,
      },
      768: {
        items: 4,
        margin: 5,
      },
      1024: {
        items: 5,
      },
    },
  });
});
mybutton = document.querySelector(".scroll-top");

// When the user scrolls down 20px from the top of the document, show the button
window.onscroll = function () {
  scrollFunction();
};

function scrollFunction() {
  if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
    mybutton.style.display = "block";
  } else {
    mybutton.style.display = "none";
  }
}
$(document).ready(function () {
  var id = "";

  $("#dmsearch").change(function (event) {
    var id = $("#dmsearch").val();
    console.log(id);
  });

  $("#textsearch").keyup(function (event) {
    var text = $("#textsearch").val();
    if (text.length >= 0) {
      $.ajax({
        url: "sources/ajax.php",
        type: "POST",

        data: {
          do: "loadsp",
          text: text,
        },
        success: function (result) {
          $("#searchsp").html(result);
        },
      });
    }
  });

  $("#textsearch2").keyup(function (event) {
    var text = $("#textsearch2").val();
    if (text.length >= 0) {
      $.ajax({
        url: "sources/ajax.php",
        type: "POST",

        data: {
          do: "loadsp",
          text: text,
        },
        success: function (result) {
          $("#searchsp2").html(result);
        },
      });
    }
  });
});

$("#scroll-top").click(function (event) {
  document.body.scrollTop = 0; // For Safari
  document.documentElement.scrollTop = 0; // For Chrome, Firefox, IE and Opera
});
$(".list-video").slick({
  dots: false,
  infinite: true,
  speed: 300,
  arrows: false,
  slidesToShow: 1,
  slidesToScroll: 1,

  responsive: [
    {
      breakpoint: 1025,
      settings: {
        slidesToShow: 1,
        slidesToScroll: 1,
        infinite: true,

        dots: false,
      },
    },
    {
      breakpoint: 769,
      settings: {
        slidesToShow: 1,

        slidesToScroll: 1,
      },
    },
    {
      breakpoint: 481,
      settings: {
        slidesToShow: 1,

        slidesToScroll: 1,
      },
    },
    // You can unslick at a given breakpoint now by adding:
    // settings: "unslick"
    // instead of a settings object
  ],
});
$(".gro12up-dtac").slick({
  dots: false,
  infinite: true,
  speed: 300,
  arrows: true,
  slidesToShow: 5,
  slidesToScroll: 1,

  responsive: [
    {
      breakpoint: 1025,
      settings: {
        slidesToShow: 4,
        slidesToScroll: 1,
        infinite: true,

        dots: false,
      },
    },
    {
      breakpoint: 769,
      settings: {
        slidesToShow: 2,

        slidesToScroll: 1,
      },
    },
    {
      breakpoint: 481,
      settings: {
        slidesToShow: 1,
        autoplay: true,
        autoplaySpeed: 2500,
        slidesToScroll: 1,
      },
    },
    // You can unslick at a given breakpoint now by adding:
    // settings: "unslick"
    // instead of a settings object
  ],
});

$(".group-tintuc").slick({
  dots: false,
  infinite: true,
  speed: 300,
  arrows: true,
  slidesToShow: 2,
  slidesToScroll: 1,

  responsive: [
    {
      breakpoint: 1025,
      settings: {
        slidesToShow: 2,
        slidesToScroll: 1,
        infinite: true,

        dots: false,
      },
    },
    {
      breakpoint: 769,
      settings: {
        slidesToShow: 2,

        slidesToScroll: 1,
      },
    },
    {
      breakpoint: 481,
      settings: {
        slidesToShow: 1,

        slidesToScroll: 1,
      },
    },
    // You can unslick at a given breakpoint now by adding:
    // settings: "unslick"
    // instead of a settings object
  ],
});

$(".owl_img_detail").slick({
  dots: false,
  infinite: true,
  speed: 300,
  arrows: true,
  slidesToShow: 4,
  slidesToScroll: 1,

  responsive: [
    {
      breakpoint: 1025,
      settings: {
        slidesToShow: 3,
        slidesToScroll: 1,
        infinite: true,

        dots: false,
      },
    },
    {
      breakpoint: 769,
      settings: {
        slidesToShow: 3,
        arrows: false,
        slidesToScroll: 1,
        autoplay: false,
        autoplaySpeed: 2000,
      },
    },
    {
      breakpoint: 481,
      settings: {
        slidesToShow: 3,
        arrows: false,
        slidesToScroll: 1,
        autoplay: false,
        autoplaySpeed: 2000,
      },
    },
    // You can unslick at a given breakpoint now by adding:
    // settings: "unslick"
    // instead of a settings object
  ],
});
$(".group-congtrinh").slick({
  dots: false,
  infinite: true,
  speed: 300,
  arrows: true,
  slidesToShow: 3,
  slidesToScroll: 1,

  responsive: [
    {
      breakpoint: 1025,
      settings: {
        slidesToShow: 3,
        slidesToScroll: 1,
        infinite: true,

        dots: false,
      },
    },
    {
      breakpoint: 769,
      settings: {
        slidesToShow: 2,
        arrows: false,
        slidesToScroll: 1,
        autoplay: true,
        autoplaySpeed: 2000,
      },
    },
    {
      breakpoint: 481,
      settings: {
        slidesToShow: 1,
        arrows: false,
        slidesToScroll: 1,
        autoplay: true,
        autoplaySpeed: 2000,
      },
    },
    // You can unslick at a given breakpoint now by adding:
    // settings: "unslick"
    // instead of a settings object
  ],
});
$("#frm__l button").click(function (event) {
  event.preventDefault();
  var ten = $("#txtFullname").val();
  var dienthoai = $("#txtPhone").val();
  var email = $("#txtEmail").val();
  var address = $("#txtAddress").val();
  var loinhan = $("#txtContent").val();
  var err = "";

  var vnf_regex = /^[+]*[(]{0,1}[0-9]{1,4}[)]{0,1}[-\s\./0-9]*$/g;
  var em =
    /^[a-zA-Z0-9.!#$%&’*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/;
  if (em.test(email) == false) {
    err = "Email không hợp lệ";
  }
  if (!vnf_regex.test(dienthoai)) {
    err = "Số điện thoại không hợp lệ";
  }
  if (ten.length < 1) {
    err = "Chưa nhập tên";
  }

  if (err) {
    swal(err, "", "warning");
  } else {
    $.ajax({
      url: "sources/ajax.php",
      method: "POST",
      dataType: "json",
      data: {
        do: "dkda",
        ten: ten,
        dienthoai: dienthoai,
        email: email,
        loinhan: loinhan,
        address,
      },
      success: function (result) {
        if (result.status == "success") {
          swal(result.message, "", result.status);
          $("#frm__l")[0].reset();
        } else {
          swal(result.message, "", result.status);
        }
      },
    });
  }
});
$(".group-right-hedaer").click(function () {
  $(".popup").fadeIn(1000);
});
$(".huyfor").click(function () {
  $(".popup").fadeOut(1000);
});

$(document).ready(function () {
  $("input.dkmail").keyup(function () {
    var em =
      /^[a-zA-Z0-9.!#$%&’*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/;
    var err = "";
    var val = $(this).val();
    if (val != "") {
      if (!em.test(val)) {
        $(this).attr("class", "dkmail red");
      } else {
        $(this).attr("class", "dkmail green");
      }
    } else {
      $(this).attr("class", "dkmail");
    }
  });

  $("#dkynhanmail").click(function (event) {
    event.preventDefault();
    var val = $("input.dkmail").val();
    var em =
      /^[a-zA-Z0-9.!#$%&’*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/;
    var err = "";
    if (!em.test(val)) {
      err = "Email không hợp lệ";
    }
    if (err) {
      swal(err, "", "warning");
    } else {
      $.ajax({
        url: "sources/ajax.php",
        method: "POST",
        dataType: "json",
        data: {
          do: "dkemail",
          email: val,
        },
        success: function (result) {
          if (result.status == "success") {
            swal(result.message, "", result.status);
            $("#dknmail")[0].reset();
          } else {
            swal(result.message, "", result.status);
          }
        },
      });
    }
  });
});
// $('.muahangsp-bc').click(function(event){
//     event.preventDefault();
//     var cha = $(this.parentNode);
//     var idgh = cha.find('input');
//     var valuein = idgh.val();
//     console.log(valuein);
//      $.ajax({
//         url: "sources/ajax.php",
//         method: 'POST',
//         dataType:'json',
//         data:{
//             do : 'themghang',
//             id : valuein,

//         },
//         success:function(result){
//             if (result.status == 'success') {

//                 swal(result.message,'',result.status);
//                 setTimeout(function(){
//                      window.location.reload(1);
//                   }, 1500);
//                 // $('.ctgh').append(result.data);
//             }
//             else{
//                 swal(result.message,'',result.status);
//             }

//         }

//     });
// });
