<div>

    <!-- Validation Errors -->
    <x-auth-validation-errors class="mb-4" :errors="$errors" />
                    
    <div class="row">
        <div class="col-12">

	        <!-- begin:Add new footer translations -->
	        <div class="dropdown mb-3">
	          <a class="btn bg-gradient-primary dropdown-toggle " data-bs-toggle="dropdown" id="navbarDropdownMenuLang">
	             {{ __('Add New Translations') }}
	          </a>
	          <ul class="dropdown-menu px-2 mt-5" aria-labelledby="navbarDropdownMenuLang">
	             @foreach(localization()->getSupportedLocales() as $localeCode => $properties)
	                  <li class="mb-2">
	                      <a class="dropdown-item border-radius-md" href="{{ localization()->getLocalizedURL($properties->key(), route('create-footer-translations'), [], true) }}">
	                        <img src="{{ asset('assets/img/flags/' . $properties->key() . '.svg') }}" class="lang-menu me-1 my-auto"> {{ $properties->native() }}
	                      </a>
	                  </li>
	              @endforeach
	          </ul>
	        </div>
	        <!-- begin:Add new footer translations -->

            <div class="card">
              <div class="card-body">
	            	<div class="table-responsive">
	            		<table class="table settings">
	                        <tbody>
	            				<tr>
	            					<th>{{ __('Language') }}</th>
	            					<th>{{ __('Action') }}</th>
	            				</tr>

	                            @if ( $footer_translations->isNotEmpty() )

	                                @foreach ($footer_translations as $footer_translation)

	                                    <tr>
	                                        <td class="align-middle py-3">
	                                        	<img src="{{ asset('assets/img/flags/' . $footer_translation->locale . '.svg') }}" class="lang-menu mx-auto me-1"> 
	                                        	<span>{{ localization()->getSupportedLocales()[$footer_translation->locale]->native() }}</span>
	                                        </td>
	                                        <td class="align-middle w-25">
	                                            <a href="{{ localization()->getLocalizedURL($footer_translation->locale, route('edit-footer-translations', $footer_translation->id), [], true) }}" class="btn bg-gradient-info" title="{{ __('Edit') }}"><i class="fas fa-edit icon"></i> {{ __('Edit') }}</a>
	                                            <a wire:click="onDeleteConfirmFooterTranslation( {{ $footer_translation->id }} )" class="btn bg-gradient-danger" title="{{ __('Delete') }}"><i class="fas fa-trash icon"></i> {{ __('Delete') }}</a>
	                                        </td>
	                                    </tr>

	                                @endforeach

	                            @else

	                                <tr>
	                                    <td class="align-middle">{{ __('No record found') }}</td>
	                                </tr>
									
	                            @endif

	                        </tbody>

	            		</table>
	            	</div>

					<div class="float-end">
						<!-- begin:pagination -->
						{{ $footer_translations->links() }}
						<!-- begin:pagination -->
					</div>
				</div>
            </div>
        </div>

    </div>

</div>
<script>
(function( $ ) {
    "use strict";
	
	document.addEventListener('livewire:load', function () {
		
		window.addEventListener('swal:modal', event => {

			const swalWithBootstrapButtons = Swal.mixin({
			  customClass: {
				confirmButton: 'btn bg-gradient-success',
				cancelButton: 'btn bg-gradient-danger'
			  },
			  buttonsStyling: false
			})

			swalWithBootstrapButtons.fire({
			  title: event.detail.title,
			  text: event.detail.text,
			  icon: event.detail.type,
			  showCancelButton: true,
			  confirmButtonText: "{{ __('Yes, delete it!') }}",
			  cancelButtonText: "{{ __('Cancel') }}"
			}).then((result) => {
			  if (result.isConfirmed) {
				window.livewire.emit('onDeleteFooterTranslation', event.detail.id)
			  }
			});

		});

		window.addEventListener('alert', event => {
			toastr[event.detail.type](event.detail.message);
		});

	});

})( jQuery );
</script>