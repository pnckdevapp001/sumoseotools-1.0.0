<div>

    <!-- Validation Errors -->
    <x-auth-validation-errors class="mb-4" :errors="$errors" />
    
	<form wire:submit.prevent="onUpdateADS">

		<div class="row">
			<!-- Begin:Ads Area 1 -->
			<div class="col-12 col-lg-6 mb-4">
				<div class="card">
					<div class="card-body">

						<div class="form-group mb-3">

							<div class="d-flex">
								<label for="ads-area-1" class="form-label">{{ __('Before the Title') }} </label>

								<div class="form-check form-switch ps-3 align-items-start">
									<input class="form-check-input ms-auto" type="checkbox" wire:model="area1_status">
								</div>
							</div>

							<div class="col">
								<textarea class="form-control" id="ads-area-1" wire:model="area1" rows="5"></textarea>
							</div>

						</div>

						<div class="row">
							<div class="input-group">

								<div class="col-12 col-md-6 pe-md-4">
									<div class="input-group">
										<button class="btn bg-gradient-secondary mb-0" type="button">{{ __('Align') }}</button>
										<select name="align" class="form-control ps-3" wire:model="area1_align">
											<option value="left">{{ __('Left') }}</option>
											<option value="right">{{ __('Right') }}</option>
											<option value="center">{{ __('Center') }}</option>
										</select>
									</div>
								</div>

								<div class="col-12 col-md-6">
									<div class="input-group">
										<button class="btn bg-gradient-secondary mb-0" type="button">{{ __('Margin') }}</button>
										<input type="number" class="form-control ps-3" wire:model="area1_margin" value="10">
										<span class="input-group-text">{{ __('px') }}</span>
									</div>
								</div>

							</div>
						</div>

					</div>
				</div>
			</div>
			<!-- End:Ads Area 1 -->

			<!-- Begin:Ads Area 2 -->
			<div class="col-12 col-lg-6 mb-4">
				<div class="card">
					<div class="card-body">

						<div class="form-group mb-3">
							<div class="d-flex">
								<label for="ads-area-2" class="form-label">{{ __('After the Title') }} </label>

								<div class="form-check form-switch ps-3 align-items-start">
									<input class="form-check-input ms-auto" type="checkbox" wire:model="area2_status">
								</div>
							</div>

							<div class="col">
								<textarea class="form-control" id="ads-area-2" rows="5" wire:model="area2"></textarea>
							</div>
						</div>

						<div class="row">
							<div class="input-group">

								<div class="col-12 col-md-6 pe-md-4">
									<div class="input-group">
										<button class="btn bg-gradient-secondary mb-0" type="button">{{ __('Align') }}</button>
										<select name="align" class="form-control ps-3" wire:model="area2_align">
											<option value="left">{{ __('Left') }}</option>
											<option value="right">{{ __('Right') }}</option>
											<option value="center">{{ __('Center') }}</option>
										</select>
									</div>
								</div>

								<div class="col-12 col-md-6">
									<div class="input-group">
										<button class="btn bg-gradient-secondary mb-0" type="button">{{ __('Margin') }}</button>
										<input type="number" class="form-control ps-3" value="10" wire:model="area2_margin">
										<span class="input-group-text">{{ __('px') }}</span>
									</div>
								</div>

							</div>
						</div>

					</div>
				</div>
			</div>
			<!-- End:Ads Area 2 -->

			<!-- Begin:Ads Area 3 -->
			<div class="col-12 col-lg-6 mb-4">
				<div class="card">
					<div class="card-body">

						<div class="form-group mb-3">
							<div class="d-flex">
								<label for="ads-area-3" class="form-label">{{ __('Above the toolbox') }} </label>

								<div class="form-check form-switch ps-3 align-items-start">
									<input class="form-check-input ms-auto" type="checkbox" wire:model="area3_status">
								</div>
							</div>

							<div class="col">
								<textarea class="form-control" id="ads-area-3" rows="5" wire:model="area3"></textarea>
							</div>
						</div>

						<div class="row">
							<div class="input-group">

								<div class="col-12 col-md-6 pe-md-4">
									<div class="input-group">
										<button class="btn bg-gradient-secondary mb-0" type="button">{{ __('Align') }}</button>
										<select name="align" class="form-control ps-3" wire:model="area3_align">
											<option value="left">{{ __('Left') }}</option>
											<option value="right">{{ __('Right') }}</option>
											<option value="center">{{ __('Center') }}</option>
										</select>
									</div>
								</div>

								<div class="col-12 col-md-6">
									<div class="input-group">
										<button class="btn bg-gradient-secondary mb-0" type="button">{{ __('Margin') }}</button>
										<input type="number" class="form-control ps-3" value="10" wire:model="area3_margin">
										<span class="input-group-text">{{ __('px') }}</span>
									</div>
								</div>

							</div>
						</div>

					</div>
				</div>
			</div>
			<!-- End:Ads Area 3 -->

			<!-- Begin:Ads Area 4 -->
			<div class="col-12 col-lg-6 mb-4">
				<div class="card">
					<div class="card-body">

						<div class="form-group mb-3">
							<div class="d-flex">
								<label for="ads-area-4" class="form-label">{{ __('Before the Content') }} </label>

								<div class="form-check form-switch ps-3 align-items-start">
									<input class="form-check-input ms-auto" type="checkbox" wire:model="area4_status">
								</div>
							</div>

							<div class="col">
								<textarea class="form-control" id="ads-area-4" rows="5" wire:model="area4"></textarea>
							</div>
						</div>

						<div class="row">
							<div class="input-group">

								<div class="col-12 col-md-6 pe-md-4">
									<div class="input-group">
										<button class="btn bg-gradient-secondary mb-0" type="button">{{ __('Align') }}</button>
										<select name="align" class="form-control ps-3" wire:model="area4_align">
											<option value="left">{{ __('Left') }}</option>
											<option value="right">{{ __('Right') }}</option>
											<option value="center">{{ __('Center') }}</option>
										</select>
									</div>
								</div>

								<div class="col-12 col-md-6">
									<div class="input-group">
										<button class="btn bg-gradient-secondary mb-0" type="button">{{ __('Margin') }}</button>
										<input type="number" class="form-control ps-3" value="10" wire:model="area4_margin">
										<span class="input-group-text">{{ __('px') }}</span>
									</div>
								</div>

							</div>
						</div>

					</div>
				</div>
			</div>
			<!-- End:Ads Area 4 -->

			<!-- Begin:Ads Area 5 -->
			<div class="col-12 col-lg-6 mb-4">
				<div class="card">
					<div class="card-body">

						<div class="form-group mb-3">
							<div class="d-flex">
								<label for="ads-area-4" class="form-label">{{ __('After the Content') }} </label>

								<div class="form-check form-switch ps-3 align-items-start">
									<input class="form-check-input ms-auto" type="checkbox" wire:model="area5_status">
								</div>
							</div>

							<div class="col">
								<textarea class="form-control" id="ads-area-4" rows="5" wire:model="area5"></textarea>
							</div>
						</div>

						<div class="row">
							<div class="input-group">

								<div class="col-12 col-md-6 pe-md-4">
									<div class="input-group">
										<button class="btn bg-gradient-secondary mb-0" type="button">{{ __('Align') }}</button>
										<select name="align" class="form-control ps-3" wire:model="area5_align">
											<option value="left">{{ __('Left') }}</option>
											<option value="right">{{ __('Right') }}</option>
											<option value="center">{{ __('Center') }}</option>
										</select>
									</div>
								</div>

								<div class="col-12 col-md-6">
									<div class="input-group">
										<button class="btn bg-gradient-secondary mb-0" type="button">{{ __('Margin') }}</button>
										<input type="number" class="form-control ps-3" value="10" wire:model="area5_margin">
										<span class="input-group-text">{{ __('px') }}</span>
									</div>
								</div>

							</div>
						</div>

					</div>
				</div>
			</div>
			<!-- End:Ads Area 5 -->

			<!-- Begin:Ads Sidebar Top -->
			<div class="col-12 col-lg-6 mb-4">
				<div class="card">
					<div class="card-body">

						<div class="form-group mb-3">
							<div class="d-flex">
								<label for="ads_sidebar_top" class="form-label">{{ __('Sidebar Top') }} </label>

								<div class="form-check form-switch ps-3 align-items-start">
									<input class="form-check-input ms-auto" type="checkbox" wire:model="sidebar_top_status">
								</div>
							</div>

							<div class="col">
								<textarea class="form-control" id="ads_sidebar_top" rows="5" wire:model="sidebar_top"></textarea>
							</div>
						</div>

						<div class="row">
							<div class="input-group">

								<div class="col-12 col-md-6 pe-md-4">
									<div class="input-group">
										<button class="btn bg-gradient-secondary mb-0" type="button">{{ __('Align') }}</button>
										<select name="align" class="form-control ps-3" wire:model="sidebar_top_align">
											<option value="left">{{ __('Left') }}</option>
											<option value="right">{{ __('Right') }}</option>
											<option value="center">{{ __('Center') }}</option>
										</select>
									</div>
								</div>

								<div class="col-12 col-md-6">
									<div class="input-group">
										<button class="btn bg-gradient-secondary mb-0" type="button">{{ __('Margin') }}</button>
										<input type="number" class="form-control ps-3" value="10" wire:model="sidebar_top_margin">
										<span class="input-group-text">{{ __('px') }}</span>
									</div>
								</div>

							</div>
						</div>

					</div>
				</div>
			</div>
			<!-- End:Ads Sidebar Top -->

			<!-- Begin:Ads Sidebar Middle -->
			<div class="col-12 col-lg-6 mb-4">
				<div class="card">
					<div class="card-body">

						<div class="form-group mb-3">
							<div class="d-flex">
								<label for="ads_sidebar_middle" class="form-label">{{ __('Sidebar Middle') }} </label>

								<div class="form-check form-switch ps-3 align-items-start">
									<input class="form-check-input ms-auto" type="checkbox" wire:model="sidebar_middle_status">
								</div>
							</div>

							<div class="col">
								<textarea class="form-control" id="ads_sidebar_middle" rows="5" wire:model="sidebar_middle"></textarea>
							</div>
						</div>

						<div class="row">
							<div class="input-group">

								<div class="col-12 col-md-6 pe-md-4">
									<div class="input-group">
										<button class="btn bg-gradient-secondary mb-0" type="button">{{ __('Align') }}</button>
										<select name="align" class="form-control ps-3" wire:model="sidebar_middle_align">
											<option value="left">{{ __('Left') }}</option>
											<option value="right">{{ __('Right') }}</option>
											<option value="center">{{ __('Center') }}</option>
										</select>
									</div>
								</div>

								<div class="col-12 col-md-6">
									<div class="input-group">
										<button class="btn bg-gradient-secondary mb-0" type="button">{{ __('Margin') }}</button>
										<input type="number" class="form-control ps-3" value="10" wire:model="sidebar_middle_margin">
										<span class="input-group-text">{{ __('px') }}</span>
									</div>
								</div>

							</div>
						</div>

					</div>
				</div>
			</div>
			<!-- End:Ads Sidebar Middle -->

			<!-- Begin:Ads Sidebar Bottom -->
			<div class="col-12 col-lg-6 mb-4">
				<div class="card">
					<div class="card-body">

						<div class="form-group mb-3">
							<div class="d-flex">
								<label for="ads_sidebar_bottom" class="form-label">{{ __('Sidebar Bottom') }} </label>

								<div class="form-check form-switch ps-3 align-items-start">
									<input class="form-check-input ms-auto" type="checkbox" wire:model="sidebar_bottom_status">
								</div>
							</div>

							<div class="col">
								<textarea class="form-control" id="ads_sidebar_bottom" rows="5" wire:model="sidebar_bottom"></textarea>
							</div>
						</div>

						<div class="row">
							<div class="input-group">

								<div class="col-12 col-md-6 pe-md-4">
									<div class="input-group">
										<button class="btn bg-gradient-secondary mb-0" type="button">{{ __('Align') }}</button>
										<select name="align" class="form-control ps-3" wire:model="sidebar_bottom_align">
											<option value="left">{{ __('Left') }}</option>
											<option value="right">{{ __('Right') }}</option>
											<option value="center">{{ __('Center') }}</option>
										</select>
									</div>
								</div>

								<div class="col-12 col-md-6">
									<div class="input-group">
										<button class="btn bg-gradient-secondary mb-0" type="button">{{ __('Margin') }}</button>
										<input type="number" class="form-control ps-3" value="10" wire:model="sidebar_bottom_margin">
										<span class="input-group-text">{{ __('px') }}</span>
									</div>
								</div>

							</div>
						</div>

					</div>
				</div>
			</div>
			<!-- End:Ads Sidebar Bottom -->

			<div class="col-12 mt-4">
				<div class="card">
					<div class="card-header bg-gradient-info">
						<h6 class="card-title text-white mb-0">{{ __('Enable or Disable Ads on the specified page') }}</h6>
					</div>
					<div class="card-body">
						<div class="table-responsive">
							<table class="table table-hover">
								<thead>
									<tr>
										<th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">{{ __('Page Slug') }}</th>
										<th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">{{ __('Page Type') }}</th>
										<th class="text-uppercase text-secondary text-xxs text-end font-weight-bolder opacity-7">{{ __('Status') }}</th>
									</tr>
								</thead>

								<tbody>
									@foreach ($pages as $index => $page)
										<tr>
											<td class="align-middle py-3">
												<div class="d-flex px-2">
													<div class="my-auto">
														{{ $page['slug'] }}
													</div>
												</div>
											</td>
											<td class="align-middle">{{ $page['type'] }}</td>
											<td class="align-middle">
												<div class="form-check form-switch">
													<input class="form-check-input ms-auto" type="checkbox" wire:model="pages.{{ $index }}.ads_status">
												</div>
											</td>
										</tr>
									@endforeach

								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>

			<div class="form-group mt-4">
				<button class="btn bg-gradient-primary float-end">
					<span>
						<div wire:loading wire:target="onUpdateADS">
							<x-loading />
						</div>
						<span>{{ __('Save Changes') }}</span>
					</span>
				</button>
			</div>

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