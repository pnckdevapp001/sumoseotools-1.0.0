<div>
    
    <form wire:submit.prevent="onEditUser({{ $this->user_id }})">
        <div class="modal-body">
            
            <!-- Validation Errors -->
            <x-auth-validation-errors class="mb-4" :errors="$errors" />

            <div class="form-group mb-3">
                <label for="fullname" class="form-label">{{ __('Full name') }}</label>
                <div class="input-group">
                    <input class="form-control @error('fullname') is-invalid @enderror" type="text" wire:model="fullname" required>
                </div>
            </div>

            <div class="form-group mb-3">
                <label for="email" class="form-label">{{ __('Email') }}</label>
                <div class="input-group">
                    <input class="form-control @error('email') is-invalid @enderror" type="text" wire:model="email" required>
                </div>
            </div>

            <div class="form-group">
                <label for="password" class="form-label">{{ __('Password') }}</label>
                <div class="input-group">
                    <input class="form-control @error('password') is-invalid @enderror" type="password" wire:model="password">
                </div>
                <span class="text-sm">{{ __('Just leave it blank in case you don\'t want to change the new password.') }}</span>
            </div>
        </div>

        <div class="modal-footer">
            <button type="submit" class="btn bg-gradient-primary">
                <span>
                    <div wire:loading wire:target="onEditUser">
                        <x-loading />
                    </div>
                    <span>{{ __('Save changes') }}</span>
                </span>
			</button>
			<button type="button" class="btn btn-link ml-auto" data-bs-dismiss="modal">{{ __('Close') }}</button>
        </div>
    </form>

</div>
