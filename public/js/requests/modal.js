$(document).ready(function () {

        $('#modal-form').submit(function (event) {
                event.preventDefault();

                var formData = new FormData($(this)[0]);
                formData.append('_method', 'PUT');

                $.ajax({
                        url: $(this).attr('action'),
                        type: 'POST',
                        data: formData,
                        dataType: 'json',
                        contentType: false,
                        processData: false,
                        headers: {
                                'X-CSRF-TOKEN': formData.get('_token')
                        },
                        success: function (response, status) {
                                if (formData.get('language')) {
                                        $('html').attr('lang', formData.get('language'));
                                }

                                $.alertBox(response.message, status);

                                removeInputError();

                                if (response.data) {
                                        response.data.name ? $('#user-name').text(response.data.name) : '';
                                        response.data.email ? $('#user-email').text(response.data.email) : '';
                                        response.data.avatar ? $('#user-avatar').attr('src', '/storage/' + response.data.avatar) : '';
                                }

                                if (response.theme) {
                                        $('#theme-link').attr('href', response.theme);
                                        $('#theme-toggle').prop('checked', response.data.theme === 'dark' ? true : false);
                                }

                                if (response.reload) {
                                        setTimeout(function () {
                                                location.reload();
                                        }, 1000);
                                }
                        },
                        error: function (xhr, status, error) {
                                const data = xhr.responseJSON;

                                $.alertBox(data.message, status);

                                if (data.errors) {
                                        removeInputError();

                                        $.each(data.errors, function (key, value) {
                                                $('#modal-form').find('input[name="' + key + '"]').addClass('input-error');
                                        });

                                        var firstErrorInput = $('#modal-form .input-error').filter(':first');

                                        if (firstErrorInput.length > 0) {
                                                firstErrorInput.focus();
                                        }
                                }
                        }
                });
        });
});

