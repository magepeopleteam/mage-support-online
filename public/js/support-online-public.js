(function ($) {
    $(document).ready(function () {

            clockUpdate();
            setInterval(clockUpdate, 1000);
            setInterval(timestamp, 1000);

            function timestamp() {
                jQuery.ajax({
                    url:mageso_ajax.mageso_ajaxurl,
                    data: {"action": "mageso_get_our_time"},
                    success: function(data) {
                        jQuery('#mage_our_time').html(data);
                    },
                });
            }
            function clockUpdate() {
                var date = new Date();
                function addZero(x) {
                  if (x < 10) {
                    return x = '0' + x;
                  } else {
                    return x;
                  }
                }              
            function twelveHour(x) {
                  if (x > 12) {
                    return x = x - 12;
                  } else if (x == 0) {
                    return x = 12;
                  } else {
                    return x;
                  }
                }              
                var h = addZero(twelveHour(date.getHours()));
                var m = addZero(date.getMinutes());
                var s = addZero(date.getSeconds());              
                jQuery('.current_date').text('Your Time: '+ h + ':' + m + ':' + s)
              }
              
    });
})(jQuery);