<div>
        <div class="card">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">{{ __('Page Name') }}</th>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">{{ __('Status') }}</th>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">{{ __('Latest updates') }}</th>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">{{ __('Action') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ( $auth_pages->isNotEmpty() )

                            @foreach ($auth_pages as $auth_page)

                                <tr>
                                    <td class="align-middle">
                                        <div class="d-flex px-2">
                                            <div class="my-auto">
                                                {{ $auth_page->name }}
                                            </div>
                                        </div>
                                    </td>
                                    <td class="align-middle">
                                        <span class="badge bg-{{ ($auth_page->status == true) ? 'success' : 'secondary' }}">{{ ($auth_page->status == true) ? __('Enabled') : __('Disabled') }}</span>
                                    </td>
                                    <td class="align-middle">{{ $auth_page->updated_at }}</td>
                                    <td class="w-25">
                                        <a wire:click="onEnablePage( {{ $auth_page->id }} )" class="btn bg-gradient-success" title="{{ __('Enable') }}">
                                            <i class="fas fa-check icon"></i>
                                            {{ __('Enable') }}
                                        </a>

                                        <a wire:click="onDisablePage( {{ $auth_page->id }} )" class="btn bg-gradient-danger" title="{{ __('Disable') }}">
                                            <i class="fas fa-ban icon"></i>
                                            {{ __('Disable') }}
                                        </a>
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
        </div>

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