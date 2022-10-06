@extends('plugins/stock::themes.layouts.master')
@section('content')

<main class="cp-wrapper main" id="main">
    <div class="container">
        <img src="{{ asset('vendor/core/plugins/stock/images/check-customer-bg.jpg') }}" class="img-responsive bg-ubg-stock">
        <h1 class="overview-title">Kiểm tra tài khoản</h1>  
        <form id="form-check-customer">
            <div class="form-group">
              <label for="phone-number-customer">Số điện thoại</label>
              <input type="tel" id="customer_phone" class="form-control" placeholder="Nhập số điện thoại của khách hàng" required pattern="[0-9]{10}">
              <small class="form-text text-muted">Kiểm tra số điện thoại của khách hàng đã đăng ký tài khoản?</small>
            </div>
            <button type="submit" id="btn-check-customer" class="btn-check-customer btn btn-primary">Kiểm tra</button>

            <div id="cp_customer_info">
                              
            </div>
            
        </form>      
    </div>  
</main>

@endsection

    


@push('scripts')
    

<script type="text/javascript">
    $( document ).ready(function() {
        $('#cp_customer_info').hide();

		$('#form-check-customer').submit(function(e){
            e.preventDefault();      
            var customerPhone = $('#customer_phone').val()   
                urlRegister = 'http://ubg-stock.test/stock/cp-create-customer/' + customerPhone;;
                urlCreateContract = 'http://ubg-stock.test/stock/cp-create-contract/' + customerPhone;

			$.ajax({
				type: 'GET',
				url: '{{route('public.ajax.checkxu')}}',
				data: {
					customer_phone: customerPhone
				},
				success: res => {
					$('#cp_customer_info').show();
                    if(res.data == null){
                        $('#cp_customer_info').html('<div class="text-center"><p>Tài khoản không tồn tại!</p><a href="'+urlRegister+'" class="btn-check-customer btn btn-success btn-sm">Tạo tài khoản</a></div>');
                    }else{
                        var html = '<p>Họ tên: <span id="cp_customer_name">'+res.data.name+'</span></p><p>Điện thoại: <span id="cp_customer_email">'+res.data.phone+'</span></p><a class="btn-sm btn-check-customer btn btn-success" href="'+urlCreateContract+'">Tạo hợp đồng</a>';
                        $('#cp_customer_info').html(html);
                    }
					
				},
				error: res => {
					console.log(res);
				}
			});

            e.preventDefault();
        })

    })
</script>
@endpush