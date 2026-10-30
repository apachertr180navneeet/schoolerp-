<x-guest-layout>
    <div class="row justify-content-center">
        <div class="col-md-6 col-lg-5">
            <div class="card shadow">
                <div class="card-body p-4 p-md-5">
                    <div class="text-center mb-4">
                        <h4 class="fw-bold">{{ config('app.name', 'Laravel') }}</h4>
                        <p class="text-muted">{{ __('Two-Factor Authentication') }}</p>
                    </div>

                    <div x-data="{ recovery: false }">
                        <p class="text-muted mb-4" x-show="! recovery">
                            {{ __('Please confirm access to your account by entering the authentication code provided by your authenticator application.') }}
                        </p>

                        <p class="text-muted mb-4" x-show="recovery">
                            {{ __('Please confirm access to your account by entering one of your emergency recovery codes.') }}
                        </p>

                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul class="mb-0">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form method="POST" action="/two-factor-challenge">
                            @csrf

                            <div class="mb-3" x-show="! recovery">
                                <label for="code" class="form-label">{{ __('Code') }}</label>
                                <input id="code" class="form-control @error('code') is-invalid @enderror" type="text" inputmode="numeric" name="code" autofocus x-ref="code" autocomplete="one-time-code">
                                @error('code') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

                            <div class="mb-3" x-show="recovery">
                                <label for="recovery_code" class="form-label">{{ __('Recovery Code') }}</label>
                                <input id="recovery_code" class="form-control @error('recovery_code') is-invalid @enderror" type="text" name="recovery_code" x-ref="recovery_code" autocomplete="one-time-code">
                                @error('recovery_code') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

                            <div class="d-flex justify-content-between align-items-center mt-4">
                                <button type="button" class="btn btn-link text-decoration-none p-0"
                                                x-show="! recovery"
                                                x-on:click="
                                                    recovery = true;
                                                    $nextTick(() => { $refs.recovery_code.focus() })
                                                ">
                                    {{ __('Use a recovery code') }}
                                </button>

                                <button type="button" class="btn btn-link text-decoration-none p-0"
                                                x-show="recovery"
                                                x-on:click="
                                                    recovery = false;
                                                    $nextTick(() => { $refs.code.focus() })
                                                ">
                                    {{ __('Use an authentication code') }}
                                </button>

                                <button type="submit" class="btn btn-primary">
                                    {{ __('Login') }}
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>
