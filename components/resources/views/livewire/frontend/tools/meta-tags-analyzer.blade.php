<div>

      <form wire:submit.prevent="onMetaTagsAnalyzer">

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
            </div>

            <div class="col-auto">
                <div class="form-group">
                    <button class="btn bg-gradient-info mx-auto d-block" wire:loading.attr="disabled">
                        <span>
                            <div wire:loading.inline wire:target="onMetaTagsAnalyzer">
                                <x-loading />
                            </div>
                            <span wire:target="onMetaTagsAnalyzer">{{ __('Analyze') }}</span>
                        </span>
                    </button>
                </div>
            </div>
        </div>

        @if ( !empty($data) )
            <div class="table-responsive">
                <table class="table table-hover table-bordered table-striped">
                    <thead class="bg-gradient-success">
                        <tr>
                            <th colspan="2" class="text-center text-white h6">{{ __('Meta Tags Analysis') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{ __('Meta title') }}</td>
                            <td>{{ !empty($data['title']) ? $data['title'] : __('Not found') }}</td>
                        </tr>
                        <tr>
                            <td>{{ __('Meta description') }}</td>
                            <td>{{ !empty($data['description']) ? $data['description'] : __('Not found') }}</td>
                        </tr>
                        <tr>
                            <td>{{ __('Meta keyword') }}</td>
                            <td>{{ !empty($data['keywords']) ? $data['keywords'] : __('Not found') }}</td>
                        </tr>
                        <tr>
                            <td>{{ __('Meta viewport') }}</td>
                            <td>{{ !empty($data['viewport']) ? $data['viewport'] : __('Not found') }}</td>
                        </tr>
                        <tr>
                            <td>{{ __('Meta robots') }}</td>
                            <td>{{ !empty($data['robots']) ? $data['robots'] : __('Not found') }}</td>
                        </tr>
                        <tr>
                            <td>{{ __('Meta author') }}</td>
                            <td>{{ !empty($data['author']) ? $data['author'] : __('Not found') }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        @endif

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
        });

  })( jQuery );
</script>