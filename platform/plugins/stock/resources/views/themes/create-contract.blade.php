@extends('plugins/stock::themes.layouts.master')
@section('content')
<main class="cp-wrapper main" id="main">
    <div class="container">
        <h1 class="text-center create-contract-title">TẠO GÓI HỢP ĐỒNG</h1>
        <img src="{{ asset('vendor/core/plugins/stock/images/check-customer-bg.jpg') }}" class="img-responsive bg-ubg-stock">
         
        {!! Form::open(['route' => 'public.cp-create-contract.post', 'id' => 'form-check-customer', 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
            @csrf
            <h5>Thông tin khách hàng</h5>
            <div class="form-group">
              <label for="phone-number-customer">Số điện thoại</label>
                <input class="form-control" name="phone" type="text"
                        value="{{ $phone }}" placeholder="Số điện thoại" required pattern="[0-9]{10}" disabled>
                <input class="form-control" name="phone" type="hidden"
                        value="{{ $phone }}" placeholder="Số điện thoại" required pattern="[0-9]{10}">        
                @if ($errors->has('phone'))
                    <span class="text-danger">{{ $errors->first('phone') }}</span>
                @endif
              
            </div>
            <div class="form-group">
                <label for="phone-number-name">Họ tên<span class="required">*</span></label>
                <input class="form-control" name="name" type="text"
                        value="{{ old('name') }}" placeholder="Họ và tên" required>
                @if ($errors->has('name'))
                    <span class="text-danger">{{ $errors->first('name') }}</span>
                @endif
            </div>
            <div class="form-group">
                <label for="phone-number-password">Ngày sinh<span class="required">*</span></label>
                <input class="form-control form-date-time" type="text" name="datebirth"  value="{{ old('datebirth') }}" 
                     placeholder="Ngày sinh" required>
                <span class="toggle-show-password">
                    <i class="fi-rs-eye active-icon"></i>
                </span>
                @if ($errors->has('datebirth'))
                    <span class="text-danger">{{ $errors->first('datebirth') }}</span>
                @endif
            </div>
            <div class="form-group">
                <label for="phone-number-name">Dân tộc<span class="required">*</span></label>
                <input class="form-control" name="ethnic" type="text"
                        value="{{ old('ethnic') }}" placeholder="Dân tộc" required>
                @if ($errors->has('ethnic'))
                    <span class="text-danger">{{ $errors->first('ethnic') }}</span>
                @endif
            </div>
            <div class="form-group">
                <label for="phone-number-name">Quốc tịch<span class="required">*</span></label>
                <input class="form-control" name="nationality" type="text"
                        value="{{ old('nationality') }}" placeholder="Quốc tịch" required>
                @if ($errors->has('nationality'))
                    <span class="text-danger">{{ $errors->first('nationality') }}</span>
                @endif
            </div>
            <div class="form-group" >
                <label for="phone-number-password">CMND/CCCD/HC<span class="required">*</span></label>                

                <input class="form-control" type="text" name="passport_number" value="{{ old('passport_number') }}" 
                        id="txt-password-confirmation"
                        placeholder="" required>
                <span class="toggle-show-password">
                    <i class="fi-rs-eye active-icon"></i>
                </span>
                @if ($errors->has('passport_number'))
                    <span class="text-danger">{{ $errors->first('passport_number') }}</span>
                @endif
            </div>     
            <div class="form-group">
                <label for="phone-number-password">Ngày cấp<span class="required">*</span></label>
                <input class="form-control  form-date-time" type="text" name="ngaycap"   value="{{ old('ngaycap') }}" 
                     placeholder="Ngày cấp" required>
                <span class="toggle-show-password">
                    <i class="fi-rs-eye active-icon"></i>
                </span>
                @if ($errors->has('ngaycap'))
                    <span class="text-danger">{{ $errors->first('ngaycap') }}</span>
                @endif
            </div>     
            <div class="form-group">
                <label for="phone-number-password">Nơi cấp<span class="required">*</span></label>
                <input class="form-control" type="text" name="noicap"   value="{{ old('noicap') }}" 
                     placeholder="" required>
                <span class="toggle-show-password">
                    <i class="fi-rs-eye active-icon"></i>
                </span>
                @if ($errors->has('noicap'))
                    <span class="text-danger">{{ $errors->first('noicap') }}</span>
                @endif
            </div>   
            <div class="card-upload-wrapper">
                <div class="form-group">
                    <label for="card_front">Ảnh CMND mặt trước <span class="required">*</span></label>
                    <div class="card-upload-inner">
                        <p class="card-upload-button">Tải ảnh lên</p>
                        <input type="file" name="card_front" accept="image/png, image/gif, image/jpeg" class="card-preview d-none">
                        <img src="{{ Theme::asset()->url('imgs/theme/card-front.png') }}" alt="" class="img-fluid">
                    </div>
                </div>
            </div>

            <div class="card-upload-wrapper">
                <div class="form-group">
                    <label for="card_back">Ảnh CMND mặt sau <span class="required">*</span></label>
                    <div class="card-upload-inner">
                        <p class="card-upload-button">Tải ảnh lên</p>
                        <input type="file" name="card_back" accept="image/png, image/gif, image/jpeg" class="card-preview d-none">
                        <img src="{{ Theme::asset()->url('imgs/theme/card-back.png') }}" alt="" class="img-fluid">
                    </div>
                </div>
            </div>    

            <div class="form-group">
                <label for="phone-number-password">Địa chỉ thường trú<span class="required">*</span></label>
                <input class="form-control" type="text" name="address"   value="{{ old('address') }}" 
                     placeholder="" required>
                <span class="toggle-show-password">
                    <i class="fi-rs-eye active-icon"></i>
                </span>
                @if ($errors->has('address'))
                    <span class="text-danger">{{ $errors->first('address') }}</span>
                @endif
            </div>  
            <div class="form-group">
                <label for="phone-number-password">Địa chỉ hiện tại<span class="required">*</span></label>
                <input class="form-control" type="text" name="current_address"   value="{{ old('current_address') }}" 
                     placeholder="" required>
                <span class="toggle-show-password">
                    <i class="fi-rs-eye active-icon"></i>
                </span>
                @if ($errors->has('current_address'))
                    <span class="text-danger">{{ $errors->first('current_address') }}</span>
                @endif
            </div>   
            
            <h5>Thông tin tài khoản ngân hàng</h5>
            <div class="form-group">
                <label for="phone-number-password">Tên ngân hàng<span class="required">*</span></label>
                <input class="form-control" type="text" name="bank_name"   value="{{ old('bank_name') }}" 
                     placeholder="" required>
                <span class="toggle-show-password">
                    <i class="fi-rs-eye active-icon"></i>
                </span>
                @if ($errors->has('bank_name'))
                    <span class="text-danger">{{ $errors->first('bank_name') }}</span>
                @endif
            </div>   
            <div class="form-group">
                <label for="phone-number-password">Số tài khoản<span class="required">*</span></label>
                <input class="form-control" type="text" name="account_number"   value="{{ old('account_number') }}" 
                     placeholder="" required>
                <span class="toggle-show-password">
                    <i class="fi-rs-eye active-icon"></i>
                </span>
                @if ($errors->has('account_number'))
                    <span class="text-danger">{{ $errors->first('account_number') }}</span>
                @endif
            </div>
            
            <div class="form-group">
                <label for="phone-number-password">Chủ tài khoản<span class="required">*</span></label>
                <input class="form-control" type="text" name="account_holder"   value="{{ old('account_holder') }}" 
                     placeholder="" required>
                <span class="toggle-show-password">
                    <i class="fi-rs-eye active-icon"></i>
                </span>
                @if ($errors->has('account_holder'))
                    <span class="text-danger">{{ $errors->first('account_holder') }}</span>
                @endif
            </div>  
            <div class="form-group">
                <label for="phone-number-password">Chi nhánh<span class="required">*</span></label>
                <input class="form-control" type="text" name="branch"   value="{{ old('branch') }}" 
                     placeholder="" required>
                <span class="toggle-show-password">
                    <i class="fi-rs-eye active-icon"></i>
                </span>
                @if ($errors->has('branch'))
                    <span class="text-danger">{{ $errors->first('branch') }}</span>
                @endif
            </div>    

            <h5>Thông tin hợp đồng</h5>
            <div class="form-group">
                <label for="phone-number-password">Trả lãi bằng xu & tiền mặt<span class="required">*</span></label>
                <select name="type" class="form-control">
                    <option {{ (old('type') == 'vnd-ubgxu') ? 'selected' : '' }} value="vnd-ubgxu">Tiền mặt + UBG Xu</option>
                    <option {{ (old('type') == 'ubgxu') ? 'selected' : '' }} value="ubgxu">UBG Xu</option>
                    <option {{ (old('type') == 'vnd') ? 'selected' : '' }} value="vnd">Tiền mặt</option>
                </select>
                <span class="toggle-show-password">
                    <i class="fi-rs-eye active-icon"></i>
                </span>
                @if ($errors->has('type'))
                    <span class="text-danger">{{ $errors->first('type') }}</span>
                @endif
            </div>   

            <div class="form-group">
                <label for="phone-number-password">Suất đầu tư(VNĐ)<span class="required">*</span></label>
                <input class="form-control" type="text" name="suat_dau_tu"   value="{{ old('suat_dau_tu') }}" 
                     placeholder="" required>
                <span class="toggle-show-password">
                    <i class="fi-rs-eye active-icon"></i>
                </span>
                @if ($errors->has('suat_dau_tu'))
                    <span class="text-danger">{{ $errors->first('suat_dau_tu') }}</span>
                @endif
            </div>   
            <div class="form-group">
                <label for="phone-number-password">Kỳ hạn(tháng)<span class="required">*</span></label>
                <input class="form-control" type="number" name="ky_han"   value="{{ old('ky_han') }}" 
                     placeholder="" required>
                <span class="toggle-show-password">
                    <i class="fi-rs-eye active-icon"></i>
                </span>
                @if ($errors->has('ky_han'))
                    <span class="text-danger">{{ $errors->first('ky_han') }}</span>
                @endif
            </div>   

            <div class="form-group">
                <label for="phone-number-password">Giá trên 1 cổ phần<span class="required">*</span></label>
                <input class="form-control" type="number" name="price"   value="{{ old('price') }}" 
                     placeholder="" required>
                <span class="toggle-show-password">
                    <i class="fi-rs-eye active-icon"></i>
                </span>
                @if ($errors->has('price'))
                    <span class="text-danger">{{ $errors->first('price') }}</span>
                @endif
            </div>   

            <div class="form-group">
                <label for="phone-number-password">Số lượng cổ phần<span class="required">*</span></label>
                <input class="form-control" type="number" name="total"   value="{{ old('total') }}" 
                     placeholder="" required>
                <span class="toggle-show-password">
                    <i class="fi-rs-eye active-icon"></i>
                </span>
                @if ($errors->has('total'))
                    <span class="text-danger">{{ $errors->first('total') }}</span>
                @endif
            </div>  
            <div class="form-group">
                <label for="phone-number-password">Lợi nhuận / năm(%)<span class="required">*</span></label>
                <input class="form-control" type="number" name="profit"   value="{{ old('profit') }}" 
                     placeholder="" required>
                <span class="toggle-show-password">
                    <i class="fi-rs-eye active-icon"></i>
                </span>
                @if ($errors->has('profit'))
                    <span class="text-danger">{{ $errors->first('profit') }}</span>
                @endif
            </div>    

            <div class="form-group">
                <label for="phone-number-password">Lợi tức bằng xu / năm(%)<span class="required">*</span></label>
                <input class="form-control" type="number" name="profit_xu"   value="{{ old('profit_xu') }}" 
                     placeholder="" required>
                <span class="toggle-show-password">
                    <i class="fi-rs-eye active-icon"></i>
                </span>
                @if ($errors->has('profit_xu'))
                    <span class="text-danger">{{ $errors->first('profit_xu') }}</span>
                @endif
            </div> 
            <div class="form-group">
                <label for="phone-number-password">Lợi tức bằng tiền mặt / năm(%)<span class="required">*</span></label>
                <input class="form-control" type="number" name="profit_vnd"   value="{{ old('profit_vnd') }}" 
                     placeholder="" required>
                <span class="toggle-show-password">
                    <i class="fi-rs-eye active-icon"></i>
                </span>
                @if ($errors->has('profit_vnd'))
                    <span class="text-danger">{{ $errors->first('profit_vnd') }}</span>
                @endif
            </div> 
            <button type="submit" id="btn-check-customer" class="btn-check-customer btn btn-primary mt-20">Tạo hợp đồng</button>
           
        
        {!! Form::close() !!} 
    </div>  
</main>

@endsection