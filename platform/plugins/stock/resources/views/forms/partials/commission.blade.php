@php
    $data = json_decode($commission, true);
    $data = $data == null ? [] : $data;
    $totalLevel = \Botble\Ecommerce\Enums\CollaboratorLevelEnums::labels();
@endphp
<div class="alert alert-warning" role="alert">
    <h4 class="alert-heading">{{$title}}</h4>
    <div class="row">
        @forelse($data as $k => $d)
            <div class="col-sm-12">
                <div class="form-group mb-3">
                    <label for="date_of_birth" class="control-label required">Tỷ lệ % cho cấp độ: {{\Botble\Ecommerce\Enums\CollaboratorLevelEnums::compareValue($k)}}</label>
                    <input class="form-control" required placeholder="Tỷ lệ %"
                           name="commission[]" type="number" min="1" max="100"
                           value="{{$d}}">
                </div>
            </div>
        @empty
            @foreach($totalLevel as $k => $d)
                <div class="col-sm-12">
                    <div class="form-group mb-3">
                        <label for="date_of_birth" class="control-label required">Tỷ lệ % cho cấp độ: {{\Botble\Ecommerce\Enums\CollaboratorLevelEnums::compareValue($k)}}</label>
                        <input class="form-control" required placeholder="Tỷ lệ %"
                               name="commission[]" type="number" min="1" max="100"
                               value="0">
                    </div>
                </div>
            @endforeach
        @endforelse
    </div>
</div>
