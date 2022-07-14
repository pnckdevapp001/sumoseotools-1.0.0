<div>
    <form wire:submit.prevent="onAddTranslation">
        <div class="modal-body">
            <!-- Validation Errors -->
            <x-auth-validation-errors class="mb-4" :errors="$errors" />
        
            <div class="form-group mb-3">
                <label for="key" class="form-label">{{ __('Translation Key') }}</label>
                <input class="form-control @error('key') is-invalid @enderror" type="text" id="key" wire:model="key" required>
                <small class="form-hint">{{ __('Word or sentence you want to translate.') }}</small>
            </div>

            <div class="form-group">
                <label for="value" class="form-label">{{ __('Translation Value') }}</label>
                <input class="form-control @error('value') is-invalid @enderror" type="text" id="value" wire:model="value" required>
                <small class="form-hint">{{ __('What word or sentence should be translated to.') }}</small>
            </div>
        </div>

        <div class="modal-footer">
            <button type="submit" class="btn bg-gradient-primary">
                <span>
                    <div wire:loading wire:target="onAddTranslation">
                        <x-loading />
                    </div>
                    <span>{{ __('Add new') }}</span>
                </span>
            </button>
			<button type="button" class="btn btn-link ml-auto" data-bs-dismiss="modal">{{ __('Close') }}</button>
        </div>
    </form>
</div>
