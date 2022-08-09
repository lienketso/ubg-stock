<div class="alert alert-dark" role="alert">
    <h4 class="alert-heading">{{ $title ?? 'Thông tin tỷ lệ hoa hồng' }}</h4>
    @php
        $data = json_decode($commission);
    @endphp

    @foreach($data as $key => $d)
        <p><b>{{\Botble\Ecommerce\Enums\CollaboratorLevelEnums::compareValue($key)}}</b>: {{$d}}%</p>
    @endforeach
</div>
