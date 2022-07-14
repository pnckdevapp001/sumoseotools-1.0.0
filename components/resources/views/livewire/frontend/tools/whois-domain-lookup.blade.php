<div>

      <form wire:submit.prevent="onWhoisDomainLookup">

        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />
                                    
        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <div class="row">
            <label class="form-label">{{ __('Enter a domain name') }}</label>
            <div class="col">
                <div class="input-group input-group-flat">
                    <input type="text" class="form-control" wire:model="link" placeholder="google.com" required />
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
                            <div wire:loading.inline wire:target="onWhoisDomainLookup">
                                <x-loading />
                            </div>
                            <span wire:target="onWhoisDomainLookup">{{ __('Lookup') }}</span>
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
                            <th class="text-center text-white h6" colspan="2">{{ __('Whois Data') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="bg-gradient-success text-white">{{ __('Domain Name') }}</td>
                            <td>{{ $data['domainName'] }}</td>
                        </tr>

                            @if( $data['registrar'] )
                            <tr>
                                <td class="bg-gradient-success text-white">{{ __('Registrar') }}</td>
                                <td>{{ $data['registrar'] }}</td>
                            </tr>
                        @endif

                        @if( $data['owner'] )
                            <tr>
                                <td class="bg-gradient-success text-white">{{ __('Owner') }}</td>
                                <td>{{ $data['owner'] }}</td>
                            </tr>
                        @endif

                        <tr>
                            <td class="bg-gradient-success text-white">{{ __('Creation Date') }}</td>
                            <td>{{ date("Y-m-d H:i:s", $data['creationDate']) }}</td>
                        </tr>

                        <tr>
                            <td class="bg-gradient-success text-white">{{ __('Expiration Date') }}</td>
                            <td>{{ date("Y-m-d H:i:s", $data['expirationDate']) }}</td>
                        </tr>

                        <tr>
                            <td class="bg-gradient-success text-white">{{ __('Updated Date') }}</td>
                            <td>{{ date("Y-m-d H:i:s", $data['updatedDate']) }}</td>
                        </tr>

                        @if( $data['nameServers'] )
                            <tr>
                                <td class="bg-gradient-success text-white">{{ __('Name Servers') }}</td>
                                <td>
                                    @foreach($data['nameServers'] as $value)
                                        <p>{{ $value }}</p>
                                    @endforeach
                                </td>
                            </tr>
                        @endif

                        @if( $data['whoisServer'] )
                            <tr>
                                <td class="bg-gradient-success text-white">{{ __('Whois Server') }}</td>
                                <td>{{ $data['whoisServer'] }}</td>
                            </tr>
                        @endif

                        @if( $data['dnssec'] )
                            <tr>
                                <td class="bg-gradient-success text-white">{{ __('DNSSEC') }}</td>
                                <td>{{ $data['dnssec'] }}</td>
                            </tr>
                        @endif

                        @if( $data['states'] )
                            <tr>
                                <td class="bg-gradient-success text-white">{{ __('States') }}</td>
                                <td>
                                    @foreach($data['states'] as $value)
                                        <p>{{ $value }}</p>
                                    @endforeach
                                </td>
                            </tr>
                        @endif
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