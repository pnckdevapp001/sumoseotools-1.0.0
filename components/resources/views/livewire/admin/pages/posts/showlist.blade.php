<div>

		<button class="btn bg-gradient-primary mb-3" data-bs-toggle="modal" data-bs-target="#addNewPage"><i class="fas fa-plus fa-fw me-1"></i> {{ __('Add New Post') }}</button>

		<!-- begin:Form Search -->
		<form id="formSearchPage">
			<div class="input-group mb-3">
				<input type="text" class="form-control" wire:model="searchQuery" placeholder="{{ __('Search with title...') }}">
			</div>
		</form>
		<!-- end:Form Search -->

		<div class="alert alert-info bg-gradient-info text-white" role="alert">
		  <span>{{ __('These posts will be displayed in the Blog page.') }}</span>
		</div>

		<div class="card">
			<div class="table-responsive">
				<table class="table table-hover">
					<thead>
						<tr>
							<th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">{{ __('Slug') }}</th>
							<th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">{{ __('Default Language') }}</th>
							<th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">{{ __('Translation Progress') }}</th>
							<th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">{{ __('Status') }}</th>
							<th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">{{ __('Latest updates') }}</th>
							<th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">{{ __('Action') }}</th>
						</tr>
					</thead>
					<tbody>
						@if ( $pages->isNotEmpty() )

							@foreach ($pages as $page)

								<tr>
									<td class="align-middle">
										<div class="d-flex px-2 py-1">
											<div>
												<img src="{{ ($page->featured_image) ? $page->featured_image : asset('assets/img/no-thumb.svg') }}" class="avatar avatar-sm me-3">
											</div>
											<div class="d-flex align-items-center">{{ $page->slug }}</div>
										</div>
									</td>
									<td class="align-middle">
										<img src="{{ asset('assets/img/flags/' . $default_lang . '.svg') }}" class="lang-menu mx-auto"> 
									</td>

									<td class="align-middle">
										@foreach ($translation_progress as $value)

											@if ($value['page_id'] == $page->id)

												@if ($value['progress'] == $total_lang)
													<span class="badge bg-success">{{ $value['progress'] }}/{{ $total_lang }}</span>
												@else
													<span class="badge bg-secondary">{{ $value['progress'] }}/{{ $total_lang }}</span>
												@endif
												
											@endif
										@endforeach
									</td>
                                    <td class="align-middle">
                                        <span class="badge bg-{{ ($page->post_status == true) ? 'success' : 'secondary' }}">{{ ($page->post_status == true) ? __('Enabled') : __('Disabled') }}</span>
                                    </td>
									<td class="align-middle">
										<span>{{ $page->updated_at }}</span>
									</td>
									<td class="align-middle">
										<div class="bg-gradient-group w-100">
											<a href="{{ route('page-translations', $page->id ) }}" class="btn bg-gradient-primary" data-bs-toggle="tooltip" data-bs-placement="top" title="{{ __('Translations') }}" data-bs-original-title="{{ __('Translations') }}">
												<i class="fas fa-language"></i>
											</a>
	                                        
	                                        <a wire:click="onEnablePost( {{ $page->id }} )" class="btn bg-gradient-success" data-bs-toggle="tooltip" data-bs-placement="top" title="{{ __('Enable') }}" data-bs-original-title="{{ __('Enable') }}">
	                                            <i class="fas fa-check"></i>
	                                        </a>

	                                        <a wire:click="onDisablePost( {{ $page->id }} )" class="btn bg-gradient-warning" data-bs-toggle="tooltip" data-bs-placement="top" title="{{ __('Disable') }}" data-bs-original-title="{{ __('Disable') }}">
	                                            <i class="fas fa-ban"></i>
	                                        </a>

											<a wire:click="onShowEditPageModal( {{ $page->id }} )" class="btn bg-gradient-info" data-bs-toggle="tooltip" data-bs-placement="top" title="{{ __('Edit') }}" data-bs-original-title="{{ __('Edit') }}">
												<i class="fas fa-edit"></i>
											</a>

											<a wire:click="onDeleteConfirmPage( {{ $page->id }} )" class="btn bg-gradient-danger" data-bs-toggle="tooltip" data-bs-placement="top" title="{{ __('Delete') }}" data-bs-original-title="{{ __('Delete') }}">
												<i class="fas fa-trash"></i>
											</a>
										</div>
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
				{{ $pages->links() }}
				<!-- begin:pagination -->
			</div>
		</div>

	    <!-- Begin::Add New Post -->
	    <div class="modal fade" id="addNewPage" tabindex="-1" role="dialog" aria-labelledby="addNewPageLabel" aria-hidden="true">
	      <div class="modal-dialog modal-dialog-centered">
	        <div class="modal-content">
	          <div class="modal-header">
	            <h5 class="modal-title" id="addNewPageModalLabel">{{ __('Add New Post') }}</h5>
	            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
	              <span aria-hidden="true">&times;</span>
	            </button>
	          </div>

	          @livewire('admin.pages.posts.create')

	        </div>
	      </div>
	    </div>
	    <!-- End::Add New Post -->

	    <!-- Begin::Edit Post -->
	    <div class="modal fade" id="editPage" tabindex="-1" role="dialog" aria-labelledby="editPageLabel" aria-hidden="true">
	      <div class="modal-dialog modal-dialog-centered">
	        <div class="modal-content">
	          <div class="modal-header">
	            <h5 class="modal-title" id="editPageModalLabel">{{ __('Edit Post') }}</h5>
	            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
	              <span aria-hidden="true">&times;</span>
	            </button>
	          </div>

	          @livewire('admin.pages.posts.edit')
	          
	        </div>
	      </div>
	    </div>
	    <!-- End::Edit Post -->

</div>

<script src="{{ asset('components/public/vendor/laravel-filemanager/js/stand-alone-button.js') }}"></script>
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
			    window.livewire.emit('onDeletePage', event.detail.id)
			  }
			});
	
		});

		window.addEventListener('closeModal', event => {
			jQuery('#' + event.detail.id).modal('hide');
		});

		window.addEventListener('showModal', event => {
			jQuery('#' + event.detail.id).modal('show');
		});
			
		window.addEventListener('alert', event => {
			toastr[event.detail.type](event.detail.message);
		});

	});

})( jQuery );
</script>