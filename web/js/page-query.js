$(function () {
    //get the click of modal button to create / update item
    //we get the button by class not by ID because you can only have one id on a page and you can
    //have multiple classes therefore you can have multiple open modal buttons on a page all with or without
    //the same link.
//we use on so the dom element can be called again if they are nested, otherwise when we load the content once it kills the dom element and wont let you load anther modal on click without a page refresh
    $(document).on('click', '.tablinks', function () {
        var data = $(this).attr('data-display');

        $(".tablinks").each(function () {
            $(this).removeClass('active');
        });
        $(".detail-tab-content").each(function () {
            $(this).removeClass('active');
        });
        $(this).addClass('active');
        $("#detail-" + data).addClass('active');
    });


});
//size picker
$(document).on('click', '.product-properties-picker a', function () {
    if ($(this).is('#properties-choose')) {
        $(this).attr('id', '');
    } else {
        $(this).parent().find('#properties-choose').attr('id', '');
        $(this).attr('id', 'properties-choose');
    }
    return false;

});
//color picker
$(document).on('click', '.product-properties-picker.color a', function () {
    $(".product-properties-picker.color a").each(function () {
        $(this).removeAttr('id', 'properties-choose');
    });

    $(this).attr('id', 'properties-choose');
});
//onload 
$(window).load(function () {
    //auto resize height 
    var t = $(".slide-image").outerHeight(true);

    $(".slide-control-prev").css('line-height', t + "px");
    $(".slide-control-next").css('line-height', t + "px");
    $(".others-title").css('height', t + "px");
    $(".slide-container").css('height', t + "px");
    //image zoom
    $('.image-detail').jqzoom({
        zoomType: 'standard',
        lens: false,
        zoomWidth: 400,
        zoomHeight: 400,
        preloadImages: false,
        alwaysOn: false,
        title: false
    });
    //horizontle slideshow
    $(function () {

        // ========= Điều chỉnh các thông số cho slideshow =========

        // Số lượng hình muốn hiển thị
        // Lượng hình tồn tại trong slide cần nhiều hơn con số này để slide có thể thực hiện chức năng xoay vòng
        var display_image_number = 3;

        // Lựa chọn cách thức xoay vòng (circle) của slide bằng cách thay đổi circle_method bằng các con số tương ứng
        // Method = 1: Sau khi chạm đến giới hạn slide, slide stage sẽ trượt thẳng về vị trí cuối cùng hoặc đầu tiên
        // Method = 2: Sau khi chạm đến giới hạn slide, slide sẽ được quay vòng qua từng hình
        var circle_method = 2;

        // Tốc độ dịch chuyển của hình ảnh (đơn vị: milisecond)
        var anispeed = 200;

        // Lựa chọn có sử dụng chế độ tự động cuốn hình slide
        // 1 = Kích hoạt, 0 = Không kích hoạt
        var auto_scroll = 0;

        // Nếu giá trị auto_scroll = 1 thì có thể điều chỉnh giá trị sau để thay đổi thời gian cuộn
        var timeinterval = 1200;


        // ========= Xác định các thông số cơ bản của slideshow =========

        // Xác định số lượng hình của slide, chiều rộng của mỗi hình để tìm ra độ rộng của stage
        var image_count = $('.slide-image').length;
        var image_width = $('.slide-image').outerWidth(true);
        // Độ rộng của hình ảnh có thể chỉnh sửa bằng css
        // Độ rộng này quan trọng vì nó sẽ ảnh hưởng đến độ rộng của toàn bộ slide, cần được tính toán cẩn thận
        var stage_width = image_width * image_count;
        // Xác định chiều rộng của khung hiển thị slide
        var display_width = display_image_number * image_width;

        // Chỉnh độ dài slide stage tương ứng với số lượng hình cần hiển thị thông qua display_width
        $('.slide-holder').css("width", display_width + "px");

        // Chỉnh lại độ dài của khối bao quanh các slide-image (slide-stage) cho vừa bằng tổng số khối slide-image
        $('.slide-stage').css("width", stage_width + "px");


        // ========= Xử lý khi click nút next và prev =========

        function left_slide_circle() {
            $('.slide-image:last-child').addClass('swapthis'); // Xác định hình đang ở vị trí cuối cùng
            $('.swapthis').insertBefore('.slide-image:first'); // Chuyển hình cuối lên trước hình đầu tiên
            $('.slide-stage').css("left", -image_width + "px"); // Dịch chuyển tức thời vị trí của stage sang một khoảng bằng 1 slide-image
            $('.slide-stage').stop().animate({left: 0}, anispeed); // Thực hiện animation
            $('.swapthis').removeClass('swapthis'); // Reset class cho slide-image vừa chuyển
        }
        function right_slide_circle() {
            $('.slide-image:first').addClass('swapthis'); // Xác định hình đang ở vị trí cuối cùng
            $('.swapthis').insertAfter('.slide-image:last-child'); // Chuyển hình cuối lên trước hình đầu tiên
            $('.slide-stage').css("left", -(stage_width - image_width - display_width) + "px"); // Dịch chuyển tức thời vị trí của stage sang một khoảng bằng 1 slide-image
            $('.slide-stage').stop().animate({left: display_width - stage_width}, anispeed); // Thực hiện animation
            $('.swapthis').removeClass('swapthis'); // Reset class cho slide-image vừa chuyển
        }
        function left_slide_scroll() {
            // Xác định xem slide có còn hình phía bên trái hay không dựa trên Left của stage
            var stage_left = $('.slide-stage').position().left;

            // Nếu có
            if (stage_left < 0 && !$('.slide-stage').is(':animated')) { //Kích hoạt chỉ khi stage ko chuyển động nữa
                $('.slide-stage').stop().animate({left: "+=" + image_width}, anispeed);
            } else // Nếu đã chuyển về hình ảnh đầu tiên thì lựa chọn cách thức quay vòng
            {
                switch (circle_method) { //Lựa chọn
                    case 1:
                        $('.slide-stage').stop().animate({left: display_width - stage_width}, anispeed);
                        break;
                    case 2:
                        left_slide_circle();
                        break;
                }

            }
        }
        function right_slide_scroll() {
            // Xác định xem slide có còn hình phía bên phải hay không dựa trên độ dài của stage và container
            var stage_left = Math.abs($('.slide-stage').position().left);
            var right_remain = stage_width - (display_width + stage_left);

            // Nếu có
            if (right_remain > 0 && !$('.slide-stage').is(':animated')) { //Kích hoạt chỉ khi stage ko chuyển động nữa
                $('.slide-stage').stop().animate({left: "-=" + image_width}, anispeed);
            } else // Nếu đã chuyển về hình ảnh đầu tiên thì lựa chọn cách thức quay vòng
            {
                switch (circle_method) { //Lựa chọn
                    case 1:
                        $('.slide-stage').stop().animate({left: 0}, anispeed);
                        break;
                    case 2:
                        right_slide_circle();
                        break;
                }
            }
        }

        $('.slide-control-prev').click(function () {
            left_slide_scroll();
        });
        $('.slide-control-next').click(function () {
            right_slide_scroll();
        });

        // ========= Xử lý auto scroll ==================
        /*
         function start_slide_auto_scroll() {
         play = setInterval(right_slide_scroll, timeinterval);
         }
         
         // Nếu chế độ auto scroll được chọn thì sẽ kích hoạt 
         if (auto_scroll == 1) {
         start_slide_auto_scroll();
         }
         
         // Đưa chuột vào slide và các nút sẽ tạm dừng quá trình auto scroll
         $(".slide-container,.slide-control-prev,.slide-control-next").hover(function () {
         clearInterval(play);
         }, function () {
         start_slide_auto_scroll();
         });
         */

    });
    $("input").iCheck({
        checkboxClass: "icheckbox_square-grey"
    });


});
//verticle slider
$(document).on('click', '.button-next', function () {
    var count = $("#image-scroller-verticle li").length;
    var number = $("#image-scroller-verticle li.active").last().attr('id');
    number = number.replace("item", '');

    var start = (number * 1 + 1);

    if (start < count) {
        $("#image-scroller-verticle li.active").each(function () {
            $(this).removeClass('active');

        });
        for (var i = start; i <= ((start * 1 + 2) <= count ? (start * 1 + 2) : count); i++) {
            $("#item" + i).addClass('active', '1000', 'easeInBack');
        }
    }

});

$(document).on('click', '.button-prev', function () {

    var number = $("#image-scroller-verticle li.active").first().attr('id');
    number = number.replace("item", '');

    $("#image-scroller-verticle li.active").each(function () {
        $(this).removeClass('active');

    });
    var start = (number * 1 - 3);
    if (start == 1 || start <= 0) {
        for (var i = 1; i <= 3; i++) {
            $("#item" + i).addClass('active', '1000', 'easeInBack');
        }
    } else {
        for (var i = (number * 1 - 3); i <= (number * 1 - 1); i++) {
            $("#item" + i).addClass('active', '1000', 'easeInBack');
        }
    }

});
//change image onclik and refresh the cursor zoom
$(document).on('click', '.image-thumbmail-container .thumb', function () {
    var image = $(this).attr('data-images');
    $(".image-detail img").fadeOut(500, function () {
        $(".image-detail").remove();
        $(".image-detail-container").append('<a class="image-detail" href="' + image + '">' +
                '<img src="' + image + '"/>' +
                '</a>');

        $('.image-detail').jqzoom({
            zoomType: 'standard',
            lens: true,
            preloadImages: false,
            alwaysOn: false,
            title: false
        });
        $(".image-detail img").fadeIn(500);
    });

    return false;
});
