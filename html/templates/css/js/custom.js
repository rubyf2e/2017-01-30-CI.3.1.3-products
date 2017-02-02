/**
 * Resize function without multiple trigger
 * 
 * Usage:
 * $(window).smartresize(function(){  
 *     // code here
 * });
 */
 (function($,sr){
    // debouncing function from John Hann
    // http://unscriptable.com/index.php/2009/03/20/debouncing-javascript-methods/
    var debounce = function (func, threshold, execAsap) {
      var timeout;

      return function debounced () {
        var obj = this, args = arguments;
        function delayed () {
            if (!execAsap)
                func.apply(obj, args); 
            timeout = null; 
        }

        if (timeout)
            clearTimeout(timeout);
        else if (execAsap)
            func.apply(obj, args);

        timeout = setTimeout(delayed, threshold || 100); 
    };
};

    // smartresize 
    jQuery.fn[sr] = function(fn){  return fn ? this.bind('resize', debounce(fn)) : this.trigger(sr); };

})(jQuery,'smartresize');
/**
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

 var CURRENT_URL = window.location.href.split('#')[0].split('?')[0],
 $BODY = $('body'),
 $MENU_TOGGLE = $('#menu_toggle'),
 $SIDEBAR_MENU = $('#sidebar-menu'),
 $SIDEBAR_FOOTER = $('.sidebar-footer'),
 $LEFT_COL = $('.left_col'),
 $RIGHT_COL = $('.right_col'),
 $NAV_MENU = $('.top_nav'),
 $FOOTER = $('footer');

// Sidebar
$(document).ready(function() {
    // TODO: This is some kind of easy fix, maybe we can improve this
    var setContentHeight = function () {
        // reset height
        $RIGHT_COL.css('min-height', $(window).height());

        var bodyHeight = $BODY.outerHeight(),
        footerHeight   = $BODY.hasClass('footer_fixed') ? -10 : $FOOTER.height(),
        leftColHeight  = $LEFT_COL.eq(1).height() + $SIDEBAR_FOOTER.height(),
        contentHeight  = bodyHeight < leftColHeight ? leftColHeight : bodyHeight;

        // normalize content
        contentHeight -= $NAV_MENU.height() + footerHeight+ $SIDEBAR_FOOTER.height()*2+12;

        $RIGHT_COL.css('min-height', contentHeight);
    };

    $SIDEBAR_MENU.find('a').on('click', function(ev) {
        var $li = $(this).parent();

        if ($li.is('.active')) {
            $li.removeClass('active active-sm');
            $('ul:first', $li).slideUp(function() {
                setContentHeight();
            });
        } else {
            // prevent closing menu if we are on child menu
            if (!$li.parent().is('.child_menu')) {
                $SIDEBAR_MENU.find('li').removeClass('active active-sm');
                $SIDEBAR_MENU.find('li ul').slideUp();
            }
            
            $li.addClass('active');

            $('ul:first', $li).slideDown(function() {
                setContentHeight();
            });
        }
    });

    // toggle small or large menu
    $MENU_TOGGLE.on('click', function() {
        if ($BODY.hasClass('nav-md')) {
            $SIDEBAR_MENU.find('li.active ul').hide();
            $SIDEBAR_MENU.find('li.active').addClass('active-sm').removeClass('active');
        } else {
            $SIDEBAR_MENU.find('li.active-sm ul').show();
            $SIDEBAR_MENU.find('li.active-sm').addClass('active').removeClass('active-sm');
        }

        $BODY.toggleClass('nav-md nav-sm');

        setContentHeight();
    });

    // check active menu
    $SIDEBAR_MENU.find('a[href="' + CURRENT_URL + '"]').parent('li').addClass('current-page');

    $SIDEBAR_MENU.find('a').filter(function () {
        return this.href == CURRENT_URL;
    }).parent('li').addClass('current-page').parents('ul').slideDown(function() {
        setContentHeight();
    }).parent().addClass('active');

    // recompute content when resizing
    $(window).smartresize(function(){  
        setContentHeight();
    });

    setContentHeight();

    // fixed sidebar
    if ($.fn.mCustomScrollbar) {
        $('.menu_fixed').mCustomScrollbar({
            autoHideScrollbar: true,
            theme: 'minimal',
            mouseWheel:{ preventDefault: true }
        });
    }
});
// /Sidebar

// Panel toolbox
$(document).ready(function() {
    $('.collapse-link').on('click', function() {
        var $BOX_PANEL = $(this).closest('.x_panel'),
        $ICON = $(this).find('i'),
        $BOX_CONTENT = $BOX_PANEL.find('.x_content');
        
        // fix for some div with hardcoded fix class
        if ($BOX_PANEL.attr('style')) {
            $BOX_CONTENT.slideToggle(200, function(){
                $BOX_PANEL.removeAttr('style');
            });
        } else {
            $BOX_CONTENT.slideToggle(200); 
            $BOX_PANEL.css('height', 'auto');  
        }

        $ICON.toggleClass('fa-chevron-up fa-chevron-down');
    });

    $('.close-link').click(function () {
        var $BOX_PANEL = $(this).closest('.x_panel');

        $BOX_PANEL.remove();
    });
});
// /Panel toolbox

// Tooltip
$(document).ready(function() {
    $('[data-toggle="tooltip"]').tooltip({
        container: 'body'
    });
});
// /Tooltip

// Progressbar
if ($(".progress .progress-bar")[0]) {
    $('.progress .progress-bar').progressbar();
}
// /Progressbar

// Switchery
$(document).ready(function() {
    if ($(".js-switch")[0]) {
        var elems = Array.prototype.slice.call(document.querySelectorAll('.js-switch'));
        elems.forEach(function (html) {
            var switchery = new Switchery(html, {
                color: '#26B99A'
            });
        });
    }
});
// /Switchery

// iCheck
$(document).ready(function() {
    if ($("input.flat")[0]) {
        $(document).ready(function () {
            $('input.flat').iCheck({
                checkboxClass: 'icheckbox_flat-green',
                radioClass: 'iradio_flat-green'
            });
        });
    }
});
// /iCheck

// Table
$('table input').on('ifChecked', function () {
    checkState = '';
    $(this).parent().parent().parent().addClass('selected');
    countChecked();
});
$('table input').on('ifUnchecked', function () {
    checkState = '';
    $(this).parent().parent().parent().removeClass('selected');
    countChecked();
});

var checkState = '';

$('.bulk_action input').on('ifChecked', function () {
    checkState = '';
    $(this).parent().parent().parent().addClass('selected');
    countChecked();
});
$('.bulk_action input').on('ifUnchecked', function () {
    checkState = '';
    $(this).parent().parent().parent().removeClass('selected');
    countChecked();
});
$('.bulk_action input#check-all').on('ifChecked', function () {
    checkState = 'all';
    countChecked();
});
$('.bulk_action input#check-all').on('ifUnchecked', function () {
    checkState = 'none';
    countChecked();
});

function countChecked() {
    if (checkState === 'all') {
        $(".bulk_action input[name='table_records']").iCheck('check');
    }
    if (checkState === 'none') {
        $(".bulk_action input[name='table_records']").iCheck('uncheck');
    }

    var checkCount = $(".bulk_action input[name='table_records']:checked").length;

    if (checkCount) {
        $('.column-title').hide();
        $('.bulk-actions').show();
        $('.action-cnt').html(checkCount + ' Records Selected');
    } else {
        $('.column-title').show();
        $('.bulk-actions').hide();
    }
}

// Accordion
$(document).ready(function() {
    $(".expand").on("click", function () {
        $(this).next().slideToggle(200);
        $expand = $(this).find(">:first-child");

        if ($expand.text() == "+") {
            $expand.text("-");
        } else {
            $expand.text("+");
        }
    });
});

// NProgress
if (typeof NProgress != 'undefined') {
    $(document).ready(function () {
        NProgress.start();
    });

    $(window).load(function () {
        NProgress.done();
    });
}

/**ajax相關函式**/
function toggleFullscreen(elem) {
    elem = elem || document.documentElement;
    if (!document.fullscreenElement && !document.mozFullScreenElement &&
        !document.webkitFullscreenElement && !document.msFullscreenElement) {
        if (elem.requestFullscreen) {
            elem.requestFullscreen();
        } else if (elem.msRequestFullscreen) {
            elem.msRequestFullscreen();
        } else if (elem.mozRequestFullScreen) {
            elem.mozRequestFullScreen();
        } else if (elem.webkitRequestFullscreen) {
            elem.webkitRequestFullscreen(Element.ALLOW_KEYBOARD_INPUT);
        }
    } else {
        if (document.exitFullscreen) {
            document.exitFullscreen();
        } else if (document.msExitFullscreen) {
            document.msExitFullscreen();
        } else if (document.mozCancelFullScreen) {
            document.mozCancelFullScreen();
        } else if (document.webkitExitFullscreen) {
            document.webkitExitFullscreen();
        }
    }
}

