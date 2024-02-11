$(document).ready(function () {
        const modal = $('.modal');

        const closeModal = () => {
                modal.addClass('modal-hidden');

                modal.html('');
        };

        const openModal = (id) => {
                modal.removeClass('modal-hidden');

                modal.load(`${id}`);
        };

        let isMouseDownInside = false;

        modal.on('mousedown', function (event) {
            isMouseDownInside = $(event.target).closest('.modal-content').length > 0;
        });
        
        modal.on('mouseup', function (event) {
            const isMouseUpInside = !$(event.target).closest('.modal-content').length;
        
            if (!isMouseDownInside && isMouseUpInside) {
                closeModal();
            }
        
            isMouseDownInside = false;
        });
        

        $(document).on('click', '#modal-close', function () {
                closeModal();
        });

        $('#profile, #settings').on('click', function () {
                openModal($(this).data('modal'));
        });

        $(document).on('change', '#profile-picture input[type="file"]', function () {
                const file = this.files[0];
                const reader = new FileReader();

                reader.onload = function (e) {
                        $('#profile-picture img').attr('src', e.target.result);
                };

                reader.readAsDataURL(file);
        });
});
