<x-form :title="__('pagination.tag')" :action="route('tags.update', $tag->id)" form="tags" method="PUT" id="{{ $tag->id }}">
        <div class="form-group">
                <label for="name">{{ __('pagination.name') }}</label>
                <input type="text" id="name" name="name" value="{{ $tag->name }}"
                        placeholder="{{ __('pagination.enter_the_name') }}">
        </div>
        <div class="form-group">
                <label for="description">{{ __('pagination.description') }}</label>
                <textarea name="description" id="description" value="{{ $tag->description }}"
                        placeholder="{{ __('pagination.enter_the_description') }}"></textarea>
        </div>

        <x-forms.color :color="$tag->color" />
</x-form>