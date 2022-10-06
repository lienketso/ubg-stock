<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family={{ urlencode(theme_option('font_text', 'Lato')) }}:ital,wght@0,400;0,700;1,400;1,700&family={{ urlencode(theme_option('font_heading', 'Quicksand')) }}:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- Google Tag Manager -->
    <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
				new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
			j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
			'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
		})(window,document,'script','dataLayer','GTM-NZ3X2F8');</script>
    <!-- End Google Tag Manager -->


    <style>
        :root {
            --font-text: {{ theme_option('font_text', 'Lato') }}, sans-serif;
            --font-heading: {{ theme_option('font_heading', 'Quicksand') }}, sans-serif;
            --color-brand: {{ theme_option('color_brand', '#3BB77E') }};
            --color-brand-rgb: {{ hex_to_rgb(theme_option('color_brand', '#3BB77E')) }};
            --color-brand-dark: {{ theme_option('color_brand_dark', '#29A56C') }};
            --color-brand-2: {{ theme_option('color_brand_2', '#FDC040') }};
            --color-primary: {{ theme_option('color_primary', '#5a97fa') }};
            --color-secondary: {{ theme_option('color_secondary', '#3e5379') }};
            --color-warning: {{ theme_option('color_warning', '#ff9900') }};
            --color-danger: {{ theme_option('color_danger', '#FD6E6E') }};
            --color-success: {{ theme_option('color_success', '#81B13D') }};
            --color-info: {{ theme_option('color_info', '#2cc1d8') }};
            --color-text: {{ theme_option('color_text', '#7E7E7E') }};
            --color-heading: {{ theme_option('color_heading', '#253D4E') }};
            --color-grey-1: {{ theme_option('color_grey_1', '#253D4E') }};
            --color-grey-2: {{ theme_option('color_grey_2', '#242424') }};
            --color-grey-4: {{ theme_option('color_grey_4', '#adadad') }};
            --color-grey-9: {{ theme_option('color_grey_9', '#f4f5f9') }};
            --color-muted: {{ theme_option('color_muted', '#B6B6B6') }};
            --color-body: {{ theme_option('color_body', '#7E7E7E') }};
        }
    </style>

    @php
        Theme::asset()->remove('language-css');
        Theme::asset()->container('footer')->remove('language-public-js');
        Theme::asset()->container('footer')->remove('simple-slider-owl-carousel-css');
        Theme::asset()->container('footer')->remove('simple-slider-owl-carousel-js');
        Theme::asset()->container('footer')->remove('simple-slider-css');
        Theme::asset()->container('footer')->remove('simple-slider-js');
    @endphp

    {!! Theme::header() !!}

    @php
        $headerStyle = theme_option('header_style') ?: '';
        $page = Theme::get('page');
        if ($page) {
            $headerStyle = $page->getMetaData('header_style', true) ?: $headerStyle;
        }
        $headerStyle = ($headerStyle && in_array($headerStyle, array_keys(get_layout_header_styles()))) ? $headerStyle : '';
    @endphp
</head>
<body @if (BaseHelper::siteLanguageDirection() == 'rtl') dir="rtl" @endif @if (Theme::get('bodyClass')) class="{{ Theme::get('bodyClass') }}" @endif>

<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-NZ3X2F8"
                  height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->


    {!! apply_filters(THEME_FRONT_BODY, null) !!}
    <div id="alert-container"></div>

    {!! Theme::partial('preloader') !!}

<header class="header-area header-style-1 header-height-2 {{ $headerStyle }}">

<div class="header-top header-top-ptb-1 d-none d-lg-block">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-xl-3 col-lg-6">
                <div class="header-info">
                    {!!
                        Menu::renderMenuLocation('header-navigation', [
                            'options' => [],
                            'theme'   => true,
                        ])
                    !!}
                </div>
            </div>
            <div class="col-xl-6 d-none d-xl-block">
                <div class="text-center">
                    @if (theme_option('header_messages') && theme_option('header_messages') != '[]')
                        <div id="news-flash" class="d-inline-block">
                            <ul>
                                @foreach(json_decode(theme_option('header_messages'), true) as $headerMessage)
                                    @if (count($headerMessage) == 4)
                                        <li @if (!$loop->first) style="display: none" @endif>
                                            @if ($headerMessage[0]['value'])
                                                <i class="{{ $headerMessage[0]['value'] }} d-inline-block mr-5"></i>
                                            @endif

                                            @if ($headerMessage[1]['value'])
                                                <span class="d-inline-block">
                                                    {!! clean($headerMessage[1]['value']) !!}
                                                </span>
                                            @endif
                                            @if ($headerMessage[2]['value'] && $headerMessage[3]['value'])
                                                <a class="active d-inline-block" href="{{ url($headerMessage[2]['value']) }}">{!! clean($headerMessage[3]['value']) !!}</a>
                                            @endif
                                        </li>
                                    @endif
                                @endforeach
                            </ul>
                        </div>
                    @endif
                </div>
            </div>
            @php $currencies = is_plugin_active('ecommerce') ? get_all_currencies() : []; @endphp
            <div class="col-xl-3 col-lg-6">
                <div class="header-info header-info-right">
                    <ul>
                        @if (theme_option('hotline'))
                            <li>{{ __('Need help? Call Us:') }} &nbsp;<strong class="text-brand"> {{ theme_option('hotline') }}</strong></li>
                        @endif

                        @if (is_plugin_active('language'))
                            {!! Theme::partial('language-switcher') !!}
                        @endif

                        @if (count($currencies) > 1)
                            <li>
                                <a class="language-dropdown-active" href="#">{{ get_application_currency()->title }} <i class="fi-rs-angle-small-down"></i></a>
                                <ul class="language-dropdown">
                                    @foreach ($currencies as $currency)
                                        <li><a href="{{ route('public.change-currency', $currency->title) }}">{{ $currency->title }}</a></li>
                                    @endforeach
                                </ul>
                            </li>
                        @endif
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

