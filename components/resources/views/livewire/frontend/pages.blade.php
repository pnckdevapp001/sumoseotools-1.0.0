  <div class="page">
    <x-frontend.navbar :header="$header" :homeTitle="$homeTitle" :menus="$menus" :general="$general" />

    <main class="main">

        @if(Auth::user() && Auth::user()->email_verified_at == null)
            <div class="alert alert-warning mb-0 text-center text-white rounded-0 z-index-1" role="alert">
              {{ __('Your email address is not verified.') }} <a href="{{ route('verify-email') }}" class="alert-link text-white text-decoration-underline">{{ __('Verify it here!') }}</a>
            </div>
        @endif

        @if ( $general->parallax_status == true )
            <section id="parallax" class="text-white">
                <div class="position-relative overflow-hidden text-center bg-light">
                  <span class="mask" style="
                        @if ( $general->overlay_type == 'solid' )

                        background: {{ $general->solid_color }};opacity: {{ $general->opacity }};

                        @elseif( $general->overlay_type == 'gradient' )

                        background: {{ $general->gradient_first_color }};
                        background: -moz-linear-gradient( {{ $general->gradient_position }}, {{ $general->gradient_first_color }}, {{ $general->gradient_second_color }}  );
                        background: -webkit-linear-gradient( {{ $general->gradient_position }}, {{ $general->gradient_first_color }}, {{ $general->gradient_second_color }} );
                        background: linear-gradient( {{ $general->gradient_position }}, {{ $general->gradient_first_color }}, {{ $general->gradient_second_color }} );
                        opacity: {{ $general->opacity }};

                        @endif

                  "></span>

                  @if ( !empty($general->parallax_image) )
                    <div class="position-absolute start-0 top-0 w-100 parallax-image" style="background-image: url({{ $general->parallax_image }});filter: blur({{ $general->blur }}px);"></div>
                  @else
                    <div class="position-absolute start-0 top-0 w-100 parallax-image" style="background-image: url({{ asset('assets/img/parallax.jpg') }});filter: blur({{ $general->blur }}px);"></div>
                  @endif

                  <div class="container position-relative zindex-1">
                      <div class="col text-center p-lg-5 mx-auto my-5">

                          @if ( $page->ads_status == true && $advertisement->area1_status == true && $advertisement->area1 != null )
                            <x-frontend.advertisement.area1 :advertisement="$advertisement" />
                          @endif
                          <h1 class="text-white">{{ __($pageTrans->title) }}</h1>
                          <h4 class="lead text-white letter-normal my-3">{{ __($pageTrans->subtitle) }}</h4>

                          @if ( $page->ads_status == true && $advertisement->area2_status == true && $advertisement->area2 != null )
                            <x-frontend.advertisement.area2 :advertisement="$advertisement" />
                          @endif
                      </div>
                  </div>

                </div>
            </section>
        @endif

        <section>
            <div class="container py-4">
                <div class="row">
                    <div class="{{ ( $page->ads_status == true && ( ( $advertisement->sidebar_top_status == true && $advertisement->sidebar_top != null ) || ( $advertisement->sidebar_middle_status == true && $advertisement->sidebar_middle != null ) || ( $advertisement->sidebar_bottom_status == true && $advertisement->sidebar_bottom != null ) ) || $sidebar->tool_status == true || $sidebar->post_status == true ) ? 'col-lg-9' : 'col' }}">
                        @if ( $page->ads_status == true && $advertisement->area3_status == true && $advertisement->area3 != null )
                          <x-frontend.advertisement.area3 :advertisement="$advertisement" />
                        @endif

                        @if ( $page->type == 'home' )

                          @if ( $general->search_box_status == true )
                            <section id="search-box" class="mb-3">
                              <div class="input-group input-group-alternative">
                                  <span class="input-group-text"><i class="fas fa-search"></i></span>
                                  <input type="text" class="form-control search-input" wire:model="searchQuery" placeholder="{{ __('Search for your tool') }}" />
                              </div>

                              @if ( !empty($search_queries) && !empty($searchQuery) )
                                <div class="card mb-3 overflow-auto" style="max-height: 18rem">
                                  <div class="card-body pb-0">
                                    <div class="row">
                                        @foreach ($search_queries as $key => $value)
                                          <div class="col-12 col-md-6 col-lg-4 mb-3">
                                              <a class="card text-decoration-none cursor-pointer item-box" href="{{ (empty($value['custom_tool_link'])) ? route('home') . '/' . $value['slug'] : $value['custom_tool_link'] }}" {{ (empty($value['custom_tool_link'])) ? "" : 'target=_blank' }}>
                                                  <div class="card-body">
                                                      <div class="d-flex align-items-center">
                                                          <img class="avatar rounded-0" src="{{ ($value['icon_image']) ? $value['icon_image'] : asset('assets/img/no-thumb.svg') }}"></span>
                                                          <div class="name ps-3">
                                                              <div class="font-weight-medium">{{ $value['title'] }}</div>
                                                          </div>
                                                      </div>
                                                   </div>
                                              </a>
                                          </div>
                                        @endforeach
                                    </div>
                                  </div>
                                </div>
                              @endif

                            </section>
                          @endif

                          <section id="tools-box">
                                @if ( !empty($tool_with_categories) )

                                      @foreach ($tool_with_categories as $key => $value)
                                       <div class="card mb-3">
                                          <div class="d-block card-header category-box text-{{ $value['align'] }} {{ ($value['background'] == 'bg-white') ? $value['background'] : $value['background'] . ' text-white'}}">
                                            <h5 class="{{ ($value['background'] == 'bg-white') ? 'text-dark' : 'text-white'}}">{{ __($value['title']) }}</h5>
                                            <p class="text-sm mb-0">{{ __($value['description']) }}</p>
                                          </div>
                                          <div class="card-body pb-0">
                                                <div class="row">
                                                    @foreach ($value['pages'] as $key2 => $value2)
                                                      <div class="col-12 col-md-6 col-lg-4 mb-3">
                                                          <a class="card text-decoration-none cursor-pointer item-box" href="{{ (empty($value2['custom_tool_link'])) ? route('home') . '/' . $value2['slug'] : $value2['custom_tool_link'] }}" {{ (empty($value2['custom_tool_link'])) ? "" : 'target=_blank' }}>
                                                              <div class="card-body">
                                                                  <div class="d-flex align-items-center">
                                                                      <img class="avatar rounded-0" src="{{ ($value2['icon_image']) ? $value2['icon_image'] : asset('assets/img/no-thumb.svg') }}"></span>
                                                                      <div class="name ps-3">
                                                                          <div class="font-weight-medium">{{ $value2['title'] }}</div>
                                                                      </div>
                                                                  </div>
                                                              </div>
                                                          </a>
                                                      </div>
                                                    @endforeach
                                                </div>
                                          </div>
                                        </div>
                                      @endforeach

                                @else

                                    <div class="row">
                                      @foreach ($tools as $key => $value)
                                        <div class="col-12 col-md-6 col-lg-4 mb-3">
                                            <a class="card text-decoration-none cursor-pointer item-box" href="{{ ( empty( $value['custom_tool_link'] ) ) ? route('home') . '/' . $value['slug'] : $value['custom_tool_link'] }}" {{ (empty($value['custom_tool_link'])) ? "" : 'target=_blank' }}>
                                              <div class="card-body">
                                                  <div class="d-flex align-items-center">
                                                      <img class="avatar rounded-0" src="{{ ($value['icon_image']) ? $value['icon_image'] : asset('assets/img/no-thumb.svg') }}"></span>
                                                      <div class="name ps-3">
                                                          <div class="font-weight-medium">{{ $value['title'] }}</div>
                                                      </div>
                                                  </div>
                                               </div>
                                            </a>
                                        </div>
                                      @endforeach
                                    </div>
                                @endif
                          </section>

                        @endif

                            <section id="content-box" class="mb-3 page-{{ $page->id }}">

                                @if ( $page->type == 'tool')
                                  <div class="card mb-3">
                                    <div class="card-body">

                                      @switch($page->tool_name)

                                          @case('Keywords Suggestion Tool')
                                                @livewire('frontend.tools.keywords-suggestion-tool')
                                              @break
                                              
                                          @case('Adsense Calculator')
                                                @livewire('frontend.tools.adsense-calculator')
                                              @break
                                              
                                          @case('WordPress Theme Detector')
                                                @livewire('frontend.tools.wordpress-theme-detector')
                                              @break

                                          @case('Credit Card Validator')
                                                @livewire('frontend.tools.credit-card-validator')
                                              @break
                                              
                                          @case('Credit Card Generator')
                                                @livewire('frontend.tools.credit-card-generator')
                                              @break

                                          @case('URL Opener')
                                                @livewire('frontend.tools.url-opener')
                                              @break

                                          @case('Page Size Checker')
                                                @livewire('frontend.tools.page-size-checker')
                                              @break

                                          @case('Screen Resolution Simulator')
                                                @livewire('frontend.tools.screen-resolution-simulator')
                                              @break
                                              
                                          @case('What Is My Screen Resolution')
                                                @livewire('frontend.tools.what-is-my-screen-resolution')
                                              @break

                                          @case('Twitter Card Generator')
                                                @livewire('frontend.tools.twitter-card-generator')
                                              @break

                                          @case('Get HTTP Headers')
                                                @livewire('frontend.tools.get-http-headers')
                                              @break

                                          @case('Open Graph Generator')
                                                @livewire('frontend.tools.open-graph-generator')
                                              @break

                                          @case('Open Graph Checker')
                                                @livewire('frontend.tools.open-graph-checker')
                                              @break

                                          @case('What Is My User Agent')
                                                @livewire('frontend.tools.what-is-my-user-agent')
                                              @break

                                          @case('What Is My Browser')
                                                @livewire('frontend.tools.what-is-my-browser')
                                              @break
                                              
                                          @case('Hosting Checker')
                                                @livewire('frontend.tools.hosting-checker')
                                              @break

                                          @case('Server Status Checker')
                                                @livewire('frontend.tools.server-status-checker')
                                              @break

                                          @case('Moz Rank Checker')
                                                @livewire('frontend.tools.moz-rank-checker')
                                              @break

                                          @case('Meta Tags Analyzer')
                                                @livewire('frontend.tools.meta-tags-analyzer')
                                              @break

                                          @case('Meta Tag Generator')
                                                @livewire('frontend.tools.meta-tag-generator')
                                              @break

                                          @case('Whois Domain Lookup')
                                                @livewire('frontend.tools.whois-domain-lookup')
                                              @break

                                          @case('Htaccess Redirect Generator')
                                                @livewire('frontend.tools.htaccess-redirect-generator')
                                              @break

                                          @case('DA PA Checker')
                                                @livewire('frontend.tools.da-pa-checker')
                                              @break
                                              
                                          @case('Page Authority Checker')
                                                @livewire('frontend.tools.page-authority-checker')
                                              @break

                                          @case('Domain Authority Checker')
                                                @livewire('frontend.tools.domain-authority-checker')
                                              @break

                                          @case('Domain Age Checker')
                                                @livewire('frontend.tools.domain-age-checker')
                                              @break

                                          @case('HTTP Status Code Checker')
                                                @livewire('frontend.tools.http-status-code-checker')
                                              @break

                                          @case('Domain to IP')
                                                @livewire('frontend.tools.domain-to-ip')
                                              @break

                                          @case('Robots.txt Generator')
                                                @livewire('frontend.tools.robots-txt-generator')
                                              @break

                                          @case('Google Cache Checker')
                                                @livewire('frontend.tools.google-cache-checker')
                                              @break

                                          @case('Google Index Checker')
                                                @livewire('frontend.tools.google-index-checker')
                                              @break

                                          @case('Alexa Rank Checker')
                                                @livewire('frontend.tools.alexa-rank-checker')
                                              @break

                                          @case('Keyword Density Checker')
                                                @livewire('frontend.tools.keyword-density-checker')
                                              @break
                                              
                                          @default
                                      @endswitch
                                      
                                    </div>
                                  </div>
                                @endif
                        
                                @if ( !empty($related_tools) && $general->related_tools == true && $page->type == 'tool' )
                                    <section>
                                        <div class="card mb-3">
                                            <div class="d-block card-header related-tools-box text-start bg-gradient-primary text-white">
                                              <h6 class="text-white mb-0">{{ __('Related Tools') }}</h6>
                                            </div>
                                            <div class="card-body">
                                                <div class="row">
                                                  @foreach ($related_tools as $key => $value)
                                                    <div class="col-12 col-md-6 col-lg-4 mb-3">
                                                        <a class="card text-decoration-none cursor-pointer item-box" href="{{ ( empty( $value['custom_tool_link'] ) ) ? route('home') . '/' . $value['slug'] : $value['custom_tool_link'] }}" {{ (empty($value['custom_tool_link'])) ? "" : 'target=_blank' }}>
                                                          <div class="card-body">
                                                              <div class="d-flex align-items-center">
                                                                  <img class="avatar rounded-0" src="{{ ($value['icon_image']) ? $value['icon_image'] : asset('assets/img/no-thumb.svg') }}"></span>
                                                                  <div class="name ps-3">
                                                                      <div class="font-weight-medium">{{ $value['title'] }}</div>
                                                                  </div>
                                                              </div>
                                                           </div>
                                                        </a>
                                                    </div>
                                                  @endforeach
                                              </div>
                                            </div>
                                        </div>
                                    </section>
                                @endif

                                <div class="card">
                                    @if ( $general->parallax_status == false )
                                        <div class="card-header d-block">
                                              <h1 class="page-title">{{ __($pageTrans->title) }}</h1>
                                              <p class="mb-0">{{ __($pageTrans->subtitle) }}</p>
                                        </div>
                                    @endif

                                    <div class="card-body {{ ($general->author_box_status == true) ? 'pb-0' : ''}}">
                                        @if ( Auth::user() && Auth::user()->is_admin == 1 )
                                          <div class="d-flex justify-content-center mb-3">
                                            <a href="{{ localization()->getLocalizedURL($pageTrans->locale, route('edit-page-translations', $pageTrans->translations[0]['id']), [], true) }}" class="btn bg-gradient-primary">{{ __('Edit Page') }}</a>
                                          </div>
                                        @endif

                                        @if ( $page->ads_status == true && $advertisement->area4_status == true && $advertisement->area4 != null )
                                          <x-frontend.advertisement.area4 :advertisement="$advertisement" />
                                        @endif

                                        {!! $pageTrans->description !!}

                                        @if ( $page->ads_status == true && $advertisement->area5_status == true && $advertisement->area5 != null )
                                          <x-frontend.advertisement.area5 :advertisement="$advertisement" />
                                        @endif

                                        @switch( $page->type )

                                            @case('report')
                                                  @livewire('frontend.report')
                                                @break

                                            @case('contact')
                                                  @livewire('frontend.contact')
                                                @break

                                            @default
                                        @endswitch

                                      @if ( $general->share_icons_status == true )
                                        <div class="social-share text-center">
                                          <div class="is-divider"></div>
                                          <div class="share-icons relative">

                                              <a wire:ignore href="https://www.facebook.com/sharer.php?u={{ ($page->type == 'home') ? route('home') : route('page', $page->slug ) }}"
                                                  onclick="window.open('https://www.facebook.com/sharer/sharer.php?u={{ ($page->type == 'home') ? route('home') : route('page', $page->slug ) }}','facebook','height=500,width=800,resizable=1,scrollbars=yes'); return false;"
                                                  data-label="Facebook"
                                                  rel="noopener noreferrer nofollow"
                                                  target="_blank"
                                                  class="btn btn-facebook btn-icon-only">
                                                  <span class="btn-inner--icon"><i class="fab fa-facebook"></i></span>
                                              </a>

                                              <a wire:ignore href="https://twitter.com/share?url={{ ($page->type == 'home') ? route('home') : route('page', $page->slug ) }}"
                                                  onclick="window.open('https://twitter.com/share?url={{ ($page->type == 'home') ? route('home') : route('page', $page->slug ) }}','twitter','height=500,width=800,resizable=1,scrollbars=yes'); return false;"
                                                  rel="noopener noreferrer nofollow"
                                                  target="_blank"
                                                  class="btn btn-twitter btn-icon-only">
                                                  <span class="btn-inner--icon"><i class="fab fa-twitter"></i></span>
                                              </a>

                                              <a wire:ignore href="https://www.pinterest.com/pin-builder/?url={{ ($page->type == 'home') ? route('home') : route('page', $page->slug ) }}&media={{ $page->featured_image }}&description={{ str_replace(' ', '%20', $pageTrans->title) }}"
                                                  onclick="window.open('https://www.pinterest.com/pin-builder/?url={{ ($page->type == 'home') ? route('home') : route('page', $page->slug ) }}&media={{ $page->featured_image }}&description={{ str_replace(' ', '%20', $pageTrans->title) }}','pinterest','height=500,width=800,resizable=1,scrollbars=yes'); return false;"
                                                  rel="noopener noreferrer nofollow"
                                                  target="_blank"
                                                  class="btn btn-pinterest btn-icon-only">
                                                  <span class="btn-inner--icon"><i class="fab fa-pinterest"></i></span>
                                              </a>

                                              <a wire:ignore href="https://www.linkedin.com/sharing/share-offsite/?url={{ ($page->type == 'home') ? route('home') : route('page', $page->slug ) }}"
                                                  onclick="window.open('https://www.linkedin.com/sharing/share-offsite/?url={{ ($page->type == 'home') ? route('home') : route('page', $page->slug ) }}','linkedin','height=500,width=800,resizable=1,scrollbars=yes'); return false;"
                                                  rel="noopener noreferrer nofollow"
                                                  target="_blank"
                                                  class="btn btn-linkedin btn-icon-only">
                                                  <span class="btn-inner--icon"><i class="fab fa-linkedin"></i></span>
                                              </a>

                                              <a wire:ignore href="https://www.reddit.com/submit?url={{ ($page->type == 'home') ? route('home') : route('page', $page->slug ) }}&title={{ str_replace(' ', '%20', $pageTrans->title) }}"
                                                  onclick="window.open('https://www.reddit.com/submit?url={{ ($page->type == 'home') ? route('home') : route('page', $page->slug ) }}&title={{ str_replace(' ', '%20', $pageTrans->title) }}','reddit','height=500,width=800,resizable=1,scrollbars=yes'); return false;"
                                                  rel="noopener noreferrer nofollow"
                                                  target="_blank"
                                                  class="btn btn-reddit btn-icon-only">
                                                  <span class="btn-inner--icon"><i class="fab fa-reddit"></i></span>
                                              </a>

                                              <a wire:ignore href="https://tumblr.com/widgets/share/tool?canonicalUrl={{ ($page->type == 'home') ? route('home') : route('page', $page->slug ) }}"
                                                  onclick="window.open('https://tumblr.com/widgets/share/tool?canonicalUrl={{ ($page->type == 'home') ? route('home') : route('page', $page->slug ) }}','tumblr','height=500,width=800,resizable=1,scrollbars=yes'); return false;"
                                                  target="_blank"
                                                  class="btn btn-tumblr btn-icon-only"
                                                  rel="noopener noreferrer nofollow">
                                                  <span class="btn-inner--icon"><i class="fab fa-tumblr"></i></span>
                                              </a>

                                          </div>
                                        </div>
                                      @endif

                                      @if ( $general->author_box_status == true )

                                        <hr class="horizontal dark">
                                        <div class="my-3">
                                          <div class="row">

                                            <div class="col-lg-2">
                                                <div class="position-relative mb-3">
                                                  <div class="blur-shadow-image">
                                                    <img class="w-100 rounded-3 shadow-sm" src="{{ $profile->avatar }}">
                                                  </div>
                                                </div>
                                            </div>

                                            <div class="col-lg-10 ps-0">
                                              <div class="card-body text-start py-0">

                                                <div class="p-md-0 pt-3">
                                                  <h5>{{ $profile->fullname }}</h5>
                                                  <p class="text-uppercase text-sm font-weight-bold mb-2">{{ $profile->position }}</p>
                                                </div>

                                                <p class="mb-3">{{ __($profile->bio) }}</p>

                                                @if ( ($profile->social_status == true) && !empty($profile->user_socials) )

                                                  @foreach ($profile->user_socials as $element)

                                                    <a class="btn btn-{{ $element->name }} btn-icon-only rounded-circle btn-sm" href="{{ $element->url }}" target="blank">
                                                      <i class="fab fa-{{ $element->name }}" aria-hidden="true"></i>
                                                    </a>

                                                  @endforeach

                                                @endif

                                              </div>
                                            </div>

                                          </div>
                                        </div>

                                      @endif

                                    </div>
                                </div>
                            </section>
                    </div>

                    @if ( $page->ads_status == true && ( ( $advertisement->sidebar_top_status == true && $advertisement->sidebar_top != null ) || ( $advertisement->sidebar_middle_status == true && $advertisement->sidebar_middle != null ) || ( $advertisement->sidebar_bottom_status == true && $advertisement->sidebar_bottom != null ) ) || $sidebar->tool_status == true || $sidebar->post_status == true)
                      <div class="col-lg-3 ml-auto">
                          <x-frontend.sidebar :page="$page" :advertisement="$advertisement" :sidebar="$sidebar" :recentPosts="$recent_posts" :popularTools="$popular_tools" />
                      </div>
                    @endif

                </div>
            </div>

        </section>
    </main>

    <x-frontend.footer :footer="$footer" :general="$general" :socials="$socials" />

    <!-- Theme JS -->
    <script src="{{ asset('assets/js/main.min.js') }}"></script>

    @if ( $captcha->status == true && !empty($captcha->site_key ) && !empty($captcha->secret_key ) )
      <script src="https://www.google.com/recaptcha/api.js?render={{ $captcha->site_key }}"></script>
    @endif

    @if ( $general->back_to_top == true )
        <!-- Scroll back to top -->
        <div id="backtotop"> 
            <a href="javascript:void(0)" class="backtotop"></a> 
        </div>

        <script type="text/javascript"> 
            jQuery(document).ready(function ($) {
                $("#backtotop").hide(); 
                $(window).scroll(function () { 
                    if ($(this).scrollTop() > 500) { 
                        $('#backtotop').fadeIn(); 
                    } else { 
                        $('#backtotop').fadeOut(); 
                    } 
                });   
            });

            jQuery('.backtotop').click(function () { 
                jQuery('html, body').animate({ 
                    scrollTop: 0 
                }, 'slow'); 
            });
        </script> 
        <!-- End of Scroll back to top -->
    @endif

    @if ( $general->adblock_detection == true )

      <!-- Sweetalert2 -->
      <script src="{{ asset('assets/js/sweetalert2.min.js') }}"></script>

      <script src="{{ asset('assets/js/prebid-ads.js') }}"></script>

      <script>
      (function( $ ) {
        "use strict";

              if( window.canRunAds === undefined ){
                  Swal.fire({
                    title: "{{ __('You\'re blocking ads') }}",
                    text: "{{ __('Our website is made possible by displaying online ads to our visitors. Please consider supporting us by disabling your ad blocker.') }}",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: "{{ __('I have disabled Adblock') }}",
                    cancelButtonText: "{{ __('No, thanks!') }}"
                  }).then((result) => {
                    if (result.isConfirmed) {
                      window.location.reload();
                    }
                  });
              }

      })( jQuery );
      </script>

    @endif

    @if (Cookie::get('cookies') == null)

      @if ( $notice->status == true )

              <div class="row cookies-wrapper alert {{ $notice->background }}" role="alert">
                <div class="col-md-12 col-lg-{{ ($notice->button == true) ? '10' : '12'}} my-auto {{ $notice->align }}">
                  {!! __(GrahamCampbell\Security\Facades\Security::clean($notice->notice)) !!}
                </div>

                @if ( $notice->button == true)
                  <div class="col-md-12 col-lg-2 my-auto text-end p-2">
                      <button id="acceptCookies" target="_blank" class="btn btn-sm bg-white mb-0 text-capitalize"> {{ __('Accept all cookies') }} </button>
                  </div>
                @endif
                <button type="button" class="btn-close text-white" data-bs-dismiss="alert" aria-label="Close">x</button>
              </div>

          <script>
             (function( $ ) {
                "use strict";

                    jQuery("#acceptCookies").click(function(){
                        jQuery.ajax({
                            type : 'get',
                            url : '{{ url('/') }}/cookies/accept',
                            success: function(e) {
                                jQuery('.cookies-wrapper').remove();
                            }
                        });
                    });

            })( jQuery );
          </script>
      @endif

    @endif

    @if ( $general->dir_mode == true )
        <script>
           (function( $ ) {
              "use strict";

                  jQuery(".btn-toggle-dir").click(function(){
                      jQuery.ajax({
                          type : 'get',
                          url : '{{ url('/') }}/dir/mode',
                          success: function(e) {
                              window.location.reload();
                          }
                      });
                  });

          })( jQuery );
        </script>
      @endif

    @if ( $general->theme_mode == true )
      <script>
         (function( $ ) {
            "use strict";

                jQuery(".btn-toggle-mode").click(function(){
                    jQuery.ajax({
                        type : 'get',
                        url : '{{ url('/') }}/theme/mode',
                        success: function(e) {
                            window.location.reload();
                        }
                    });
                });

        })( jQuery );
      </script>
    @endif

    <script>
        function copyToClipboard() {
          document.getElementById("text").select();
          document.execCommand('copy');
        }
    </script>

    @if ( $advanced->footer_status == true && $advanced->insert_footer != null )
      {!! $advanced->insert_footer !!}
    @endif

  </div>