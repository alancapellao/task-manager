$(document).ajaxComplete(function (event, xhr, settings) {
        if (settings.url !== '/menu') {
                getItemsMenu();
        }
});
