<div class="modal-content">
        <div class="modal-header">
                <h2>{{ $title }}</h2>
                <i class="icon-close-box" id="modal-close"></i>
        </div>
        <form action="{{ $action }}" name="modal-form" id="modal-form">
                @csrf
                {{ $slot }}

                <button type="submit" class="btn-form">{{ __('pagination.save') }}</button>
        </form>
</div>

<script src="{{ asset('js/requests/modal.js') }}"></script>