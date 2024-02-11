<div class="form-container">
        <div class="form-header">
                <h1>{{ $title }}</h1>
                <i class="icon-close" id="form-close"></i>
        </div>
        <form action="{{ $action }}" id="form-{{ $form }}" method="{{ $method }}">
                @csrf
                {{ $slot }}
        </form>
        <div class="form-action">
                @if (isset($id))
                <button class="btn-form" id="btn-delete">{{ __('pagination.delete') }} {{ $title }}</button>
                <button class="btn-form" id="btn-save">{{ __('pagination.save_changes') }}</button>
                @else
                <button class="btn-form" id="btn-save">{{ __('pagination.save') }} {{ $title }}</button>
                @endif
        </div>
</div>

<script src="{{ asset('js/requests/' . $form . '.js') }}"></script>