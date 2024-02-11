<x-form :title="__('pagination.task')" :action="route('tasks.update', $task->id)" form="tasks" method="PUT" id="{{ $task->id }}">
        <div class="form-group">
                <label for="title">{{ __('pagination.title') }}</label>
                <input type="text" id="title" name="title" placeholder="{{ __('pagination.enter_the_title') }}" value="{{ $task->title }}">
        </div>
        <div class="form-group">
                <label for="description">{{ __('pagination.description') }}</label>
                <textarea name="description" id="description"
                        placeholder="{{ __('pagination.enter_the_description') }}">{{ $task->description }}</textarea>
        </div>
        <div class="form-group">
                <label for="list">{{ __('pagination.list') }}</label>
                <select name="list" id="list">
                        <option value=""></option>
                        @foreach ($lists as $list)
                        <option value="{{ $list['id'] }}" {{ $task->lista_id == $list['id'] ? 'selected' : '' }}>{{ $list['name'] }}</option>
                        @endforeach
                </select>
        </div>
        <div class="form-group">
                <label for="due-date">{{ __('pagination.due_date') }}</label>
                <input type="date" name="due_date" id="due-date" value="{{ $task->due_date }}">
        </div>
        <div class="form-group">
                <label for="priority">{{ __('pagination.priority') }}</label>
                <select name="priority" id="priority">
                        <option value="0" {{ $task->priority == 0 ? 'selected' : '' }}>{{ __('pagination.low') }}</option>
                        <option value="1" {{ $task->priority == 1 ? 'selected' : '' }}>{{ __('pagination.mid') }}</option>
                        <option value="2" {{ $task->priority == 2 ? 'selected' : '' }}>{{ __('pagination.high') }}</option>
                </select>
        </div>
        <div class="form-group">
                <label for="status">{{ __('pagination.status') }}</label>
                <select name="status" id="status">
                        <option value="2" {{ $task->status == 2 ? 'selected' : '' }}>{{ __('pagination.done') }}</option>
                        <option value="1" {{ $task->status == 1 ? 'selected' : '' }}>{{ __('pagination.in_progress') }}</option>
                        <option value="0" {{ $task->status == 0 ? 'selected' : '' }}>{{ __('pagination.to_do') }}</option>
                </select>
        </div>

        <x-forms.tags :tags="$tags" :taggable="$task->tags->toArray()" />
</x-form>