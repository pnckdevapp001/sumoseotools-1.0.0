<div>

    <!-- Validation Errors -->
    <x-auth-validation-errors class="mb-4" :errors="$errors" />
    
    <form wire:submit.prevent="onUpdateCaptcha" class="row">

        <!-- Begin:reCAPTCHA v3 -->
        <div class="col-12 mb-4">
            <div class="card">
                <div class="card-header bg-gradient-info">
                    <h6 class="card-title text-white mb-0">{{ __('reCAPTCHA v3') }} (<a href="https://docs.themeluxury.com/sumowebtools/getting-started/how-to-get-google-recaptcha-v3-keys/" target="_blank" class="text-white">{{ __('How to get Google reCAPTCHA v3 Keys') }}</a>)</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table settings">
                            <tr>
                                <td class="align-middle w-25"><label for="status" class="form-label">{{ __('Status') }}</label></td>
                                <td class="align-middle">
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" wire:model="status">
                                    </div>
                                </td>
                            </tr>

                            @if ( $status == true)
                                <tr>
                                    <td class="align-middle"><label for="username" class="form-label">{{ __('Site Key') }}</label></td>
                                    <td class="align-middle">
                                        <input type="text" class="form-control" wire:model="site_key">
                                    </td>
                                </tr>

                                <tr>
                                    <td class="align-middle"><label for="password" class="form-label">{{ __('Secret Key') }}</label></td>
                                    <td class="align-middle">
                                        <input type="text" class="form-control" wire:model="secret_key">
                                    </td>
                                </tr>
                            @endif

                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- End:reCAPTCHA v3 -->

        <div class="form-group">
            <button class="btn bg-gradient-primary float-end">
                <span>
                    <div wire:loading wire:target="onUpdateCaptcha">
                        <x-loading />
                    </div>
                    <span>{{ __('Save Changes') }}</span>
                </span>
            </button>
        </div>

    </form>

</div>

<script>
(function( $ ) {
    "use strict";
    
    document.addEventListener('livewire:load', function () {
    
        window.addEventListener('alert', event => {
            toastr[event.detail.type](event.detail.message);
        });
        
    });

})( jQuery );
</script>
