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
        'customer_info',
        'status',
        'customer_id',
        'presenter_id',
        'contract_info',
        'phone_ref',
        'first_buy_price',
        'first_buy_percentage',
        'percent_paid_by_ubgxu',
        'percent_paid_by_money',
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