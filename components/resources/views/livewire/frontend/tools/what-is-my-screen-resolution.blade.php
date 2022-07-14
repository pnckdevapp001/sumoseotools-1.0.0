<div>

      <form wire:submit.prevent="onSetScreenResolution">

        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />
                                    
        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <div class="table-responsive">

            <table class="table table-hover table-bordered border">
                <thead class="bg-gradient-success">
                    <tr>
                        <th colspan="2" class="text-center text-white h6">{{ __('Results') }}</th>
                    </tr>
                </thead>
                <tbody>
                        <tr>
                            <td class="bg-gradient-success text-white">{{ __('Your Screen Resolution') }}</td>
                            <td><span id="resolution" wire:ignore></span></td>
                        </tr>

                        @if ( !empty($data) )

                            <tr>
                                <td class="bg-gradient-success text-white">{{ __('Screen Width') }}</td>
                                <td>{{ $data['width'] }} {{ __('Pixels') }}</td>
                            </tr>

                            <tr>
                                <td class="bg-gradient-success text-white">{{ __('Screen Height') }}</td>
                                <td>{{ $data['height'] }} {{ __('Pixels') }}</td>
                            </tr>

                            <tr>
                                <td class="bg-gradient-success text-white">{{ __('DPR (Device Pixel Ratio)') }}</td>
                                <td>{{ $data['dpr'] }}</td>
                            </tr>

                            <tr>
                                <td class="bg-gradient-success text-white">{{ __('Color depth') }}</td>
                                <td>{{ $data['color'] }} {{ __('bits per pixel') }}</td>
                            </tr>

                            <tr>
                                <td class="bg-gradient-success text-white">{{ __('Browser Viewport Width') }}</td>
                                <td>{{ $data['viewport_width'] }} {{ __('Pixels') }}</td>
                            </tr>

                            <tr>
                                <td class="bg-gradient-success text-white">{{ __('Browser Viewport Height') }}</td>
                                <td>{{ $data['viewport_height'] }} {{ __('Pixels') }}</td>
                            </tr>

                        @endif
                </tbody>
            </table>
        </div>

        <div class="form-group my-3">
            <button class="btn bg-gradient-info d-block mx-auto" wire:loading.attr="disabled">
              <span>
                <div wire:loading.inline wire:target="onSetScreenResolution">
                  <x-loading />
                </div>
                <span wire:target="onSetScreenResolution">{{ __('Show More Details') }}</span>
              </span>
            </button>
        </div>

      </form>
</div>

<script>
(function( $ ) {
  "use strict";

    document.addEventListener('livewire:load', function () {

          jQuery('#resolution').text(screen.width + 'x' + screen.height);

            var viewport_width = window.innerWidth || document.documentElement.clientWidth || document.body.clientWidth;
            var viewport_height = window.innerHeight || document.documentElement.clientHeight || document.body.clientHeight;

            window.addEventListener('onSetScreenResolution', event => {
                window.livewire.emit('onWhatIsMyScreenResolution', screen.width, screen.height, window.devicePixelRatio, screen.colorDepth, viewport_width, viewport_height)
            });
    });

})( jQuery );
</script>