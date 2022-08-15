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
            <div class="location-popup-list">
                <div class="row">
                    @foreach($stores as $store)
                        <div class="col-6">
                            <a href="{{$store->url}}" class="location-popup-item">
                                <img src="{{ Theme::asset()->url('imgs/theme/location.svg') }}" class="img-fluid" alt="location-select"/>
                                <span class="location-popup-title">{{$store->name}}</span>
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="affiliate-popup-confirm">
                <a href="javascript:;" class="affiliate-popup-reject btn btn-fill-out btn-block hover-up">Bỏ qua</a>
            </div>
        </div>
    </div>
</div>
