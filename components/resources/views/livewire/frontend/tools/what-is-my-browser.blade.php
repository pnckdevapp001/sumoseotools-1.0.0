<div>

    @php

        $preview = new \Jenssegers\Agent\Agent;

    @endphp

      <form wire:submit.prevent="onWhatIsMyBrowser">

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
                        <td class="bg-gradient-success text-white">{{ __('Your Browser') }}</td>
                        <td>{{ $preview->browser() }}</td>
                    </tr>
                    <tr>
                        <td class="bg-gradient-success text-white">{{ __('Browser Version') }}</td>
                        <td>{{ $preview->version( $preview->browser() ) }}</td>
                    </tr>

                    @if ( !empty($data) )
                        <tr>
                            <td class="bg-gradient-success text-white">{{ __('Your User Agent') }}</td>
                            <td>{{ $data['user_agent'] }}</td>
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
                <div wire:loading.inline wire:target="onWhatIsMyBrowser">
                  <x-loading />
                </div>
                <span wire:target="onWhatIsMyBrowser">{{ __('Show More Details') }}</span>
              </span>
            </button>
        </div>

      </form>
</div>