<div>

    <!-- Validation Errors -->
    <x-auth-validation-errors class="mb-4" :errors="$errors" />
                    
    <div class="row">
        <div class="col-12">

            <button class="btn bg-gradient-primary mb-3" data-bs-toggle="modal" data-bs-target="#addNewLanguage"><i class="fas fa-plus fa-fw me-1"></i> {{ __('Add New Language') }}</button>

            <div class="card">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">{{ __('Language') }}</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">{{ __('Default') }}</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">{{ __('Status') }}</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">{{ __('Action') }}</th>
                            </tr>
                        </thead>

                        <tbody>
                            @if ( !empty($languages) )

                                @foreach ($languages as $language)
                                    <tr>
                                        <td class="align-middle">
                                            <div class="d-flex px-2">
                                                <div class="my-auto">
                                                    {{ $language['name'] }}
                                                </div>
                                            </div>
                                        </td>
                                        <td class="align-middle"><span class="badge bg-{{ ($language['default'] == true) ? 'success' : 'secondary' }}">{{ ($language['default'] == true) ? __('Yes') : __('No') }}</span></td>
                                        <td class="align-middle"><span class="badge bg-{{ ($language['status'] == true) ? 'success' : 'secondary' }}">{{ ($language['status'] == true) ? __('Enabled') : __('Disabled') }}</span></td>
                                        <td class="align-middle w-50 py-3">
                                            <a class="btn bg-gradient-success" title="{{ __('Set as Default') }}" wire:click="onSetDefault( {{ $language['id'] }} )">{{ __('Set as Default') }}</a>
                                            <a class="btn bg-gradient-primary" title="{{ __('Translations') }}" href="{{ route('edit-translations', $language['id'] ) }}"><i class="fas fa-language icon"></i> {{ __('Translations') }}</a>
                                            <a class="btn bg-gradient-info" title="{{ __('Edit') }}" wire:click="onShowEditLanguageModal( {{ $language['id'] }} )"><i class="fas fa-edit icon"></i> {{ __('Edit') }}</a>
                                            <a class="btn bg-gradient-danger" title="{{ __('Delete') }}" wire:click="onDeleteLanguageConfirm( {{ $language['id'] }} )"><i class="fas fa-trash icon"></i> {{ __('Delete') }}</a>
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
    </div>

    <!-- Begin::Add New Language -->
    <div class="modal fade" id="addNewLanguage" tabindex="-1" role="dialog" aria-labelledby="addNewLanguageLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="addNewLanguageModalLabel">{{ __('Add New Language') }}</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          
            @livewire('admin.settings.translations.add-new-language')

        </div>
      </div>
    </div>
    <!-- End::Add New Language -->

    <!-- Begin::Edit Language -->
    <div class="modal fade" id="editLanguage" tabindex="-1" role="dialog" aria-labelledby="editLanguageLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="editLanguageModalLabel">{{ __('Edit Language') }}</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>

            @livewire('admin.settings.translations.edit-language')

        </div>
      </div>
    </div>
    <!-- End::Edit Language -->

</div>