<div>

    <div id="page-content" class="py-3">
        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />
        
        <!-- Contact Form -->
        <form id="formContact" wire:submit.prevent="sendMessage">
            <div class="pb-2">
                <div class="row">
                    <div class="col-md-6">
                        <label class="form-label">{{ __('Full name') }} *</label>
                        <div class="input-group mb-3">
                            <input class="form-control @error('name') is-invalid @enderror" placeholder="{{ __('Enter your name') }}" wire:model="name" type="text" required />
                        </div>
                    </div>

                    <div class="col-md-6 ps-md-2">
                        <label class="form-label">{{ __('Email') }} *</label>
                        <div class="input-group mb-3">
                            <input type="email" class="form-control @error('email') is-invalid @enderror" wire:model="email" placeholder="{{ __('Enter your email') }}" required />
                        </div>
                    </div>
                </div>

                <div class="form-group mb-0 mt-md-0 mt-4">
                    <label class="form-label">{{ __('Message') }} *</label>
                    <textarea class="form-control @error('message') is-invalid @enderror" wire:model="message" rows="10" placeholder="{{ __('Describe your problem here!') }}" required></textarea>
                </div>

                <div class="row">
                    <div class="col-md-12 text-center">

                        <div class="form-group">
                            <button class="btn bg-gradient-primary mt-3 mb-0">
                                <span>
                                    <div wire:loading wire:target="sendMessage">
                                        <x-loading />
                                    </div>
                                    <span>{{ __('Send Message') }}</span>
                                </span>
                            </button>
                        </div>

                    </div>
                </div>
            </div>
        </form>
    </div>

</div>
