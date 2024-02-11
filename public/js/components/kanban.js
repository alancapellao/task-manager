$(document).ready(function () {

        $('#search').on('input', function () {
                const search = $(this).val();
                const url = window.location.pathname;

                if (url.includes('lists')) {
                        var listId = url.split('/').pop();
                }

                const params = {
                        index: 1,
                        list: listId,
                        search: search
                };

                var urlRequest = '/tasks/search?' + $.param(params);

                refreshTasks(urlRequest);
        });


        $('.kanban-body .column').scroll(function () {
                const scrollHeight = $(this)[0].scrollHeight;
                const scrollPosition = $(this).height() + $(this).scrollTop();

                if (Math.round(scrollPosition) === scrollHeight) {
                        const column = $(this);
                        const columnId = column.attr('id');
                        const qtyTasks = column.find('.task').length;

                        const index = Math.ceil(qtyTasks / 15) + 1;

                        var url = window.location.pathname;

                        if (url.includes('lists')) {
                                var listId = url.split('/').pop();
                        }

                        const params = {
                                index: index,
                                column: columnId,
                                list: listId,
                                search: $('#search').val()
                        };

                        var urlRequest = '/tasks/search?' + $.param(params);

                        refreshTasks(urlRequest, columnId);
                }
        });
});

function refreshTasks(url, column = null) {

        $.get(url, function (data) {

                const renderTasks = (tasks, column) => {
                        tasks.forEach(task => {
                                const taskElement = `
                                        <div class="task">
                                                <div class="task-header">
                                                        <span style="background-color: ${task.lista.color}">
                                                                ${task.lista.name}
                                                        </span>
                                                        <i onclick="openForm('tasks', ${task.id})" class="icon-more">Editar</i>
                                                </div>
                                                <div class="task-title">${task.title}</div>
                                                <p class="task-description">${task.description ?? ''}</p>
                                                <p class="task-due-date"><i class="icon-calendar"></i><span>${task.formatted_due_date}</span></p>
                                                </p>
                                                <ul class="task-tags">
                                                        ${task.tags.map(tag => `<li style="background-color: ${tag.color};">${tag.name}</li>`).join('')}
                                                </ul>
                                        </div>`;

                                column.append(taskElement);
                        });
                }

                const columns = {
                        'to-do': $('#to-do'),
                        'in-progress': $('#in-progress'),
                        'done': $('#done')
                };

                if (column) {
                        if (data[column]['tasks']['data'] === undefined) {
                                return false;
                        }

                        renderTasks(data[column]['tasks']['data'], columns[column]);

                        $('#' + column + '-quantity').text(data[column]['tasks']['total']);
                } else {
                        const statusList = ['to-do', 'in-progress', 'done'];

                        for (const status of statusList) {
                                if (data[status]['tasks']['data'] === undefined) {
                                        return false;
                                }

                                const statusElement = $(`#${status}-quantity`);
                                const columnElement = columns[status];

                                statusElement.text(data[status]['tasks']['total']);
                                columnElement.empty();
                                renderTasks(data[status]['tasks']['data'], columnElement);
                        }
                }
        });
}
