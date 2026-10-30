<div class="card shadow-sm">
    <div class="card-header bg-white">
        <h5 class="mb-0">{{ __('Two Factor Authentication') }}</h5>
        <small class="text-muted">{{ __('Add additional security to your account using two factor authentication.') }}</small>
    </div>
    <div class="card-body">
        <h6 class="fw-medium">
            @if ($this->enabled)
                {{ __('You have enabled two factor authentication.') }}
            @else
                {{ __('You have not enabled two factor authentication.') }}
            @endif
        </h6>

        <p class="text-muted small mt-2">
            {{ __('When two factor authentication is enabled, you will be prompted for a secure, random token during authentication. You may retrieve this token from your phone\'s Google Authenticator application.') }}
        </p>

        @if ($this->enabled)
            @if ($showingQrCode)
                <div class="mt-3">
                    <p class="fw-semibold small">
                        {{ __('Two factor authentication is now enabled. Scan the following QR code using your phone\'s authenticator application.') }}
                    </p>
                </div>

                <div class="mt-3 p-3 bg-light d-inline-block">
                    {!! $this->user->twoFactorQrCodeSvg() !!}
                </div>
            @endif

            @if ($showingRecoveryCodes)
                <div class="mt-3">
                    <p class="fw-semibold small">
                        {{ __('Store these recovery codes in a secure password manager. They can be used to recover access to your account if your two factor authentication device is lost.') }}
                    </p>
                </div>

                <div class="bg-light rounded p-3 font-monospace small mt-3">
                    @foreach (json_decode(decrypt($this->user->two_factor_recovery_codes), true) as $code)
                        <div>{{ $code }}</div>
                    @endforeach
                </div>
            @endif
        @endif

        <div class="mt-4">
            @if (! $this->enabled)
                <button type="button" class="btn btn-primary" wire:click="enableTwoFactorAuthentication" wire:loading.attr="disabled">
                    {{ __('Enable') }}
                </button>
            @else
                @if ($showingRecoveryCodes)
                    <button type="button" class="btn btn-secondary me-2" wire:click="regenerateRecoveryCodes">
                        {{ __('Regenerate Recovery Codes') }}
                    </button>
                @else
                    <button type="button" class="btn btn-secondary me-2" wire:click="showRecoveryCodes">
                        {{ __('Show Recovery Codes') }}
                    </button>
                @endif

                <button type="button" class="btn btn-danger" wire:click="disableTwoFactorAuthentication" wire:loading.attr="disabled">
                    {{ __('Disable') }}
                </button>
            @endif
        </div>
    </div>
</div>

