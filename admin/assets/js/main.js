$.noConflict();

jQuery(document).ready(function($) {

    "use strict";

    [].slice.call(document.querySelectorAll('select.cs-select')).forEach(function(el) {
        new SelectFx(el);
    });

    jQuery('.selectpicker').selectpicker;


    $('#menuToggle').on('click', function(event) {
        $('body').toggleClass('open');
    });

    $('.search-trigger').on('click', function(event) {
        event.preventDefault();
        event.stopPropagation();
        $('.search-trigger').parent('.header-left').addClass('open');
    });

    $('.search-close').on('click', function(event) {
        event.preventDefault();
        event.stopPropagation();
        $('.search-trigger').parent('.header-left').removeClass('open');
    });

    // $('.user-area> a').on('click', function(event) {
    // 	event.preventDefault();
    // 	event.stopPropagation();
    // 	$('.user-menu').parent().removeClass('open');
    // 	$('.user-menu').parent().toggleClass('open');
    // });

    $("#login-form").submit(function(event) {
        var $this = $(this);
        var $btn = $this.find("button");

        $.ajax({
            url: "assets/action.php",
            method: "POST",
            data: $this.serialize(),
            beforeSend: function() {
                $btn.prop("disabled", true);
            },
            success: function(data) {
                if (data == "Yes") {
                    alert("Login Successful.. You'll be redirected Shortly..");
                    window.location.href = "dashboard.php";
                } else {
                    alert("Wrong Email Address / Password.. Try Another..");
                    $btn.prop("disabled", false);
                }
            }
        });

        event.preventDefault();
    });

    $.ajax({
        url: "assets/action.php",
        method: "POST",
        data: { subCount: 1 },
        success: function(data) {
            $("#sub-count").html(data);
        }
    });

    $.ajax({
        url: "assets/action.php",
        method: "POST",
        data: { msgCount: 1 },
        success: function(data) {
            $("#msg-count").html(data);
        }
    });

    $.ajax({
        url: "assets/action.php",
        method: "POST",
        data: { curMsgCount: 1 },
        success: function(data) {
            $("#cur-msgs").html(data);
        }
    });

    $('#filter').change(function(event) {
        event.preventDefault();
        var command = $(this).val();

        if (command == "level") {
            $('#levelSelector').show();
            $('#departmentSelector').hide();
        } else if (command == "department") {
            $('#departmentSelector').show();
            $('#levelSelector').hide();
        } else {
            $('#departmentSelector').hide();
            $('#levelSelector').hide();
        }
    });

    $("#leveltosend").change(function(event) {
        event.preventDefault();
        var lts = $(this).val();

        if (lts == 0) {
            alert(lts);
        } else {
            $.ajax({
                url: "assets/action.php",
                method: "POST",
                data: { countbyLevel: lts },
                success: function(data) {
                    $('#lbl1').html("<strong>" + data + " targeted recipient(s)</strong>");
                }
            })
        }
    });

    $("#departarmenttosend").change(function(event) {
        event.preventDefault();
        var dept = $(this).val();

        if (dept == 0) {
            alert(dept);
        } else {
            $.ajax({
                url: "assets/action.php",
                method: "POST",
                data: { countbyDepartment: dept },
                success: function(data) {
                    $('#lbl2').html("<strong>" + data + " targeted recipient(s)</strong>");
                }
            })
        }
    });

    $("#send-msg").submit(function(event) {
        event.preventDefault();

        $.ajax({
            url: "assets/action.php",
            method: "POST",
            data: $(this).serialize(),
            success: function(data) {
                if (data == "Yes") {
                    alert("Message successfully sent to all recipients");
                } else if (data == "Error") {
                    alert("An error occured.. Check to see if you have enough Units");
                }
            }
        })
    });

    var idx = window.location.pathname.lastIndexOf("/");
    var curPage = window.location.pathname.substr(idx + 1).replace(".php", "");

    curPage = curPage.charAt(0).toUpperCase() + curPage.substr(1);

    var $dir = $("#directory");
    var el, li;

    if (curPage != "Dashboard") {
        el = $dir.find("li").eq(0);
        el.html("<a href='dashboard.php'>Dashboard</a>");
        li = $("<li>" + curPage + "</li>");
        $dir.append(li);
    }

});