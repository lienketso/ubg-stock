@extends('plugins/stock::themes.layouts.master')
@section('content')
<main class="cp-wrapper main" id="main">
    <div class="container">
        <h1 class="text-center create-contract-title">THÔNG TIN HỢP ĐỒNG</h1>
        <img src="{{ asset('vendor/core/plugins/stock/images/check-customer-bg.jpg') }}" class="img-responsive bg-ubg-stock">
         
        {!! Form::open(['route' => 'public.cp-create-contract.post', 'id' => 'form-check-customer', 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
            @csrf
            <h5>Thông tin khách hàng</h5>
            <div class="form-group">
              <label for="phone-number-customer">Số điện thoại</label>
                <input class="form-control" type="text"
                            value="{{ $customer->phone }}" placeholder="Số điện thoại" disabled>  
               
              
            </div>
            <div class="form-group">
                <label for="phone-number-name">Họ tên<span class="required">*</span></label>
                <input class="form-control" name="name" type="text"
                        value="{{ $customer->name }}" placeholder="Họ và tên" disabled>               
            </div>
            @php
                $customerInfo = json_decode($contract->customer_info, true);
                
            @endphp
            <div class="form-group">
                <label for="phone-number-password">Ngày sinh<span class="required">*</span></label>
                <input class="form-control form-date-time" type="text" name="date_of_birth"  value="{{ isset($customerInfo['date_of_birth']) ? $customerInfo['date_of_birth'] : ''}}" 
                     placeholder="Ngày sinh" disabled>
                <span class="toggle-show-password">
                    <i class="fi-rs-eye active-icon"></i>
              
            </div>
            <div class="form-group">
                <label for="phone-number-name">Dân tộc<span class="required">*</span></label>
                <input class="form-control" name="ethnic" type="text"
                        value="{{ isset($customerInfo['ethnic']) ? $customerInfo['ethnic'] : ''}}" placeholder="Dân tộc" disabled>
               
            </div>
            <div class="form-group">
                <label for="phone-number-name">Quốc tịch<span class="required">*</span></label>
                <input class="form-control" name="nationality" type="text"
                        value="{{ isset($customerInfo['nationality']) ? $customerInfo['nationality'] : ''}}" placeholder="Quốc tịch" disabled>
               
            </div>
            <div class="form-group" >
                <label for="phone-number-password">CMND/CCCD/HC<span class="required">*</span></label>               

                <input class="form-control" type="text" name="cmnd" value="{{ isset($customerInfo['cmnd']) ? $customerInfo['cmnd'] : ''}}" 
                        id="txt-password-confirmation"
                        placeholder="" disabled>
                <span class="toggle-show-password">
                    <i class="fi-rs-eye active-icon"></i>
                </span>
              
            </div>     
            <div class="form-group">
                <label for="phone-number-password">Ngày cấp<span class="required">*</span></label>
                <input class="form-control  form-date-time" type="text" name="date_of_issue"   value="{{ isset($customerInfo['date_of_issue']) ? $customerInfo['date_of_issue'] : ''}}" 
                     placeholder="Ngày cấp" disabled>
                <span class="toggle-show-password">
                    <i class="fi-rs-eye active-icon"></i>
                </span>
                
            </div>     
            <div class="form-group">
                <label for="phone-number-password">Nơi cấp<span class="required">*</span></label>
                <input class="form-control" type="text" name="place_of_issue"   value="{{ isset($customerInfo['place_of_issue']) ? $customerInfo['place_of_issue'] : ''}}" 
                     placeholder="" disabled>
                <span class="toggle-show-password">
                    <i class="fi-rs-eye active-icon"></i>
                </span>
              
            </div>   
            <div class="card-upload-wrapper">
                <div class="form-group">
                    <label for="card_front">Ảnh CMND mặt trước <span class="required">*</span></label>
                    <div class="card-upload-inner">
                        <p class="card-upload-button">Tải ảnh lên</p>
                            <img style="width:100%; max-height: 400px" src="{{'/storage/'.$customer->card_front}}" alt="" class="img-responsive">                           
                    </div>
                </div>
            </div>

            <div class="card-upload-wrapper">
                <div class="form-group">
                    <label for="card_back">Ảnh CMND mặt sau <span class="required">*</span></label>
                    <div class="card-upload-inner">                                           
                        <img style="width:100%; max-height: 400px" src="{{'/storage/'.$customer->card_back}}" alt="" class="img-responsive">                        
                    </div>
                </div>
            </div>    

            <div class="form-group">
                <label for="phone-number-password">Địa chỉ thường trú<span class="required">*</span></label>
                <input class="form-control" type="text" name="permanent_address"   value="{{ isset($customerInfo['permanent_address']) ? $customerInfo['permanent_address'] : ''}}" 
                     placeholder="" disabled>
                <span class="toggle-show-password">
                    <i class="fi-rs-eye active-icon"></i>
                </span>
               
            </div>  
            <div class="form-group">
                <label for="phone-number-password">Địa chỉ hiện tại<span class="required">*</span></label>
                <input class="form-control" type="text" name="current_address"   value="{{ isset($customerInfo['current_address']) ? $customerInfo['current_address'] : ''}}" 
                     placeholder="" disabled>
                <span class="toggle-show-password">
                    <i class="fi-rs-eye active-icon"></i>
                </span>
                
            </div>  
            
            <div class="form-group">
                <label for="phone-number-password">Khu vực<span class="required">*</span></label>
               
                    <input class="form-control" type="text" name="area"   value="{{ $contract->area }}" 
                     placeholder="" disabled>
                
            </div>  
            @php
                    $bankInfo = $customer->collaborator_bank_info;
                    $bankName = Arr::get($bankInfo, 'name');
                    $bankNumber = Arr::get($bankInfo, 'number');
                    $bankFullName = Arr::get($bankInfo, 'full_name');
                    $bankBranch = Arr::get($bankInfo, 'branch');

               
            @endphp
            <h5>Thông tin tài khoản ngân hàng</h5>
            <div class="form-group">
                <label for="phone-number-password">Tên ngân hàng<span class="required">*</span></label>
                <input class="form-control" type="text" name="bank_name"   value="{{ $bankName }}" 
                     placeholder="" disabled>
                <span class="toggle-show-password">
                    <i class="fi-rs-eye active-icon"></i>
                </span>
                @if ($errors->has('bank_name'))
                    <span class="text-danger">{{ $errors->first('bank_name') }}</span>
                @endif
            </div>   
            <div class="form-group">
                <label for="phone-number-password">Số tài khoản<span class="required">*</span></label>
                <input class="form-control" type="text" name="account_number"   value="{{ $bankNumber }}" 
                     placeholder="" disabled>
                <span class="toggle-show-password">
                    <i class="fi-rs-eye active-icon"></i>
                </span>
                @if ($errors->has('account_number'))
                    <span class="text-danger">{{ $errors->first('account_number') }}</span>
                @endif
            </div>
            
            <div class="form-group">
                <label for="phone-number-password">Chủ tài khoản<span class="required">*</span></label>
                <input class="form-control" type="text" name="account_holder"   value="{{ $bankFullName }}" 
                     placeholder="" disabled>
                <span class="toggle-show-password">
                    <i class="fi-rs-eye active-icon"></i>
                </span>
                @if ($errors->has('account_holder'))
                    <span class="text-danger">{{ $errors->first('account_holder') }}</span>
                @endif
            </div>  
            <div class="form-group">
                <label for="phone-number-password">Chi nhánh<span class="required">*</span></label>
                <input class="form-control" type="text" name="branch"   value="{{ $bankBranch }}" 
                     placeholder="" disabled>
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
                <select name="type" id="select-payment-type" class="form-control" disabled>
                    <option {{ ($contract->type == 'vnd-ubgxu') ? 'selected' : '' }} value="vnd-ubgxu">Tiền mặt + UBG Xu</option>
                    <option {{ ($contract->type == 'ubgxu') ? 'selected' : '' }} value="ubgxu">UBG Xu</option>
                    <option {{ ($contract->type == 'vnd') ? 'selected' : '' }} value="vnd">Tiền mặt</option>
                </select>
                
            </div>   

            <div class="form-group">
                <label for="phone-number-password">Suất đầu tư(VNĐ)<span class="required">*</span></label>
                <input class="form-control" id="suat_dau_tu" type="number" name="first_buy_price" min="1000" value="{{ $contract->first_buy_price }}" 
                     placeholder="" disabled>
                <span class="toggle-show-password">
                    <i class="fi-rs-eye active-icon"></i>
                </span>
               
            </div>   
            
            @php
                $contractInfo = json_decode($contract->contract_info)
            @endphp
            <div class="form-group">
                <label for="phone-number-password">Giá trên 1 cổ phần<span class="required">*</span></label>
                <input class="form-control" id="gia_co_phan" type="number" name="price" min="1"  value="{{ isset($contractInfo->price) ? $contractInfo->price : '' }}" 
                     placeholder="" disabled>
                
                <span class="toggle-show-password">
                    <i class="fi-rs-eye active-icon"></i>
                </span>
                @if ($errors->has('price'))
                    <span class="text-danger">{{ $errors->first('price') }}</span>
                @endif
            </div>   

            <div class="form-group">
                <label for="phone-number-password">Số lượng cổ phần<span class="required">*</span></label>
                <input class="form-control total-cp" type="text" disabled name="total"  min="1"   value="{{ isset($contractInfo->total) ? $contractInfo->total : '' }}" 
                     placeholder="" disabled>
              
            </div>  
            <div class="form-group">
                <label for="phone-number-password">Kỳ hạn(tháng)<span class="required">*</span></label>
                <input class="form-control" id="ky_han" type="number" name="ky_han" min="1"   value="{{ isset($contractInfo->ky_han) ? $contractInfo->ky_han : '' }}"" 
                     placeholder="" disabled>
                <span class="toggle-show-password">
                    <i class="fi-rs-eye active-icon"></i>
                </span>
                
            </div>   
            <div class="form-group">
                <label for="phone-number-password">Lợi nhuận(%)<span class="required">*</span></label>
                <input class="form-control" id="first_buy_percentage" type="number" name="first_buy_percentage" min="1" max="100"  value="{{ $contract->first_buy_percentage }}" 
                     placeholder="" disabled>
                <span class="toggle-show-password">
                    <i class="fi-rs-eye active-icon"></i>
                </span>
                
            </div>    

            <div class="form-group option-payment-ubgxu">
                <label for="phone-number-password">Lợi tức bằng xu(%)<span class="required">*</span></label>
                <input class="form-control" type="number" id="percent_paid_by_ubgxu" name="percent_paid_by_ubgxu" min="0" max="100"   value="{{ $contract->percent_paid_by_ubgxu}}" 
                     placeholder="" disabled>
                <span class="toggle-show-password">
                    <i class="fi-rs-eye active-icon"></i>
                </span>
                @if ($errors->has('percent_paid_by_ubgxu'))
                    <span class="text-danger">{{ $errors->first('percent_paid_by_ubgxu') }}</span>
                @endif
            </div> 
            <div class="form-group option-payment-vnd">
                <label for="phone-number-password">Lợi tức bằng tiền mặt(%)<span class="required">*</span></label>
                <input class="form-control" type="number" id="percent_paid_by_money" name="percent_paid_by_money" min="0" max="100"  value="{{ $contract->percent_paid_by_money }}" 
                     placeholder="" disabled>
                <span class="toggle-show-password">
                    <i class="fi-rs-eye active-icon"></i>
                </span>
                
            </div> 
           
            {{-- <button type="submit" id="btn-check-customer" class="btn-check-customer btn btn-primary mt-20">Tạo hợp đồng</button> --}}
           
        
        {!! Form::close() !!} 
    </div>  
</main>

@endsection

