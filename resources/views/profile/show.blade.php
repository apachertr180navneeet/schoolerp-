<x-app-layout>
    <x-slot name="header">
        <h5 class="mb-0 fw-semibold">
            {{ __('Profile') }}
        </h5>
    </x-slot>

    <div>
        <div class="row justify-content-center">
            <div class="col-12">
                @if (Laravel\Fortify\Features::canUpdateProfileInformation())
                    @livewire('profile.update-profile-information-form')

                    <hr class="my-4" />
                @endif

                @if (Laravel\Fortify\Features::enabled(Laravel\Fortify\Features::updatePasswords()))
                    <div class="mt-4">
                        @livewire('profile.update-password-form')
                    </div>

                    <hr class="my-4" />
                @endif

                @if (Laravel\Fortify\Features::canManageTwoFactorAuthentication())
                    <div class="mt-4">
                        @livewire('profile.two-factor-authentication-form')
                    </div>

                    <hr class="my-4" />
                @endif

                <div class="mt-4">
                    @livewire('profile.logout-other-browser-sessions-form')
                </div>

                <hr class="my-4" />

                <div class="mt-4">
                    @livewire('profile.delete-user-form')
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
