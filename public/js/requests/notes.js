$(document).ready(function () {
        const locale = $('html').attr('lang') || 'en';

        $('#btn-save').on('click', function (event) {
                event.preventDefault();

                var formData = new FormData($('#form-notes')[0]);

                if ($('#form-notes').attr('method') === 'PUT') {
                        formData.append('_method', 'PUT');
                }

                $.ajax({
                        url: $('#form-notes').attr('action'),
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

                                if (response.data.id) {
                                        openForm('notes', response.data.id);

                                        const noteElement = $('.wall').find('.note[data-note-id="' + response.data.id + '"]');

                                        const newNoteElement = $(`
                                                <div class="note" data-note-id="${response.data.id}">
                                                        <div class="note-header">
                                                                ${response.data.title}
                                                        </div>
                                                        <div class="note-body">
                                                                ${response.data.content}
                                                        </div>
                                                </div>
                                        `);

                                        if (noteElement.length > 0) {
                                                noteElement.replaceWith(newNoteElement);
                                        } else {
                                                $('.wall').prepend(newNoteElement);
                                        }
                                }
                        },
                        error: function (xhr, status, error) {
                                const data = xhr.responseJSON;

                                $.alertBox(data.message, status);

                                if (data.errors) {
                                        removeInputError();

                                        $.each(data.errors, function (key, value) {
                                                $('#form-notes').find('input[name="' + key + '"]').addClass('input-error');
                                        });

                                        var firstErrorInput = $('#form-notes .input-error').filter(':first');

                                        if (firstErrorInput.length > 0) {
                                                firstErrorInput.focus();
                                        }
                                }
                        }
                });
        });

        $('#btn-delete').on('click', function (event) {
                event.preventDefault();

                $.dialogBox(languageTexts[locale].note.title, languageTexts[locale].note.message, 'confirm', function (response) {
                        if (response) {
                                var formData = new FormData($('#form-notes')[0]);

                                $.ajax({
                                        url: $('#form-notes').attr('action'),
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

                                                $('.wall').find('.note[data-note-id="' + response.note + '"]').remove();

                                                closeForm('notes');
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

