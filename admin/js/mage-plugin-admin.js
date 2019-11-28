(function( $ ) {

    $(document).ready(function () {


        $('.timepicker').timepicker({
            timeFormat: 'h:mm p',
            interval: 30,
            minTime: '8:00am',
            maxTime: '6:00pm',
            startTime: '8:00',
            dynamic: false,
            dropdown: true,
            scrollbar: true
        });

        //Add vacation field
        $('.main_wrapper').on('click', '.add_vacation', function (e) {
            e.preventDefault();

            var $global_wrapper = $('.main_wrapper');
            var $local_wrapper = $('.wrapper');

            var $last_count = $('.last_count');

            var $last_count_val = parseInt($last_count.val());

            $last_count_val++;

            $last_count.val($last_count_val);

            var $field = '<p class="field">' +
                '<input type="text" name="mage_so_pro_general_setting_sec_holiday[' + $last_count_val + '][vacation_date]" class="datepicker" autocomplete="off" placeholder="' + obj.vacation_date + '" /> ' +

                '<input type="text" name="mage_so_pro_general_setting_sec_holiday[' + $last_count_val + '][vacation_name]" required placeholder="' + obj.vacation_name + '"/> ' +

                '<input type="url" class="regular-text" name="mage_so_pro_general_setting_sec_holiday[' + $last_count_val + '][vacation_link]" placeholder="' + obj.vacation_link + '"/> ' +

                '<a class="button remove_field"> <span class="dashicons dashicons-trash" style="color: red;margin-top: 3px;margin-left: 2px"></span> ' + obj.remove + ' </a>' +
                '</p>';

            $($global_wrapper).find($local_wrapper).append($field);

            // call for this function for js
            datePicker();

        });//end vacation add field


        // Remove vacation field
        $('.main_wrapper').on('click', '.remove_field', function (e) {
            e.preventDefault();

            $(this).closest('.field').remove();

        });

        // Datepicker function
        function datePicker() {
            $('.datepicker').datepicker({
                dateFormat: 'yy-mm-dd',
                timeFormat: "HH:mm"
            });
        }

        // call this function for php
        datePicker();



    });

})( jQuery );
