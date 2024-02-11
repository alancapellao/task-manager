$(document).ready(function () {

        $('#btn-save').on('click', function (event) {
                event.preventDefault();

                var formData = new FormData($('#form-lists')[0]);

                if ($('#form-lists').attr('method') === 'PUT') {
                        formData.append('_method', 'PUT');
                }

                $.ajax({
                        url: $('#form-lists').attr('action'),
                        type: 'POST',
                        data: formData,
                        dataType: 'json',
                        contentType: false,
                        processData: false,
                        headers: {
                                'X-CSRF-TOKEN': formData.get('_token')
                        },
                        success: function (response, status) {
                                $.alertBox(response.message, status);

                                openForm('lists', response.data.id);
                        },
                        error: function (xhr, status, error) {
                                const data = xhr.responseJSON;

                                $.alertBox(data.message, status);

                                if (data.errors) {
                                        removeInputError();

                                        $.each(data.errors, function (key, value) {
                                                $('#form-lists').find('input[name="' + key + '"]').addClass('input-error');
                                        });

                                        var firstErrorInput = $('#form-lists .input-error').filter(':first');

                                        if (firstErrorInput.length > 0) {
                                                firstErrorInput.focus();
                                        }
                                }
                        }
                });
        });

        $('#btn-delete').on('click', function (event) {
                event.preventDefault();

                $.dialogBox(languageTexts[locale].list.title, languageTexts[locale].list.message, 'confirm', function (response) {
                        if (response) {
                                var formData = new FormData($('#form-lists')[0]);

                                $.ajax({
                                        url: $('#form-lists').attr('action'),
                                        type: 'DELETE',
                                        data: formData,
                                        dataType: 'json',
                                        contentType: false,
                                        processData: false,
                                        headers: {
                                                'X-CSRF-TOKEN': formData.get('_token')
                                        },
                                        success: function (response, status) {
                                                $.alertBox(response.message, status);

                                                setTimeout(function () {
                                                        window.location.href = response.redirect;
                                                }, 2000);
                                        },
                                        error: function (xhr, status, error) {
                                                const data = xhr.responseJSON;

                                                $.alertBox(data.message, status);
                                        }
                                });
                        }
                });
        });
});

