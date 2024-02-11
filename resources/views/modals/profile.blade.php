<x-modal title="{{ __('pagination.edit_profile') }}" name="profile" :action="route('profile.update')">
        <div class="picture-container">
                <label for="profile-picture">{{ __('pagination.profile_picture') }}</label>
                <div class="profile-picture" id="profile-picture">
                        <img src="{{ $user->avatar ? asset('storage/' . $user->avatar) : asset('images/user.svg') }}" alt="Profile">
                        <input type="file" name="profile_photo" accept="image/*">
                </div>
        </div>

        <label for="name">{{ __('pagination.name') }}:</label>
        <input type="text" class="input-form" id="name" name="name" value="{{ $user->name }}"
                placeholder="{{ __('pagination.edit_your_name') }}">

        <label for="name">{{ __('pagination.username') }}:</label>
        <input type="text" class="input-form" id="username" name="username" value="{{ $user->username }}"
                placeholder="{{ __('pagination.edit_your_username') }}">

        <label for="email">{{ __('pagination.email') }}:</label>
        <input type="email" class="input-form" id="email" name="email" value="{{ $user->email }}"
                placeholder="{{ __('pagination.edit_your_email') }}">
</x-modal>