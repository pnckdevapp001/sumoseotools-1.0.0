<div>

    <!-- Validation Errors -->
    <x-auth-validation-errors class="mb-4" :errors="$errors" />
    
    <form wire:submit.prevent="onUpdateAPIKeys" class="row">

        <!-- Begin:Facebook -->
        <div class="col-12 mb-4">
            <div class="card">
                <div class="card-header bg-gradient-info">
                    <h6 class="card-title text-white mb-0">{{ __('Facebook') }} (<a href="https://docs.themeluxury.com/sumoseotools/getting-started/how-to-get-facebook-cookies/" target="_blank" class="text-white">{{ __('How to get Facebook Cookies') }}</a>)</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table settings">
                            <tr>
                                <td class="align-middle"><label for="facebook_cookies" class="form-label">{{ __('Cookies') }}</label></td>
                                <td class="align-middle">
                                    <textarea class="form-control" wire:model="facebook_cookies" rows="5"></textarea>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- End:Facebook -->

        <!-- Begin:Moz -->
        <div class="col-12 mb-4">
            <div class="card">
                <div class="card-header bg-gradient-info">
                    <h6 class="card-title text-white mb-0">{{ __('Moz') }} (<a href="https://docs.themeluxury.com/sumoseotools/getting-started/how-to-get-moz-access-id-and-secret-key/" target="_blank" class="text-white">{{ __('How to get Moz access id and secret key') }}</a>)</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table settings">
                            <tr>
                                <td class="align-middle"><label class="form-label">{{ __('Access ID') }}</label></td>
                                <td class="align-middle">
                                    <input type="text" class="form-control" wire:model="moz_access_id">
                                </td>
                            </tr>

                            <tr>
                                <td class="align-middle"><label class="form-label">{{ __('Secret Key') }}</label></td>
                                <td class="align-middle">
                                    <input type="text" class="form-control" wire:model="moz_secret_key">
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- End:Moz -->

        <div class="form-group">
            <button class="btn bg-gradient-primary float-end">
                <span>
                    <div wire:loading wire:target="onUpdateAPIKeys">
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