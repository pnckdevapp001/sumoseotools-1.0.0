<div>
    <div class="card">
       <div class="table-responsive">
           <table class="table">
               <thead>
                   <tr>
                       <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">{{ __('Tool name') }}</th>
                       <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">{{ __('Client IP') }}</th>
                       <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">{{ __('Country') }}</th>
                       <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">{{ __('Date') }}</th>
                   </tr>
               </thead>
               <tbody>
                    @if ( $histories->isNotEmpty() )

                        @foreach ($histories as $history)

                            <tr>
                                <td class="align-middle">
                                    <div class="d-flex px-2">
                                        <div class="my-auto">
                                            {{ $history->tool_name }}
                                        </div>
                                    </div>
                                </td>
                                <td class="align-middle">{{ $history->client_ip }}</td>
                                <td class="align-middle">

                                    @if ( !empty( $history->flag ) && !empty( $history->country ) )
                                        <img src="{{ asset('assets/img/flags/' . $history->flag . '.png') }}" class="lang-menu me-1 my-auto">
                                        {{ $history->country }}
                                    @else
                                        {{ __('Unknown') }}
                                    @endif

                                </td>
                                <td class="align-middle">{{ $history->created_at }}</td>
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

        <div class="mx-auto mt-3">
            {{ $histories->links() }}
        </div>
    </div>                      
</div>
