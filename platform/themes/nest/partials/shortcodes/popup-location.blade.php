@php
    $with = ['slugable'];
    $condition = ['status' => \Botble\Base\Enums\BaseStatusEnum::PUBLISHED];
    $stores = app(\Botble\Marketplace\Repositories\Interfaces\StoreInterface::class)->advancedGet([
        'condition' => $condition,
        'order_by'  => ['created_at' => 'desc'],
        'with'      => $with,
    ]);
@endphp
<div class="ps-popup">
    <div class= "ps-popup__content">
        <a href="" class="ps-popup__close"></a>
        <div class="location-popup-wrapper">
            <h4>Chọn địa điểm mua sắm gần bạn nhất</h4>
            <img src="{{ Theme::asset()->url('imgs/theme/location.svg') }}" class="img-fluid" alt="location-select"/>
            <form action="">
                <div class="form-group">
                    <select name="location-shopping" id="location-shopping" class="form-control">
                        <option value="">-- Chọn khu vực --</option>
                        @foreach($stores as $store)
                            <option value="{{$store->url}}">{{$store->name}}</option>
                        @endforeach
                    </select>
                </div>
            </form>
            <div class="affiliate-popup-confirm">
                <a href="javascript:;" class="location-popup-accept btn btn-fill-out btn-block hover-up">Xác nhận</a>
                <a href="javascript:;" class="affiliate-popup-reject btn btn-fill-out btn-block hover-up">Từ chối</a>
            </div>
        </div>
    </div>
</div>