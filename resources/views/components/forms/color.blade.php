<div class="form-group">
        <label for="color">{{ __('pagination.color') }}</label>
        <div class="color-container">
                <div class="color-header">
                        <i class="icon-close-box" id="color-cancel"></i>
                        <span>{{ __('pagination.select_color') }}</span>
                        <i class="icon-success" id="color-success"></i>
                </div>
                <div class="color-content">
                        <div class="color" data-color="#ff0000" style="background-color: #ff0000"></div>
                        <div class="color" data-color="#00ff00" style="background-color: #00ff00"></div>
                        <div class="color" data-color="#0000ff" style="background-color: #0000ff"></div>
                        <div class="color" data-color="#ffff00" style="background-color: #ffff00"></div>
                        <div class="color" data-color="#00ffff" style="background-color: #00ffff"></div>
                        <div class="color" data-color="#ff00ff" style="background-color: #ff00ff"></div>
                        <div class="color" data-color="#000000" style="background-color: #000000"></div>
                        <div class="color" data-color="#ffffff" style="background-color: #ffffff"></div>
                        <div class="color" data-color="#ffffff" id="color-personalized"
                                style="background-color: #ffffff">
                                <i class="icon-color"></i>
                                <input type="color" id="color-input">
                        </div>
                </div>
        </div>

        <input type="hidden" name="color" id="color-data" value="{{ $color }}">
        <button class="add-button" id="select-color"><i class="icon-add"></i>{{ __('pagination.select_color') }}</button>
</div>

<script src="{{ asset('js/components/forms/color.js') }}"></script>