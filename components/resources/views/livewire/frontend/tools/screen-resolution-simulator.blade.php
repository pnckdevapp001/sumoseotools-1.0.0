<div>

      <form wire:submit.prevent="onScreenResolutionSimulator">

        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />
                                    
        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <div class="row">
            <label class="form-label">{{ __('Enter a website URL') }}</label>
            <div class="col">
                <div class="input-group input-group-flat">
                    <input type="text" class="form-control" wire:model="link" placeholder="https://..." required />
                    <span class="input-group-text {{ ( Cookie::get('theme_mode') == 'theme-light' ) ? 'bg-white' : '' }}">
                        <a id="paste" class="link-secondary cursor-pointer" title="{{ __('Paste') }}" data-bs-toggle="tooltip" data-bs-original-title="{{ __('Paste') }}">
                            <i class="far fa-clipboard fa-fw {{ ( Cookie::get('theme_mode') == 'theme-dark') ? 'text-dark' : '' }}"></i>
                        </a>
                    </span>
                </div>

                <div class="form-group mt-3">
                    <h6 class="d-block w-100">{{ __('Select Screen Resolution:') }}</h6>
                    <div class="form-check">
                      <input class="form-check-input" type="radio" name="type" id="160x160" value="160x160" wire:model="resolution">
                      <label class="form-check-label" for="160x160">{{ __('160x160') }} {{ __('Pixels') }}</label>
                    </div>

                    <div class="form-check">
                      <input class="form-check-input" type="radio" name="type" id="320x320" value="320x320" wire:model="resolution">
                      <label class="form-check-label" for="320x320">{{ __('320x320') }} {{ __('Pixels') }}</label>
                    </div>

                    <div class="form-check">
                      <input class="form-check-input" type="radio" name="type" id="640x480" value="640x480" wire:model="resolution">
                      <label class="form-check-label" for="640x480">{{ __('640x480') }} {{ __('Pixels') }}</label>
                    </div>

                    <div class="form-check">
                      <input class="form-check-input" type="radio" name="type" id="800x600" value="800x600" wire:model="resolution">
                      <label class="form-check-label" for="800x600">{{ __('800x600') }} {{ __('Pixels') }}</label>
                    </div>

                    <div class="form-check">
                      <input class="form-check-input" type="radio" name="type" id="1024x768" value="1024x768" wire:model="resolution">
                      <label class="form-check-label" for="1024x768">{{ __('1024x768') }} {{ __('Pixels') }}</label>
                    </div>

                    <div class="form-check">
                      <input class="form-check-input" type="radio" name="type" id="1152x864" value="1152x864" wire:model="resolution">
                      <label class="form-check-label" for="1152x864">{{ __('1152x864') }} {{ __('Pixels') }}</label>
                    </div>

                    <div class="form-check">
                      <input class="form-check-input" type="radio" name="type" id="1280x720" value="1280x720" wire:model="resolution">
                      <label class="form-check-label" for="1280x720">{{ __('1280x720') }} {{ __('Pixels') }}</label>
                    </div>

                    <div class="form-check">
                      <input class="form-check-input" type="radio" name="type" id="1366x768" value="1366x768" wire:model="resolution">
                      <label class="form-check-label" for="1366x768">{{ __('1366x768') }} {{ __('Pixels') }}</label>
                    </div>

                    <div class="form-check">
                      <input class="form-check-input" type="radio" name="type" id="1600x1200" value="1600x1200" wire:model="resolution">
                      <label class="form-check-label" for="1600x1200">{{ __('1600x1200') }} {{ __('Pixels') }}</label>
                    </div>

                    <div class="form-check">
                      <input class="form-check-input" type="radio" name="type" id="1920x1080" value="1920x1080" wire:model="resolution">
                      <label class="form-check-label" for="1920x1080">{{ __('1920x1080') }} {{ __('Pixels') }}</label>
                    </div>

                </div>
            </div>

            <div class="col-auto">
                <div class="form-group">
                    <button class="btn bg-gradient-info mx-auto d-block" wire:loading.attr="disabled">
                        <span>
                            <div wire:loading.inline wire:target="onScreenResolutionSimulator">
                                <x-loading />
                            </div>
                            <span wire:target="onScreenResolutionSimulator">{{ __('Simulate') }}</span>
                        </span>
                    </button>
                </div>
            </div>
        </div>

      </form>
</div>

<script>
   (function( $ ) {
      "use strict";

        document.addEventListener('livewire:load', function () {

              var el = document.getElementById('paste');

              if(el){

                el.addEventListener('click', function(paste) {

                    paste = document.getElementById('paste');

                    '<svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"> <path stroke="none" d="M0 0h24v24H0z" fill="none"></path> <line x1="4" y1="7" x2="20" y2="7"></line> <line x1="10" y1="11" x2="10" y2="17"></line> <line x1="14" y1="11" x2="14" y2="17"></line> <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12"></path> <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3"></path> </svg>' === paste.innerHTML ? (link.value = "", paste.innerHTML = '<svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M9 5h-2a2 2 0 0 0 -2 2v12a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-12a2 2 0 0 0 -2 -2h-2"></path><rect x="9" y="3" width="6" height="4" rx="2"></rect></svg>') : navigator.clipboard.readText().then(function(clipText) {

                        @this.set('link', clipText);

                    }, paste.innerHTML = '<svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"> <path stroke="none" d="M0 0h24v24H0z" fill="none"></path> <line x1="4" y1="7" x2="20" y2="7"></line> <line x1="10" y1="11" x2="10" y2="17"></line> <line x1="14" y1="11" x2="14" y2="17"></line> <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12"></path> <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3"></path> </svg>');

                });
              }

            window.addEventListener('onSetScreenResolution', event => {
                window.open(event.detail.link, event.detail.resolution,'toolbar=no,status=yes,scrollbars=yes,location=yes,menubar=no,directories=yes,width='+event.detail.width+',height='+event.detail.height);  
            });
        });

  })( jQuery );
</script>