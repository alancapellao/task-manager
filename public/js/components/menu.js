$(document).ready(function () {
        const menu = $('#menu');
        const menuToggle = $('#menu-toggle');
        const menuClose = $('#menu-close');

        getItemsMenu();

        const closeMenu = () => {
                menu.addClass('menu-hidden');
                menu.children().hide();
                menuClose.css('display', 'flex');
        };

        const openMenu = () => {
                menu.removeClass('menu-hidden');

                setTimeout(function () {
                        menu.children().show();
                }, 500);

                menuClose.hide();
        };

        menuToggle.on('click', closeMenu);
        menuClose.on('click', openMenu);
});

function getItemsMenu() {
        
        $.get('/menu', function (response) {
                const lists = response.lists;
                const tags = response.tags;

                const listsMenu = $('#lists-menu');
                const tagsMenu = $('#tags-menu');

                lists.forEach(list => {
                        const existingList = listsMenu.children(`li[data-list-id="${list.id}"]`);

                        if (existingList.length > 0) {
                                const listName = existingList.find('.list-name');
                                const listQuantity = existingList.find('.list-quantity');

                                if (listName.text() !== list.name) {
                                        listName.text(list.name);
                                }

                                if (listQuantity.text() !== list.tasks_count) {
                                        listQuantity.text(list.tasks_count);
                                }

                                if (window.location.pathname === `/lists/${list.id}`) {
                                        $('#header-title').text(list.name);
                                }
                                return;
                        }

                        listsMenu.append(`
                                        <li data-list-id="${list.id}">
                                                <a href="/lists/${list.id}">
                                                        <span class="list-color" style="background-color: ${list.color};"></span>
                                                        <span class="list-name">${list.name}</span>
                                                        <span class="list-quantity">${list.tasks_count}</span>
                                                </a>
                                        </li>
                                `);

                        if (window.location.pathname === `/lists/${list.id}`) {
                                listsMenu.children().last().append('<span class="active"></span>');
                                listsMenu.find(`li [href="/lists/${list.id}"]`).focus();
                        }
                });

                tags.forEach(tag => {
                        const existingTag = tagsMenu.children(`div[data-tag-id="${tag.id}"]`);

                        if (existingTag.length > 0) {
                                const tagName = existingTag.find('.tag-name');
                                const tagColor = existingTag;

                                if (tagName.text() !== tag.name) {
                                        tagName.text(tag.name);
                                }

                                if (tagColor.css('background-color') !== tag.color) {
                                        tagColor.css('background-color', tag.color);
                                }
                                return;
                        }

                        tagsMenu.prepend(`
                                        <div class="tag" data-tag-id="${tag.id}" style="background-color: ${tag.color};">
                                                <span class="tag-name">${tag.name}</span>
                                        </div>
                                `);

                        tagsMenu.find(`div[data-tag-id="${tag.id}"]`).on('click', function () {
                                openForm('tags', tag.id);
                        });
                });
        });
}
