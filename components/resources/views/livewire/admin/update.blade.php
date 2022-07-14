<div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />
                                
    <!-- Validation Errors -->
    <x-auth-validation-errors class="mb-4" :errors="$errors" />
    
    <form wire:submit.prevent="onUpdateDatabase" class="row">

        <!-- Begin:Update -->
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <p>{{ __('Click the button below to update the database to the latest version!') }}</p>
                    <div class="form-group mb-0">
                        <button class="btn bg-gradient-primary">
                            <span>
                                <div wire:loading wire:target="onUpdateDatabase">
                                    <x-loading />
                                </div>
                                <span>{{ __('Update now') }}</span>
                            </span>
                        </button>
                    </div>

                </div>
            </div>
        </div>
        <!-- End:Update -->

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
