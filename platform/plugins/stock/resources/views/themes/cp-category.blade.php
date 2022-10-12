@extends('plugins/stock::themes.layouts.master')
@section('content')

<main class="cp-wrapper main" id="main">
    <div class="container">
        <h1 class="overview-title">Tổng quan</h1>  
       
        <div class="overview-list">
            <a class="item" href="{{route('public.get-all-contract', 'all')}}">
                <div class="icon">
                    <i class="fa-solid fa-file-lines"></i>
                </div>
                <div class="text">
                    <p>Tổng số hợp đồng</p>
                    <h3>{{ $totalContract }}</h3>
                </div>
            </a>

            <a class="item" href="{{route('public.get-all-contract', 'paid')}}">
                <div class="icon">
                    <i class="fa-solid fa-dollar-sign"></i>
                </div>
                <div class="text">
                    <p>Số hợp đồng đã thanh toán</p>
                    <h3>{{ $paidContract }}</h3>
                </div>
            </a>


            <a class="item" href="{{route('public.get-all-contract', 'paid')}}">
                <div class="icon">
                    <i class="fa-solid fa-clock"></i>
                </div>
                <div class="text">
                    <p>Số hợp đồng chờ thanh toán</p>
                    <h3>{{ $signedContract }}</h3>
                </div>
            </a>

            <a class="item" {{route('public.get-all-contract', 'expired')}}>
                <div class="icon">
                    <i class="fa-solid fa-triangle-exclamation"></i>
                </div>
                <div class="text">
                    <p>Số hợp đồng đã hết hạn</p>
                    <h3>{{ $expiredContract }}</h3>
                </div>
            </a>

            <div class="item item-last">
                <div class="icon">
                    <i class="fa-solid fa-money-bill-trend-up"></i>
                </div>
                <div class="text">
                    <p>Tổng doanh số</p>
                    <h3>{{ number_format($sumContract,0,'','.') }}</h3>
                </div>
            </div>
        </div>
    </div>  
    <a href="{{route('public.check-customer')}}" class="btn-create-cp"><i class="fa-solid fa-file-circle-plus"></i></a>
</main>

@endsection

