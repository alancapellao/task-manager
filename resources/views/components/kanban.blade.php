<div class="kanban">
        <div class="kanban-header">
                <div class="action-bar">
                        <div class="search">
                                <i class="icon-search"></i>
                                <input type="text" placeholder="{{ __('pagination.search') }}" id="search">
                        </div>
                        <button class="tasks-button" id="add-new-task">
                                <i class="icon-add"></i>
                                <span>{{ __('pagination.add_new_task') }}</span>
                        </button>
                </div>
                <div class="kanban-tittle">
                        <strong class="column-title">{{ __('pagination.to_do') }}
                                <span class="column-quantity" id="to-do-quantity">
                                        {{ $tasks['to-do']['tasks']['total'] ?? 0 }}
                                </span>
                        </strong>
                        <strong class="column-title">{{ __('pagination.in_progress') }}
                                <span class="column-quantity" id="in-progress-quantity">
                                        {{ $tasks['in-progress']['tasks']['total'] ?? 0 }}
                                </span>
                        </strong>
                        <strong class="column-title">{{ __('pagination.done') }}
                                <span class="column-quantity" id="done-quantity">
                                        {{ $tasks['done']['tasks']['total'] ?? 0 }}
                                </span>
                        </strong>
                </div>
        </div>
        <div class="kanban-body">
                <div class="column" id="to-do">
                        @foreach($tasks['to-do']['tasks']['data'] as $task)
                        <div class="task">
                                <div class="task-header">
                                        <span style="background-color: {{ $task['lista']['color'] }};">
                                                {{ $task['lista']['name'] }}
                                        </span>
                                        <i onclick="openForm('tasks', {{ $task['id'] }})" class="icon-more">Editar</i>
                                </div>
                                <div class="task-title">{{ $task['title'] }}</div>
                                <p class="task-description">{{ $task['description'] }}</p>
                                <p class="task-due-date"><i class="icon-calendar"></i><span>{{
                                                $task['formatted_due_date'] }}</span>
                                </p>
                                <ul class="task-tags">
                                        @foreach($task['tags'] as $tag)
                                        <li style="background-color: {{ $tag['color'] }};">{{ $tag['name'] }}</li>
                                        @endforeach
                                </ul>
                        </div>
                        @endforeach
                </div>
                <div class="column" id="in-progress">
                        @foreach($tasks['in-progress']['tasks']['data'] as $task)
                        <div class="task">
                                <div class="task-header">
                                        <span style="background-color: {{ $task['lista']['color'] }};">
                                                {{ $task['lista']['name'] }}
                                        </span>
                                        <i onclick="openForm('tasks', {{ $task['id'] }})" class="icon-more">Editar</i>
                                </div>
                                <div class="task-title">{{ $task['title'] }}</div>
                                <p class="task-description">{{ $task['description'] }}</p>
                                <p class="task-due-date"><i class="icon-calendar"></i><span>{{
                                                $task['formatted_due_date'] }}</span>
                                </p>
                                <ul class="task-tags">
                                        @foreach($task['tags'] as $tag)
                                        <li style="background-color: {{ $tag['color'] }};">{{ $tag['name'] }}</li>
                                        @endforeach
                                </ul>
                        </div>
                        @endforeach
                </div>
                <div class="column" id="done">
                        @foreach($tasks['done']['tasks']['data'] as $task)
                        <div class="task">
                                <div class="task-header">
                                        <span style="background-color: {{ $task['lista']['color'] }};">
                                                {{ $task['lista']['name'] }}
                                        </span>
                                        <i onclick="openForm('tasks', {{ $task['id'] }})" class="icon-more">Editar</i>
                                </div>
                                <div class="task-title">{{ $task['title'] }}</div>
                                <p class="task-description">{{ $task['description'] }}</p>
                                <p class="task-due-date"><i class="icon-calendar"></i><span>{{
                                                $task['formatted_due_date'] }}</span>
                                </p>
                                <ul class="task-tags">
                                        @foreach($task['tags'] as $tag)
                                        <li style="background-color: {{ $tag['color'] }};">{{ $tag['name'] }}</li>
                                        @endforeach
                                </ul>
                        </div>
                        @endforeach
                </div>
        </div>
</div>

<script src="{{ asset('js/components/kanban.js') }}"></script>