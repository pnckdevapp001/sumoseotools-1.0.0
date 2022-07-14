@if ( $page->ads_status == true && $advertisement->sidebar_top_status == true && $advertisement->sidebar_top != null )
    <div class="mb-3">
        <x-frontend.advertisement.sidebar-top :advertisement="$advertisement" /> 
    </div>
@endif

@if ( $sidebar->tool_status == true )
    <div class="card mb-3">
        <div class="card-header d-block text-{{ $sidebar->tool_align }} {{ ($sidebar->tool_background == 'bg-white') ? $sidebar->tool_background : $sidebar->tool_background . ' text-white' }}">
            <h6 class="text-white mb-0">{{ __('Popular Tools') }}</h6>
        </div>
        <div class="list-group list-group-flush list-group-hoverable">

            @foreach ($popularTools  as $key => $value)
                <div class="list-group-item">
                    <div class="row align-items-center">
                        <div class="col d-flex">
                            <span>
                                <i class="fas fa-check text-success me-2"></i>
                            </span>
                            <a href="{{ ( empty( $value['custom_tool_link'] ) ) ? route('home') . '/' . $value['slug'] : $value['custom_tool_link'] }}" {{ (empty($value['custom_tool_link'])) ? "" : 'target=_blank' }} class="text-body d-block">{{ $value['title'] }}</a>
                        </div>
                    </div>
                </div>
            @endforeach

        </div>
    </div>
@endif

@if ( $page->ads_status == true && $advertisement->sidebar_middle_status == true && $advertisement->sidebar_middle != null )
    <div class="mb-3">
        <x-frontend.advertisement.sidebar-middle :advertisement="$advertisement" />
    </div>
@endif

@if ( $sidebar->post_status == true )
    <div class="card mb-3">
        <div class="card-header d-block text-{{ $sidebar->post_align }} {{ ($sidebar->post_background == 'bg-white') ? $sidebar->post_background : $sidebar->post_background . ' text-white' }}">
            <h6 class="text-white mb-0">{{ __('Recent Posts') }}</h6>
        </div>
        <div class="list-group list-group-flush list-group-hoverable">
            
            @foreach ($recentPosts as $key => $value)
                @if ( $loop->index <= $sidebar->post_count - 1 )
                    <div class="list-group-item">
                      <div class="d-flex align-items-center">
                          <img class="avatar" src="{{ $value['featured_image'] }}">
                          <div class="name ps-3">
                            <a href="{{ route('home') . '/' . $value['slug'] }}" class="text-body d-block text-nowrap" title="{{ $value['title'] }}">{{ $value['title'] }}</a>
                            <small class="d-block text-muted text-truncate mt-n1">{{ \Carbon\Carbon::parse( ($value['updated_at']) ? $value['updated_at'] : $value['created_at'] )->format('F j, Y') }}</small>
                          </div>
                      </div>
                    </div>
                @endif
            @endforeach
        </div>
    </div>
@endif

@if ( $page->ads_status == true && $advertisement->sidebar_bottom_status == true && $advertisement->sidebar_bottom != null )
    <div class="mb-3">
        <x-frontend.advertisement.sidebar-bottom :advertisement="$advertisement" />
    </div>
@endif