var option_output = function(response) {
   var option_name = '';
   for(var i = 0; i < response.length; i++)
   {
    option_name += "<option value=" +response[i]['id'] +">"+response[i]['name']+"</option>";
}  
return option_name;
}

var all_sidebar_box_ajax = function(url, hideen_id) { 
    $.ajax({
        url : url,
        cache: false,
        success : function(response)
        {         
          $("#"+hideen_id).val(JSON.stringify(response));
      }
  });
}

var option_ajax = function(select_one_id, url, select_two_id, value) { 
    var value = (select_one_id) ? $("#"+select_one_id).val() : value;
    $.ajax({
        url : url,
        type: 'POST',
        data: {id : value},
        cache: false,
        success : function(response)
        {         
            var option = option_output(response);
            $("#"+select_two_id).html(option);  
        }
    });
}

var select_ajax = function(select_one_id, url, select_two_id) { 
    $("#"+select_one_id).bind('change',  function (event) {  
        option_ajax(select_one_id, url, select_two_id);
    });
}

var select_ajax_single = function(array, num) { 
    $("#"+array[num][2]).bind('change',  function (event) { 
      select_ajax_three($("#"+array[num][2]).val(), array, num);
  });
}

var select_ajax_three = function (value, array, num) { 
  if(num <= array.length - 1){
      $.ajax({
        url : array[num][0],
        type: 'POST',
        data: {id : value},
        cache: false,
        success : function(response){
            var option = '';
            for(i = 0; i < response.length; i++)
            {
             var id = response[0]['id'] ? response[0]['id'] : '';
             option += "<option value=" + response[i]['id'] + ">"+ response[i]['name'] +"</option>";
         }

         $("#"+array[num][1]).html(option);
         select_ajax_three(id, array, num+1); 
     }
 })
  }
}
databoxArray = [];
var select_ajax_threebox = function (target_url, target_id, array, num) { 
 if(num <= array.length - 1){
    $.ajax({
        url : target_url,
        type: 'POST',
        data: {id : $('#'+array[num][1]).val()},
        cache: false,
        success : function(response)
        {         
            databoxArray[num] = option_output(response);
            for (var i = databoxArray.length - 1; i >= 0; i--) 
            {
                if(databoxArray[i])
                {
                    $("#"+target_id).html(databoxArray[i]);
                }
            }
            if(num+1 <= array.length - 1){
                $.ajax({
                    url : array[num+1][0],
                    type: 'POST',
                    data: {id : $('#'+array[num][1]).val()},
                    cache: false,
                    success : function(response)
                    {         
                       var option = option_output(response);  
                       $("#"+array[num+1][1]).html(option); 
                       select_ajax_threebox(target_url, target_id, array, num+1); 
                   }
               });
            }
        }
    });
}
}

var check_email = function(target_id, show_box_id){
    $("#"+target_id).bind('keyup', function() {
      var value     = $(this).val();
      var emailRule = /^\w+((-\w+)|(\.\w+))*\@[A-Za-z0-9]+((\.|-)[A-Za-z0-9]+)*\.[A-Za-z]+$/;
      if(value == '')
      {  
        $("#"+show_box_id).html("<span style='color:red'>電子信箱未填</span>");
    }
    else if(value.search(emailRule) == -1)
    {
        $("#"+show_box_id).html("<span style='color:red'>電子信箱格式錯誤</span>");
    }
    else
    {
        $("#"+show_box_id).html("<input type='hidden' name='check_email' value='true'/>");
    }
});
}
  /**ajax相關函式結束**/