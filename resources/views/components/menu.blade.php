<aside class="menu" id="menu">
        <div class="menu-header">
                <h1>{{ __('pagination.menu') }}</h1>
                <div class="menu-toggle" id="menu-toggle">
                        <i class="icon-menu"></i>
                </div>
        </div>
        <div class="list-menu">
                <ul>
                        <li>
                                <a href="{{ route('dashboard') }}">
                                        <i class="list-icon icon-dashboard"></i>
                                        <span class="list-name">{{ __('pagination.dashboard') }}</span>
                                </a>
                                @if(request()->is('dashboard'))
                                <span class="active"></span>
                                @endif
                        </li>
                        <li>
                                <a href="{{ route('notes.index') }}">
                                        <i class="list-icon icon-sticky"></i>
                                        <span class="list-name">{{ __('pagination.sticky_notes') }}</span>
                                </a>
                                @if(request()->is('notes'))
                                <span class="active"></span>
                                @endif
                        </li>
                </ul>
        </div>
        <div class="list-menu">
                <h2>{{ __('pagination.lists') }}</h2>
                <ul id="lists-menu"></ul>

                <button class="add-button" id="add-new-list"><i class="icon-add"></i>{{ __('pagination.add_new_list')
                        }}</button>
        </div>
        <div class="list-menu">
                <h2>{{ __('pagination.tags') }}</h2>
                <div class="tag-container" id="tags-menu"></div>

                <button class="add-button" id="add-new-tag"><i class="icon-add"></i>{{ __('pagination.add_new_tag')
                        }}</button>
        </div>
        <div class="list-menu-inferior">
                <div class="title">
                        <i class="list-icon icon-mode"></i>
                        <span class="list-name">{{ __('pagination.dark_mode') }}</span>
                </div>
                <div class="switch">
                        <input type="checkbox" id="theme-toggle" @if(session('user.settings')->theme == 'dark') checked
                        @endif>
                        <label for="theme-toggle"></label>
                </div>
        </div>
</aside>
<div class="menu-toggle menu-close" id="menu-close">
        <i class="icon-menu"></i>
</div>

<script src="{{ asset('js/components/menu.js') }}"></script>
<script src="{{ asset('js/requests/theme-toggle.js') }}"></script>