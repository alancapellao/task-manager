<x-form :title="__('pagination.task')" :action="route('tasks.store')" form="tasks" method="POST">
        <div class="form-group">
                <label for="title">{{ __('pagination.title') }}</label>
                <input type="text" id="title" name="title" placeholder="{{ __('pagination.enter_the_title') }}">
        </div>
        <div class="form-group">
                <label for="description">{{ __('pagination.description') }}</label>
                <textarea name="description" id="description"
                        placeholder="{{ __('pagination.enter_the_description') }}"></textarea>
        </div>
        <div class="form-group">
                <label for="list">{{ __('pagination.list') }}</label>
                <select name="list" id="list">
                        <option value=""></option>
                        @foreach ($lists as $list)
                        <option value="{{ $list['id'] }}" @if (url()->previous() == route('lists.show', $list['id'])) selected @endif>
                                {{ $list['name'] }}
                        </option>
                        @endforeach
                </select>
        </div>
        <div class="form-group">
                <label for="due-date">{{ __('pagination.due_date') }}</label>
                <input type="date" name="due_date" id="due-date">
        </div>
        <div class="form-group">
                <label for="priority">{{ __('pagination.priority') }}</label>
                <select name="priority" id="priority">
                        <option value="0">{{ __('pagination.low') }}</option>
                        <option value="1">{{ __('pagination.mid') }}</option>
                        <option value="2">{{ __('pagination.high') }}</option>
                </select>
        </div>
        <div class="form-group">
                <label for="status">{{ __('pagination.status') }}</label>
                <select name="status" id="status">
                        <option value="0">{{ __('pagination.to_do') }}</option>
                        <option value="1">{{ __('pagination.in_progress') }}</option>
                        <option value="2">{{ __('pagination.done') }}</option>
                </select>
        </div>

        <x-forms.tags :tags="$tags" :taggable="[]" />
</x-form>