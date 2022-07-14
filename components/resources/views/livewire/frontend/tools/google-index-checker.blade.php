<div>

      <form wire:submit.prevent="onGoogleIndexChecker">

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
                            <div wire:loading.inline wire:target="onGoogleIndexChecker">
                                <x-loading />
                            </div>
                            <span wire:target="onGoogleIndexChecker">{{ __('Check') }}</span>
                        </span>
                    </button>
                </div>
            </div>
        </div>

        @if ( !empty($data) )

            <div class="table-responsive">
                <table class="table table-bordered table-hover border">
                   <thead class="bg-gradient-success text-white">
                       <tr>
                           <th>{{ __('URLs') }}</th>
                           <th>{{ __('Status') }}</th>
                       </tr>
                   </thead>
                   <tbody>
                           <tr>
                               <td class="border">{{ $data['link'] }}</td>
                               <td class="border">
                                    <span class="text-{{ ( $data['status'] == 200 ) ? 'success' :  'danger' }} text-bold">{{ ( $data['status'] == 200 ) ? __('Indexed') :  __('Not Indexed') }}</span>
                                </td>
                           </tr>
                   </tbody>
                </table>
            </div>

        @endif

      </form>
</div>