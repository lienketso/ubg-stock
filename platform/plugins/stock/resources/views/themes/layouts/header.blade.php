<header class="header" id="header">
    <div class="container">
        <div class="main-bar d-flex justify-content-center align-items-center">
            @if (theme_option('logo'))
                <div class="logo logo-width-1">
                    <a href="{{ route('public.index') }}">
                        <img src="{{ asset('vendor/core/plugins/stock/images/logoubg.png') }}" alt="{{ theme_option('site_title') }}">
                    </a>
                </div>
            @endif
            <div class="mobile-menu-button d-block d-sm-none">
                <i class="fa-solid fa-bars"></i>
            </div>
        </div>
    </div>
    <div class="main-navigation">
        <ul>
            <li><a href="{{route('public.index')}}">Tổng quan</a></li>
            <li><a href="{{route('public.get-all-contract', 'paid')}}">Hợp đồng đã thanh toán</a></li>
            <li><a href="{{route('public.get-all-contract', 'unpaid')}}">Hợp đồng chờ thanh toán</a></li>
            <li><a href="{{route('public.get-all-contract', 'expired')}}">Hợp đồng hết hạn</a></li>
            <li><a href="{{ route('public.check-customer')}}">Tạo hợp đồng</a></li>
        </ul>
    </div>
</header>