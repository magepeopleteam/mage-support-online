(function ($) {

    $(document).ready(function () {

        var today = new Date();
        var time = today.getHours() + ":" + today.getMinutes() + ":" + today.getSeconds();
        var dateTime = "Your time :" + time;

        $('.current_date').html(dateTime);

    });

})(jQuery);
