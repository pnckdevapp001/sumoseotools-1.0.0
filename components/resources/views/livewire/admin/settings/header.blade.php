<div>

    <!-- Validation Errors -->
    <x-auth-validation-errors class="mb-4" :errors="$errors" />
    
	<form wire:submit.prevent="onUpdateHeader" wire:ignore>

		<div class="card">
			<div class="card-body">
				<table class="table settings">

						<tr>
							<td class="align-middle"><label for="logo-light" class="form-label">{{ __('Logo Light') }}</label></td>
							<td class="align-middle">
								<div class="input-group">
									<span class="input-group-btn">
										<a data-input="logo-light" class="btn bg-gradient-primary mb-0 rounded-0 rounded-start logo-light">
											<i class="fa fa-picture-o"></i> {{ __('Choose') }}
										</a>
									</span>
									<input id="logo-light" class="form-control ps-2" type="text" wire:model="logo_light">
								</div>
							</td>
						</tr>

						<tr>
							<td class="align-middle"><label for="logo-dark" class="form-label">{{ __('Logo Dark') }}</label></td>
							<td class="align-middle">
								<div class="input-group">
									<span class="input-group-btn">
										<a data-input="logo-dark" class="btn bg-gradient-primary mb-0 rounded-0 rounded-start logo-dark">
											<i class="fa fa-picture-o"></i> {{ __('Choose') }}
										</a>
									</span>
									<input id="logo-dark" class="form-control ps-2" type="text" wire:model="logo_dark">
								</div>
							</td>
						</tr>

						<tr>
							<td class="align-middle"><label for="favicon" class="form-label">{{ __('Favicon') }}</label></td>
							<td class="align-middle">
								<div class="input-group">
									<span class="input-group-btn">
										<a data-input="favicon" class="btn bg-gradient-primary mb-0 rounded-0 rounded-start favicon">
											<i class="fa fa-picture-o"></i> {{ __('Choose') }}
										</a>
									</span>
									<input id="favicon" class="form-control ps-2" type="text" wire:model="favicon">
								</div>
							</td>
						</tr>

						<tr>
							<td class="align-middle"><label for="sticky-header" class="form-label">{{ __('Sticky Header') }}</label></td>
							<td class="align-middle">
								<div class="form-check form-switch">
									<input id="sticky-header" class="form-check-input" type="checkbox" wire:model="sticky_header">
								</div>
							</td>
						</tr>

				</table>
			</div>
		</div>

		<div class="form-group mt-4">
			<button class="btn bg-gradient-primary float-end">
				<span>
					<div wire:loading wire:target="onUpdateHeader">
						<x-loading />
					</div>
					<span>{{ __('Save Changes') }}</span>
				</span>
			</button>
		</div>

	</form>

</div>

<script src="{{ asset('components/public/vendor/laravel-filemanager/js/stand-alone-button.js') }}"></script>
<script>
(function( $ ) {
	"use strict";

    document.addEventListener('livewire:load', function () {

		jQuery('.logo-light, .logo-dark, .favicon').filemanager('image', {prefix: '{{ url('/') }}/filemanager'});

		jQuery('input#logo-light').change(function() { 
			window.livewire.emit('onSetLogoLight', this.value)
		});

		jQuery('input#logo-dark').change(function() { 
			window.livewire.emit('onSetLogoDark', this.value)
		});

		jQuery('input#favicon').change(function() { 
			window.livewire.emit('onSetFavicon', this.value)
		});

		window.addEventListener('alert', event => {
			toastr[event.detail.type](event.detail.message);
		});
	
    });

})( jQuery );
</script>