<div>

    <form wire:submit.prevent="onAddLanguage">

        <div class="modal-body">
            <!-- Validation Errors -->
            <x-auth-validation-errors class="mb-4" :errors="$errors" />
            
            @php

                $languages = json_decode($languages, true);

            @endphp
        
            <div class="form-group mb-3">
                <label for="name" class="form-label">{{ __('Name') }}</label>
                <input class="form-control" type="text" id="name" wire:model="name">
            </div>

            <div class="form-group" wire:ignore>
                <label for="name" class="form-label">{{ __('Language') }}</label>
                <select id="lang_code" class="form-control" wire:model="code">
                    <optgroup label="{{ __('Languages') }}">
                        @foreach ($languages as $key => $value)
                            <option value="{{ $key }}">{{ $value['name'] }}</option>
                        @endforeach
                    </optgroup>
                </select>
			</div>
        </div>

        <div class="modal-footer">
            <button type="submit" class="btn bg-gradient-primary">
                <span>
                    <div wire:loading wire:target="onAddLanguage">
                        <x-loading />
                    </div>
                    <span>{{ __('Add new') }}</span>
                </span>
            </button>
			<button type="button" class="btn btn-link ml-auto" data-bs-dismiss="modal">{{ __('Close') }}</button>
        </div>
    </form>

</div>

<script>
(function( $ ) {
    "use strict";

    jQuery(document).ready(function(){

        const lang_code = new Choices( document.querySelector('#lang_code') );

        jQuery('#lang_code').on('change', function (e) {
            var lang_data = jQuery(this).find(":selected").val();
            @this.set('code', lang_data);
        });

    });

})( jQuery );
</script>
