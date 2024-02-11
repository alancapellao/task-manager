$(document).ready(function () {
        const locale = $('html').attr('lang') || 'en';

        $('#btn-save').on('click', function (event) {
                event.preventDefault();

                var formData = new FormData($('#form-tags')[0]);

                if ($('#form-tags').attr('method') === 'PUT') {
                        formData.append('_method', 'PUT');
                }

                $.ajax({
                        url: $('#form-tags').attr('action'),
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

                                openForm('tags', response.data.id);
                        },
                        error: function (xhr, status, error) {
                                const data = xhr.responseJSON;

                                $.alertBox(data.message, status);

                                if (data.errors) {
                                        removeInputError();

                                        $.each(data.errors, function (key, value) {
                                                $('#form-tags').find('input[name="' + key + '"]').addClass('input-error');
                                        });

                                        var firstErrorInput = $('#form-tags .input-error').filter(':first');

                                        if (firstErrorInput.length > 0) {
                                                firstErrorInput.focus();
                                        }
                                }
                        }
                });
        });

        $('#btn-delete').on('click', function (event) {
                event.preventDefault();

                $.dialogBox(languageTexts[locale].tag.title, languageTexts[locale].tag.message, 'confirm', function (response) {
                        if (response) {
                                var formData = new FormData($('#form-tags')[0]);

                                $.ajax({
                                        url: $('#form-tags').attr('action'),
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

                                                $('#tags-menu').children(`div[data-tag-id="${response.tag}"]`).remove();

                                                closeForm('tags');
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

