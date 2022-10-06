<?php

namespace Botble\Stock\Http\Requests;

use Botble\Stock\Enums\ContractStatusEnum;
use Botble\Support\Http\Requests\Request;
use Illuminate\Validation\Rule;

class ContractRequest extends Request
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'card_front' => ['required', 'max:8000'],
            'card_back' => ['required', 'max:8000'],
        ];
    }

    /**
     * @return string[]
     */
    public function messages() : array
    {
        return [
            'card_front.required' => 'Ảnh CMND/CCCD mặt trước không được bỏ trống',
            'card_front.mimes' => 'Ảnh CMND/CCCD mặt trước không đúng định dạng',
            'card_front.max' => 'Dung lượng tối đa cho ảnh CMND/CCCD mặt trước là 8MB',
            'card_back.required' => 'Ảnh CMND/CCCD mặt sau không được bỏ trống',
            'card_back.mimes' => 'Ảnh CMND/CCCD mặt sau không đúng định dạng',
            'card_back.max' => 'Dung lượng tối đa cho ảnh CMND/CCCD mặt sau là 8MB',
        ];
    }

   
}
