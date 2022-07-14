<div>

      <form wire:submit.prevent="onRobotsTxtGenerator">

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <div class="row">

            <div class="form-group mb-3 row">
              <label class="form-label col-3 col-form-label">{{ __('Default - All Robots are') }}</label>
              <div class="col">
                <select wire:model="all_robots" class="form-control">
                    <option value=" ">{{ __('Allow') }}</option>
                    <option value=" /">{{ __('Disallow') }}</option>
                </select>
              </div>
            </div>

            <div class="form-group mb-3 row">
              <label class="form-label col-3 col-form-label">{{ __('Crawl-Delay') }}</label>
              <div class="col">
                <select wire:model="delay" class="form-control">
                    <option value>{{ __('Default - No Delay') }}</option>
                    <option value="5">{{ __('5') }} {{ __('Seconds') }}</option>
                    <option value="10">{{ __('10') }} {{ __('Seconds') }}</option>
                    <option value="20">{{ __('20') }} {{ __('Seconds') }}</option>
                    <option value="60">{{ __('60') }} {{ __('Seconds') }}</option>
                    <option value="120">{{ __('120') }} {{ __('Seconds') }}</option>
                </select>
              </div>
            </div>

            <div class="form-group mb-3 row">
              <label class="form-label col-3 col-form-label">{{ __('Sitemap') }}</label>
              <div class="col">
                <input type="text" wire:model="sitemap" class="form-control" placeholder="https://www.example.com/sitemap.xml">
                <small class="text-sm">{{ __('Leave blank if you don\'t have.') }}</small>
              </div>
            </div>

            <div class="form-group mb-3 row">
              <label class="form-label col-3 col-form-label">{{ __('Search Robots:') }}</label>
              <div class="col">

                <table class="table border-none table-hover">
                    <tbody>
                        <tr>
                            <td class="align-middle">{{ __('Google') }}</td>
                            <td>
                                <select wire:model="google" class="form-control">
                                    <option value>{{ __('Same as Default') }}</option>
                                    <option value=" ">{{ __('Allow') }}</option>
                                    <option value=" /">{{ __('Disallow') }}</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td class="align-middle">{{ __('Google Image') }}</td>
                            <td>
                                <select wire:model="google_image" class="form-control">
                                    <option value>{{ __('Same as Default') }}</option>
                                    <option value=" ">{{ __('Allow') }}</option>
                                    <option value=" /">{{ __('Disallow') }}</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td class="align-middle">{{ __('Google Mobile') }}</td>
                            <td>
                                <select wire:model="google_mobile" class="form-control">
                                    <option value>{{ __('Same as Default') }}</option>
                                    <option value=" ">{{ __('Allow') }}</option>
                                    <option value=" /">{{ __('Disallow') }}</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td class="align-middle">{{ __('MSN Search') }}</td>
                            <td>
                                <select wire:model="msn_search" class="form-control">
                                    <option value>{{ __('Same as Default') }}</option>
                                    <option value=" ">{{ __('Allow') }}</option>
                                    <option value=" /">{{ __('Disallow') }}</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td class="align-middle">{{ __('Yahoo') }}</td>
                            <td>
                                <select wire:model="yahoo" class="form-control">
                                    <option value>{{ __('Same as Default') }}</option>
                                    <option value=" ">{{ __('Allow') }}</option>
                                    <option value=" /">{{ __('Disallow') }}</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td class="align-middle">{{ __('Yahoo MM') }}</td>
                            <td>
                                <select wire:model="yahoo_mm" class="form-control">
                                    <option value>{{ __('Same as Default') }}</option>
                                    <option value=" ">{{ __('Allow') }}</option>
                                    <option value=" /">{{ __('Disallow') }}</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td class="align-middle">{{ __('Yahoo Blogs') }}</td>
                            <td>
                                <select wire:model="yahoo_blogs" class="form-control">
                                    <option value>{{ __('Same as Default') }}</option>
                                    <option value=" ">{{ __('Allow') }}</option>
                                    <option value=" /">{{ __('Disallow') }}</option>
                                </select>
                            </td>
                        </tr>

                        <tr>
                            <td class="align-middle">{{ __('Ask/Teoma') }}</td>
                            <td>
                                <select wire:model="ask_teoma" class="form-control">
                                    <option value>{{ __('Same as Default') }}</option>
                                    <option value=" ">{{ __('Allow') }}</option>
                                    <option value=" /">{{ __('Disallow') }}</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td class="align-middle">{{ __('GigaBlast') }}</td>
                            <td>
                                <select wire:model="gigablast" class="form-control">
                                    <option value>{{ __('Same as Default') }}</option>
                                    <option value=" ">{{ __('Allow') }}</option>
                                    <option value=" /">{{ __('Disallow') }}</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td class="align-middle">{{ __('DMOZ Checker') }}</td>
                            <td>
                                <select wire:model="dmoz_checker" class="form-control">
                                    <option value>{{ __('Same as Default') }}</option>
                                    <option value=" ">{{ __('Allow') }}</option>
                                    <option value=" /">{{ __('Disallow') }}</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td class="align-middle">{{ __('Nutch') }}</td>
                            <td>
                                <select wire:model="nutch" class="form-control">
                                    <option value>{{ __('Same as Default') }}</option>
                                    <option value=" ">{{ __('Allow') }}</option>
                                    <option value=" /">{{ __('Disallow') }}</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td class="align-middle">{{ __('Alexa/Wayback') }}</td>
                            <td>
                                <select wire:model="alexa" class="form-control">
                                    <option value>{{ __('Same as Default') }}</option>
                                    <option value=" ">{{ __('Allow') }}</option>
                                    <option value=" /">{{ __('Disallow') }}</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td class="align-middle">{{ __('Baidu') }}</td>
                            <td>
                                <select wire:model="baidu" class="form-control">
                                    <option value>{{ __('Same as Default') }}</option>
                                    <option value=" ">{{ __('Allow') }}</option>
                                    <option value=" /">{{ __('Disallow') }}</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td class="align-middle">{{ __('Naver') }}</td>
                            <td>
                                <select wire:model="naver" class="form-control">
                                    <option value>{{ __('Same as Default') }}</option>
                                    <option value=" ">{{ __('Allow') }}</option>
                                    <option value=" /">{{ __('Disallow') }}</option>
                                </select>
                            </td>
                        </tr>

                        <tr>
                            <td class="align-middle">{{ __('MSN PicSearch') }}</td>
                            <td>
                                <select wire:model="msb_picpearch" class="form-control">
                                    <option value>{{ __('Same as Default') }}</option>
                                    <option value=" ">{{ __('Allow') }}</option>
                                    <option value=" /">{{ __('Disallow') }}</option>
                                </select>
                            </td>
                        </tr>
                    </tbody>
                </table>

              </div>
            </div>

            <div class="form-group mb-3 row">
              <label class="form-label col-3 col-form-label">{{ __('Disallow Folders') }}</label>
              <div class="col">
                <small class="text-sm">{{ __('The path is relative to the root and must contain a trailing slash "/".') }}</small>
                <div class="col mb-3">
                    <div class="input-group input-group-flat">
                        <input type="text" class="form-control" wire:model="folders.0" placeholder="/cgi-bin/">
                        @error('folders.0') <span class="error">{{ $message }}</span> @enderror
                        <span class="input-group-text bg-white">
                            <button class="btn btn-sm btn-icon bg-gradient-success mb-0" wire:click.prevent="onAddFolder( {{ $i }} )" title="{{ __('Add new') }}">
                                <i class="fas fa-plus fa-fw "></i>
                            </button>
                        </span>
                    </div>
                </div>

                @foreach($inputs as $key => $value)
                        <div class="col mb-3">
                            <div class="input-group input-group-flat">
                                <input type="text" class="form-control" wire:model="folders.{{ $value }}" placeholder="/cgi-bin/">
                                @error( 'folders.' . $value ) <span class="error">{{ $message }}</span> @enderror
                                <span class="input-group-text bg-white">
                                    <button class="btn btn-sm btn-icon bg-gradient-danger mb-0" wire:click.prevent="onDeleteFolder({{ $key }})" title="{{ __('Delete') }}">
                                        <i class="fas fa-trash fa-fw "></i>
                                    </button>
                                </span>
                            </div>
                        </div>
                @endforeach

              </div>
            </div>

            <div class="form-group">
                <button class="btn bg-gradient-info mx-auto d-block" id="create" wire:loading.attr="disabled">
                    <span>
                        <div wire:loading.inline wire:target="onRobotsTxtGenerator">
                            <x-loading />
                        </div>
                        <span wire:target="onRobotsTxtGenerator">{{ __('Generate') }}</span>
                    </span>
                </button>
            </div>
        </div>

        @if ( !empty($data) )
            <div class="form-group position-relative mb-3">
              <textarea id="textbox" class="form-control" rows="10" readonly>{{ $data }}</textarea>
              <a onclick="saveTextAsFile('robots.txt')" class="btn bg-gradient-primary btn-sm cursor-pointer position-absolute top-0 end-0 m-2">
                  {{ __('Export Robots.txt') }}
              </a>
            </div>
        @endif

      </form>
</div>

<script>
    function saveTextAsFile(fileNameToSaveAs)
    {
        var textbox = document.getElementById('textbox');

        var textFileAsBlob = new Blob([textbox.value], {type:'text/plain'}); 

        var downloadLink = document.createElement("a");

        downloadLink.download = fileNameToSaveAs;

        if (window.webkitURL != null) {
            // Chrome allows the link to be clicked
            // without actually adding it to the DOM.
            downloadLink.href = window.webkitURL.createObjectURL(textFileAsBlob);
        } else {
            // Firefox requires the link to be added to the DOM
            // before it can be clicked.
            downloadLink.href = window.URL.createObjectURL(textFileAsBlob);
            downloadLink.onclick = destroyClickedElement;
            downloadLink.style.display = "none";
            document.body.appendChild(downloadLink);
        }

        downloadLink.click();
    }
</script>