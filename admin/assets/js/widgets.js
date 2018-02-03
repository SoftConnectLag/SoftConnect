(function($) {
    $.animateCounter = function(el) {
        // Counter Number
        console.log(el.text())
        el.prop('Counter', 1).animate({
            Counter: Number($(this).text())
        }, {
            duration: 3000,
            easing: 'swing',
            step: function(now) {
                $(this).text(Math.ceil(now));
            }
        });
    }
})(jQuery);