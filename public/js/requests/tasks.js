$(document).ready(function () {
        const url = window.location.pathname;

        if (url.includes('lists')) {
                var listId = url.split('/').pop();
        }

        const urlRequest = url.includes('lists') ? `/tasks/search?list=${listId}` : `/tasks/search`;

        $('#btn-save').on('click', function (event) {
                event.preventDefault();

                var formData = new FormData($('#form-tasks')[0]);

                if ($('#form-tasks').attr('method') === 'PUT') {
                        formData.append('_method', 'PUT');
                }

                $.ajax({
                        url: $('#form-tasks').attr('action'),
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

                                openForm('tasks', response.data.id);

                                refreshTasks(urlRequest);
                        },
                        error: function (xhr, status, error) {
                                const data = xhr.responseJSON;

                                $.alertBox(data.message, status);

                                if (data.errors) {
                                        removeInputError();

                                        $.each(data.errors, function (key, value) {
                                                $('#form-tasks').find('input[name="' + key + '"]').addClass('input-error');
                                        });

                                        var firstErrorInput = $('#form-tasks .input-error').filter(':first');

                                        if (firstErrorInput.length > 0) {
                                                firstErrorInput.focus();
                                        }
                                }
                        }
                });
        });

        $('#btn-delete').on('click', function (event) {
                event.preventDefault();

                $.dialogBox(languageTexts[locale].task.title, languageTexts[locale].task.message, 'confirm', function (response) {
                        if (response) {
                                var formData = new FormData($('#form-tasks')[0]);

                                $.ajax({
                                        url: $('#form-tasks').attr('action'),
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

                                                closeForm('tasks');

                                                refreshTasks(urlRequest);
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

