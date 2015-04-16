jQuery(document).ready(function() {
    jQuery('.datepicker').datetimepicker({
        timeFormat: 'HH:mm:ss',
        pickerTimeFormat: 'hh:mm tt',
        showSecond: 0,
        stepHour: 1,
        stepMinute: 15,
        dateFormat : 'yy-mm-dd'
    });

});