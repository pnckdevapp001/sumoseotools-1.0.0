<div>

		<button class="btn bg-gradient-primary mb-3" data-bs-toggle="modal" data-bs-target="#addNewPage"><i class="fas fa-plus fa-fw me-1"></i> {{ __('Add New Tool') }}</button>

		<!-- begin:Form Search -->
		<form id="formSearchPage">
			<div class="input-group mb-3">
				<input type="text" class="form-control" wire:model="searchQuery" placeholder="{{ __('Search with title...') }}">
			</div>
		</form>
		<!-- end:Form Search -->

		<div class="card">
			<div class="table-responsive">
				<table class="table table-hover">
					<thead>
						<tr>
							<th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">{{ __('Tool Name') }}</th>
							<th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">{{ __('Category') }}</th>
							<th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">{{ __('Default Language') }}</th>
							<th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">{{ __('Translation Progress') }}</th>
							<th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">{{ __('Status') }}</th>
							<th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">{{ __('Position') }}</th>
							<th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">{{ __('Latest updates') }}</th>
							<th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">{{ __('Action') }}</th>
						</tr>
					</thead>
					<tbody>
						@if ( $tools->isNotEmpty() )

							@foreach ($tools as $tool)
								<tr>
									<td class="align-middle">
										<div class="d-flex px-2">
											<div class="my-auto">
												{{ ( empty( $tool->custom_tool_link ) ) ? $tool->tool_name : __('Custom Link'); }}
											</div>
										</div>
									</td>
									<td class="align-middle">
										@if ( !empty($tool->category_id) )
											<span>{{ \App\Models\Admin\PageCategory::where('id', $tool->category_id)->first()->title }}</span>
										@endif
									</td>
									<td class="align-middle">
										<img src="{{ asset('assets/img/flags/' . $default_lang . '.svg') }}" class="lang-menu mx-auto"> 
									</td>
									<td class="align-middle">
										@foreach ($translation_progress as $value)

											@if ($value['page_id'] == $tool->id)

												@if ($value['progress'] == $total_lang)
													<span class="badge bg-success">{{ $value['progress'] }}/{{ $total_lang }}</span>
												@else
													<span class="badge bg-secondary">{{ $value['progress'] }}/{{ $total_lang }}</span>
												@endif
											@endif
										@endforeach
									</td>
                                    <td class="align-middle">
                                        <span class="badge bg-{{ ($tool->tool_status == true) ? 'success' : 'secondary' }}">{{ ($tool->tool_status == true) ? __('Enabled') : __('Disabled') }}</span>
                                    </td>
									<td class="align-middle">
										<span class="badge bg-gradient-secondary">{{ $tool->position }}</span>
									</td>
									<td class="align-middle">
										<span>{{ $tool->updated_at }}</span>
									</td>
									<td class="align-middle">

										<div class="bg-gradient-group w-100">
											<a href="{{ route('page-translations', $tool->id ) }}" class="btn btn-sm bg-gradient-primary" data-bs-toggle="tooltip" data-bs-placement="top" title="{{ __('Translations') }}" data-bs-original-title="{{ __('Translations') }}">
												<i class="fas fa-language"></i>
											</a>
	                                        
	                                        <a wire:click="onEnableTool( {{ $tool->id }} )" class="btn btn-sm bg-gradient-success" data-bs-toggle="tooltip" data-bs-placement="top" title="{{ __('Enable') }}" data-bs-original-title="{{ __('Enable') }}">
	                                            <i class="fas fa-check"></i>
	                                        </a>

	                                        <a wire:click="onDisableTool( {{ $tool->id }} )" class="btn btn-sm bg-gradient-warning" data-bs-toggle="tooltip" data-bs-placement="top" title="{{ __('Disable') }}" data-bs-original-title="{{ __('Disable') }}">
	                                            <i class="fas fa-ban"></i>
	                                        </a>
											<a wire:click="onShowEditPageModal( {{ $tool->id }} )" class="btn btn-sm bg-gradient-info" data-bs-toggle="tooltip" data-bs-placement="top" title="{{ __('Edit') }}" data-bs-original-title="{{ __('Edit') }}">
												<i class="fas fa-edit"></i>
											</a>

											<a wire:click="onDeleteConfirmPage( {{ $tool->id }} )" class="btn btn-sm bg-gradient-danger" data-bs-toggle="tooltip" data-bs-placement="top" title="{{ __('Delete') }}" data-bs-original-title="{{ __('Delete') }}">
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
				{{ $tools->links() }}
				<!-- begin:pagination -->
			</div>
		</div>

	    <!-- Begin::Add New Page -->
	    <div class="modal fade" id="addNewPage" tabindex="-1" role="dialog" aria-labelledby="addNewPageLabel" aria-hidden="true">
	      <div class="modal-dialog modal-dialog-centered">
	        <div class="modal-content">
	          <div class="modal-header">
	            <h5 class="modal-title" id="addNewPageModalLabel">{{ __('Add New Tool') }}</h5>
	            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
	              <span aria-hidden="true">&times;</span>
	            </button>
	          </div>

	          @livewire('admin.pages.tools.create')

	        </div>
	      </div>
	    </div>
	    <!-- End::Add New Page -->

	    <!-- Begin::Edit Page -->
	    <div class="modal fade" id="editPage" tabindex="-1" role="dialog" aria-labelledby="editPageLabel" aria-hidden="true">
	      <div class="modal-dialog modal-dialog-centered">
	        <div class="modal-content">
	          <div class="modal-header">
	            <h5 class="modal-title" id="editPageModalLabel">{{ __('Edit Tool') }}</h5>
	            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
	              <span aria-hidden="true">&times;</span>
	            </button>
	          </div>

	          @livewire('admin.pages.tools.edit')
	          
	        </div>
	      </div>
	    </div>
	    <!-- End::Edit Page -->

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
			$('#' + event.detail.id).modal('hide');
		});

		window.addEventListener('showModal', event => {
			$('#' + event.detail.id).modal('show');
		});
			
		window.addEventListener('alert', event => {
			toastr[event.detail.type](event.detail.message);
		});

	});

})( jQuery );
</script>