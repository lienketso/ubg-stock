@extends('plugins/stock::themes.layouts.master')
@section('content')

<main class="cp-wrapper main" id="main">
    <div class="container">
        <img src="{{ asset('vendor/core/plugins/stock/images/check-customer-bg.jpg') }}" class="img-responsive bg-ubg-stock">
        <h1 class="overview-title">Tạo tài khoản</h1>  
        <form id="form-check-customer" method="POST" action="{{route('public.cp-create-customer.post')}}">
            @csrf
            <div class="form-group">
              <label for="phone-number-customer">Số điện thoại</label>
                <input class="form-control" name="phone" id="txt-phone" type="text"
                        value="{{ $phone }}" placeholder="Số điện thoại" required pattern="[0-9]{10}">
                @if ($errors->has('phone'))
                    <span class="text-danger">{{ $errors->first('phone') }}</span>
                @endif
              
            </div>
            <div class="form-group">
                <label for="phone-number-name">Họ tên</label>
                <input class="form-control" name="name" id="txt-name" type="text"
                        value="{{ old('name') }}" placeholder="Họ và tên" required>
                @if ($errors->has('name'))
                    <span class="text-danger">{{ $errors->first('name') }}</span>
                @endif
            </div>
            <div class="form-group">
                <label for="phone-number-password">Mật khẩu</label>
                <input class="form-control" type="password" name="password"
                        id="txt-password" placeholder="{{ __('Your password') }} (Tối thiểu 6 ký tự)" required>
                <span class="toggle-show-password">
                    <i class="fi-rs-eye active-icon"></i>
                </span>
                @if ($errors->has('password'))
                    <span class="text-danger">{{ $errors->first('password') }}</span>
                @endif
            </div>
            <div class="form-group">
                <label for="phone-number-password">Nhập lại mật khẩu</label>                

                <input class="form-control" type="password" name="password_confirmation"
                        id="txt-password-confirmation"
                        placeholder="{{ __('Password confirmation') }}" required>
                <span class="toggle-show-password">
                    <i class="fi-rs-eye active-icon"></i>
                </span>
                @if ($errors->has('password_confirmation'))
                    <span class="text-danger">{{ $errors->first('password_confirmation') }}</span>
                @endif
            </div>           
            <button type="submit" id="btn-check-customer" class="btn-check-customer btn btn-primary mt-20">Tạo tài khoản</button>

           
        </form>    
    </div>  
</main>

@endsection