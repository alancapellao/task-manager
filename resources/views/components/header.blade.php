<header class="header">
        <div class="header-title">
                <h1 id="header-title" @isset($id) style="cursor: pointer;" onclick="openForm('lists', {{ $id }})"
                        @endisset>
                        {{ $title }}
                </h1>
                {{ $slot }}
        </div>
        <div class="user-container" id="user-container">
                <div class="user-info">
                        <img src="{{ session('user')->avatar ? asset('storage/' . session('user')->avatar) : asset('images/user.svg') }}"
                                alt="Photo Perfil" id="user-avatar">
                        <div class="user-details">
                                <p id="user-name">{{ session('user')->name }}</p>
                                <p id="user-email">{{ session('user')->email }}</p>
                        </div>
                        <div class="user-menu-trigger">
                                <i class="icon-trigger"></i>
                        </div>
                </div>
                <div class="user-menu" id="user-menu">
                        <ul>
                                <li id="profile" data-modal="{{ route('profile.index') }}"><i
                                                class="icon-profile"></i>{{ __('pagination.profile') }}</li>
                                <li id="settings" data-modal="{{ route('settings.index') }}"><i
                                                class="icon-settings"></i>{{ __('pagination.settings') }}</li>
                        </ul>
                        <ul>
                                <form action="{{ route('logout') }}" method="POST">
                                        @csrf
                                        <li onclick="event.preventDefault(); this.closest('form').submit();">
                                                <i class="icon-sign-out"></i>{{ __('pagination.sign_out') }}</a>
                                        </li>
                                </form>
                        </ul>
                </div>
        </div>

</header>

<script src="{{ asset('js/components/header.js') }}"></script>