<div class="card shadow-sm">
    <div class="card-header bg-white">
        <h5 class="mb-0">{{ __('Browser Sessions') }}</h5>
        <small class="text-muted">{{ __('Manage and logout your active sessions on other browsers and devices.') }}</small>
    </div>
    <div class="card-body">
        <p class="text-muted small">
            {{ __('If necessary, you may logout of all of your other browser sessions across all of your devices. Some of your recent sessions are listed below; however, this list may not be exhaustive. If you feel your account has been compromised, you should also update your password.') }}
        </p>

        @if (count($this->sessions) > 0)
            <div class="mt-3">
                @foreach ($this->sessions as $session)
                    <div class="d-flex align-items-center mb-3">
                        <div class="flex-shrink-0">
                            @if ($session->agent->isDesktop())
                                <svg fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor" width="32" height="32" class="text-muted">
                                    <path d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                </svg>
                            @else
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round" width="32" height="32" class="text-muted">
                                    <path d="M0 0h24v24H0z" stroke="none"></path><rect x="7" y="4" width="10" height="16" rx="1"></rect><path d="M11 5h2M12 17v.01"></path>
                                </svg>
                            @endif
                        </div>

                        <div class="ms-3">
                            <div class="small">
                                {{ $session->agent->platform() }} - {{ $session->agent->browser() }}
                            </div>

                            <div class="text-muted" style="font-size: 0.8rem;">
                                {{ $session->ip_address }},

                                @if ($session->is_current_device)
                                    <span class="text-success fw-semibold">{{ __('This device') }}</span>
                                @else
                                    {{ __('Last active') }} {{ $session->last_active }}
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif

        <div class="d-flex align-items-center mt-3">
            <button type="button" class="btn btn-primary" wire:click="confirmLogout" wire:loading.attr="disabled">
                {{ __('Logout Other Browser Sessions') }}
            </button>

            <span class="text-success small ms-3" id="saved-message-sessions" style="display: none;">{{ __('Done.') }}</span>
        </div>

        <!-- Logout Other Devices Confirmation Modal -->
        <div class="modal fade" id="confirmLogoutModal" tabindex="-1" aria-hidden="true" wire:ignore.self>
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">{{ __('Logout Other Browser Sessions') }}</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p>{{ __('Please enter your password to confirm you would like to logout of your other browser sessions across all of your devices.') }}</p>

                        <div x-data="{}" x-on:confirming-logout-other-browser-sessions.window="setTimeout(() => $refs.password.focus(), 250)">
                            <input type="password" class="form-control @error('password') is-invalid @enderror" placeholder="{{ __('Password') }}"
                                        x-ref="password"
                                        wire:model.defer="password"
                                        wire:keydown.enter="logoutOtherBrowserSessions" />
                            @error('password') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" wire:click="$toggle('confirmingLogout')" data-bs-dismiss="modal">
                            {{ __('Nevermind') }}
                        </button>
                        <button type="button" class="btn btn-primary" wire:click="logoutOtherBrowserSessions" wire:loading.attr="disabled">
                            {{ __('Logout Other Browser Sessions') }}
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