</header>
<div class="mobile-header-active mobile-header-wrapper-style">
<div class="mobile-header-wrapper-inner">
    <div class="mobile-header-top">
        @if (theme_option('logo'))
            <div class="mobile-header-logo">
                <a href="{{ route('public.index') }}"><img src="{{ RvMedia::getImageUrl(theme_option('logo')) }}" alt="{{ theme_option('site_title') }}"></a>
            </div>
        @endif
        <div class="mobile-menu-close close-style-wrap close-style-position-inherit">
            <button class="close-style search-close">
                <i class="icon-top"></i>
                <i class="icon-bottom"></i>
            </button>
        </div>
    </div>
    <div class="mobile-header-content-area">
        @if (is_plugin_active('ecommerce'))
            <div class="mobile-search search-style-3 mobile-header-border">
                <form action="{{ route('public.products') }}" method="get">
                    <input type="text" name="q" placeholder="{{ __('Search for items…') }}" value="{{ request()->input('q') }}" autocomplete="off">
                    <button type="submit"><i class="fi-rs-search"></i></button>
                </form>
            </div>
        @endif
        <div class="mobile-menu-wrap mobile-header-border">
            <!-- mobile menu start -->
            <nav>
                {!!
                    Menu::renderMenuLocation('main-menu', [
                        'options' => ['class' => 'mobile-menu'],
                        'view'    => 'mobile-menu',
                    ])
                !!}
            </nav>
            <!-- mobile menu end -->
        </div>

        <div class="mobile-header-info-wrap">

            @if (is_plugin_active('language'))
                <div class="single-mobile-header-info">
                    <a class="mobile-language-active" href="#"><i class="fi-rs-globe"></i> {{ __('Language') }} <span><i class="fi-rs-angle-down"></i></span></a>
                    <div class="lang-curr-dropdown lang-dropdown-active">
                        <ul>
                            @php
                                $showRelated = setting('language_show_default_item_if_current_version_not_existed', true);
                            @endphp

                            @foreach (Language::getSupportedLocales() as $localeCode => $properties)
                                <li><a rel="alternate" hreflang="{{ $localeCode }}" href="{{ $showRelated ? Language::getLocalizedURL($localeCode) : url($localeCode) }}">{!! language_flag($properties['lang_flag'], $properties['lang_name']) !!} {{ $properties['lang_name'] }}</a></li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            @endif

            @if (count($currencies) > 1)
                <div class="single-mobile-header-info">
                    <a class="mobile-language-active" href="#"><i class="fi-rs-money"></i> {{ __('Currency') }} <span><i class="fi-rs-angle-down"></i></span></a>
                    <div class="lang-curr-dropdown lang-dropdown-active">
                        <ul>
                            @foreach ($currencies as $currency)
                                <li><a href="{{ route('public.change-currency', $currency->title) }}">{{ $currency->title }}</a></li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            @endif

            @if (is_plugin_active('ecommerce'))
                @if (auth('customer')->check())
                    <div class="single-mobile-header-info mobile-customer-info">
                        <a href="{{ route('customer.overview') }}">
                            <img class="svgInject rounded-circle"
                                 alt="{{ __('Account') }}"
                                 src="{{ auth('customer')->check() ? auth('customer')->user()->avatar_url : Theme::asset()->url('imgs/theme/icons/icon-user.svg') }}" />
                        </a>
                        <a href="{{ route('customer.overview') }}"><span class="lable ml-0">{{ auth('customer')->check() ? Str::limit(auth('customer')->user()->name, 20) : __('Account') }}</span></a>
                    </div>
                    <div class="customer-info-wallet">
                        <div class="customer-info-wallet-item">
                            <i class="fi-rs-money"></i> {{number_format(auth('customer')->user()->ubgxu)}} xu
                        </div>

                        <div class="customer-info-wallet-item">
                            <i class="fi-rs-money"></i> {{format_price(auth('customer')->user()->collaborator_balance)}}
                        </div>
                    </div>
                @else
                    <div class="single-mobile-header-info">
                        <a href="{{ route('customer.login') }}"><i class="fi-rs-user"></i> {{ __('Log In / Sign Up') }}</a>
                    </div>
                @endif
            @endif
            @if (theme_option('hotline'))
                <div class="single-mobile-header-info">
                    <a href="tel:{{ theme_option('hotline') }}"><i class="fi-rs-headphones"></i> {{ theme_option('hotline') }}</a>
                </div>
            @endif
        </div>
        @if (theme_option('social_links'))
            <div class="mobile-social-icon mb-50">
                <h6 class="mb-15">{{ __('Follow Us') }}</h6>
                @foreach(json_decode(theme_option('social_links'), true) as $socialLink)
                    @if (count($socialLink) == 3)
                        <a href="{{ $socialLink[2]['value'] }}"
                        title="{{ $socialLink[0]['value'] }}">
                            <img src="{{ RvMedia::getImageUrl($socialLink[1]['value']) }}" alt="{{ $socialLink[0]['value'] }}" />
                        </a>
                    @endif
                @endforeach
            </div>
        @endif
        <div class="site-copyright">{{ theme_option('copyright') }}</div>
    </div>
</div>
</div>
<!--End header-->
