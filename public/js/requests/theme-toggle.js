$(document).ready(function () {

        $('#theme-toggle').on('change', function () {
                var theme = this.checked ? 'dark' : 'light';
                var data = { theme: theme };
                var themeLink = $('#theme-link');

                $.ajax({
                        url: '/settings/theme',
                        type: 'PATCH',
                        data: data,
                        dataType: 'json',
                        headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function (response, status) {
                                $.alertBox(response.message, status);

                                themeLink.attr('href', response.theme);
                        },
                        error: function (xhr, status, error) {
                                const data = xhr.responseJSON;

                                $.alertBox(data.message, status);

                                $('#theme-toggle').prop('checked', !this.checked);
                        }
                });
        });
});
