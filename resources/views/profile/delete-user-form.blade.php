<div class="card shadow-sm">
    <div class="card-header bg-white">
        <h5 class="mb-0 text-danger">{{ __('Delete Account') }}</h5>
        <small class="text-muted">{{ __('Permanently delete your account.') }}</small>
    </div>
    <div class="card-body">
        <p class="text-muted small">
            {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.') }}
        </p>

        <div class="mt-3">
            <button type="button" class="btn btn-danger" wire:click="confirmUserDeletion" wire:loading.attr="disabled">
                {{ __('Delete Account') }}
            </button>
        </div>

        <!-- Delete User Confirmation Modal -->
        <div class="modal fade" id="confirmUserDeletionModal" tabindex="-1" aria-hidden="true" wire:ignore.self>
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">{{ __('Delete Account') }}</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p>{{ __('Are you sure you want to delete your account? Once your account is deleted, all of its resources and data will be permanently deleted. Please enter your password to confirm you would like to permanently delete your account.') }}</p>

                        <div x-data="{}" x-on:confirming-delete-user.window="setTimeout(() => $refs.password.focus(), 250)">
                            <input type="password" class="form-control @error('password') is-invalid @enderror" placeholder="{{ __('Password') }}"
                                        x-ref="password"
                                        wire:model.defer="password"
                                        wire:keydown.enter="deleteUser" />
                            @error('password') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" wire:click="$toggle('confirmingUserDeletion')" data-bs-dismiss="modal">
                            {{ __('Nevermind') }}
                        </button>
                        <button type="button" class="btn btn-danger" wire:click="deleteUser" wire:loading.attr="disabled">
                            {{ __('Delete Account') }}
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
