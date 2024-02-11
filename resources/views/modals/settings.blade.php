<x-modal :title="__('pagination.settings')" name="settings" :action="route('settings.update')">
        <label for="theme">{{ __('pagination.theme') }}:</label>
        <select id="theme" name="theme" class="input-form">
                <option value="light" {{ $settings->theme == 'light' ? 'selected' : '' }}>{{ __('pagination.light') }}
                </option>
                <option value="dark" {{ $settings->theme == 'dark' ? 'selected' : '' }}>{{ __('pagination.dark') }}
                </option>
        </select>

        <label for="language">{{ __('pagination.language') }}:</label>
        <select id="language" name="language" class="input-form">
                <option value="en" {{ $settings->language == 'en' ? 'selected' : '' }}>{{ __('pagination.english') }}
                </option>
                <option value="pt-BR" {{ $settings->language == 'pt-BR' ? 'selected' : '' }}>{{
                        __('pagination.portuguese-brazil') }}</option>
        </select>
</x-modal>