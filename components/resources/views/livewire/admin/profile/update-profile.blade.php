<div class="card h-100 tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab" wire:ignore.self>
	<div class="card-header bg-gradient-secondary">
		<span class="card-title text-white text-bold">{{ __('Update Profile') }}</span>
	</div>
	<div class="card-body">

		<!-- Validation Errors -->
		<x-auth-validation-errors class="mb-4" :errors="$errors" />

		<form wire:submit.prevent="onUpdateProfile">
			<div class="form-group mb-3">
				<label for="fullname" class="form-label">{{ __('Full Name') }}</label>
				<input class="form-control @error('fullname') is-invalid @enderror" type="text" wire:model="fullname" id="fullname">
			</div>

			<div class="form-group mb-3">
				<label for="position" class="form-label">{{ __('Position') }}</label>
				<input class="form-control @error('position') is-invalid @enderror" type="text" wire:model="position" id="position">
			</div>

			<div class="form-group mb-3">
				<label for="phone" class="form-label">{{ __('Phone') }}</label>
				<input class="form-control @error('phone') is-invalid @enderror" type="text" wire:model="phone" id="phone">
			</div>

			<div class="form-group mb-3">
				<label for="email" class="form-label">{{ __('Email') }}</label>
				<input class="form-control @error('email') is-invalid @enderror" type="email" wire:model="email" id="email" required>
			</div>

			<div class="form-group mb-3">
				<label for="address" class="form-label">{{ __('Address') }}</label>
				<input class="form-control @error('address') is-invalid @enderror" type="text" wire:model="address" id="address">
			</div>

			<div class="form-group mb-3">
				<label for="bio" class="form-label">{{ __('Description') }}</label>
				<input class="form-control @error('bio') is-invalid @enderror" type="text" wire:model="bio" id="bio">
			</div>
			
			<div class="form-group mb-3">

				<div class="d-flex my-3">
					<label for="social" class="form-label">{{ __('Social') }}</label>
					<div class="form-check form-switch ps-3 align-items-start">
						<input class="form-check-input ms-auto" type="checkbox" wire:model="social_status">
					</div>
				</div>

				@foreach ($socials as $index => $social)
				
					<div class="row">
						<div class="col-md-5">
							<div class="form-group mb-3">
								<select class="form-control" wire:model="socials.{{ $index }}.name">
									<option value="facebook">{{ __('Facebook') }}</option>
									<option value="twitter">{{ __('Twitter') }}</option>
									<option value="instagram">{{ __('Instagram') }}</option>
									<option value="youtube">{{ __('Youtube') }}</option>
									<option value="linkedin">{{ __('Linkedin') }}</option>
									<option value="skype">{{ __('Skype') }}</option>
									<option value="github">{{ __('Github') }}</option>
									<option value="behance">{{ __('Behance') }}</option>
									<option value="dribbble">{{ __('Dribble') }}</option>
									<option value="flickr">{{ __('Flickr') }}</option>
									<option value="pinterest">{{ __('Pinterest') }}</option>
									<option value="tumblr">{{ __('Tumblr') }}</option>
									<option value="vimeo">{{ __('Vimeo') }}</option>
									<option value="vk">{{ __('VK') }}</option>
									<option value="telegram">{{ __('Telegram') }}</option>
									<option value="reddit">{{ __('Reddit') }}</option>
									<option value="whatsapp">{{ __('WhatsApp') }}</option>
								</select>
								@error( 'socials.' . $index . '.name' ) <span class="error">{{ $message }}</span> @enderror
							</div>
						</div>
						<div class="col-md-5">
							<div class="form-group mb-3">
								<input type="text" class="form-control" placeholder="URL" wire:model="socials.{{ $index }}.url">
								@error( 'socials.' . $index . '.url' ) <span class="error">{{ $message }}</span> @enderror
							</div>
						</div>

						@if ( $index == 0 )

							<div class="col-md-2">
								<button class="btn text-white bg-gradient-info w-100" wire:click.prevent="addSocial( {{ $i }} )">{{ __('Add new') }}</button>
							</div>

						@else
							<div class="col-md-2">
								<button class="btn bg-gradient-danger w-100" wire:click.prevent="onDeleteSocial({{ $social['id'] }})">{{ __('Remove') }}</button>
							</div>
						@endif

					</div>
				@endforeach

				@foreach($inputs as $key => $value)
					<div class="row">
						<div class="col-md-5">
							<div class="form-group mb-3">
								<select wire:model="name.{{ $value }}" class="form-control">
									<option value selected style="display:none;">{{ __('Choose a social...') }}</option>
									<option value="facebook">{{ __('Facebook') }}</option>
									<option value="twitter">{{ __('Twitter') }}</option>
									<option value="instagram">{{ __('Instagram') }}</option>
									<option value="youtube">{{ __('Youtube') }}</option>
									<option value="linkedin">{{ __('Linkedin') }}</option>
									<option value="skype">{{ __('Skype') }}</option>
									<option value="github">{{ __('Github') }}</option>
									<option value="behance">{{ __('Behance') }}</option>
									<option value="dribbble">{{ __('Dribble') }}</option>
									<option value="flickr">{{ __('Flickr') }}</option>
									<option value="pinterest">{{ __('Pinterest') }}</option>
									<option value="tumblr">{{ __('Tumblr') }}</option>
									<option value="vimeo">{{ __('Vimeo') }}</option>
									<option value="vk">{{ __('VK') }}</option>
									<option value="telegram">{{ __('Telegram') }}</option>
									<option value="reddit">{{ __('Reddit') }}</option>
									<option value="whatsapp">{{ __('WhatsApp') }}</option>
								</select>
								@error( 'name.' . $value ) <span class="error">{{ $message }}</span> @enderror
							</div>
						</div>
						<div class="col-md-5">
							<div class="form-group mb-3">
								<input type="text" class="form-control" placeholder="URL" wire:model="url.{{ $value }}">
								@error( 'url.' . $value ) <span class="error">{{ $message }}</span> @enderror
							</div>
						</div>
						<div class="col-md-2">
							<button class="btn bg-gradient-danger w-100" wire:click.prevent="removeSocial({{ $key }})">{{ __('Remove') }}</button>
						</div>
					</div>
				@endforeach

			</div>

			<div class="form-group mb-3 text-end">
				<button class="btn bg-gradient-primary">
					<span>
						<div wire:loading wire:target="onUpdateProfile">
							<x-loading />
						</div>
						<span>{{ __('Save Changes') }}</span>
					</span>
				</button>
			</div>

		</form>

	</div>
</div>

