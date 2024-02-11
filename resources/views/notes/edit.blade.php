<x-form :title="__('pagination.note')" :action="route('notes.update', $note->id)" form="notes" method="POST" id="{{ $note->id }}">
        <div class="form-group">
                <label for="title">{{ __('pagination.title') }}</label>
                <input type="text" id="title" name="title" value="{{ $note->title }}" placeholder="{{ __('pagination.enter_the_title') }}">
        </div>
        <div class="form-group">
                <label for="note-content">{{ __('pagination.note_content') }}</label>
                <div id="note-content" class="note-content quill-editor" contenteditable="true">
                        {!! $note->content !!}
                </div>
                <input type="hidden" name="content" id="input-note-content" value="{{ $note->content }}">
        </div>
</x-form>

<script src="{{ asset('js/libs/quill.js') }}"></script>