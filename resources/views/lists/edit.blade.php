<x-form :title="__('pagination.list')" :action="route('lists.update', $list->id)" form="lists" method="PUT" id="{{ $list->id }}">
        <div class="form-group">
                <label for="name">{{ __('pagination.name') }}</label>
                <input type="text" id="name" name="name" placeholder="{{ __('pagination.enter_the_name') }}" value="{{ $list->name }}">
        </div>
        <div class="form-group">
                <label for="description">{{ __('pagination.description') }}</label>
                <textarea name="description" id="description" placeholder="{{ __('pagination.enter_the_description') }}">{{ $list->description }}</textarea>
        </div>

        <x-forms.color :color="$list->color" />
</x-form>
