<div>

    <!-- Validation Errors -->
    <x-auth-validation-errors class="mb-4" :errors="$errors" />
    
    <form wire:submit.prevent="onUpdateSidebar">

        <div class="row">
 
            <div class="col-12">

                <div class="card mb-3">
                    <div class="card-header bg-gradient-info">
                        <h6 class="card-title text-white mb-0">{{ __('Recent Posts') }}</h6>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table settings">
                                <tr>
                                    <td class="align-middle w-25"><label for="status" class="form-label">{{ __('Status') }}</label></td>
                                    <td class="align-middle">
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox" wire:model="post_status">
                                        </div>
                                    </td>
                                </tr>

                                <tr>
                                    <td class="align-middle"><label for="username" class="form-label">{{ __('Number of posts you want to display') }}</label></td>
                                    <td class="align-middle">
                                        <input type="text" class="form-control" wire:model="post_count">
                                    </td>
                                </tr>

                                <tr>
                                    <td class="align-middle"><label class="form-label">{{ __('Heading Align') }}</label></td>
                                    <td class="align-middle">
                                        <select class="form-control" wire:model="post_align">
                                            <option value="start">{{ __('Left') }}</option>
                                            <option value="end">{{ __('Right') }}</option>
                                            <option value="center">{{ __('Center') }}</option>
                                        </select>
                                    </td>
                                </tr>

                                <tr>
                                    <td class="align-middle"><label class="form-label">{{ __('Heading Background') }}</label></td>
                                    <td class="align-middle">
                                        <select name="align" class="form-control" wire:model="post_background">
                                            <optgroup label="{{ __('Base colors') }}">
                                                <option value="bg-white">{{ __('White') }}</option>
                                                <option value="bg-default">{{ __('Default') }}</option>
                                                <option value="bg-primary">{{ __('Primary') }}</option>
                                                <option value="bg-secondary">{{ __('Secondary') }}</option>
                                                <option value="bg-success">{{ __('Success') }}</option>
                                                <option value="bg-info">{{ __('Info') }}</option>
                                                <option value="bg-warning">{{ __('Warning') }}</option>
                                                <option value="bg-danger">{{ __('Danger') }}</option>
                                            </optgroup>
                                            <optgroup label="{{ __('Gradient colors') }}">
                                                <option value="bg-gradient-primary">{{ __('Primary') }}</option>
                                                <option value="bg-gradient-secondary">{{ __('Secondary') }}</option>
                                                <option value="bg-gradient-success">{{ __('Success') }}</option>
                                                <option value="bg-gradient-info">{{ __('Info') }}</option>
                                                <option value="bg-gradient-warning">{{ __('Warning') }}</option>
                                                <option value="bg-gradient-danger">{{ __('Danger') }}</option>
                                            </optgroup>
                                        </select>
                                    </td>
                                </tr>

                            </table>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header bg-gradient-info">
                        <h6 class="card-title text-white mb-0">{{ __('Popular Tools') }}</h6>
                    </div>
                    <div class="card-body">

                        <div class="table-responsive">

                            <table class="table settings">
                                <tr>
                                    <td class="align-middle w-25"><label for="status" class="form-label">{{ __('Status') }}</label></td>
                                    <td class="align-middle">
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox" wire:model="tool_status">
                                        </div>
                                    </td>
                                </tr>

                                <tr>
                                    <td class="align-middle"><label class="form-label">{{ __('Heading Align') }}</label></td>
                                    <td class="align-middle">
                                        <select class="form-control" wire:model="tool_align">
                                            <option value="start">{{ __('Left') }}</option>
                                            <option value="end">{{ __('Right') }}</option>
                                            <option value="center">{{ __('Center') }}</option>
                                        </select>
                                    </td>
                                </tr>

                                <tr>
                                    <td class="align-middle"><label class="form-label">{{ __('Heading Background') }}</label></td>
                                    <td class="align-middle">
                                        <select name="align" class="form-control" wire:model="tool_background">
                                            <optgroup label="{{ __('Base colors') }}">
                                                <option value="bg-white">{{ __('White') }}</option>
                                                <option value="bg-default">{{ __('Default') }}</option>
                                                <option value="bg-primary">{{ __('Primary') }}</option>
                                                <option value="bg-secondary">{{ __('Secondary') }}</option>
                                                <option value="bg-success">{{ __('Success') }}</option>
                                                <option value="bg-info">{{ __('Info') }}</option>
                                                <option value="bg-warning">{{ __('Warning') }}</option>
                                                <option value="bg-danger">{{ __('Danger') }}</option>
                                            </optgroup>
                                            <optgroup label="{{ __('Gradient colors') }}">
                                                <option value="bg-gradient-primary">{{ __('Primary') }}</option>
                                                <option value="bg-gradient-secondary">{{ __('Secondary') }}</option>
                                                <option value="bg-gradient-success">{{ __('Success') }}</option>
                                                <option value="bg-gradient-info">{{ __('Info') }}</option>
                                                <option value="bg-gradient-warning">{{ __('Warning') }}</option>
                                                <option value="bg-gradient-danger">{{ __('Danger') }}</option>
                                            </optgroup>
                                        </select>
                                    </td>
                                </tr>

                            </table>

                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">{{ __('Tool Name') }}</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">{{ __('Tool Slug') }}</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">{{ __('Page Type') }}</th>
                                        <th class="text-uppercase text-secondary text-xxs text-end font-weight-bolder opacity-7">{{ __('Popular') }}</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach ($pages as $index => $page)
                                        <tr>
                                            <td class="align-middle">
                                                <div class="d-flex px-2">
                                                    <div class="my-auto">
                                                        {{ ( empty( $page['custom_tool_link'] ) ) ? $page['tool_name'] : __('Custom Link'); }}
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="align-middle py-3">{{ ( empty( $page['custom_tool_link'] ) ) ? $page['slug'] : $page['custom_tool_link'] }}</td>
                                            <td class="align-middle">{{ $page['type'] }}</td>
                                            <td class="align-middle">
                                                <div class="form-check form-switch">
                                                    <input class="form-check-input ms-auto" type="checkbox" wire:model="pages.{{ $index }}.popular">
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
                        <div wire:loading wire:target="onUpdateSidebar">
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