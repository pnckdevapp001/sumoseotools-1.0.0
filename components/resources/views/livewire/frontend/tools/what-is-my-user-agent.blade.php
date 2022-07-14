<div>

      <form wire:submit.prevent="onWhatIsMyUserAgent">

        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />
                                    
        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <div class="table-responsive">

            <table class="table table-hover table-bordered table-striped border">
                <thead class="bg-gradient-success">
                    <tr>
                        <th colspan="2" class="text-center text-white h6">{{ __('Results') }}</th>
                    </tr>
                </thead>
                <tbody>

                        <tr>
                            <td class="bg-gradient-success text-white">{{ __('Your User Agent') }}</td>
                            <td>{{ $_SERVER['HTTP_USER_AGENT'] }}</td>
                        </tr>

                        @if ( !empty($data) )
                            <tr>
                                <td class="bg-gradient-success text-white">{{ __('Your Browser') }}</td>
                                <td>{{ $data['browser'] }}</td>
                            </tr>

                            <tr>
                                <td class="bg-gradient-success text-white">{{ __('Browser Version') }}</td>
                                <td>{{ $data['browser_version'] }}</td>
                            </tr>

                            <tr>
                                <td class="bg-gradient-success text-white">{{ __('Operating System') }}</td>
                                <td>{{ $data['os']  . ' ' . $data['os_version']}}</td>
                            </tr>

                            <tr>
                                <td class="bg-gradient-success text-white">{{ __('Languages') }}</td>
                                <td>{{ $data['languages'] }}</td>
                            </tr>
                        @endif

                </tbody>
            </table>
        </div>

        <div class="form-group my-3">
            <button class="btn bg-gradient-info d-block mx-auto" wire:loading.attr="disabled">
              <span>
                <div wire:loading.inline wire:target="onWhatIsMyUserAgent">
                  <x-loading />
                </div>
                <span wire:target="onWhatIsMyUserAgent">{{ __('Show More Details') }}</span>
              </span>
            </button>
        </div>

      </form>
</div>