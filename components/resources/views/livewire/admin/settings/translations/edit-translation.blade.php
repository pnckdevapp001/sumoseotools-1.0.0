<div>
    <!-- Validation Errors -->
    <x-auth-validation-errors class="mb-4" :errors="$errors" />
    
    <div class="row">
        <div class="col-12">

            <button class="btn bg-gradient-primary mb-3" data-bs-toggle="modal" data-bs-target="#addNewTranslation">{{ __('Add New Translation') }}</button>

            <div class="card">
                <div class="card-body">

                      <div class="alert alert-info bg-gradient-info" role="alert">
                          <strong>{{ __('You are translating :langNative language.', ['langNative' => $lang_name]) }}</strong>
                      </div>

                    <!-- begin:Form Search -->
                    <form id="formSearchTranslation">
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" wire:model="searchQuery" placeholder="{{ __('Search here...') }}">
                        </div>
                    </form>
                    <!-- end:Form Search -->

                    <div class="table-responsive">
                        <form wire:submit.prevent="onUpdateTranslation">
                            <div class="form-group">
                                <button class="btn bg-gradient-primary">
                                    <span>
                                        <div wire:loading wire:target="onUpdateTranslation">
                                            <x-loading />
                                        </div>
                                        <span>{{ __('Save Changes') }}</span>
                                    </span>
                                </button>
                            </div>

                            <table class="table">
                                <thead>
                                    <tr class="bg-gradient-success text-white">
                                        <th>{{ __('Default Text') }}</th>
                                        <th>{{ __('Translation') }}</th>
                                        <th></th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @if ( !empty($translations) )

                                        @foreach ($translations as $index => $translation)

                                        <tr>
                                            <td class="align-middle"><input type="text" class="form-control" wire:model.defer="translations.{{ $index }}.key" readonly></td>
                                            <td class="align-middle"><input type="text" class="form-control" wire:model.defer="translations.{{ $index }}.value" wire:ignore></td>
                                            <td class="align-middle"><a title="Delete" class="float-end cursor-pointer" wire:click="onDeleteTranslation({{ $translation['id'] }})"><i class="fas fa-trash"></i></a></td>
                                        </tr>
                                        @endforeach

                                    @else
                                        <tr><td class="align-middle">{{ __('No record found') }}</td></tr>
                                    @endif

                                </tbody>
                            </table>
                        </form>
                        
                    </div>
                </div>
            </div>

        </div>
    </div>

    <!-- Begin::Add New Translation -->
    <div class="modal fade" id="addNewTranslation" tabindex="-1" role="dialog" aria-labelledby="addNewTranslationLabel" aria-hidden="true">
       <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
             <div class="modal-header">
                <h5 class="modal-title" id="addNewTranslationModalLabel">{{ __('Add New Translation') }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
             </div>
            @livewire('admin.settings.translations.add-new-translation', ['lang_id' => Route::current()->parameter('lang_id') ])
          </div>
       </div>
    </div>
    <!-- End::Add New Translation -->

</div>
