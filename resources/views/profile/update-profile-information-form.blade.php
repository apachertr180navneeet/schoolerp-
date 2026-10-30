<div class="card shadow-sm">
    <div class="card-header bg-white">
        <h5 class="mb-0">{{ __('Profile Information') }}</h5>
        <small class="text-muted">{{ __('Update your account\'s profile information and email address.') }}</small>
    </div>
    <div class="card-body">
        <form wire:submit.prevent="updateProfileInformation">
            <!-- Profile Photo -->
            @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                <div x-data="{photoName: null, photoPreview: null}" class="mb-3">
                    <input type="file" class="d-none"
                                wire:model="photo"
                                x-ref="photo"
                                x-on:change="
                                        photoName = $refs.photo.files[0].name;
                                        const reader = new FileReader();
                                        reader.onload = (e) => {
                                            photoPreview = e.target.result;
                                        };
                                        reader.readAsDataURL($refs.photo.files[0]);
                                " />

                    <label class="form-label">{{ __('Photo') }}</label>

                    <div class="mt-2" x-show="! photoPreview">
                        <img src="{{ $this->user->profile_photo_url }}" alt="{{ $this->user->name }}" class="rounded-circle" width="80" height="80" style="object-fit: cover;">
                    </div>

                    <div class="mt-2" x-show="photoPreview" style="display: none;">
                        <span class="d-block rounded-circle" style="width: 80px; height: 80px; background-size: cover; background-repeat: no-repeat; background-position: center center;"
                              x-bind:style="'background-size: cover; background-repeat: no-repeat; background-position: center center; background-image: url(\'' + photoPreview + '\');'">
                        </span>
                    </div>

                    <button class="btn btn-secondary btn-sm mt-2 me-2" type="button" x-on:click.prevent="$refs.photo.click()">
                        {{ __('Select A New Photo') }}
                    </button>

                    @if ($this->user->profile_photo_path)
                        <button class="btn btn-secondary btn-sm mt-2" type="button" wire:click="deleteProfilePhoto">
                            {{ __('Remove Photo') }}
                        </button>
                    @endif

                    @error('photo') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                </div>
            @endif

            <div class="mb-3">
                <label for="name" class="form-label">{{ __('Name') }}</label>
                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" wire:model.defer="state.name" autocomplete="name">
                @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">{{ __('Email') }}</label>
                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" wire:model.defer="state.email">
                @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="d-flex align-items-center">
                <span class="text-success small me-3" id="saved-message" style="display: none;">{{ __('Saved.') }}</span>
                <button type="submit" class="btn btn-primary" wire:loading.attr="disabled" wire:target="photo">
                    {{ __('Save') }}
                </button>
            </div>
        </form>
    </div>
</div>
