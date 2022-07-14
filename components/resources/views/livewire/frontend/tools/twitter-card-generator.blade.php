<div>

    <form wire:submit.prevent="onTwitterCardGenerator">
        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />
                                    
        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <div class="form-group">
            <label class="form-label">{{ __('Select type') }}</label>
            <select wire:model="type" class="form-control">
                <option value="app">{{ __('App') }}</option>
                <option value="player">{{ __('Player') }}</option>
                <option value="product">{{ __('Product') }}</option>
                <option value="summary">{{ __('Summary') }}</option>
                <option value="summary_large_image">{{ __('Summary With Large Image') }}</option>
            </select>
        </div>
   
        <div class="form-group">
            <label class="form-label">{{ __('Site Username') }}</label>
            <input type="text" class="form-control" wire:model="site_username"/>
        </div>

        <div class="form-group">
            <label class="form-label">{{ __('App Name') }}</label>
            <input type="text" class="form-control" wire:model="app_name"/>
        </div>

        <div class="form-group">
            <label class="form-label">{{ __('iPhone App ID') }}</label>
            <input type="text" class="form-control" wire:model="iphone_app_id"/>
        </div>

        <div class="form-group">
            <label class="form-label">{{ __('iPad App ID') }}</label>
            <input type="text" class="form-control" wire:model="ipad_app_id"/>
        </div>

        <div class="form-group">
            <label class="form-label">{{ __('Google Play App ID') }}</label>
            <input type="text" class="form-control" wire:model="google_play_app_id"/>
        </div>

        <div class="form-group">
            <label class="form-label">{{ __('App Country (If Not Available in US Store)') }}</label>
            <input type="text" class="form-control" wire:model="app_country"/>
        </div>

        <div class="form-group">
          <label class="form-label col-3 col-form-label">{{ __('Number of Images') }}</label>
          <div class="col">
            <div class="col mb-3">
                <div class="input-group input-group-flat">
                    <input type="text" class="form-control" wire:model="images.0">
                    @error('images.0') <span class="error">{{ $message }}</span> @enderror
                    <span class="input-group-text bg-white">
                        <button class="btn btn-sm btn-icon bg-gradient-success mb-0" wire:click.prevent="onAddImage( {{ $i }} )" title="{{ __('Add new') }}">
                            <i class="fas fa-plus fa-fw "></i>
                        </button>
                    </span>
                </div>
            </div>

            @foreach($inputs as $key => $value)
                <div class="col mb-3">
                    <div class="input-group input-group-flat">
                        <input type="text" class="form-control" wire:model="images.{{ $value }}">
                        @error( 'images.' . $value ) <span class="error">{{ $message }}</span> @enderror
                        <span class="input-group-text bg-white">
                            <button class="btn btn-sm btn-icon bg-gradient-danger mb-0" wire:click.prevent="onDeleteImage({{ $key }})" title="{{ __('Delete') }}">
                                <i class="fas fa-trash fa-fw "></i>
                            </button>
                        </span>
                    </div>
                </div>
            @endforeach
          </div>
        </div>

        <div class="form-group">
            <label class="form-label">{{ __('Description') }}</label>
            <textarea maxlength="200" wire:model="description" rows="5" placeholder="{{ __('Up to 200 characters.') }}" class="form-control"></textarea>
        </div>

        <div class="form-group">
            <button class="btn bg-gradient-info mx-auto d-block" id="create" wire:loading.attr="disabled">
                <span>
                    <div wire:loading.inline wire:target="onTwitterCardGenerator">
                        <x-loading />
                    </div>
                    <span wire:target="onTwitterCardGenerator">{{ __('Generate') }}</span>
                </span>
            </button>
        </div>

        @if ( !empty($data) )
          <div class="form-group position-relative mb-3">
              <textarea id="text" class="form-control" rows="10" readonly>{{ $data }}</textarea>
              <a value="copy" onclick="copyToClipboard()" class="btn bg-gradient-success btn-icon btn-icon-only cursor-pointer position-absolute top-0 end-0 m-2" title="{{ __('Copy') }}" data-bs-toggle="tooltip" data-bs-original-title="{{ __('Copy') }}">
                  <i class="fas fa-copy"></i>
              </a>
          </div>
        @endif
    </form>
</div>