$(document).ready(function () {
        $('.date-period').daterangepicker({
                startDate: moment().startOf('day'),
                endDate: moment().startOf('day').add(1, 'day'),
                minDate: moment().startOf('day'),
                opens: 'center',
                locale: {
                        format: 'MM/DD/YYYY'
                }
        });
});
