<div>

      <form wire:submit.prevent="onAdsenseCalculator">

            <!-- Session Status -->
            <x-auth-session-status class="mb-4" :status="session('status')" />
                                        
            <!-- Validation Errors -->
            <x-auth-validation-errors class="mb-4" :errors="$errors" />

            <div class="form-group mb-3 row">
              <label class="form-label col-3 col-form-label">{{ __('Page Impressions') }}</label>
              <div class="col">
                <input type="text" wire:model="impressions" class="form-control">
              </div>
            </div>

            <div class="form-group mb-3 row">
              <label class="form-label col-3 col-form-label">{{ __('Click Through Rate (CTR) in %') }}</label>
              <div class="col">
                <input type="text" wire:model="ctr" class="form-control">
              </div>
            </div>

            <div class="form-group mb-3 row">
              <label class="form-label col-3 col-form-label">{{ __('Cost Per Click') }}</label>
              <div class="col">
                <input type="text" wire:model="cpc" class="form-control">
              </div>
            </div>

            <div class="form-group">
                <button class="btn bg-gradient-info mx-auto d-block" wire:loading.attr="disabled">
                    <span>
                        <div wire:loading.inline wire:target="onAdsenseCalculator">
                            <x-loading />
                        </div>
                        <span wire:target="onAdsenseCalculator">{{ __('Calculate') }}</span>
                    </span>
                </button>
            </div>
            
            @if ( !empty($data) )
                <div class="table-responsive">
                    <table class="table table-bordered border">
                        <thead class="bg-gradient-success text-white">
                            <tr>
                                <th>{{ __('Periods') }}</th>
                                <th>{{ __('Earnings') }}</th>
                                <th>{{ __('Clicks') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>{{ __('Daily') }}</td>
                                <td>${{ $data['daily_earnings'] }}</td>
                                <td>{{ $data['daily_clicks'] }}</td>
                            </tr>
                            <tr>
                                <td>{{ __('Monthly') }}</td>
                                <td>${{ $data['mothly_earnings'] }}</td>
                                <td>{{ $data['mothly_clicks'] }}</td>
                            </tr>
                            <tr>
                                <td>{{ __('Yearly') }}</td>
                                <td>${{ $data['yearly_earnings'] }}</td>
                                <td>{{ $data['yearly_clicks'] }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            @endif

      </form>
</div>