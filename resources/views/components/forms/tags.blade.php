<div class="form-group">
        <label for="tags">{{ __('pagination.tags') }}</label>
        <div class="tags-container" id="tags">
                <div class="tags-list">
                        @foreach ($tags as $tag)
                        @if ($taggable && in_array($tag['id'], array_column($taggable, 'id')))
                        @continue
                        @endif
                        
                        <div class="tag" data-tag-id="{{ $tag['id'] }}" style="background-color: {{ $tag['color'] }}">
                                <span class="tag-name">{{ $tag['name'] }}</span>
                        </div>
                        @endforeach
                </div>

                @foreach ($taggable as $tag)
                <div class="tag" data-tag-id="{{ $tag['id'] }}" style="background-color: {{ $tag['color'] }}">
                        <span class="tag-name">{{ $tag['name'] }}</span>
                </div>

                <input type="hidden" name="tags[]" value="{{ $tag['id'] }}">
                @endforeach

                <button class="add-button" id="add-tag"><i class="icon-add"></i>{{ __('pagination.add_tag') }}</button>
        </div>
</div>

<script src="{{ asset('js/components/forms/tags.js') }}"></script>