<div class="card shadow-sm">
    <div class="card-header bg-white">
        <h5 class="mb-0">{{ __('Update Password') }}</h5>
        <small class="text-muted">{{ __('Ensure your account is using a long, random password to stay secure.') }}</small>
    </div>
    <div class="card-body">
        <form wire:submit.prevent="updatePassword">
            <div class="mb-3">
                <label for="current_password" class="form-label">{{ __('Current Password') }}</label>
                <input id="current_password" type="password" class="form-control @error('current_password') is-invalid @enderror" wire:model.defer="state.current_password" autocomplete="current-password">
                @error('current_password') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">{{ __('New Password') }}</label>
                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" wire:model.defer="state.password" autocomplete="new-password">
                @error('password') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="mb-3">
                <label for="password_confirmation" class="form-label">{{ __('Confirm Password') }}</label>
                <input id="password_confirmation" type="password" class="form-control @error('password_confirmation') is-invalid @enderror" wire:model.defer="state.password_confirmation" autocomplete="new-password">
                @error('password_confirmation') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="d-flex align-items-center">
                <span class="text-success small me-3" id="saved-message-password" style="display: none;">{{ __('Saved.') }}</span>
                <button type="submit" class="btn btn-primary">
                    {{ __('Save') }}
                </button>
            </div>
        </form>
    </div>
</div>
