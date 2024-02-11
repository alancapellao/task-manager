$(document).ready(function () {
        const menuTrigger = $('#user-container');
        const userMenu = $('#user-menu');

        menuTrigger.click(function () {

                if (menuTrigger.hasClass('active')) {
                        userMenu.slideUp(function () {
                                menuTrigger.removeClass('active');
                        });

                        menuTrigger.find('.icon-trigger').removeClass('rotate');
                        return;
                }

                if (!menuTrigger.hasClass('active')) {
                        menuTrigger.addClass('active');
                        userMenu.slideDown();
                        menuTrigger.find('.icon-trigger').addClass('rotate');
                }

        });

        menuTrigger.mouseleave(function () {
                userMenu.slideUp(function () {
                        menuTrigger.removeClass('active');
                });

                menuTrigger.find('.icon-trigger').removeClass('rotate');
        });
});