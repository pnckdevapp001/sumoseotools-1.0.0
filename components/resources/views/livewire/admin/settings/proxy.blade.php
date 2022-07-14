<div>

    <!-- Validation Errors -->
    <x-auth-validation-errors class="mb-4" :errors="$errors" />
                    
    <div class="row">
        <div class="col-12">

            <button class="btn bg-gradient-info mb-3" data-bs-toggle="modal" data-bs-target="#addNewProxy"><i class="fas fa-plus fa-fw me-1"></i> {{ __('Add New Proxy') }}</button>

            <div class="card">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">{{ __('IP') }}</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">{{ __('Port') }}</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">{{ __('Username') }}</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">{{ __('Password') }}</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">{{ __('Type') }}</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">{{ __('Status') }}</th>
                                <th class="text-uppercase text-secondary text-xxs text-end font-weight-bolder opacity-7">{{ __('Action') }}</th>
                            </tr>
                        </thead>
                        <tbody>

                            @if ( $proxies->isNotEmpty() )

                                @foreach ($proxies as $proxy)
                                    <tr>
                                        <td class="align-middle">
                                            <div class="d-flex px-2">
                                                <div class="my-auto">
                                                   {{ $proxy['ip'] }}
                                                </div>
                                            </div>
                                        </td>
                                        <td class="align-middle">{{ $proxy['port'] }}</td>
                                        <td class="align-middle">{{ ($proxy['username']) ? $proxy['username']: 'none' }}</td>
                                        <td class="align-middle">{{ ($proxy['password']) ? $proxy['password'] : 'none' }}</td>
                                        <td class="align-middle">{{ $proxy['type'] }}</td>
                                        <td class="align-middle">
                                            @if ( $proxy['banned'] == true)
                                                <span class="badge bg-danger"><i class="fas fa-times"></i></span>
                                            @else
                                                <span class="badge bg-success"><i class="fas fa-check"></i></span>
                                            @endif

                                        </td>
                                        <td class="align-middle w-15 py-3">
                                            <a class="btn bg-gradient-primary" title="{{ __('Check Proxy') }}" wire:click="onProxyCheck( {{ $proxy['id'] }} )">
                                                <i class="fas fa-check icon" wire:loading.remove wire:target="onProxyCheck( {{ $proxy['id'] }} )"></i>
                                                <i class="fas fa-spinner fa-spin icon" wire:loading wire:target="onProxyCheck( {{ $proxy['id'] }} )"></i>
                                                {{ __('Check Proxy') }}
                                            </a>
                                            <a class="btn bg-gradient-warning" title="{{ __('Disable') }}" wire:click="onDisableProxy( {{ $proxy['id'] }} )">
                                                <i class="fas fa-times-circle icon" wire:loading.remove wire:target="onDisableProxy( {{ $proxy['id'] }} )"></i>
                                                <i class="fas fa-spinner fa-spin icon" wire:loading wire:target="onDisableProxy( {{ $proxy['id'] }} )"></i>
                                                {{ __('Disable') }}
                                            </a>
                                            <a class="btn bg-gradient-info" title="{{ __('Edit') }}" wire:click="onShowEditProxyModal( {{ $proxy['id'] }} )"><i class="fas fa-edit icon"></i> {{ __('Edit') }}</a>
                                            <a class="btn bg-gradient-danger" title="{{ __('Delete') }}" wire:click="onDeleteProxyConfirm( {{ $proxy['id'] }} )"><i class="fas fa-trash icon"></i> {{ __('Delete') }}</a>
                                        </td>
                                    </tr>
                                @endforeach
                                
                            @else

                                <tr>
                                    <td class="align-middle">
                                        <div class="d-flex px-2">
                                            <div class="my-auto">
                                               {{ __('No record found') }}
                                            </div>
                                        </div>
                                    </td>
                                </tr>

                            @endif

                        </tbody>
                    </table>
                </div>

                <div class="float-end">
                    <!-- begin:pagination -->
                    {{ $proxies->links() }}
                    <!-- begin:pagination -->
                </div>
            </div>
        </div>
    </div>

    <!-- Begin::Add New Proxy -->
    <div class="modal fade" id="addNewProxy" tabindex="-1" role="dialog" aria-labelledby="addNewProxyLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="addNewProxyModalLabel">{{ __('Add New Proxy') }}</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>

          <div class="modal-body">
            @livewire('admin.settings.proxy.create')
          </div>

        </div>
      </div>
    </div>
    <!-- End::Add New Proxy -->

    <!-- Begin::Edit Proxy -->
    <div class="modal fade" id="editProxy" tabindex="-1" role="dialog" aria-labelledby="editProxyLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="editProxyModalLabel">{{ __('Edit Proxy') }}</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>

          <div class="modal-body">
            @livewire('admin.settings.proxy.edit')
          </div>

        </div>
      </div>
    </div>
    <!-- End::Edit Proxy -->

</div>