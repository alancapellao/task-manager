<x-form :title="__('pagination.tag')" :action="route('tags.store')" form="tags" method="POST">
        <div class="form-group">
                <label for="name">{{ __('pagination.name') }}</label>
                <input type="text" id="name" name="name" placeholder="{{ __('pagination.enter_the_name') }}">
        </div>
        <div class="form-group">
                <label for="description">{{ __('pagination.description') }}</label>
                <textarea name="description" id="description"
                        placeholder="{{ __('pagination.enter_the_description') }}"></textarea>
        </div>

        <x-forms.color :color="null" />
</x-form>