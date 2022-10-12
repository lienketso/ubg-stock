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
                <input class="form-control" type="text"
                            value="{{ $customer->phone }}" placeholder="Số điện thoại" disabled>
                <input class="form-control" name="phone" type="hidden"
                        value="{{ $customer->phone }}" placeholder="Số điện thoại" required pattern="[0-9]{10}">        
                @if ($errors->has('phone'))
                    <span class="text-danger">{{ $errors->first('phone') }}</span>
                @endif
              
            </div>
            <div class="form-group">
                <label for="phone-number-name">Họ tên<span class="required">*</span></label>
                <input class="form-control" name="name" type="text"
                        value="{{ $customer->name }}" placeholder="Họ và tên" required>
                @if ($errors->has('name'))
                    <span class="text-danger">{{ $errors->first('name') }}</span>
                @endif
            </div>
            <div class="form-group">
                <label for="phone-number-password">Ngày sinh<span class="required">*</span></label>
                <input class="form-control form-date-time" type="text" name="date_of_birth"  value="{{ old('date_of_birth') }}" 
                     placeholder="Ngày sinh" required>
                <span class="toggle-show-password">
                    <i class="fi-rs-eye active-icon"></i>
                </span>
                @if ($errors->has('date_of_birth'))
                    <span class="text-danger">{{ $errors->first('date_of_birth') }}</span>
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

                <input class="form-control" type="text" name="cmnd" value="{{ old('cmnd') }}" 
                        id="txt-password-confirmation"
                        placeholder="" required>
                <span class="toggle-show-password">
                    <i class="fi-rs-eye active-icon"></i>
                </span>
                @if ($errors->has('cmnd'))
                    <span class="text-danger">{{ $errors->first('cmnd') }}</span>
                @endif
            </div>     
            <div class="form-group">
                <label for="phone-number-password">Ngày cấp<span class="required">*</span></label>
                <input class="form-control  form-date-time" type="text" name="date_of_issue"   value="{{ old('date_of_issue') }}" 
                     placeholder="Ngày cấp" required>
                <span class="toggle-show-password">
                    <i class="fi-rs-eye active-icon"></i>
                </span>
                @if ($errors->has('date_of_issue'))
                    <span class="text-danger">{{ $errors->first('date_of_issue') }}</span>
                @endif
            </div>     
            <div class="form-group">
                <label for="phone-number-password">Nơi cấp<span class="required">*</span></label>
                <input class="form-control" type="text" name="place_of_issue"   value="{{ old('place_of_issue') }}" 
                     placeholder="" required>
                <span class="toggle-show-password">
                    <i class="fi-rs-eye active-icon"></i>
                </span>
                @if ($errors->has('place_of_issue'))
                    <span class="text-danger">{{ $errors->first('place_of_issue') }}</span>
                @endif
            </div>   
            <div class="card-upload-wrapper">
                <div class="form-group">
                    <label for="card_front">Ảnh CMND mặt trước <span class="required">*</span></label>
                    <div class="card-upload-inner">
                        <p class="card-upload-button">Tải ảnh lên</p>

                            <input type="file" name="card_front" accept="image/png, image/gif, image/jpeg" class="card-preview d-none">                       
                            @if($customer->card_front != '')                       
                                <img style="width:100%; max-height: 400px" src="{{'/storage/'.$customer->card_front}}" alt="" class="img-responsive"> 
                            @else
                                <img style="width:100%; max-height: 400px" src="{{ Theme::asset()->url('imgs/theme/card-front.png') }}" alt="" class="img-fluid">
                            @endif
                    </div>
                </div>
            </div>

            <div class="card-upload-wrapper">
                <div class="form-group">
                    <label for="card_back">Ảnh CMND mặt sau <span class="required">*</span></label>
                    <div class="card-upload-inner">
                        <p class="card-upload-button">Tải ảnh lên</p>

                        <input type="file" name="card_back" accept="image/png, image/gif, image/jpeg" class="card-preview d-none">                        
                        @if($customer->card_back != '')                       
                            <img style="width:100%; max-height: 400px" src="{{'/storage/'.$customer->card_back}}" alt="" class="img-responsive"> 
                        @else
                            <img style="width:100%; max-height: 400px" src="{{ Theme::asset()->url('imgs/theme/card-back.png') }}" alt="" class="img-fluid">
                        @endif
                    </div>
                </div>
            </div>    

            <div class="form-group">
                <label for="phone-number-password">Địa chỉ thường trú<span class="required">*</span></label>
                <input class="form-control" type="text" name="permanent_address"   value="{{ old('permanent_address') }}" 
                     placeholder="" required>
                <span class="toggle-show-password">
                    <i class="fi-rs-eye active-icon"></i>
                </span>
                @if ($errors->has('permanent_address'))
                    <span class="text-danger">{{ $errors->first('permanent_address') }}</span>
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
            
            <div class="form-group">
                <label for="phone-number-password">Khu vực<span class="required">*</span></label>
                <select name="area" class="form-control">
                    @foreach(['' => 'Chọn Tỉnh/Thành phố'] + EcommerceHelper::getAvailableProvinces() as $provinceId => $provinceName)
                    <option value="{{ $provinceName }}" {{ (old('area')== $provinceName) ? 'selected' : ''}}>{{ $provinceName }}</option>
                    @endforeach
                </select>
                @if ($errors->has('area'))
                    <span class="text-danger">{{ $errors->first('area') }}</span>
                @endif
            </div>  
            @php
                if($customer->collaborator_bank_info){
                    $bankInfo = $customer->collaborator_bank_info;
                    $bankName = Arr::get($bankInfo, 'name');
                    $bankNumber = Arr::get($bankInfo, 'number');
                    $bankFullName = Arr::get($bankInfo, 'full_name');
                    $bankBranch = Arr::get($bankInfo, 'branch');

                }else{
                    $bankName = old('bank_name');
                    $bankNumber = old('account_number');
                    $bankFullName = old('account_holder');
                    $bankBranch = old('branch');
                }
            @endphp
            <h5>Thông tin tài khoản ngân hàng</h5>
            <div class="form-group">
                <label for="phone-number-password">Tên ngân hàng<span class="required">*</span></label>
                <input class="form-control" type="text" name="bank_name"   value="{{ $bankName }}" 
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
                <input class="form-control" type="text" name="account_number"   value="{{ $bankNumber }}" 
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
                <input class="form-control" type="text" name="account_holder"   value="{{ $bankFullName }}" 
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
                <input class="form-control" type="text" name="branch"   value="{{ $bankBranch }}" 
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
                <select name="type" id="select-payment-type" class="form-control">
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
                <input class="form-control" id="suat_dau_tu" type="number" name="first_buy_price" min="1000" value="{{ old('first_buy_price') }}" 
                     placeholder="" required>
                <span class="toggle-show-password">
                    <i class="fi-rs-eye active-icon"></i>
                </span>
                @if ($errors->has('first_buy_price'))
                    <span class="text-danger">{{ $errors->first('first_buy_price') }}</span>
                @endif
            </div>   
            

            <div class="form-group">
                <label for="phone-number-password">Giá trên 1 cổ phần<span class="required">*</span></label>
                <input class="form-control" id="gia_co_phan" type="number" name="price" min="1"  value="{{ old('price') }}" 
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
                <input class="form-control total-cp" type="text" disabled name="total"  min="1"   value="{{ old('total') }}" 
                     placeholder="" required>
                <input class="form-control total-cp" type="hidden" name="total"  min="1"   value="{{ old('total') }}" 
                     placeholder="" required>
                <span class="toggle-show-password">
                    <i class="fi-rs-eye active-icon"></i>
                </span>
                @if ($errors->has('total'))
                    <span class="text-danger">{{ $errors->first('total') }}</span>
                @endif
            </div>  
            <div class="form-group">
                <label for="phone-number-password">Kỳ hạn(tháng)<span class="required">*</span></label>
                <input class="form-control" id="ky_han" type="number" name="ky_han" min="1"   value="{{ old('ky_han') }}" 
                     placeholder="" required>
                <span class="toggle-show-password">
                    <i class="fi-rs-eye active-icon"></i>
                </span>
                @if ($errors->has('ky_han'))
                    <span class="text-danger">{{ $errors->first('ky_han') }}</span>
                @endif
            </div>   
            <div class="form-group">
                <label for="phone-number-password">Lợi nhuận(%)<span class="required">*</span></label>
                <input class="form-control" id="first_buy_percentage" type="number" name="first_buy_percentage" min="1" max="100"  value="{{ old('first_buy_percentage') }}" 
                     placeholder="" required>
                <span class="toggle-show-password">
                    <i class="fi-rs-eye active-icon"></i>
                </span>
                @if ($errors->has('first_buy_percentage'))
                    <span class="text-danger">{{ $errors->first('first_buy_percentage') }}</span>
                @endif
            </div>    

            <div class="form-group option-payment-ubgxu">
                <label for="phone-number-password">Lợi tức bằng xu(%)<span class="required">*</span></label>
                <input class="form-control" type="number" id="percent_paid_by_ubgxu" name="percent_paid_by_ubgxu" min="0" max="100"   value="{{ old('percent_paid_by_ubgxu') }}" 
                     placeholder="" required>
                <span class="toggle-show-password">
                    <i class="fi-rs-eye active-icon"></i>
                </span>
                @if ($errors->has('percent_paid_by_ubgxu'))
                    <span class="text-danger">{{ $errors->first('percent_paid_by_ubgxu') }}</span>
                @endif
            </div> 
            <div class="form-group option-payment-vnd">
                <label for="phone-number-password">Lợi tức bằng tiền mặt(%)<span class="required">*</span></label>
                <input class="form-control" type="number" id="percent_paid_by_money" name="percent_paid_by_money" min="0" max="100"  value="{{ old('percent_paid_by_money') }}" 
                     placeholder="" required>
                <span class="toggle-show-password">
                    <i class="fi-rs-eye active-icon"></i>
                </span>
                @if ($errors->has('percent_paid_by_money'))
                    <span class="text-danger">{{ $errors->first('percent_paid_by_money') }}</span>
                @endif
            </div> 
            <div class="tong-loi-nhuan text-center" style="color: #00B032; font-size: 15px; padding: 10px 0">
              
            </div>
            <button type="submit" id="btn-check-customer" class="btn-check-customer btn btn-primary mt-20">Tạo hợp đồng</button>
           
        
        {!! Form::close() !!} 
    </div>  
