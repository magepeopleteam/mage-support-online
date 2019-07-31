(function( $ ) {

    $(document).ready(function () {

        $('.timepicker').timepicker({
            timeFormat: 'h:mm p',
            interval: 30,
            minTime: '8:00am',
            maxTime: '6:00pm',
            //defaultTime: '',
            startTime: '8:00',
            dynamic: false,
            dropdown: true,
            scrollbar: true
        });

    });

})( jQuery );
