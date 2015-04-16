jQuery(document).ready(function() {
    jQuery('.datepicker').datetimepicker({
        timeFormat: 'hh:mm tt',
        stepHour: 1,
        stepMinute: 10,
        dateFormat : 'yy-mm-dd'
    });

    $('.datepicker').text(
      $.datepicker.formatTime('HH:mm:ss', {})
    );
});