(function($) {

    'use strict';

    $(document).ready(function() {

        $('.js-datepicker').datepicker({
            autoclose: true
        });

        $('.input-group.date').datepicker({
            autoclose: true,
            todayHighlight: true
        });

        $('.input-daterange').datepicker({
            autoclose: true
        });

    });

})(window.jQuery);
