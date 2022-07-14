<div>
    <form wire:submit.prevent="onAddRedirect">
        <div class="modal-body">
            <!-- Validation Errors -->
            <x-auth-validation-errors class="mb-4" :errors="$errors" />

            <div class="form-group mb-3">
                <label for="old_slug" class="form-label">{{ __('Old Slug') }}</label>
                <input class="form-control" type="text" id="old_slug" wire:model="old_slug">
            </div>

            <div class="form-group">
                <label for="new_slug" class="form-label">{{ __('New Slug or URL') }}</label>
                <input class="form-control" type="text" id="new_slug" wire:model="new_slug">
            </div>
        </div>

        <div class="modal-footer">
            <button type="submit" class="btn bg-gradient-primary">
                <span>
                    <div wire:loading wire:target="onAddRedirect">
                        <x-loading />
                    </div>
                    <span>{{ __('Create') }}</span>
                </span>
            </button>
			<button type="button" class="btn btn-link ml-auto" data-bs-dismiss="modal">{{ __('Close') }}</button>
        </div>
    </form>

</div>
