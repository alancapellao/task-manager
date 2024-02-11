$(document).ready(function () {

        $('#add-new-tag').on('click', function () {
                openForm('tags');
        });

        $('#add-new-list').on('click', function () {
                openForm('lists');
        });

        $('#add-new-task').on('click', function () {
                openForm('tasks');
        });

        $('#note-add').on('click', function () {
                openForm('notes');
        });

        $(document).on('click', '#form-close', function () {
                closeForm();
        });
});

const form = $('.form');

var openLoading = false;

var openForm = async (link, id = null) => {
        if (openLoading) {
                return;
        }

        openLoading = true;

        if (form.children().is(':visible')) {
                await closeForm();
        }

        form.removeClass('form-hidden');

        setTimeout(async function () {
                form.load(id ? `/${link}/${id}/edit` : `/${link}/create`);
                openLoading = false;
        }, 500);
};

var closeForm = () => {
        form.addClass('form-hidden');
        form.html('');

        return new Promise((resolve) => {
                setTimeout(() => {
                        resolve();
                }, 500);
        });
};

var removeInputError = () => {
        $('form').find('input').removeClass('input-error');
}