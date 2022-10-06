<?php

namespace Botble\Stock\Models;

use Botble\Base\Models\BaseModel;
use Botble\Base\Traits\EnumCastable;
use Botble\Ecommerce\Models\Customer;
use Botble\Stock\Enums\ContractPaymentStatusEnum;
use Botble\Stock\Enums\ContractStatusEnum;
use Botble\Stock\Enums\StockTypeEnum;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Contract extends BaseModel
{
    use EnumCastable;
    /**
     * @var string
     */
    protected $table = 'cp_contract';

    /**
     * @var string[]
     */
    protected $fillable = [
        'package_id',
        'customer_id',
        'name',
        'datebirth',
        'phone',
        'ethnic',
        'nationality',
        'passport_number',
        'ngaycap',
        'current_address',
        'address',
        'card_front',
        'card_back',
        'bank_name',
        'account_number',
        'branch',
        'account_holder',
        'type',
        'suat_dau_tu',
        'ky_han',
        'price',
        'total',
        'profit',
        'profit_vnd',
        'profit_xu',
        'contract_code',          
        'status',
        'confirm_id',
        'presenter_id',
    ];

    protected $casts = [
        'status'       => ContractStatusEnum::class
    ];

    /**
     * @return BelongsTo
     */
    public function package(): BelongsTo
    {
        return $this->belongsTo(Package::class,'package_id');
    }

    /**
     * @return BelongsTo
     */
    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class,'customer_id');
    }

}