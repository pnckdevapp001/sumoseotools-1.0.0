<div>

        <!-- begin:Add new page translations -->
        <div class="dropdown mb-3">
          <a class="btn bg-gradient-primary dropdown-toggle" data-bs-toggle="dropdown" id="navbarDropdownMenuLangButton">
             {{ __('Add New Translations') }}
          </a>
          <ul class="dropdown-menu px-2 mt-5" aria-labelledby="navbarDropdownMenuLangButton">
             @foreach(localization()->getSupportedLocales() as $localeCode => $properties)
                  <li class="mb-2">
                      <a class="dropdown-item border-radius-md" href="{{ localization()->getLocalizedURL($properties->key(), route('create-page-translations', $page_id), [], true) }}">
                        <img src="{{ asset('assets/img/flags/' . $properties->key() . '.svg') }}" class="lang-menu me-1 my-auto"> {{ $properties->native() }}
                      </a>
                  </li>
              @endforeach
          </ul>
        </div>
        <!-- begin:Add new page translations -->

        <!-- begin:Form Search -->
        <form id="formSearchPage">
            <div class="input-group mb-3">
                <input type="text" class="form-control" wire:model="searchQuery" placeholder="{{ __('Search with title...') }}">
            </div>
        </form>
        <!-- end:Form Search -->

        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table align-items-center mb-0 ">
                        <thead>
                            <tr>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">{{ __('Title') }}</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">{{ __('Language') }}</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">{{ __('Action') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ( $page_translations->isNotEmpty() )

                                @foreach ($page_translations as $page_translation)

                                    <tr>
                                        <td class="align-middle">{{ $page_translation->title }}</td>
                                        <td class="align-middle">
                                            <img src="{{ asset('assets/img/flags/' . $page_translation->locale . '.svg') }}" class="lang-menu mx-auto"> 
                                        </td>
                                        <td class="w-25">
                                            <a href="{{ localization()->getLocalizedURL($page_translation->locale, route('home') . '/' . $slug, [], true) }}" class="btn bg-gradient-info" title="{{ __('View') }}" target="_blank"><i class="fas fa-eye icon"></i> {{ __('View') }}</a>
                                            <a href="{{ localization()->getLocalizedURL($page_translation->locale, route('edit-page-translations', $page_translation->id), [], true) }}" class="btn bg-gradient-primary" title="{{ __('Edit') }}"><i class="fas fa-edit icon"></i> {{ __('Edit') }}</a>
                                            <a wire:click="onDeleteConfirmPageTranslation( {{ $page_translation->id }} )" class="btn bg-gradient-danger" title="{{ __('Delete') }}"><i class="fas fa-trash icon"></i> {{ __('Delete') }}</a>
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

				<div class="mx-auto mt-3">
					<!-- begin:pagination -->
					{{ $page_translations->links() }}
					<!-- begin:pagination -->
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
				window.livewire.emit('onDeletePageTranslation', event.detail.id)
			  }
			});

		});

		window.addEventListener('alert', event => {
			toastr[event.detail.type](event.detail.message);
		});
	});

})( jQuery );
</script>