</main>

@endsection



@push('scripts')
    

<script type="text/javascript">
    $( document ).ready(function() {
        $('#select-payment-type').change(function(){
            var selected = $(this).val();
            if(selected === 'ubgxu'){
                $('.option-payment-ubgxu').show();
                $('.option-payment-vnd').hide();
                $('#percent_paid_by_money').val(0);
                $('#percent_paid_by_ubgxu').val(100);
            } else if(selected === 'vnd'){
                $('.option-payment-vnd').show();
                $('.option-payment-ubgxu').hide();
                $('#percent_paid_by_ubgxu').val(0);
                $('#percent_paid_by_money').val(100);
            }else{
                $('.option-payment-vnd').show();
                $('.option-payment-ubgxu').show();
                $('#percent_paid_by_ubgxu').val(50);
                $('#percent_paid_by_money').val(50);
            }
            getTotalCP();
        })


        $('#suat_dau_tu').keyup(function(){
            getTotalCP();
        });
        $('#gia_co_phan').keyup(function(){
            getTotalCP();
        });
        $('#ky_han').keyup(function(){
            getTotalCP();
        });
        $('#percent_paid_by_ubgxu').keyup(function(){
            getTotalCP();
        });
        $('#percent_paid_by_money').keyup(function(){
            getTotalCP();
        });
        $('#first_buy_percentage').keyup(function(){
            getTotalCP();
        });

        function getTotalCP(){
            var suatDauTu = $('#suat_dau_tu').val();
                priceCP = $('#gia_co_phan').val();
                firstBuyPercentage = $('#first_buy_percentage').val();
                percentPaidByUbgxu = $('#percent_paid_by_ubgxu').val();
                percentPaidByMoney = $('#percent_paid_by_money').val();
                kyHan = $('#ky_han').val();
                totalCP = suatDauTu/priceCP;                
                loinhuan = (suatDauTu * firstBuyPercentage/100) / 12 * kyHan;

                // Tính lợi nhuận xu
                totalXu =  addCommas(Math.floor(percentPaidByUbgxu*loinhuan/100)) + ' UBG XU';

                // Tính lợi nhuận VNĐ
                totalVND =  addCommas(Math.floor(percentPaidByMoney*loinhuan/100)) + ' VNĐ';

                loinhuan = totalVND + ' + ' + totalXu;
                

            $('.total-cp').val(Math.floor(totalCP));

            $('.tong-loi-nhuan').html(' <strong>Tổng lợi nhuận:</strong> <span class="text">'+loinhuan+'</span>');
        }

        function addCommas(nStr)
        {
            nStr += '';
            x = nStr.split('.');
            x1 = x[0];
            x2 = x.length > 1 ? '.' + x[1] : '';
            var rgx = /(\d+)(\d{3})/;
            while (rgx.test(x1)) {
                x1 = x1.replace(rgx, '$1' + '.' + '$2');
            }
            return x1 + x2;
        }

    })
</script>
@endpush
