@php
    Theme::layout('mobile-login');
@endphp

<div class="page-content pt-50 pb-30">
    <div class="container">
        <div class="row">
            <div class="col-xl-12 col-lg-12 col-md-12 m-auto">
                <img class="login-logo border-radius-15" src="{{Theme::asset()->url('imgs/logo.png')}}" alt="{{ theme_option('site_name') }}" />
                <div class="row">
                   
                    <div class="col-lg-6 col-md-8">
                        <div class="login_wrap widget-taber-content background-white">
                            <div class="padding_eight_all bg-white">
                                <div class="heading_s1">
                                    <h1 class="mb-5">{{ __('Login') }}</h1>
                                    {{-- <p class="mb-30">{{ __("Don't have an account?") }} <a href="{{ route('customer.register') }}">{{ __('Create one') }}</a></p> --}}
                                </div>
                                <form method="POST" action="{{ route('customer.login.post') }}">
                                    @csrf
                                    @if (isset($errors) && $errors->has('confirmation'))
                                        <div class="alert alert-danger">
                                            <span>{!! $errors->first('confirmation') !!}</span>
                                        </div>
                                        <br>
                                    @endif
                                    <div class="form-group">
                                        <label for="">Số điện thoại</label>
                                        <input name="phone" required id="txt-phone" type="text" value="{{ old('phone') }}" placeholder="Số điện thoại*">
                                        @if ($errors->has('phone'))
                                            <span class="text-danger">{{ $errors->first('phone') }}</span>
                                        @endif
                                    </div>
                                    <div class="form-group form-password-input">
                                        <label for="">Mật khẩu</label>
                                        <input type="password" required name="password" id="txt-password" placeholder="{{ __('Your password') }}*">
                                        <span class="toggle-show-password">
                                            <i class="fi-rs-eye active-icon"></i>
                                        </span>
                                        @if ($errors->has('password'))
                                            <span class="text-danger">{{ $errors->first('password') }}</span>
                                        @endif
                                    </div>
                                    <div class="login_footer form-group mb-50">
                                        <div class="chek-form">
                                            <div class="custome-checkbox">
                                                <input class="form-check-input" type="checkbox" name="remember" id="remember-checkbox" value="" />
                                                <label class="form-check-label" for="remember-checkbox"><span>{{ __('Remember me') }}</span></label>
                                            </div>
                                        </div>
                                        <a class="text-muted" href="{{ route('customer.password.reset') }}">{{ __('Forgot password?') }}</a>
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-heading btn-block hover-up">{{ __('Login') }}</button>
                                    </div>
         
                                    <div class="text-left">
                                        {!! apply_filters(BASE_FILTER_AFTER_LOGIN_OR_REGISTER_FORM, null, \Botble\Ecommerce\Models\Customer::class) !!}
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
