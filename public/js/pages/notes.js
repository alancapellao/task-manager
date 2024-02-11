$(document).ready(function () {
        $('.form').on('blur', '#note-content', function () {
                var content = $('.ql-editor').html();

                $('#input-note-content').val(content);
        });

        $('.note').on('click', function () {
                var noteId = $(this).data('note-id');

                openForm('notes', noteId);
        });
});
